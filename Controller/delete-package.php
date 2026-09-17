<?php
session_start();
require_once '../Model/package.php';


if (!isset($_SESSION['role']) || strtolower(trim($_SESSION['role'])) != "sales") {
    header("Location: ../View/dashboard.php");
    exit();
}


if (isset($_GET['id'])) {
    $id = htmlspecialchars(trim($_GET['id']));
    deletePackage($id);
}


header("Location: ../View/sales-package.php");
exit();
?>