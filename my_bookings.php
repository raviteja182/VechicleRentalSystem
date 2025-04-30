<?php
require('db.php');
include('authentication.php');

$username = $_SESSION['username'];

// Use prepared statements for security
$query = "
    SELECT r.rental_id, r.vehicle_id, r.rent_date, r.end_date, r.price, r.status, 
           v.name AS vehicle_name, v.vehicle_img 
    FROM rentals r 
    JOIN vehicles v ON r.vehicle_id = v.vehicle_id 
    WHERE r.username = ? 
    ORDER BY r.rent_date DESC
";

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Bookings</title>
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
        <li><a href="my_bookings.php">My Bookings</a></li>
        <li><a href="owner_bookings.php">Bookings for My Vehicles</a></li> 
        <li><a href="testinomials.php">Reviews</a></li> 
        <li><a href="profile.php">Profile</a></li> 
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
    </div>
</header>

<div class="form">
    <h2 style="text-align:center;">My Bookings</h2>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
              <tr>
                <th>Vehicle</th>
                <th>Image</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['vehicle_name']) . "</td>";
            echo "<td><img src='Vehicles/" . htmlspecialchars($row['vehicle_img']) . "' width='100'></td>";
            echo "<td>" . htmlspecialchars($row['rent_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['end_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";

            // Show cancel option only if booking is still active
            if (in_array(strtolower($row['status']), ['pending', 'approved'])) {

                echo "<td><a href='cancel_booking.php?rental_id=" . $row['rental_id'] . "' onclick='return confirm(\"Are you sure you want to cancel this booking?\");'>Cancel</a></td>";
            } else {
                echo "<td>-</td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No bookings found.</p>";
    }
    ?>
</div>

</body>
</html>
