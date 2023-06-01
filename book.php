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
<div class="container">
  <h1>Booking Details</h1>
  <h2>Customer Information</h2>
  <p>Name: <?php echo $_POST["name"]; ?></p>
  <p>Email: <?php echo $_POST["email"]; ?></p>
  <h2>Reservation Information</h2>
  <p>Destination: <?php echo $_POST["destination"]; ?></p>
  <p>Number of Adults: <?php echo $_POST["adults"]; ?></p>
  <p>Number of Kids: <?php echo $_POST["kids"]; ?></p>
  <p>Room Type: <?php echo $_POST["roomtype"]; ?></p>
  <p>Check-In: <?php echo $_POST["checkin"]; ?></p>
  <p>Check-Out: <?php echo $_POST["checkout"]; ?></p>
  <?php
  $booking_username = $_POST["cuser"];
  $adults = $_POST["adults"];
  $kids = $_POST["kids"];
  $roomtype = $_POST["roomtype"];
  $checkin = strtotime($_POST["checkin"]);
  $checkout = strtotime($_POST["checkout"]);
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

  $servername = "localhost";
  $db_username = "root";
  $db_password = "";
  $dbname = "batanes";
  $conn = new mysqli($servername, $db_username, $db_password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = $_POST["name"];
  $email = $_POST["email"];
  $destination = $_POST["destination"];
  $checkin_str = date("Y-m-d", $checkin);
  $checkout_str = date("Y-m-d", $checkout);

  $stmt = $conn->prepare("INSERT INTO bookings (name,cuser, email, destination, adults, kids, roomtype, checkin, checkout, subtotal, tax, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssiissssddd", $name, $booking_username, $email, $destination, $adults, $kids, $roomtype, $checkin_str, $checkout_str, $subtotal, $tax, $total);
  $stmt->execute();
  $stmt->close();
  $conn->close();
  ?>
  <h2>Payment Information</h2>
  <div class="payment-info">
    <p>Subtotal: <?php echo "₱" . number_format($subtotal, 2); ?></p>
    <p>Tax (<?php echo $tax_rate * 100 . "%"; ?>): <?php echo "₱" . number_format($tax, 2); ?></p>
    <p>Total: <?php echo "₱" . number_format($total, 2); ?></p>
  </div>
</div>
</body>