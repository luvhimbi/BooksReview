<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <!-- Add content for the left section here -->
            <img src="Sign up-rafiki.png" alt="Story Image" class="story-image">
            <h2>Welcome to our platform!</h2>
            <p>Already have an account? <a href="Login.php">Login</a></p>
        </div>
        
        <form class="register-form" action="register.php" method="POST">
            <h1>Create Account</h1>
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span id="emailAvailability"></span>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#email').on('input', function() {
                var email = $(this).val();

                if (email.trim() !== '') {
                    $.ajax({
                        type: 'POST',
                        url: 'check_email_availability.php',
                        data: { email: email },
                        success: function(response) {
                            $('#emailAvailability').html(response);
                        }
                    });
                } else {
                    $('#emailAvailability').html('');
                }
            });
        });
    </script>
</body>
</html>
