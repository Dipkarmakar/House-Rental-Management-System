<?php
include("database.php");
session_start();

$oid = $_SESSION['owner_id'];
$ouname = $_SESSION['username'];
$ofname = $_SESSION['full_name'];

$query = "SELECT * FROM owner WHERE owner_id = $oid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$uname = $row["username"];
$email = $row["email"];
$fname = $row["full_name"];
$phone = $row["phone_number"];
$address = $row["address"];

if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql = "UPDATE owner SET full_name='$name', address='$address', phone_number='$phone' WHERE owner_id='$oid'";
    if (mysqli_query($conn, $sql)) {
        echo "Updated Successfull";
    }
}
if (isset($_POST["delete"])) {

    $sql = "DELETE FROM OWNER WHERE owner_id ='$oid'";
    if (mysqli_query($conn, $sql)) {
        header ('location: HomePage-SEC.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Owner Profile</title>
    <style>
        .header {
            color: white;
            padding: 20px;
            margin: auto;
            display: flex;
            font-size: 22px;
            align-items: center;
            background-color: rgb(10, 100, 110);
        }

        .nav {
            padding-left: 50px;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this data?");
        }
    </script>
</head>

<body>
<header class="header">
        <a href="owner_profile.php">OWNER</a>
        <nav class="nav">
            <a href="owner_add_property.php">ADD PROPERTY</a>
        </nav>
        <nav class="nav">
            <a href="owner_profile_update.php">Edit Profile</a>
        </nav>
        <nav class="nav">
            <a href="owner_login.php">Log Out</a>
        </nav>
    </header>
    <main>
        <div class="container my-y">
            
        <div class="row my-3">
                <div class="col-3">Owner ID:</div>
                <div class="col-5">: <?php echo $oid ?></div>
            </div>
            <div class="row my-3">
                <div class="col-3">User Name:</div>
                <div class="col-5">: <?php echo $uname ?></div>
            </div>
            <div class="row my-3">
                <div class="col-3">Email</div>
                <div class="col-5">: <?php echo $email ?></div>
            </div>
            <div class="row my-3">
                <div class="col-3">Full Name:</div>
                <div class="col-5">: <?php echo $fname ?></div>
            </div>
            <div class="row my-3">
                <div class="col-3">Phone Number:</div>
                <div class="col-5">: <?php echo $phone ?></div>
            </div>
            <div class="row my-3">
                <div class="col-3">Addrss</div>
                <div class="col-5">: <?php echo $address ?></div>
            </div>
            <form action="" method="post">
            <button type="submit" name="updates" class="btn btn-primary">Update Owner Information</button>
            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirmDelete()">Delete owner account</button>
        </form>
        </div>
        </div>
        <?php if(isset($_POST['updates'])) { ?>
            <div class="container my-7">
            <form method="post" class="form">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class = "form-control mb-3">
                <label for="address">Owner Address</label>
                <input type="text" name="address" id="address" class = "form-control mb-3">
                <label for="cost">Phone Number</label>
                <input type="text" name="phone" id="cost" class = "form-control mb-3">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div><?php } ?>
        <hr>
    </main>
</body>

</html>
