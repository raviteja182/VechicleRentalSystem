<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Add Vechicle</title>
    <link rel="stylesheet" href="style.css"/>


<head>
        <header>
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
        </header>

    </head>
<body>
<?php
require('db.php');
include('authentication.php');
    if(isset($_POST['submit'])){
        $name = stripslashes($_REQUEST['name']);
        $name = mysqli_real_escape_string($con, $name);
        $price = stripslashes($_REQUEST['price']);
        $price = mysqli_real_escape_string($con, $price);
        $description = stripslashes($_REQUEST['description']);
        $description = mysqli_real_escape_string($con, $description);
        $username = $_SESSION['username'];
        $imageName = $_FILES['vehicleImg']['name'];
        $destination = 'Vehicles/'. $imageName;
        move_uploaded_file($_FILES['vehicleImg']['tmp_name'], $destination);

        $query    = "INSERT into `vehicles` (name, username, price, vehicle_img, description)
                     VALUES ('$name','$username', '$price','$imageName','$description')";
        $result   = mysqli_query($con, $query);
        if ($result){
            echo "<div class='form'>
            <h3>You haved added vehicles successfully</h3><br/>
            <p class='link'>Click here to <a href='home.php'>Vehicles</a> again.</p>
            </div>";
            
        } else {
            echo "<div class='form'>
            <h3>Field Missing</h3><br/>
            <p class='link'>Click here to <a href='addVehicles.php'>Add Vehicles</a> again.</p>
            </div>";

        }
    }
    else{
?>
<h1 style="font-size:45px;text-align:center">Vechicle Rental System </h1>  
    <form class="form" action="" method="post" name="addvechicle" enctype="multipart/form-data">
        <h3 class="login-title">Add Vechicle</h3>
        <input type="file" class="login-input" name="vehicleImg" placeholder="Vechicle Image"/>
        <input type="text" class="login-input" name="name" placeholder="Name" required/>
        <input type="text" class="login-input" name="price" placeholder="Price" required/>
        <input type="text" class="login-input" name="description" placeholder="Description" required>
        <input type="submit" value="Add Vechicle" name="submit" class="login-button"/>
  </form>
<?php
}
?>
</body>
</html>