<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "houserent";

try{
    $conn = mysqli_connect($db_server,
                      $db_user, 
                      $db_pass, 
                      $db_name);
}
catch(mysqli_sql_exception){
    echo"Could not connect!";
}
$result=mysqli_query($conn,"select * from house");
echo"<center>";
echo"<h1>PHP Search Functionality Dropdownlist From Database </h1>";
echo"<h2>Using jQuery Chosen CDN</h2>";
echo "<hr/>";
echo"<select>";
echo"<option>-- Search your range --</option>";
while ($row=mysqli_fetch_array($result))
{
    echo "<option>$row[rental_cost]</option>";
}
echo"</select>";
echo"</center>";
mysqli_close($conn);
?>