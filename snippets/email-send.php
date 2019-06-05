<?php
    require_once dirname(__DIR__) .'/snippets/src/PHPMailer.php';
    require_once dirname(__DIR__) .'/snippets/src/SMTP.php';
    require_once dirname(__DIR__) .'/snippets/src/Exception.php';
    require_once dirname(__DIR__) .'/db-config.php';

    if( isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['topic']) && isset($_POST['message']))
    {
        sendEmail("", 'Eco-Traveler: '.$_POST['topic'] .' from '.$_POST['firstName'],"from: " . $_POST['email']."<br/><br/>".$_POST['message']);
    } else {
    }
    function sendEmail($recipient, $subject, $body) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPKeepAlive = true;   
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->Username = emailUsername;
        $mail->Password = emailPassword;
        $mail->setFrom('noreply@eco-traveller.com', "Eco-Travellar");
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->IsHTML(true);  
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->SMTPAutoTLS = false;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

        //send the message, check for errors
        if (!$mail->send()) {
            echo "ERROR: " . $mail->ErrorInfo;
        } else {
            echo 200;
        }
    }
    


?>