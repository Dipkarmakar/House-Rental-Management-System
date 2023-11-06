<?php include 'header.php'; ?>

<div id="main-content">
    <h2>Update Record</h2>
    <?php
    $conn = mysqli_connect("localhost","root","","houserent") or die("Connection Failed");
    $stu_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = {$stu_id}";
    $result = mysqli_query($conn,$sql) or die("Query Unsuccessful");
    
    if(mysqli_num_rows($result)> 0){
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <form class="post-form" action="updatedata.php" method="post">
      <div class="form-group">
          <label>FIRST_NAME</label>
          <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>"/>
          <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"/>
      </div>
      <div class="form-group">
          <label>LAST_NAME</label>
          <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"/>
      </div>
      <div class="form-group">
          <label>EMAIL</label>
          <input type="text" name="email" value="<?php echo $row['email']; ?>"/>
      </div>
      <input class="submit" type="submit" value="Update"/>
    </form>

    <?php
        }
    }
    ?>
</div>
</div>
</body>
</html>
