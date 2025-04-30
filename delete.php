<?php
    $product_id=$_GET['product_id'];
    include('db.php');
    $result = mysqli_query($con, "SELECT * from `vehicles` where vehicle_id='$vehicle_id'");
    $row=mysqli_fetch_array($result);
    unlink("Vehicles/".$row['imageName']);
    mysqli_query($con,"delete from `vehicles` where vehicle_id='$vehicle_id'");
    echo "<div class='form'>
    <h3>Deleted succesfully</h3><br/>
    <p class='link'>Click here to see products<a href='home.php'>Vehicles</a></p>
    </div>";
?>