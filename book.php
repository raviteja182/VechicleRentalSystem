<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Booking Details</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<header>
    <div class="container">
        <nav>
            <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="addVehicles.php">Add Vehicle</a></li>
            <li><a href="myVehicles.php">My Vehicle</a></li>
                <li><a href="my_booking.php">My Bookings</a></li>
                <li><a href="testinomials.php">Reviews</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<?php
require('db.php');
include('authentication.php');

$vehicle_id = intval($_GET['vehicle_id']);
$username = $_SESSION['username'];

if (isset($_POST['book'])) {
    $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
    $num_days = intval($_POST['num_days']);

    // Fetch price from DB
    $vehicleResult = mysqli_query($con, "SELECT price FROM vehicles WHERE vehicle_id = '$vehicle_id'");
    if (!$vehicleResult || mysqli_num_rows($vehicleResult) == 0) {
        echo "<div class='form'><h3>Vehicle not found.</h3><p><a href='home.php'>Back</a></p></div>";
        exit;
    }

    $vehicleData = mysqli_fetch_assoc($vehicleResult);
    $price_per_day = $vehicleData['price'];
    $total_price = $price_per_day * $num_days;
    $end_date = date('Y-m-d', strtotime($start_date . " +$num_days days"));

    $queryInsert = "INSERT INTO rentals (vehicle_id, username, price, rent_date, num_days, end_date, status) 
    VALUES ('$vehicle_id', '$username', '$total_price', '$start_date', '$num_days', '$end_date', 'pending')";

    
    if (mysqli_query($con, $queryInsert)) {
        mysqli_query($con, "UPDATE vehicles SET status = 'rented' WHERE vehicle_id = '$vehicle_id'");
        echo "<div class='form'><h3>Booking successful!</h3><p><a href='home.php'>Home</a></p></div>";
    } else {
        echo "<div class='form'><h3>Booking failed.</h3><p><a href='home.php'>Try again</a></p></div>";
    }

} else {
    $query = mysqli_query($con, "SELECT * FROM vehicles WHERE vehicle_id = '$vehicle_id'");
    $vehicle = mysqli_fetch_assoc($query);
    if (!$vehicle) {
        echo "<div class='form'><h3>Vehicle not found.</h3><p><a href='home.php'>Back</a></p></div>";
        exit;
    }
?>

<div class="form">
    <form method="POST" action="">
        <h2 style="text-align:center; color:#FF0000;">Book Vehicle</h2>

        <p><strong>Vehicle:</strong> <?php echo htmlspecialchars($vehicle['name']); ?></p>
        <p><strong>Price per day:</strong> <?php echo htmlspecialchars($vehicle['price']); ?> </p>

        <input type="hidden" name="price" value="<?php echo $vehicle['price']; ?>">

        <label>Start Date:</label>
        <input type="date" name="start_date" class="form-input" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" />
        <br>
        <label>Number of Days:</label>
        <input type="number" name="num_days" class="form-input" min="1" required placeholder="Enter number of days"/>

        <input type="submit" name="book" value="Book Now" class="login-button" />
        <p class="link"><a href="home.php">Back to Vehicle List</a></p>
    </form>
</div>

<?php } ?>

</body>
</html>
