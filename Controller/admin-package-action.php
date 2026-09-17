<?php
session_start();
require_once '../Model/booking.php'; // Or package.php

if (strtolower(trim($_SESSION['role'])) != "admin") {
    header("Location: ../View/dashboard.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        setPackageApprovalStatus($id, 'Approved');
    } elseif ($action === 'reject') {
        setPackageApprovalStatus($id, 'Rejected');
    }
}

header("Location: ../View/admin-package-approval.php");
exit();
?>