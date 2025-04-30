<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css"/>
</head>

<body>
    <header>
       
    <nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="addVehicles.php">Add Vehicle</a></li>
        <li><a href="myVehicles.php">My Vehicles</a></li>
        <li><a href="my_bookings.php">My Bookings</a></li> 
        <li><a href="owner_bookings.php">Bookings for My Vehicles</a></li> 
        <li><a href="testinomials.php">Reviews</a></li> 
        <li><a href="profiles.php">Profile</a></li> 
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
    </header>

    <div class="form">
        <h3 class="login-title" style="font-size:50px;text-align:center">Vehicles</h3>

        <?php
        require('db.php');
        include('authentication.php');

        $result = mysqli_query($con, "SELECT vehicles.name as vehicle_name, users.name as username, price, description, vehicle_img, phnum, vehicle_id FROM vehicles JOIN users ON users.username=vehicles.username");

        echo "<table border='1'>
              <tr>
                  <th>Vehicle</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Owner Name</th>
                  <th>Contact Details</th>
                  <th>Book</th>
              </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td><img src='Vehicles/{$row['vehicle_img']}' width='100'></td>";
            echo "<td>" . htmlspecialchars($row['vehicle_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phnum']) . "</td>";
            echo "<td><a href='book.php?vehicle_id=" . $row['vehicle_id'] . "'>Book</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        ?>

    </div>
</body>
</html>
