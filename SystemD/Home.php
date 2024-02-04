<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Reviews Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa; /* Light gray background */
            margin: 0;
            padding: 20px; /* Added padding for content */
        }

        .container {
            background-color: #ffffff; /* White container background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added box shadow for depth */
            margin-top: 20px;
        }

        h1 {
            color: #007bff; /* Blue heading color */
        }

        h2 {
            color: #28a745; /* Green subheading color */
            margin-top: 30px; /* Increased margin for separation */
        }

        #booksList {
            margin-top: 20px; /* Added margin for spacing */
        }

        .card {
            margin-bottom: 20px;
        }

        .card-title {
            color: #333; /* Dark text color for titles */
        }

        .card-text {
            color: #555; /* Slightly lighter text color for descriptions */
        }

        .btn-primary {
            background-color: #007bff; /* Blue button color */
            border-color: #007bff; /* Blue button border color */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Darker blue border on hover */
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'Navbar.php'
    ?>
    <div class="container">

        <h1>Hi, <?php echo $_SESSION['username']; ?>!<br />
            Welcome to the Book Reviews Dashboard!
        </h1>

      
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
