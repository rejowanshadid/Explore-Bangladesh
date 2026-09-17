<?php
session_start();
require_once '../Model/user.php';

if (strtolower(trim($_SESSION['role'])) != "admin") {
    header("Location: dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval(trim($_GET['id']));
    
   
    if ($_SESSION['username'] !== getUserById($user_id)['username']) {
        if (deleteUser($user_id)) {
            $_SESSION['userMsg'] = "User deleted successfully.";
        }
    } else {
        $_SESSION['userMsg'] = "You cannot delete your own admin account.";
    }
}

header("Location: admin-user-management.php");
exit();
?>