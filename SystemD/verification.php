


<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$verificationMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['verificationCode'])) {
        // Verify the entered code
        $verificationCode = $_POST['verificationCode'];

        if (empty($verificationCode)) {
            $verificationMessage = "Verification code is required.";
        } else {
            $sql = "SELECT * FROM users WHERE verification_code = '$verificationCode' AND verified = 0";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Update user as verified
                $row = $result->fetch_assoc();
                $userId = $row['id'];
                $updateSql = "UPDATE users SET verified = 1 WHERE id = $userId";
                if ($conn->query($updateSql) === TRUE) {
                    $verificationMessage = "Verification successful! You can now <a href='login.php'>login</a>.";
                } else {
                    $verificationMessage = "Error updating record: " . $conn->error;
                }
            } else {
                $verificationMessage = "Invalid verification code or user already verified.";
            }
        }
    } elseif (isset($_POST['resend'])) {
        // Resend verification code
        $email = $_POST['resend'];

        $verificationCode = generateVerificationCode();
        $updateSql = "UPDATE users SET verification_code = '$verificationCode' WHERE email = '$email'";

        if ($conn->query($updateSql) === TRUE) {
            sendVerificationEmail($email, $verificationCode);
            $verificationMessage = "New verification code sent. Check your email.";
        } else {
            $verificationMessage = "Error updating verification code: " . $conn->error;
        }
    }
}

$conn->close();

function generateVerificationCode() {
    return bin2hex(random_bytes(16));
}

function sendVerificationEmail($email, $verificationCode) {
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
        $mail->addAddress($email);
        
        $mail->isHTML(true);
        $mail->Subject = 'New Verification Code';
        $mail->Body    = 'Your new verification code is: ' . $verificationCode;

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
    <title>Verification</title>
    <link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #FBF6EE; /* Use the background color you prefer */
        }

        .verification-container {
            text-align: center;
            background-color: #fff; /* White background color */
            border: 1px solid #ccc; /* Border color */
            border-radius: 8px; /* Border-radius */
            padding: 20px; /* Padding */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow */
        }

        h1 {
            color: #007bff; /* Heading color */
        }

        .verification-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 15px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <h1>Verification</h1>
        <p>Enter the verification code sent to your email.</p>
        <form class="verification-form" method="post">
            <div class="form-group">
                <label for="verificationCode">Verification Code:</label>
                <input type="text" id="verificationCode" name="verificationCode" required>
            </div>
            <button type="submit">Verify</button>
        </form>
        
        <div class="verification-message alert alert-success">
            <?php echo $verificationMessage; ?>
        </div>
        
        <div class="countdown">
            Resend verification code in: 
            <span id="countdown">30</span> 
        </div>

        <script src="verify.js"></script>
    </div>


</body>
</html>
