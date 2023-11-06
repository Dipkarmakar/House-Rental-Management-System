<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="adddata.php" method="post">
        <div class="form-group">
            <label>FIRST_NAME</label>
            <input type="text" name="first_name" />
        </div>
        <div class="form-group">
            <label>LAST_NAME</label>
            <input type="text" name="last_name" />
        </div>
        <div class="form-group">
            <label>EMAIL</label>
            <input type="text" name="email" />
        </div>
        <input class="submit" type="submit" value="Save"  />
    </form>
</div>
</div>
</body>
</html>
