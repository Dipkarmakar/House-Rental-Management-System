<?php
include("database.php");
session_start();
$oid = $_SESSION['owner_id'];
$ouname = $_SESSION['username'];
$ofname = $_SESSION['full_name'];
$message = null;

if (isset($_POST["Publish"])) {
    $hname = $_POST['hname'];
    $haddress = $_POST['haddress'];
    $hcost = $_POST['hcost'];

    // Handle image upload
    $targetDir = "uploads/"; // Create a directory to store uploaded images
    $targetFile = $targetDir . basename($_FILES["house_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is a actual image or fake image
    $check = getimagesize($_FILES["house_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["house_image"]["size"] > 500000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= " Your image was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["house_image"]["tmp_name"], $targetFile)) {
            $message = "Successfully uploaded and inserted.";
            // Now you can store $targetFile path in the database if needed
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }

    // Using prepared statement to prevent SQL injection
    $insert = $conn->prepare("INSERT INTO `house`(`house_name`,`address`,`rental_cost`,`owner_id`,`house_image`) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("sssss", $hname, $haddress, $hcost, $oid, $targetFile);

    if ($insert->execute()) {
        header('location: owner_profile.php');
    } else {
        $message .= " Error: " . $insert->error;
    }

    $insert->close();
} elseif (isset($_POST['back'])) {
    header('location: owner_profile.php');
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
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .header {
            color: white;
            padding: 20px;
            margin: auto;
            display: flex;
            font-size: 22px;
            align-items: margin-right;
            background-color: rgb(10, 100, 110);
        }

        .nav {
            padding-left: 50px;
        }

        a {
            text-decoration: none;
            color: white;
            decoration: none;
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
            <a href="owner_login.php">Log Out</a>
        </nav>
    </header>
    <main>
        <div class="container my-5">
            <div class="container">
                <h2>hello, <span>
                        <?php echo $ofname; ?>
                    </span>. Please add your property details.</h2>
                <hr>
            </div>
            <form method="post" enctype="multipart/form-data">
                <label>House Name:</label>
                <input type="text" name="hname" required placeholder="Enter the house name..." class="form-control">
                <label>House Address:</label>
                <input type="text" name="haddress" required placeholder="Enter the house address..."
                    class="form-control">
                <label>Rental Cost:</label>
                <input type="number" name="hcost" required placeholder="Enter the rent cost..." class="form-control">
                <label>House Image:</label>
                <input type="file" name="house_image" class="form-control-file" accept="image/*">

                <button type="submit" name="Publish" class="btn btn-primary my-2">
                    Publish
                </button>
            </form>
        </div>
    </main>
</body>

</html>