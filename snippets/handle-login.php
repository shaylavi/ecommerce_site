<?php
    session_start();
    require_once 'class-definitions.php';
    require_once '../db-connection.php';
    function validateCustomer($email, $password) {
        $incorrectPasswordMessage = "Username or password was incorrect";

        $response = (object)'response';
        $response->success = false;
        $response->newURL = isset($_SESSION['currentURL']) ? $_SESSION['currentURL'] : "./loggedin.php";
        
        $currentCustomer = findCustomer($email);
        
        if ($currentCustomer) {
            if($currentCustomer->isValidPassword($password)) {
                $_SESSION['customer'] = $currentCustomer;
                $response->user = json_encode($currentCustomer);
                $response->success = true;
                $response->message = "Login successful";
            } else {
                $response->message = $incorrectPasswordMessage;
            }
        } else {
            $response->message = $incorrectPasswordMessage;
        }
        echo json_encode($response);
    }
   validateCustomer($_POST["email"],$_POST["password"]);
?>