<?php
session_start();
require_once '../Model/booking.php';


if (!isset($_SESSION['role']) || strtolower(trim($_SESSION['role'])) != "sales") {
    header("Location: ../View/dashboard.php");
    exit();
}


if (isset($_GET['id'])) {
    $booking_id = intval(trim($_GET['id']));
    
   
    updateBookingStatus($booking_id, 'Confirmed');
}


header("Location: ../View/sales-dashboard.php");
exit();
?>