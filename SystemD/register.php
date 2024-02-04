<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } else {
        $verificationCode = generateVerificationCode();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, username, email, password, verification_code, verified)
                VALUES ('$name', '$username', '$email', '$hashedPassword', '$verificationCode', 0)";

        if ($conn->query($sql) === TRUE) {
            sendVerificationEmail($email, $name, $verificationCode);
            header("Location: success.php"); // Redirect to the success page
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

function generateVerificationCode() {
    return bin2hex(random_bytes(16));
}

function sendVerificationEmail($email, $name, $verificationCode) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'talifhaniluvhimbi@gmail.com';
        $mail->Password   = 'szutlftfbkkkazwn';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('talifhaniluvhimbi@gmail.com', 'Talifhani');
        $mail->addAddress($email, $name);
        
        $mail->isHTML(true);
        $mail->Subject = 'Account Verification';
        $mail->Body    = 'Your verification code is: ' . $verificationCode;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
