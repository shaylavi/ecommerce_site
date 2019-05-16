<?php
require_once 'snippets/class-definitions.php';
require_once 'db-config.php';

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
function findCustomer($email) {
    $connection = openConnection();
     
    $email = $connection->real_escape_string($email);

    $query = $connection->prepare("SELECT Email, Password, FirstName, LastName FROM `Customers` WHERE Email = ?");
    $query->bind_param("s",$email);
    
    $query->execute();

    $result = $query->get_result();
    
    $numberOfResults = $result->num_rows;
    if ($numberOfResults > 0) {
        $row = $result->fetch_assoc();
        $customer = new User($row["Email"],$row["FirstName"],$row["LastName"],$row["Password"]);
        return $customer;
    } else {
        return false;
    }
}

