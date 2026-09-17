<?php
session_start();

require_once '../Model/dbConnect.php';

if ($_SESSION['role'] != "customer") {
    header("Location: ../View/dashboard.php");
    exit();
}

$booking_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($booking_id <= 0) {
    header("Location: ../View/booking-history.php");
    exit();
}

$ok = cancelBooking($booking_id, $_SESSION['username']);

if ($ok) {
    $_SESSION['successMsg'] = "Booking cancelled successfully.";
} else {
    $_SESSION['errorMsg'] = "Could not cancel. Only Pending bookings can be cancelled.";
}

header("Location: ../View/booking-history.php");
exit();
?>
