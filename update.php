<?php
	include('db.php');
	$product_id=$_GET['product_id'];
	$price=$_POST['price'];
	$description=$_POST['description'];
	mysqli_query($con,"update `products` set price='$price', description='$description' where product_id='$product_id'");
	echo "<div class='form'>
    <h3>Updated succesfully</h3><br/>
    <p class='link'>Click here to see items<a href='Home.php'>Home</a></p>
    </div>";
?>