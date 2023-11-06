<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>House Rental Registration</title>
    <link rel="stylesheet" type="text/css" href="Registration-SEC.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="left">
                <div class="Registration Form">
                    <div class="logo">House <span>Rental</span></div>
                    <h3>Create Your Account</h3>

                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "houserent") or die("Connection Failed");
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful...");
                    ?>

                    <form method="post" action="savedata.php">

                        <input type="text" name="first_name" placeholder="First Name">
                        <input type="text" name="last_name" placeholder="Last Name">

                        <input type="email" name="username" placeholder="Username">
                        <span>
                            You can use letters, numbers & periods
                        </span>
                        <br>
                        <a href="#">Use my current email address instead</a>

                        <input type="password" name="password" placeholder="Password">
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                        <span>
                            Use 8 or characters with a mix of letters, numbers & symbols
                        </span>
                        <br>
                        <input type="checkbox" class="checkbox">
                        <span>Show Password</span>
                        <div class="b-links">
                            <a href="#">Sign in Instead</a>
                            <input type="submit" id="next" value="Submit">
                        </div>
                    </form>

                    <?php
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
            <div class="right">
                <img src="images/reg.jpg" alt="Houses">
                <p>
                    Turning Houses into Homes
                </p>
            </div>
        </div>
    </header>
</body>
</html>
