<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
  
</head>
<body>
    <div class="container">
        <div class="left-section">
            <!-- Add content for the left section here -->
            <img src="Login-pana (1).png" alt="Story Image" class="story-image">
            <h2>Welcome back!</h2>
            <p>New to our platform? <a href="RegisterPage.php">Create an account</a></p>
            
        </div>
        
        <form class="register-form" action="verify_login.php" method="POST">
            <h1>Login</h1>
            <?php
            session_start(); // Start the session

            // Display error message if set
            if (isset($_SESSION['error_message'])) {
                echo '<p class=" error-message">' . $_SESSION['error_message'] . '</p>';
                unset($_SESSION['error_message']); // Clear the session variable
            }
            ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
            <p>Forgot your password? <a href="ForgetPassword.php">Reset Password</a></p>
        </form>
    </div>
</body>
</html>
