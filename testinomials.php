<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Cars</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="headers.css"/>
<header>
    <div class="header_input">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="addVehicles.php">Add Vehicle</a></li>
        <li><a href="myVehicles.php">My Vehicles</a></li>
        <li><a href="my_bookings.php">My Bookings</a></li> <!-- As Renter -->
        <li><a href="owner_bookings.php">Bookings for My Vehicles</a></li> <!-- As Owner -->
        <li><a href="testinomials.php">Reviews</a></li> 
        <li><a href="profile.php">Profile</a></li> 
        <li><a href="logout.php">Logout</a></li>
    </ul>
        
</div>
</header>

</head>
<body style="background-image: url('car_banner_home.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat">
<h3 class="login-title" style="font-size:50px;text-align:center">Feedback</h1>
<?php
    require('db.php');
    $query = "SELECT * from `feedback`";
    $result = mysqli_query($con, $query);
    echo "<table border='1' style=  'margin-left: auto;
    margin-right: auto;width:70%'>
    <tr>
    <th>Username</th>
    <th>Rating</th>
    <th>comments</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['rating']."</td>";
        echo "<td>".$row['notes']."</td>";
        echo "</tr>";
   
    }
 ?>
 <p class="link" style="text-align:center; margin-top:20px;"><a href="review.php">Add Review</a></p>
 
</body>
</html>