<?php
	include('db.php');
	$username=$_GET['username'];
    $email=$_POST['email'];
	$phnum=$_POST['phnum'];
	mysqli_query($con,"update `users` set email='$email', phnum='$phnum' where username='$username'");
	echo "<div class='form'>
    <h3>Updated succesfully</h3><br/>
    <p class='link'>Click here to see vehicles<a href='Home.php'>Home</a></p>
    </div>";
?>