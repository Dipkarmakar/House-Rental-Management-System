<?php
include("database.php");
session_start();

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
        <div class="container my-5">
            <h2>Hello, <span><?php echo $ofname; ?></span></h2>
        </div>
        <hr>
        
        <div class="container">
            <div class="row">
                <?php
                    $query = "SELECT * FROM house WHERE owner_id = $oid";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $img = $row["house_image"];
                            $hname = $row['house_name'];
                            $hcost = $row['rental_cost'];
                            $hid = $row['id'];
                            echo '<div class="card my-5 mx-5" style="width: 18rem;">
                                    <img src="' . $img . '" class="card-img-top" alt="Property Image">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $hname . '</h5>
                                        <p class="card-text">Rental Cost: ' . $hcost . '</p>
                                        <a href="owner_property_details.php?detailID=' . $hid . '" class="btn btn-primary">Details</a>
                                    </div>
                                </div>';
                        }
                    }
                ?>
            </div>
        </div>
    </main>
</body>

</html>
