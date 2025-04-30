<!DOCTYPE HTML>

<html>

<head>

    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />

    <head>
        <header>
        <nav>
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
</nav>
            </div>
        </header>

    </head>

<body>
    <div class="form">
        <h3 class="login-title" style="font-size:50px;text-align:center">My Vehicles</h1>
            <?php
            require('db.php');
            include('authentication.php');
            $username = $_SESSION['username'];
            $result = mysqli_query($con, "SELECT * from vehicles where username='$username'");

            echo "<table border='1'> 
 <tr>
 <th>Vehicle</th>
 <th>Name</th>
 <th>Price</th>
<th>Description</th>
 <th>Edit</th>
 <th>Delete</th>
 </tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td><img src='Vehicles/{$row['vehicle_img']}' width='100'></td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
            ?>
                <td><a href="edit.php?vehicle_id=<?php echo $row['vehicle_id']; ?>">Edit</a></td>
                <td><a href="delete.php?vehicle_id=<?php echo $row['vehicle_id']; ?>">Delete</a></td>
            <?php
            }
            ?>
    </div>
</body>