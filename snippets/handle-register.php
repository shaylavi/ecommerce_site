<?php
    require_once '../db-connection.php';
    function registerNewCustomer($firstName, $lastName, $email, $password) {
        $response = (object)'response';
        $response->success = false;

        if (findCustomer($email)) {
            $response->message = "Customer with this email already exists";
        } else {
            $connection = openConnection();
            $query = $connection->prepare("INSERT INTO `Customers` (`FirstName`,`LastName`,`Email`,`Password`) VALUES (?,?,?,?);");
            $query->bind_param("ssss",$firstName, $lastName, $email, $password);
            
            $password = password_hash($password,PASSWORD_DEFAULT);
            
            $query->execute();
            $query->close();
            $response->user = json_encode(new User($email,$firstName,$lastName,$password));
            $response->success = true;
        }
        
        echo json_encode($response);

    }

    registerNewCustomer($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password']);
?>