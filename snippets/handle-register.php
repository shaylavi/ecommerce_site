<?php
session_start();
    require_once '../db-connection.php';
    require_once 'class-definitions.php';
    function registerNewCustomer($firstName, $lastName, $email, $password) {
        $response = (object)'response';
        $response->success = false;
        $response->newURL = isset($_SESSION['currentURL']) ? $_SESSION['currentURL'] : "./loggedin.php";
        if (findCustomer($email)) {
            $response->message = "Customer with this email already exists";
        } else {
            $connection = openConnection();
            $query = $connection->prepare("INSERT INTO `Customers` (`FirstName`,`LastName`,`Email`,`Password`) VALUES (?,?,?,?);");
            $query->bind_param("ssss",$firstName, $lastName, $email, $password);
            
            $password = password_hash($password,PASSWORD_DEFAULT);
            
            $query->execute();
            $query->close();
            $newUser = new User($email,$firstName,$lastName,$password, 0);
            $_SESSION['customer'] = $newUser;
            $response->user = json_encode($newUser);
            $response->success = true;
        }
        
        echo json_encode($response);

    }

    registerNewCustomer($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password']);
?>