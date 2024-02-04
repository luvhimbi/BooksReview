<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if the email is available
    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($emailCheckQuery);

    if ($result->num_rows > 0) {
        echo "<span style='color: red;'>Email is already in use. Please choose another email.</span>";
    } else {
        echo "<span style='color: green;'>Email is available.</span>";
    }
}

$conn->close();
?>
