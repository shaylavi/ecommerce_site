<?php
    require_once '../db-connection.php';

    function validateCustomer($email, $password) {
        $response = (object)'response';
        $response->success = false;
        
        $currentCustomer = findCustomer($email);
        
        if ($currentCustomer) {
            if($currentCustomer->isValidPassword($password)) {
                $_SESSION['customer'] = $currentCustomer;
                $response->user = json_encode($currentCustomer);
                $response->success = true;
                $response->message = "Login successful";
            } else {
                $response->message = "Username or password was incorrect";
            }
        } else {
            $response->message = "Email was not found.";
        }
        echo json_encode($response);
    }
   validateCustomer($_POST["email"],$_POST["password"]);
?>