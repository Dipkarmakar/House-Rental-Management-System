<?php
session_start(); // Start the session

$conn = mysqli_connect("localhost", "root", "", "houserent") or die("Connection Failed: " . mysqli_connect_error());

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM Owner WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query) or die("Query Failed: " . mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        // Owner exists, login successful
        // Fetch user data
        $row = mysqli_fetch_assoc($result);

        // Store user data in session variables
        $_SESSION['owner_id'] = $row['owner_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['full_name'] = $row['full_name'];

        header('location: owner_profile.php');
        exit(); // Terminate the script after redirection
    } else {
        // Owner does not exist or credentials are incorrect
        echo "Invalid email or password!";
    }
}

mysqli_close($conn);
?>



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
            <button class="second-part"><a href="owner_reg.php" style="text-decoration: none; color: white;">Registration</a></button>
        </div>
    </section>

    <div class="login-container">
        <div class="login-child">
            <h2 class="heading-part">Login for Owner</h2>
            <br>
            <p>Log in with your data that you entered <br>during your registration</p>
            <br>

            <form method="post">
                <span class="hello">Enter your email address</span>
                <br>
                <input class="email-field" type="email" name="email" placeholder="yourmail@gmail.com" required>
                <!-- Use 'email' as the name for the email input field -->
                <br>
                <span class="hello">Enter your Password</span>
                <br>
                <input class="pass-field" type="password" name="password" placeholder="Password" required>
                <br>
                <p class="simple-text">Forget Password</p>
                <br>

                <div>
                    <input type="submit" name="submit" value="Login">
                </div>
            </form>
        </div>
        <div class="Login-image">
            <img src="images/login.jpg" alt="">
        </div>
    </div>
</body>

</html>
