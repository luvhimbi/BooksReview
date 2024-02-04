
<?php
include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    if (empty($email)) {
        $message = "Email is required.";
    } else {
        // Check if the email exists in the database
        $userCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($userCheckQuery);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Generate reset token
            $resetToken = generateResetToken();
            $resetTokenTimestamp = date('Y-m-d H:i:s');

            // Update the user's reset_token and reset_token_timestamp
            $updateQuery = "UPDATE users SET reset_token = '$resetToken', reset_token_timestamp = '$resetTokenTimestamp' WHERE email = '$email'";
            $conn->query($updateQuery);

            // Send reset email
            sendResetEmail($email, $user['name'], $resetToken);

            $message = "Reset email sent successfully. Check your email to reset your password.";
        } else {
            $message = "Email not found. Please check your email or register.";
        }
    }
}

$conn->close();

function generateResetToken() {
    return bin2hex(random_bytes(16));
}

function sendResetEmail($email, $name, $resetToken) {
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
            $mail->Subject = 'Password Reset';
            $mail->Body    = 'Click the following link to reset your password: <a href="http://localhost/SystemD/reset_password.php?token=' . $resetToken . '">Reset Password</a>';
    
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <!-- Add content for the left section here -->
            <img src="Forgot password-pana.png" alt="Story Image" class="story-image">
            <h2>Forgot Your Password?</h2>
            <p>No worries, we got you covered. Enter your email below to reset your password.</p>
            <p>Remember your password? <a href="Login.php">Login</a></p>
        </div>
        
        <form class="register-form" method="POST">
            <h1>Reset Password</h1>
            <div id="message"><?php echo $message; ?></div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
