<?php
session_start();

require_once '../Model/dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username   = $_SESSION['username'];
    $package_id = isset($_POST['package_id']) ? (int) $_POST['package_id'] : 0;
    $travel_date = isset($_POST['travel_date']) ? trim($_POST['travel_date']) : '';

    if ($package_id <= 0 || empty($travel_date)) {
        $_SESSION['errorMsg'] = "Please select a valid package and travel date.";
        header("Location: ../View/packages.php");
        exit();
    }

    $ok = addBooking($username, $package_id, $travel_date);

    if ($ok) {
        $_SESSION['successMsg'] = "Booking successful! You can track it in My Bookings.";
        header("Location: ../View/booking-history.php");
    } else {
        $_SESSION['errorMsg'] = "Booking failed. Please try again.";
        header("Location: ../View/packages.php");
    }

} else {
    header("Location: ../View/packages.php");
}
exit();
?>
