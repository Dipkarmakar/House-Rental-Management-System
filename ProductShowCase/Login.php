<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="Login.css">
</head>

<body>
    <section class="upper-part">
        <div>
            <img class="img-house" src="./house-solid.svg" alt="">
        </div>

        <div class="title-part">
            <p>House Rent</p>
        </div>

        <div class="nav-btn">
            <button class="second-part">Register</button>
        </div>
    </section>

    <div class="login-container">
        <div class="login-child">
            <h2 class="heading-part">Login To Continue</h2>
            <br>
            <p>Log in with your data that you entered <br>during your registration</p>
            <br>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Server-side validation
                $user = sanitize_input($_POST['user']);
                $password = sanitize_input($_POST['password']);

                if (empty($user) || empty($password)) {
                    echo "<p class='error'>Both email and password are required!</p>";
                } else {
                    // Perform login or other actions
                    // Add your logic here
                }
            }

            function sanitize_input($data) {
                // Remove leading and trailing whitespaces
                $data = trim($data);
                // Remove backslashes
                $data = stripslashes($data);
                // Convert special characters to HTML entities
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <span class="hello">Enter your email address</span>
                <br>
                <input class="email-field" type="email" name="user" placeholder="yourmail@gmail.com" required>
                <br>
                <span class="hello">Enter your Password</span>
                <br>
                <input class="pass-field" type="password" name="password" placeholder="Password" required>
                <br>
                <p class="simple-text">Forget Password</p>
                <br>

                <div>
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
        <div class="Login-image">
            <img src="images/login.jpg" alt="">
        </div>
    </div>
</body>

</html>
