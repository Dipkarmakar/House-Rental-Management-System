<?php include ("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
    <title>Search data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <form method="post" class="form mx-5" style="margin-left: 100px; margin-top: 100px;">
            <input  type="text" placeholder="Search price range"
            name="search">
            <br>
            <button class="btn btn-dark btn-sm" name="submit">Search</button>
        </form>
        <div class="container my-5">
            <table class="table">
                <?php
 if(isset($_POST['submit'])) {
    $search=$_POST['search'];

    $sql= "Select * from `house` where id='$search'
    or house_name='$search' or rental_cost='$search' or address='$search' ";
    $result=mysqli_query($conn,$sql);
    if($result){
        // to check the number of row
        // $num=mysqli_num_rows($result);
        // echo $num; 

        
        if(mysqli_num_rows($result)>0){
            echo '<thead>
            <tr>
           
            <th>house_name</th>
            <th>rental_cost</th>
            <th>address</th>
            </tr>
            </thead>
            ';
           while($row=mysqli_fetch_assoc($result)){ 
            
                    
            echo '<tbody>
            <tr>
             

            <td><a href="index2.php?data='.$row['id'].'">'.$row['house_name'].'</a></td>
            <td>'.$row['rental_cost'].'</td>
            <td>'.$row['address'].'</td>
            </tr>
            </tbody>';
           }
        }else{
            echo '<h2 class=:text-danger>Data not found</h2>'; 
        }
    }
 }     

         ?>
                  
            </table>
        </div>
    </div>
</body>
</html>