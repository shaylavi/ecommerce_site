<?php
require_once 'snippets/class-definitions.php';
require_once 'db-config.php';
include_once 'snippets/email-send.php';

function openConnection()
{
    $connection = new mysqli(dbServer, dbUsername, dbPassword, dbName);
    if ($connection->connect_error) {
        echo "Failed to connect to database";
        die("Connection Failed: " . $connection->connect_error);
        return false;
    }
    return $connection;
}

function makeQuery($sqlStatement)
{
    $connection = openConnection();
    $result = $connection->query($sqlStatement);
    mysqli_close($connection);
    return $result;
}

// function createRecords($tablesName, $arrayOfStrings){
//     $stmt = $connection->prepare("INSERT INTO ".$tablesName." VALUES (?, ?, ?)");
//     $stmt->bind_param("sss", $firstname, $lastname, $email);    
//     $stmt->execute();
// }

function getAllMaterials()
{
    $materials = [];
    $sqlStatement = "SELECT m.* FROM Materials m";
    $result = makeQuery($sqlStatement);
    $numberOfResults = $result->num_rows;
    if ($numberOfResults > 0) {
        while ($row = $result->fetch_assoc()) {
            $newMaterial = new Material($row["Title"], $row["DisplayColour"], $row["DisplayTextColour"]);
            $newMaterial->displayColour = $row["DisplayColour"];
            $newMaterial->textColour = $row["DisplayTextColour"];
            $materials += [$row["MaterialID"] => $newMaterial];
        }
    }
    return $materials;
}

function getAllProducts()
{
    $materials = getAllMaterials();
    $products = [];
    $sqlStatement = "SELECT p.ProductID, p.Title, p.Description, p.Stock, p.Price, p.ImageUrl, p.ImageAlt, c.Title AS Category, m.MaterialID FROM `Products` p, `Materials` m, `Product_Material` pm, `Categorys` c WHERE p.ProductID = pm.ProductID AND pm.MaterialID = m.MaterialID AND p.CategoryID = c.CategoryID ORDER BY p.ProductID";
    $result = makeQuery($sqlStatement);
    $numberOfResults = $result->num_rows;

    if ($numberOfResults > 0) {
        /*
             * There may be some duplicate products due to their materials being differant
             * So we store the previous product and check if it is being repeated, if it is, append 
             * the material to the already made products materials
            */
        while ($row = $result->fetch_assoc()) {
            if (array_key_exists($row["ProductID"], $products)) {
                $products[$row["ProductID"]]->addMaterial($materials[$row["MaterialID"]]);
            } else {
                $newProduct = new Product(
                    $row["Title"],
                    $row["Description"],
                    $materials[$row["MaterialID"]],
                    $row["Stock"],
                    $row["Price"],
                    $row["ImageUrl"],
                    $row["ImageAlt"],
                    $row["Category"]
                );
                $products += [$row["ProductID"] => $newProduct];
            }
        }
    }
    return $products;
}
function guidv4()
{
    if (function_exists('com_create_guid') === true)
        return trim(com_create_guid(), '{}');

    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
function generateResetPassword($email, $path)
{
    if (findCustomer($email) != false) {
        try {
            $connection = openConnection();

            $email2 = $connection->real_escape_string($email);
            $token = guidv4();
            $timestamp = date('Y-m-d G:i:s');

            $query = $connection->prepare("INSERT INTO ResetPassword (tokenID, Email, created) VALUES (?, ?, ?)");
            $query->bind_param("sss", $token, $email2, $timestamp);

            $query->execute();
            $query->close();


            $emailHead = 'Eco-Travellar Password Reset';
            $emailBody = '

        <html>
            <head>
            <title> ' . $emailHead . '</title>
            </head>
            <body>
            <p>To Reset your password, please click <a href=\"'.$path.'?token=' . $token . '\">here</a></p>
            <br>
            <p> Alteratively, open this in a new window: '.$path.'?token=' . $token . '
            <p><b>Note: you have 15 minutes to change your password due to security reasons</b></p>
            </body>
        </html>
        
        ';

            sendEmail($email, $emailHead, $emailBody);

            return 200;
        } catch (\Throwable $th) {
            return "Error occured";
        }
    } else {
        return "Email was not found";
    }
}
function validToken($token)
{
    $connection = openConnection();
    $token = $connection->real_escape_string($token);

    $query = $connection->prepare("SELECT * FROM `ResetPassword` WHERE tokenID = ?");
    $query->bind_param("s", $token);

    $query->execute();

    $result = $query->get_result();
    $query->close();


    $numberOfResults = $result->num_rows;
    if ($numberOfResults > 0) {
        $row = $result->fetch_assoc();

        $connection = openConnection();

        $query = $connection->prepare("DELETE FROM `ResetPassword` WHERE tokenID = ?");
        $query->bind_param("s", $token);

        $query->execute();

        $result = $query->get_result();
        $query->close();

        return $row["Email"];
    } else {
        return false;
    }
}
function changePassword($token, $newPassword)
{
    $email = validToken($token);
    if ($email != false) {
        $connection = openConnection();
        
        $query = $connection->prepare("UPDATE `Customers` SET Password = ? WHERE Email = ?");
        $query->bind_param("ss", $newPassword, $email);

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $query->execute();
        $query->close();

        return 200;
    } else {
        return "Token is not valid";
    }
}
function findCustomer($email)
{
    $connection = openConnection();
    $email = $connection->real_escape_string($email);

    $query = $connection->prepare("SELECT Email, Password, FirstName, LastName FROM `Customers` WHERE Email = ?");
    $query->bind_param("s", $email);

    $query->execute();

    $result = $query->get_result();

    $query->close();
    $numberOfResults = $result->num_rows;
    if ($numberOfResults > 0) {
        $row = $result->fetch_assoc();
        $customer = new User($row["Email"], $row["FirstName"], $row["LastName"], $row["Password"]);
        return $customer;
    } else {
        return false;
    }
}
