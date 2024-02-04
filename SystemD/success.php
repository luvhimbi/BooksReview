<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <link rel="stylesheet" href="bootstrap.css">
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

        .alert {
            text-align: center;
            background-color: #d4edda; /* Green background color */
            color: #155724; /* Dark green text color */
            border: 1px solid #c3e6cb; /* Border color */
            border-radius: 8px; /* Border-radius */
            padding: 20px; /* Padding */
        }

        .success-icon {
            color: #28a745; /* Green color for the success icon */
        }
    </style>
</head>
<body>
    <div class="alert alert-success">
        <i class="fas fa-check-circle success-icon"></i>
        <h1>Registration Successful!</h1>
        <p>Check your email for a verification code. Click <a href="verification.php">here</a> to verify your account.</p>
    </div>
</body>
</html>
