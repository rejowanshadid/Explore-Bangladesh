<?php
session_start();
require_once '../Model/user.php';

if (strtolower(trim($_SESSION['role'])) != "admin" || $_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../View/dashboard.php");
    exit();
}

$id = intval($_POST['id']);
$first_name = htmlspecialchars(trim($_POST['first_name']));
$last_name = htmlspecialchars(trim($_POST['last_name']));
$email = htmlspecialchars(trim($_POST['email']));
$phone = htmlspecialchars(trim($_POST['phone']));
$role = htmlspecialchars(trim($_POST['role']));

if (adminUpdateUser($id, $first_name, $last_name, $email, $phone, $role)) {
    $_SESSION['userMsg'] = "User details updated successfully!";
} else {
    $_SESSION['userMsg'] = "Failed to update user.";
}

header("Location: ../View/admin-user-management.php");
exit();
?>