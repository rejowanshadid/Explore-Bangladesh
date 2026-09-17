<?php
session_start();

$_SESSION = array();

if (isset($_COOKIE['user_login'])) {
    setcookie('user_login', '', time() - 3600, '/');
}

if (isset($_COOKIE['user_role'])) {
    setcookie('user_role', '', time() - 3600, '/');
}

session_destroy();

header("Location: ../View/login.php");
exit();
?>