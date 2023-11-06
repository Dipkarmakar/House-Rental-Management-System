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

// CRUD Operations
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $booking_id = $_GET['id'];

    // Delete Booking
    if ($action === 'delete') {
        // Display confirmation dialog
        echo "<script>
                var isConfirmed = confirm('Are you sure you want to delete this booking?');
                if (isConfirmed) {
                    window.location.href = 'manage_bookings.php?action=delete&house_id=$booking_id';
                }
                </script>";
        exit; // Exit to prevent further execution of the page
    }
}

// Actual deletion
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $booking_id = $_GET['house_id'];
    $delete_sql = "DELETE FROM bookings WHERE house_id = '$booking_id'";
    if ($conn->query($delete_sql) === TRUE) {
        $delete_message = "Booking deleted successfully!";
    } else {
        $delete_message = "Error deleting booking: " . $conn->error;
    }
}

// Fetch all bookings
$select_bookings_sql = "SELECT * FROM bookings";
$bookings_result = $conn->query($select_bookings_sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
        }

        a:hover {
            text-decoration: underline;
        }

        .delete-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
    
</head>
<body>

    <header>
        <h2>Manage Bookings</h2>
    </header>

    <?php
    // Display delete message if it exists
    if (isset($delete_message)) {
        echo "<p class='delete-message'>$delete_message</p>";
    }
    ?>

    <table>
        <tr>
           
            <th>House ID</th>
            <th>User ID</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        while($row = $bookings_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['house_id']."</td>";
            echo "<td>".$row['user_id']."</td>";
            echo "<td>".$row['check_in']."</td>";
            echo "<td>".$row['check_out']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td><a href='manage_bookings.php?action=delete&id=".$row['house_id']."'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>