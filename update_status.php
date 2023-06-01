<?php

// Get the ID and status from the AJAX request
$id = $_POST['id'];
$status = $_POST['status'];

// Update the status in the database
$sql = "UPDATE package SET status = '$status' WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    // Status updated successfully
    // You can handle the response or perform additional actions if needed
    mysqli_close($conn);
    header("Location: admin_dashboard.php");
    exit;
} else {
    // Failed to update the status
    // You can handle the error or display an error message if needed
    echo "Error updating status: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

?>