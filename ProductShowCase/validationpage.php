<?php
$conn = mysqli_connect("localhost", "root", "", "houserent");

mysqli_select_db($conn, 'houserent');

$name = $_POST['user'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($pass, $row['password'])) {
        header("Location: http://localhost/database/ProductShowCase/HomePage-SEC.php");
        exit();
    }
}

header("Location: http://localhost/database/ProductShowCase/Login.php");
exit();

mysqli_close($conn);
?>