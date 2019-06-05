<?php 

    require_once '../db-connection.php';
    echo (changePassword($_POST['token'], $_POST['password'])) ;


?>