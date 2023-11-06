<?php
include 'header.php';
?>
<div id="main-content">
    <h2>All Records</h2>
    <?php
    $conn = mysqli_connect("localhost","root","","houserent") or die("Connection Failed");
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql) or die("Query Unsuccessful");
    
    if(mysqli_num_rows($result)> 0){
    ?>
    <table cellpadding="7px">
        <thead>
        <th>first_name</th>
        <th>last_name</th>
        <th>email</th>
        <th>Operation</th>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['first_name']?></td>
                <td><?php echo $row['last_name']?></td>
                <td><?php echo $row['email']?></td>
                <td>
                    <a href='edit.php?id=<?php echo $row['user_id'];?>'>Edit</a>
                    <a href='delete-inline.php?id=<?php echo $row['user_id'];?>'>Delete</a>
                </td>
            </tr>
           <?php
            }
           ?>
        </tbody>
    </table>
    <?php 
        }
    else{
        echo "<h2>No Record Found</h2>";
         } 
    mysqli_close($conn);
    ?>
</div>
</div>
</body>
</html>
