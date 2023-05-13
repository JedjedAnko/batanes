<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "batanes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted, update the booking status in the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];
    $status = $_POST['status'];
    $sql = "UPDATE bookings SET status='$status' WHERE id=$booking_id";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error updating booking status: " . $conn->error;
    }
}

// Fetch all the bookings from the database
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

// Display the bookings in a table
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Destination</th><th>Adults</th><th>Kids</th><th>Room Type</th><th>Check-in</th><th>Check-out</th><th>Subtotal</th><th>Tax</th><th>Total</th><th>Status</th><th>Action</th></tr>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total = "₱" . number_format($row["total"], 2);
        $tax = "₱" . number_format($row["tax"], 2);
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["destination"] . "</td><td>" . $row["adults"] . "</td><td>" . $row["kids"] . "</td><td>" . $row["roomtype"] . "</td><td>" . $row["checkin"] . "</td><td>" . $row["checkout"] . "</td><td>" . $row["subtotal"] . "</td><td>" . $tax . "</td><td>" . $total . "</td><td>" . $row["status"] . "</td>";
        echo "<td>";
        // Display a form to update the booking status
        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
        echo "<input type='hidden' name='booking_id' value='" . $row["id"] . "'>";
        echo "<select name='status'>";
        echo "<option value='Approved'>Approved</option>";
        echo "<option value='Declined'>Declined</option>";
        echo "<option value='Pending'>Pending</option>";
        echo "</select>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
        echo "</td></tr>";
    }
} else {
    echo "No bookings found";
}
echo "</table>";

// Close the database connection
$conn->close();

?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    select {
        margin-right: 5px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
    }
</style>