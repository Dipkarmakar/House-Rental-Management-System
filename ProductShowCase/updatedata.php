<?php
$stu_id = $_POST['user_id'];
$stu_name = $_POST['first_name'];
$stu_address = $_POST['last_name'];
$stu_phone = $_POST['email'];

$conn = mysqli_connect("localhost","root","","houserent") or die("Connection Failed");

$sql = "UPDATE users SET first_name = '{$stu_name}', last_name = '{$stu_address}', email = '{$stu_phone}' WHERE user_id = {$stu_id}";

$result = mysqli_query($conn,$sql) or die("Query Unsuccessful");

header("Location: http://localhost/database/ProductShowCase/index.php");

mysqli_close($conn);
?>