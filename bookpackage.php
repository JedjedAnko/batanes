<!DOCTYPE html>
<html>

<head>
    <title>Booking Confirmation - Batanes Island</title>
    <style>
        .container {
            text-align: center;
            margin-top: 100px;
            font-family: Arial, sans-serif;
        }
    </style>
    <script>
        // JavaScript code
        setTimeout(function () {
            window.location.href = "index.html";
        }, 5000); // 5 seconds (5000 milliseconds)
    </script>
</head>

<body>
    <div class="container">
        <?php
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['userSession'])) {
            // Redirect to login page or handle unauthorized access
            header("Location: login.php");
        }

        // Get the customer's username from the session
        $customer_username = $_SESSION['userSession'];

        // Rest of your code for processing the booking and displaying the confirmation
        
        // Assuming you have retrieved the form inputs and stored them in variables
        $name = $_POST['name'];
        $email = $_POST['email'];
        $selectedPackage = $_POST['package'];

        // Perform any necessary validation and processing of the form inputs
        
        // Determine the price based on the selected package
        $price = 0;
        switch ($selectedPackage) {
            case "Package Deal 1":
                $price = 1050;
                break;
            case "Package Deal 2":
                $price = 1500;
                break;
            case "Package Deal 3":
                $price = 2050;
                break;
            case "Package Deal 4":
                $price = 2500;
                break;
            case "Package Deal 5":
                $price = 3000;
                break;
        }

        // Store the booking details in the database or perform any other necessary operations
        // For example, you can use a MySQL database with the help of PDO
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "batanes";

        try {
            // Connect to the database
            $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);

            // Set the error mode to exception for error handling
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the SQL statement to insert the booking details
            $stmt = $db->prepare("INSERT INTO package (customer_username, name, email, package, price) VALUES (?, ?, ?, ?, ?)");

            // Bind the values to the prepared statement
            $stmt->execute([$customer_username, $name, $email, $selectedPackage, $price]);

            // Close the database connection
            $db = null;

            // Display the confirmation message
            echo "Thank you, " . $customer_username . ", for booking the package deal!";
            echo "<br>";
            echo "<strong>Selected Package:</strong> " . $selectedPackage;
            echo "<br>";
            echo "<strong>Price:</strong> $" . $price;
            echo "<br><br>";
            echo "You will be redirected to the homepage in 5 seconds...";
        } catch (PDOException $e) {
            // Handle any database errors
            echo "An error occurred while processing your booking. Please try again later.";
        }
        ?>
    </div>
</body>

</html>