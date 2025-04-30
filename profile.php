<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css"/>
    <script>
        function validation() {
    var email =
        document.forms.update.email.value;
    var phone =
        document.forms.update.phnum.value;

    var regEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g; //Javascript reGex for Email Validation.
    var regPhone=/^\d{10}$/;									 // Javascript reGex for Phone Number validation.								 // Javascript reGex for Name validation

    if (email == "" || !regEmail.test(email)) {
        alert("Please enter a valid e-mail address.");
        return false;
        email.focus();
       
    }
    if (phone == "" || !regPhone.test(phone)) {
        alert("Please enter valid phone number.");
        return false;
        phone.focus();
    }
}
</script>
</head>

<body>
    <header>
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
    </header>

<body>
<?php
	include('db.php');
    include('authentication.php');
    $username = $_SESSION['username'];
 
	$query=mysqli_query($con,"select * from `users` where username='$username'");
	$row=mysqli_fetch_array($query);
?>
<form class="form" method="POST" name="update"  onsubmit="return validation()" action="update_profile.php?username=<?php echo $username; ?>">
    <h1 class="login-title">Profile</h1>
		<label>Email</label><input type="text" class="login-input" value="<?php echo $row['email']; ?>" name="email">
		<label>Mobile Number</label><input type="text" class="login-input" value="<?php echo $row['phnum']; ?>" name="phnum">
		<input type="submit" class="login-button" name="update">
		<p class="link"><a href="home.php">Home</a><p>
	</form>
</body>
</html>