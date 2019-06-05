<?php

    require_once '../db-connection.php';
    echo generateResetPassword($_POST["email"],$_POST["path"]);
?>