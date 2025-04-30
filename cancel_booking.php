<?php
require('db.php');
include('authentication.php');

$rental_id = intval($_GET['rental_id']);
$username = $_SESSION['username'];

// Verify that the rental belongs to the current user and is still in 'booked' status
$query = mysqli_query($con, "SELECT * FROM rentals WHERE rental_id = '$rental_id' AND username = '$username' AND status = 'booked'");

if (mysqli_num_rows($query) > 0) {
    // Proceed with cancellation
    mysqli_query($con, "UPDATE rentals SET status = 'cancelled' WHERE rental_id = '$rental_id'");
    echo "<div class='form'>
            <h3>Your booking has been successfully cancelled.</h3>
            <p><a href='my_bookings.php'>Back to My Bookings</a></p>
          </div>";
} else {
    echo "<div class='form'>
            <h3>Booking not found or already cancelled.</h3>
            <p><a href='my_bookings.php'>Back to My Bookings</a></p>
          </div>";
}
?>
