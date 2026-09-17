<?php
session_start();

if (!isset($_SESSION['username']) && isset($_COOKIE['user_login'])) {
    $_SESSION['username'] = $_COOKIE['user_login'];
    $_SESSION['role'] = $_COOKIE['user_role'];
}

if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.php");
    exit();
}


if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] >= 120)) {
    session_unset();
    session_destroy();
    header("Location: ../View/login.php");
    exit();
}
$_SESSION['last_activity'] = time();
?>