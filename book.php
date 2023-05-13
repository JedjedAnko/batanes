<!DOCTYPE html>
<html>

<head>
  <title>Booking Details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.5;
      margin: 0;
    }

    h1,
    h2 {
      text-align: center;
    }

    h2 {
      margin: 30px 0;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    .payment-info p {
      font-weight: bold;
      margin: 20px 0;
    }

    .payment-info p:last-of-type {
      margin-bottom: 0;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Booking Details</h1>
    <h2>Customer Information</h2>
    <p>Name: <?php echo $_GET["name"]; ?></p>
    <p>Email: <?php echo $_GET["email"]; ?></p>
    <h2>Reservation Information</h2>
    <p>Destination: <?php echo $_GET["destination"]; ?></p>
    <p>Number of Adults: <?php echo $_GET["adults"]; ?></p>
    <p>Number of Kids: <?php echo $_GET["kids"]; ?></p>
    <p>Room Type: <?php echo $_GET["roomtype"]; ?></p>
    <p>Check-In: <?php echo $_GET["checkin"]; ?></p>
    <p>Check-Out: <?php echo $_GET["checkout"]; ?></p>
    <?php
    $adults = $_GET["adults"];
    $kids = $_GET["kids"];
    $roomtype = $_GET["roomtype"];
    $checkin = strtotime($_GET["checkin"]);
    $checkout = strtotime($_GET["checkout"]);
    $num_nights = ($checkout - $checkin) / 86400; // number of nights rounded to nearest integer
    if ($num_nights < 1) {
      $num_nights = 1;
    }
    if ($roomtype == "luxury") {
      $price_per_night = 1000;
    } elseif ($roomtype == "premium") {
      $price_per_night = 500;
    } else {
      $price_per_night = 250;
    }
    $subtotal = $price_per_night * $num_nights * ($adults + $kids);
    $tax_rate = 0.12;
    $tax = $subtotal * $tax_rate;
    $total = $subtotal + $tax;
    ?>
    <h2>Payment Information</h2>
    <div class="payment-info">
      <p>Subtotal: <?php echo "₱" . number_format($subtotal, 2); ?></p>
      <p>Tax (<?php echo $tax_rate * 100 . "%"; ?>): <?php echo "₱" . number_format($tax, 2); ?></p>
      <p>Total: <?php echo "₱" . number_format($total, 2); ?></p>
    </div>
  </div>
</body>

</html>

<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "batanes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO bookings (name, email, destination, adults, kids, roomtype, checkin, checkout, subtotal, tax, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiisssddd", $name, $email, $destination, $adults, $kids, $roomtype, $checkin_str, $checkout_str, $subtotal, $tax, $total);

// Set parameters and execute the SQL statement
$name = $_GET["name"];
$email = $_GET["email"];
$destination = $_GET["destination"];
$checkin_str = date("Y-m-d", $checkin);
$checkout_str = date("Y-m-d", $checkout);
$stmt->execute();

// Close the database connection
$stmt->close();
$conn->close();
?>