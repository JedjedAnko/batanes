<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "batanes";

$conn = new mysqli($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the ID parameter from the URL
    $id = $_GET["id"];

    // Delete the record from the database
    $sql = "DELETE FROM `users` WHERE `id`='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";

        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request";
    exit;
}
?>