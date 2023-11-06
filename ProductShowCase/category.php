<?php
include("database.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style3.css?v=1">
    <title>Category page</title>
</head>

<body>
    <div class="title">
        <center>
            <h1>FIND YOUR DREAM HOME</h1>
        </center>
    </div>
    <?php
    include("search.php");
    ?>
    <main>

        <?php
        $sql = "SELECT * FROM house";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<div class="image">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['house_image']) . '" alt="' . $row['house_name'] . '"><br>';
                echo '</div>';
                echo '<div class="caption">';
                echo '<p class="rate">';
                echo '<i class="fas fa-star"></i>',
                    '<i class="fas fa-star"></i>',
                    '<i class="fas fa-star"></i>',
                    '<i class="fas fa-star"></i>',
                    '<i class="fas fa-star"></i>';
                echo '</p>';
                echo 'House_name: ' . $row['house_name'] . '<br>';
                echo 'Address: ' . $row['address'] . '<br>';
                echo 'Price: $' . $row['rental_cost'] . '<br>';
                echo '<button style=" width:240px;margin-left: 30px;"class="book"><a href="index2.php?data='.$row['id'].'">View more</a></button>';
                echo '</div><br>';
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </main>
</body>

</html>