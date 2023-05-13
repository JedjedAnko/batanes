<!-- Customer Dashboard Page -->
<html>

<head>
    <title>Customer Dashboard</title>
</head>

<body>
    <h1>Customer Dashboard</h1>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Destination</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Establish a connection to the MySQL database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "batanes";
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check if the connection is successful
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve booking data from the database
            $sql = "SELECT * FROM bookings";
            $result = $conn->query($sql);

            // Display the booking data in a table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["destination"] . "</td>";
                    echo "<td>" . $row["checkin"] . "</td>";
                    echo "<td>" . $row["checkout"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No bookings found.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>