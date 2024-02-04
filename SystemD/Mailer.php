<?php
// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'talifhaniluvhimbi@gmail.com';   // SMTP username
    $mail->Password   = 'szutlftfbkkkazwn';     // SMTP password
    $mail->SMTPSecure = 'tls';                // Enable TLS encryption
    $mail->Port       = 587;                  // TCP port to connect to

    //Recipients
    $mail->setFrom('talifhaniluvhimbi@gmail.com', 'Talifhani');
    $mail->addAddress('talifhaniluvhimbi@gmail.com', 'talifhani'); // Add a recipient

    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = '<h1>Hello</h1>';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
