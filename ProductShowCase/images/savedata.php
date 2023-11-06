<?php

$F_name = $_POST['first_name'];
$L_name = $_POST['last_name'];
$Email = $_POST['username'];
$Password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$conn = mysqli_connect("localhost", "root", "", "houserent") or die("Connection Failed");
$sql = "INSERT INTO users(first_name, last_name, email, password) VALUES ('{$F_name}', '{$L_name}', '{$Email}', '{$Password}')";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful:");

header("Location: http://localhost/database/ProductShowCase/Registration-SEC.php");

mysqli_close($conn);
?>