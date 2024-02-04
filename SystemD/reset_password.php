<?php
include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $token = $_GET['token'];

    if (empty($token)) {
        $message = "Invalid token. Please use the link provided in your email.";
    } else {
        // Check if the token exists in the database
        $tokenCheckQuery = "SELECT * FROM users WHERE reset_token = '$token'";
        $result = $conn->query($tokenCheckQuery);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userId = $user['id'];

            // Display the password reset form
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $newPassword = $_POST['new_password'];
                $confirmPassword = $_POST['confirm_password'];

                if (empty($newPassword) || empty($confirmPassword)) {
                    $message = "Both new password and confirm password are required.";
                } else {
                    if ($newPassword == $confirmPassword) {
                        // Update the user's password
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $updateQuery = "UPDATE users SET password = '$hashedPassword', reset_token = NULL, reset_token_timestamp = NULL WHERE id = $userId";
                        $conn->query($updateQuery);

                        $message = "Password reset successfully. You can now <a href='Login.php'>login</a> with your new password.";
                    } else {
                        $message = "New password and confirm password do not match. Please try again.";
                    }
                }
            }
        } else {
            $message = "Invalid token. Please use the link provided in your email.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form class="register-form" method="post">
            <h1>Reset Password</h1>
            <div id="message"><?php echo $message; ?></div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
