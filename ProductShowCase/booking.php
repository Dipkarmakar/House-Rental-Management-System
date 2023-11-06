<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "houserent";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$success_message = "";
// Process booking form submission
if(isset($_POST['book_property'])){
    $house_id = $_POST['house_id'];
    $user_id = $_POST['user_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Check if the selected house_id exists in the houses table
    $check_house_sql = "SELECT id FROM house WHERE id = '$house_id'";
    $result = $conn->query($check_house_sql);

    if ($result->num_rows > 0) {
        // Insert booking into bookings table with status 'pending'
        $insert_sql = "INSERT INTO bookings (house_id, user_id, check_in, check_out, status) VALUES ('$house_id', '$user_id', '$check_in', '$check_out', 'pending')";

        if ($conn->query($insert_sql) === TRUE) {
            $success_message = "Booking successful!";
            header("Location: manage_bookings.php");
            exit();
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: House with ID $house_id does not exist.";
    }
}

// Fetch available houses for booking
$select_houses_sql = "SELECT * FROM house";
$houses_result = $conn->query($select_houses_sql);

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px; /* Adjust the width as needed */
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php
    // Display success message if it exists
    if (!empty($success_message)) {
        echo "<p style='color: green; font-weight: bold; text-align: center;'>$success_message</p>";
    }
    ?>

    <form action="booking.php" method="post">
        <h2 style="text-align: center;">Book a Property</h2>

        <label for="house_id">Select Property:</label>
        <select name="house_id" id="house_id">
            <?php
            while($row = $houses_result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['house_name'] . "</option>";

            }
            ?>
        </select>
        <br>

        <label for="user_id">Your User ID:</label>
        <input type="text" name="user_id" required>
        <br>

        <label for="check_in">Check-in Date:</label>
        <input type="date" name="check_in" required>
        <br>

        <label for="check_out">Check-out Date:</label>
        <input type="date" name="check_out" required>
        <br>

        <input type="submit" name="book_property" value="Book Now">
    </form>

</body>
</html>
