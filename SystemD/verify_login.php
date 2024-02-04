<?php
include 'config.php';

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = "Both username and password are required.";
    } else {
        // Check if the username exists in the database
        $userCheckQuery = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($userCheckQuery);

        if ($result->num_rows > 0) {
            // Username exists, now verify the password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session variables and redirect to home page
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                header("Location: home.php"); // Replace 'home.php' with the actual home page URL
                exit();
            } else {
                $_SESSION['error_message'] = "Incorrect password. Please try again.";
            }
        } else {
            $_SESSION['error_message'] = "Username not found. Please check your username or register.";
        }
    }

    header("Location: Login.php"); // Redirect back to the login page
    exit();
}

$conn->close();
?>
