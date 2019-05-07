<?php
    require_once '../db-connection.php';
    function registerNewCustomer($firstName, $lastName, $email, $password) {
        $newUser = false;

        $connection = openConnection();
        $query = $connection->prepare("INSERT INTO `Customers` (`FirstName`,`LastName`,`Email`,`Password`) VALUES (?,?,?,?);");
        $query->bind_param("ssss",$firstName, $lastName, $email, $password);
        
        $password = password_hash($password,PASSWORD_DEFAULT);
        
        $query->execute();
        $query->close();

        $newUser = new User($email,$firstName,$lastName,$password);
        return $newUser;

    }

    $user = registerNewCustomer($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['password']);
    if($user === false) {
        echo 200;
    } else {
        // PUT USER INTO SESSION
        echo $user->firstName;
    }
?>