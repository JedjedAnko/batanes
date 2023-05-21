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

if (isset($_POST['login'])) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE `Username`=? AND `Password`=?");
    mysqli_stmt_bind_param($stmt, "ss", $Username, $Password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['userSession'] = $Username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $stmts = mysqli_prepare($conn, "SELECT * FROM users WHERE `username`=? AND `password`=?");
        mysqli_stmt_bind_param($stmts, "ss", $Username, $Password);
        mysqli_stmt_execute($stmts);
        $results = mysqli_stmt_get_result($stmts);

        $counts = mysqli_num_rows($results);

        if ($counts > 0) {
            $_SESSION['userSession'] = $Username;
            header("Location: customer_dashboard.php");
            exit();
        } else {
            header("location: incorrect.html");
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
