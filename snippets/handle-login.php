<?php
    require_once '../db-connection.php';

    function validateCustomer($email, $password) {
        $response = (object)'response';
        $response->success = false;
        $password = password_hash($password,PASSWORD_DEFAULT);
                
        $connection = openConnection();

        $email = $connection->real_escape_string($email);
        $email = $connection->real_escape_string($email);

        $query = $connection->prepare("SELECT Email, Password, FirstName, LastName FROM `Customers` WHERE Email = ? AND Password = ?");
        $query->bind_param("ss",$email, $password);
        
        $query->execute();

        $result = $query->get_result();
        
        $numberOfResults = $result->num_rows;
        if ($numberOfResults > 0) {
            $row = $result->fetch_assoc();
            $validUser = new User($row["Email"],$row["FirstName"],$row["LastName"],$row["Password"]);
            $_SESSION['customer'] = $validUser;
            $response->user = json_encode($validUser);
            $response->success = true;
            $response->message = "Login successful";
        } else {
            $response->success = false;
            $response->message = "Username or Password was incorrect.";
        }
        echo json_encode($response);
    }
   validateCustomer($_POST["email"],$_POST["password"]);
?>