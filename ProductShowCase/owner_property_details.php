<?php
include("database.php");
session_start();

$hid = null;
$hname = null;
$haddress = null;
$hcost = null;
$himg = null;

if (isset($_GET['detailID'])) {
    $hid = $_GET['detailID'];
    $sql = "SELECT * FROM house WHERE id='$hid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $hname = $row["house_name"];
    $haddress = $row["address"];
    $hcost = $row["rental_cost"];
    $himg = $row["house_image"];
}

if (isset($_POST["update"])) {
    $hname = $_POST["name"];
    $haddress = $_POST['address'];
    $hcost = $_POST['cost'];

    $sql = "UPDATE house SET house_name='$hname', address='$haddress', rental_cost='$hcost' WHERE id='$hid'";
    if (mysqli_query($conn, $sql)) {
        header('location: owner_property_details.php?detailID=' . $hid);
    }
}

if (isset($_POST['back'])) {
    header('location: owner_profile.php');
}

if (isset($_POST['delete'])) {
    $delete = "DELETE FROM house WHERE id = '$hid'";
    mysqli_query($conn, $delete);
    header("location: owner_profile.php");
}

$oid = $_SESSION['owner_id'];
$ouname = $_SESSION['username'];
$ofname = $_SESSION['full_name'];
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
        <div class="container my-5 fw-bold">
            <img src="<?php echo $himg ?>" alt="House Image" style="width:30%; border-radius: 20px; box-shadow: 0 0 1px .5px black">
            <div class="row my-3" style="font-size: 30px;">
    <div class="col-3" style="font-size: inherit;">Name</div>
    <div class="col-5" style="font-size: inherit;">: <?php echo $hname ?></div>
</div>
<div class="row my-3" style="font-size: 30px;">
    <div class="col-3" style="font-size: inherit;">Address</div>
    <div class="col-5" style="font-size: inherit;">: <?php echo $haddress ?></div>
</div>
<div class="row my-3" style="font-size: 30px;">
    <div class="col-3" style="font-size: inherit;">Cost</div>
    <div class="col-5" style="font-size: inherit;">: <?php echo $hcost ?></div>
</div>

        </div>
        <div class="container my-3">
            <form action="#" method="post" class="form">
                <button type="submit" name="updates" class = "btn btn-success mx-3">Update Details</button>
                <button type="submit" name="back" class = "btn btn-dark mx-3">Back</button>
                <button type="submit" name="delete" class="btn btn-danger mx-3" onclick="return confirmDelete()">Delete</button>
            </form>
        </div>
        <?php if(isset($_POST['updates'])) { ?>
            <div class="container my-7">
            <form method="post" class="form">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class = "form-control mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class = "form-control mb-3">
                <label for="cost">Cost</label>
                <input type="text" name="cost" id="cost" class = "form-control mb-3">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>
        <?php } ?>
    </main>
</body>

</html>
