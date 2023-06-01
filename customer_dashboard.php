<?php
session_start();
include "conn.php";

function isSessionActive()
{
    if (isset($_SESSION['userSession'])) {
        return true;
    } else {
        return false;
    }
}

if (!isSessionActive()) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batanes | Customer Dashboard</title>
</head>
<style>
    .app-content-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 4px;
    }

    .app-content-headerButton {
        background-color: var(--action-color);
        color: #fff;
        font-size: 14px;
        line-height: 24px;
        border: none;
        border-radius: 4px;
        height: 32px;
        padding: 0 16px;
        transition: 0.2s;
        cursor: pointer;
        transform: translateX(110vh);
        margin: 0.25rem;
    }

    .products-area-wrappers {
        overflow: hidden;
    }

    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap");

    * {
        box-sizing: border-box;
    }

    :root {
        --app-bg: #101827;
        --sidebar: #151e2f;
        --sidebar-main-color: #fff;
        --table-border: #1a2131;
        --table-header: #1a2131;
        --app-content-main-color: #fff;
        --sidebar-link: #fff;
        --sidebar-active-link: #1d283c;
        --sidebar-hover-link: #1a2539;
        --action-color: #35483c;
        --action-color-hover: #35483c;
        --app-content-secondary-color: #1d283c;
        --filter-reset: #2c394f;
        --filter-shadow: rgba(16, 24, 39, 0.8) 0px 6px 12px -2px,
            rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    .light:root {
        --app-bg: #fff;
        --sidebar: #f3f6fd;
        --app-content-secondary-color: #f3f6fd;
        --app-content-main-color: #1f1c2e;
        --sidebar-link: #1f1c2e;
        --sidebar-hover-link: rgba(195, 207, 244, 0.5);
        --sidebar-active-link: #c3cff4;
        --sidebar-main-color: #1f1c2e;
        --filter-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
    }

    body {
        font-family: "Poppins", sans-serif;
        background-color: var(--app-bg);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .app-container {
        border-radius: 4px;
        width: 100%;
        height: 100%;
        max-height: 100%;
        max-width: 1280px;
        display: flex;
        overflow: hidden;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        max-width: 2000px;
        margin: 0 auto;
    }

    .sidebar {
        flex-basis: 200px;
        max-width: 200px;
        flex-shrink: 0;
        background-color: var(--sidebar);
        display: flex;
        flex-direction: column;
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
    }

    .sidebar-list {
        list-style-type: none;
        padding: 0;
    }

    .sidebar-list-item {
        position: relative;
        margin-bottom: 4px;
    }

    .sidebar-list-item a {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px 16px;
        color: var(--sidebar-link);
        text-decoration: none;
        font-size: 14px;
        line-height: 24px;
    }

    .sidebar-list-item svg {
        margin-right: 8px;
    }

    .sidebar-list-item:hover {
        background-color: var(--sidebar-hover-link);
    }

    .sidebar-list-item.active {
        background-color: var(--sidebar-active-link);
    }

    .sidebar-list-item.active:before {
        content: "";
        position: absolute;
        right: 0;
        background-color: var(--action-color);
        height: 100%;
        width: 4px;
    }

    @media screen and (max-width: 1024px) {
        .sidebar {
            display: none;
        }
    }

    .mode-switch {
        background-color: transparent;
        border: none;
        padding: 0;
        color: var(--app-content-main-color);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        margin-right: 8px;
        cursor: pointer;
    }

    .app-icon {
        color: var(--sidebar-main-color);
    }

    .app-icon svg {
        width: 24px;
        height: 24px;
    }

    .app-content {
        padding: 16px;
        background-color: var(--app-bg);
        height: 100%;
        flex: 1;
        max-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .app-content-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 4px;
    }

    .app-content-headerText {
        color: var(--app-content-main-color);
        font-size: 24px;
        line-height: 32px;
        margin: 0;
    }

    .app-content-headerButton {
        background-color: var(--action-color);
        color: #fff;
        font-size: 14px;
        line-height: 24px;
        border: none;
        border-radius: 4px;
        height: 32px;
        padding: 0 16px;
        transition: 0.2s;
        cursor: pointer;
        margin: 0.25rem;
    }

    .app-content-headerButton:hover {
        background-color: var(--action-color-hover);
    }

    .app-content-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 4px;
    }

    .app-content-actions-wrapper {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    @media screen and (max-width: 520px) {
        .app-content-actions {
            flex-direction: column;
        }

        .app-content-actions .search-bar {
            max-width: 100%;
            order: 2;
        }

        .app-content-actions .app-content-actions-wrapper {
            padding-bottom: 16px;
            order: 1;
        }
    }

    .products-area-wrapper {
        width: 100%;
        max-height: 100%;
        overflow: scroll;
        padding: 0 4px;
    }

    .logout {
        font-family: monospace;
        background-color: #f3f7fe;
        color: #3b82f6;
        border: none;
        border-radius: 8px;
        width: 100px;
        height: 45px;
        transition: 0.3s;
    }

    .logout:hover {
        background-color: #3b82f6;
        box-shadow: 0 0 0 5px #3b83f65f;
        color: #fff;
    }
</style>

<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <div class="app-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon">
                    <Strong>
                        <span>Hello
                            <?php echo $_SESSION['userSession']; ?>
                        </span>
                    </Strong>
                </div>

            </div>

            <nav>
                <ul class="sidebar-list">
                    <li data-rel="1" class="sidebar-list-item active"><a href="#"><span>Bookings</span></a></li>
                    <li data-rel="2" class="sidebar-list-item"><a href="#"><span>Package Deals</span></a></li>
                    <li class="sidebar-list-item"><a href="logout.php">Logout</a></li>
            </nav>

        </div>
        <section class="products-area-wrappers">
            <article>
                <div class=" app-content">
                    <div class="app-content-header">
                        <h1 class="app-content-headerText">Bookings</h1>
                    </div>

                    <body>

                        <tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "batanes";

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $customer_username = $_SESSION['userSession']; // Assuming the customer username is stored in the session
                            
                            $sql = "SELECT * FROM bookings WHERE cuser = '$customer_username'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Destination</th>
        <th>Adults</th>
        <th>Kids</th>
        <th>Room Type</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Total</th>
        <th>Status</th>
        </tr>";

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["NAME"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["destination"] . "</td>
            <td>" . $row["adults"] . "</td>
            <td>" . $row["kids"] . "</td>
            <td>" . $row["roomtype"] . "</td>
            <td>" . $row["checkin"] . "</td>
            <td>" . $row["checkout"] . "</td>
            <td>" . $row["total"] . "</td>
            <td>" . $row["status"] . "</td>
        </tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "No bookings found for this customer.";
                            }

                            $conn->close(); ?>
                        </tbody>
                        </table>
                    </body>
            </article>
        </section>
        <section class="products-area-wrappers">
            <article>
                <div class="app-content">
                    <div class="app-content-header">
                        <h1 class="app-content-headerText">Package Deals</h1>
                        <button class="app-content-headerButton" onclick="redirectToPage1()"
                            style="transform: translateX(100vh);">Order Package Deals</button>
                    </div>
                    <div class="products-area-wrapper">
                        <div class="products-header">
                            <div class="container">
                                <table class="transaction-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Package</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $db = "batanes";

                                        $conn = new mysqli($servername, $username, $password, $db);
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $customer_username = $_SESSION['userSession']; // Assuming the customer username is stored in the session
                                        
                                        $sql = "SELECT * FROM package WHERE customer_username = '$customer_username'";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $row['id'] . '</td>';
                                                echo '<td>' . $row['booking_date'] . '</td>';
                                                echo '<td>' . $row['customer_username'] . '</td>';
                                                echo '<td>' . $row['email'] . '</td>';
                                                echo '<td>' . $row['package'] . '</td>';
                                                echo '<td>' . $row['price'] . '</td>';
                                                echo '<td>' . $row['status'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="5">No Package Deals found for this customer.</td></tr>';
                                        }

                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <script>
            document.querySelector(".jsFilter").addEventListener("click", function () {
                document.querySelector(".filter-menu").classList.toggle("active");
            });

            document.querySelector(".grid").addEventListener("click", function () {
                document.querySelector(".list").classList.remove("active");
                document.querySelector(".grid").classList.add("active");
                document.querySelector(".products-area-wrapper").classList.add("gridView");
                document
                    .querySelector(".products-area-wrapper")
                    .classList.remove("tableView");
            });

            document.querySelector(".list").addEventListener("click", function () {
                document.querySelector(".list").classList.add("active");
                document.querySelector(".grid").classList.remove("active");
                document.querySelector(".products-area-wrapper").classList.remove("gridView");
                document.querySelector(".products-area-wrapper").classList.add("tableView");
            });

            var modeSwitch = document.querySelector('.mode-switch');
            modeSwitch.addEventListener('click', function () {
                document.documentElement.classList.toggle('light');
                modeSwitch.classList.toggle('active');
            });
        </script>
        <script>
            function redirectToPage1() {
                window.location.href = "packagedeals.php";
            }

            // function redirectToPage2() {
            //     window.location.href = "addcustomer.html";
            // }
            // function redirectToPage3() {
            //     window.location.href = "addstaff.html";
            // }
        </script>
        <script>
            (function ($) {
                $('nav li').click(function () {
                    $(this).addClass('sidebar-list-item active').siblings('li').removeClass('sidebar-list-item active');
                    $('section:nth-of-type(' + $(this).data('rel') + ')').stop().fadeIn(400, 'linear').siblings('section').stop().fadeOut(400, 'linear');
                });
            })(jQuery);
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script src="js/Chart.min.js"></script>
        <script src="js/fileinput.js"></script>
        <script src="js/chartData.js"></script>
        <script src="js/main.js"></script>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Font awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Sandstone Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Bootstrap Datatables -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <!-- Bootstrap social button library -->
        <link rel="stylesheet" href="css/bootstrap-social.css">
        <!-- Bootstrap select -->
        <link rel="stylesheet" href="css/bootstrap-select.css">
        <!-- Bootstrap file input -->
        <link rel="stylesheet" href="css/fileinput.min.css">
        <!-- Awesome Bootstrap checkbox -->
        <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
        <!-- Admin Stye -->
        <link rel="stylesheet" href="css/style.css">
        <style>
            .wrapper {
                position: relative;
                width: 960px;
                padding: 10px;
            }

            section {
                position: absolute;
                display: none;
                top: 10px;
                right: 0;
                width: 1140px;
                min-height: 550px;
            }

            section:first-of-type {
                display: block;
            }

            nav {
                float: left;
                width: 200px;
            }

            .products-area-wrapper {
                width: 100%;
                max-height: 580px;
                padding: 0 4px;
            }


            a {
                display: flex;
                align-items: center;
                width: 100%;
                padding: 10px 16px;
                color: var(--sidebar-link);
                text-decoration: none;
                font-size: 14px;
                line-height: 24px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            tr:hover {
                background-color: #ddd;
            }
        </style>

</html>