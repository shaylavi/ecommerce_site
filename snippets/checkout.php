<?php
session_start();

require_once '../db-connection.php';

if (isset($_SESSION['cart-items']) && is_array($_SESSION['cart-items'])) {

    $connection = openConnection();
 
    $query = $connection->prepare("INSERT INTO `Customers` (`FirstName`,`LastName`,`Email`,`Password`) VALUES (?,?,?,?);");
    $query->bind_param("ssss",$firstName, $lastName, $email, $password);

    // if (isset($_SESSION['customer'])) {
    // }

    $query->execute();
    $query->close();
}


?>
