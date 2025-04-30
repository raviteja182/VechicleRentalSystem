<?php
	include('db.php');
	$vehicle_id=$_GET['vehicle_id'];
	$price=$_POST['price'];
	$description=$_POST['description'];
	mysqli_query($con,"update `vehicles` set price='$price', description='$description' where vehicle_id='$vehicle_id'");
	echo "<div class='form'>
    <h3>Updated succesfully</h3><br/>
    <p class='link'>Click here to see items<a href='Home.php'>Home</a></p>
    </div>";
?>