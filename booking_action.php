<?php
require('db.php');
include('authentication.php');

$rental_id = intval($_GET['rental_id']);
$action = $_GET['action']; // should be 'approve' or 'reject'
$validActions = ['approve', 'reject'];

if (!in_array($action, $validActions)) {
    header("Location: owner_bookings.php");
    exit;
}

$status = $action === 'approve' ? 'approved' : 'rejected';

// Optionally, verify that this rental belongs to the logged-in owner
mysqli_query($con, "UPDATE rentals SET status = '$status' WHERE rental_id = '$rental_id'");

header("Location: owner_bookings.php");
exit;
