<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "batanes";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $Username = $_POST["email"];
    $Password = $_POST["password"];

    $sql = "UPDATE cuser SET email='$Username', Password='$Password' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        setTimeout(function() {
            alert('Client Added Successfully');
            window.location.href = 'dashboard2.php#';
        }, 100);
    </script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<button class="app-content-headerButton" onclick="redirectToPage()">Go Back</button>
<center>
    <div class="card">
        <div class="card-header">
            <div class="text-header">Edit Client</div>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label for="username">ID:</label>
                    <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="title" name="Username" value="<?php echo $row['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="Password" id="sales" name="Password" value="<?php echo $row['password']; ?>">
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</center>


<?php
mysqli_close($conn);
?>

<style>
    .card {
        width: 350px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 10px;
    }

    .card-header {
        background-color: #000c;
        padding: 16px;
        text-align: center;
    }

    .card-header .text-header {
        margin: 0;
        font-size: 18px;
        color: rgb(255, 255, 255);
    }

    .card-body {
        padding: 16px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #333;
        font-weight: bold;
        margin-bottom: 1px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn {
        padding: 12px 24px;
        margin-left: 13px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #000c;
        color: #fff;
        text-transform: uppercase;
        transition: background-color 0.2s ease-in-out;
        cursor: pointer
    }

    .btn:hover {
        background-color: #000c;
        color: #333;
    }

    center {
        transform: translateY(5vh);
    }

    .app-content-headerButton {
        background-color: #000c;
        color: #fff;
        font-size: 14px;
        line-height: 24px;
        border: none;
        border-radius: 4px;
        height: 32px;
        padding: 0 16px;
        transition: 0.2s;
        cursor: pointer;
        transform: translate(5vh);
        margin: 0.25rem;
    }
</style>
<script>
    function redirectToPage() {
        window.location.href = "admin_dashboard.php";
    }
</script>