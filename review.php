<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Feedback</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="headers.css"/>
    <link rel="stylesheet" href="star_rating.css"/>
<header>
    <div class="header_input">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="addVehicles.php">Add Vehicle</a></li>
        <li><a href="myVehicles.php">My Vehicles</a></li>
        <li><a href="my_bookings.php">My Bookings</a></li> <!-- As Renter -->
        <li><a href="owner_bookings.php">Bookings for My Vehicles</a></li> <!-- As Owner -->
        <li><a href="testinomials.php">Reviews</a></li> 
        <li><a href="profiles.php">Profile</a></li> 
        <li><a href="logout.php">Logout</a></li>
    </ul>
        
</div>
</header
</head>
<body "background-image: url('car_banner_home.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat">
<?php
  require('db.php');
  include('authentication.php');
  $username = $_SESSION['username'];
  if(isset($_POST["feedback"]))
{ 

  $rating = stripslashes($_REQUEST['rating']);
  //escapes special characters in a string
  $rating = mysqli_real_escape_string($con, $rating);
  $comments = stripslashes($_REQUEST['comments']);
  $comments = mysqli_real_escape_string($con, $comments);
  $query="INSERT into `feedback` (username, rating, notes)
  VALUES ('$username', '$rating','$comments')";
  $result= mysqli_query($con, $query);
  if ($result) {
    echo "<div class='form'>
          <h3>You have given feedback successfully.</h3><br/>
          <p class='link'>Click here to <a href='userHome.php'>Home Page</a></p>
          </div>";
} else {
    echo "<div class='form'>
          <h3>Required fields are missing.</h3><br/>
          <p class='link'>Click here to <a href='feedback.php'>Feedback</a> again.</p>
          </div>";
}
}
else{
?>
<form class="form" method="post"> 
  <span class="star-rating">
  <input type="radio" name="rating" value="1"><i></i>
  <input type="radio" name="rating" value="2"><i></i>
  <input type="radio" name="rating" value="3"><i></i>
  <input type="radio" name="rating" value="4"><i></i>
  <input type="radio" name="rating" value="5"><i></i>
  </span>
  <input type = "text" name="comments" placeholder="Leave Comments" class="form-input">
  <input type = "submit" name="feedback" value="feedback" class="form-button">
  <p class="link" style="text-align:center; margin-top:20px;"><a href="testinomials.php">Reviews</a></p>
 
  </form>

 
<?php
}

?>
</div>