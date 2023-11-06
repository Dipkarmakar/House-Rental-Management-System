<?php
$conn = mysqli_connect("localhost", "root", "", "houserent") or die("Connection Failed");

function sanitize_input($data) {
    // Remove leading and trailing whitespaces
    $data = trim($data);
    // Remove backslashes
    $data = stripslashes($data);
    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['submit'])) {
    // Retrieve form data and sanitize inputs
    $name = sanitize_input(mysqli_real_escape_string($conn, $_POST['name']));
    $username = sanitize_input(mysqli_real_escape_string($conn, $_POST['username']));
    $password = sanitize_input(mysqli_real_escape_string($conn, $_POST['password']));
    $email = sanitize_input(mysqli_real_escape_string($conn, $_POST['email']));

    // Basic validation
    if(empty($name) || empty($username) || empty($password) || empty($email)) {
        echo "All fields are required!";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
    } else {
        // Check if the owner already exists
        $check_query = "SELECT * FROM Owner WHERE username = '$username' OR email = '$email'";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            // Owner already exists, handle accordingly (e.g., display an error message)
            echo "Owner with the provided username or email already exists!";
        } else {
            // Owner does not exist, proceed with registration
            $insert_query = "INSERT INTO Owner (username, password, email, full_name) VALUES ('$username', '$password', '$email', '$name')";

            if(mysqli_query($conn, $insert_query)) {
                echo "Registration successful!";
                header ('location: owner_login.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    // Close the connection
    mysqli_close($conn);
}
?>
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
                    <h3>Owner Reg Account</h3>

                    <form method="post">

                        <input type="text" name="name" placeholder="Full Name">
                        <input type="text" name="username" placeholder="username">

                        <input type="email" name="email" placeholder="email">
                        <span>
                            You can use letters, numbers & periods
                        </span>
                        <br>
                        <a href="#">Use my current email address instead</a>

                        <input type="password" name="password" placeholder="Password"><br>
                        Use 8 or characters with a mix of letters, numbers & symbols
                        </span>
                        <br>
                        <div class="b-links">
                            <a href="owner_login.php">Sign in Instead</a>
                            <input type="submit" id="next" value="Submit" name="submit">
                        </div>
                    </form>
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

<?php
mysqli_close($conn);
?>