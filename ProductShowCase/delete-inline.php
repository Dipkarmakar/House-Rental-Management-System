<?php

$stu_id = $_GET['id'];

$conn = mysqli_connect("localhost","root","","houserent") or die("Connection Failed");

$sql = "DELETE  FROM users WHERE user_id = {$stu_id}";

$result = mysqli_query($conn,$sql) or die("Query Unsuccessful");

header("Location: http://localhost/database/ProductShowCase/index.php");

mysqli_close($conn);

?>