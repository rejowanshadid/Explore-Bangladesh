<?php
include '../Controller/session-check.php';
require_once '../Model/booking.php';


if (strtolower(trim($_SESSION['role'])) != "sales") {
    header("Location: dashboard.php");
    exit();
}


$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


$bookingDetails = getBookingById($booking_id);

if (!$bookingDetails) {
    echo "Booking not found. <a href='sales-dashboard.php'>Go back</a>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Booking</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="view-booking.css">

</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <?php include 'sidebar.php'; ?>

        <div class="main">
            <h2>BOOKING DETAILS</h2>
            
            <div class="detail-card">
                <div class="detail-group">
                    <label>Booking ID</label>
                    <p>#<?= htmlspecialchars($bookingDetails['id']) ?></p>
                </div>
                
                <div class="detail-group">
                    <label>Customer Username</label>
                    <p><?= htmlspecialchars($bookingDetails['username'] ?? 'Unknown') ?></p>
                </div>

                <div class="detail-group">
                    <label>Package Booked</label>
                    <p><?= htmlspecialchars($bookingDetails['packagename']) ?></p>
                </div>

                <div class="detail-group">
                    <label>Travel Date</label>
                    <p><?= htmlspecialchars($bookingDetails['travel_date']) ?></p>
                </div>

                <div class="detail-group">
                    <label>Package Price</label>
                    <p><?= number_format($bookingDetails['price'] ?? 0) ?> BDT</p>
                </div>

                <div class="detail-group">
                    <label>Current Status</label>
                    <p><strong><?= htmlspecialchars(ucfirst($bookingDetails['status'])) ?></strong></p>
                </div>

                <a href="sales-dashboard.php" class="btn-back">← Back to Dashboard</a>
            </div>
        </div>
    </div>

</body>
</html>