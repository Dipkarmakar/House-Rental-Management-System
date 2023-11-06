<?php
$stu_name = $_POST['first_name'];
$stu_address = $_POST['last_name'];
$stu_phone = $_POST['email'];

$conn = mysqli_connect("localhost","root","","houserent") or die("Connection Failed");
$sql = "INSERT INTO users(first_name,last_name,email) VALUES ('{$stu_name}','{$stu_address}','{$stu_phone}')";
$result = mysqli_query($conn,$sql) or die("Query Unsuccessful");

header("Location: http://localhost/database/ProductShowCase/index.php");

mysqli_close($conn);

?>