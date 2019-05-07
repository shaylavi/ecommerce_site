<?php
    require_once '../db-connection.php';

    function validateCustomer($email, $password) {
        $validUser = false;
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
        } else {
            return false;
        }

        return $validUser;
    }

    $user = validateCustomer($_POST['email'],$_POST['password']);
    if($user === false) {
        echo 200;
    } else {
        // PUT USER INTO SESSION
        echo $user->firstName;
    }
?>