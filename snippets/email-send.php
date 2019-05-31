<?php
    require_once dirname(__DIR__) .'/snippets/src/PHPMailer.php';
    require_once dirname(__DIR__) .'/snippets/src/SMTP.php';
    require_once dirname(__DIR__) .'/snippets/src/Exception.php';
    require_once dirname(__DIR__) .'/db-config.php';

    if( isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['topic']) && isset($_POST['message']))
    {
        sendEmail("nick.hulley98@gmail.com", 'Eco-Traveler: '.$_POST['topic'] .' from '.$_POST['firstName'],"from: " . $_POST['email']."<br/><br/>".$_POST['message']);
    } else {
    }
    function sendEmail($recipient, $subject, $body) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
    
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = emailUsername;
        $mail->Password = emailPassword;
        $mail->setFrom('noreply@eco-traveller.com');
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $body;
        //send the message, check for errors
        if (!$mail->send()) {
            echo "ERROR: " . $mail->ErrorInfo;
        } else {
            echo 200;
        }
    }
    


?>