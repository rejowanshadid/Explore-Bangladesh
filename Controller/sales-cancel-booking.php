<?php
session_start();
require_once '../Model/booking.php';


if ($_SESSION['role'] != "sales") {
    header("Location: ../View/dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $booking_id = intval(trim($_GET['id']));
    updateBookingStatus($booking_id, 'Cancelled');
}

header("Location: ../View/sales-dashboard.php");
exit();
?>