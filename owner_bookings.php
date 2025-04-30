<?php
require('db.php');
include('authentication.php');

$username = $_SESSION['username'];

// Get vehicles owned by this user
$ownerVehicles = mysqli_query($con, "
    SELECT r.*, u.name AS renter_name, v.name AS vehicle_name, v.vehicle_img 
    FROM rentals r
    JOIN vehicles v ON r.vehicle_id = v.vehicle_id
    JOIN users u ON r.username = u.username
    WHERE v.username = '$username'
    ORDER BY r.rent_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="container">
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

<div class="form">
    <h2 style="text-align:center;">Manage Booking Requests</h2>

    <?php
    if (mysqli_num_rows($ownerVehicles) > 0) {
        echo "<table border='1'>
              <tr>
                <th>Vehicle</th>
                <th>Image</th>
                <th>Renter</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($ownerVehicles)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['vehicle_name']) . "</td>";
            echo "<td><img src='Vehicles/" . htmlspecialchars($row['vehicle_img']) . "' width='100'></td>";
            echo "<td>" . htmlspecialchars($row['renter_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['rent_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";

            if ($row['status'] === 'pending') {
                echo "<td>
                        <a href='booking_action.php?rental_id={$row['rental_id']}&action=approve'>Approve</a> | 
                        <a href='booking_action.php?rental_id={$row['rental_id']}&action=reject'>Reject</a>
                      </td>";
            } else {
                echo "<td>-</td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No booking requests.</p>";
    }
    ?>
</div>
</body>
</html>
