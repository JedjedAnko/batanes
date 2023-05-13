<?php
// Start a session
session_start();

// Check if the user has submitted the login form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the user's credentials
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the user's credentials against your database
    // For example, you can use PDO to query the database
    $db = new PDO('mysql:host=localhost;dbname=batanes', 'root', '');
    $query = "SELECT id FROM users WHERE email = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch();

    // If the user is found in the database, store their id in a session variable
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        // Redirect the user to the booking page
        header('Location: bookings.html');
        exit;
    } else {
        // If the user is not found in the database, show an error message
        echo 'Invalid email or password';
    }
}
