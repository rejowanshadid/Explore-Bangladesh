<?php
include '../Controller/session-check.php';
require_once '../Model/user.php';     
require_once '../Model/booking.php';  

if (strtolower(trim($_SESSION['role'])) != "admin") {
    header("Location: dashboard.php");
    exit();
}


$totalUsers = getTotalUsersCount();
$totalPackages = getTotalPackagesCount();
$totalBookings = getTotalBookingsCount();
$totalRevenue = getTotalRevenue();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="admin-dashboard.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <?php include 'sidebar.php'; ?>

        <div class="main">

            <h1>ADMIN DASHBOARD</h1>
            <h2>Welcome, Admin!</h2>

            <div class="summary-boxes">
                <div class="summary-box">
                    <h3>TOTAL USERS</h3>
                    <p><?= htmlspecialchars($totalUsers) ?></p>
                </div>

                <div class="summary-box">
                    <h3>TOTAL PACKAGES</h3>
                    <p><?= htmlspecialchars($totalPackages) ?></p>
                </div>

                <div class="summary-box">
                    <h3>TOTAL BOOKINGS</h3>
                    <p><?= htmlspecialchars($totalBookings) ?></p>
                </div>

                <div class="summary-box">
                    <h3>TOTAL REVENUE</h3>
                    <p><?= number_format($totalRevenue) ?> BDT</p>
                </div>
            </div>

            <div class="analytics">
                <h2>SYSTEM ANALYTICS</h2>
                <div class="analytics-boxes">
                    
                    <div class="analytics-box">
                        <h3>SALES STATISTICS</h3>
                        <p>Total Packages Sold: <?= htmlspecialchars($totalBookings) ?></p>
                        <p>Revenue: <?= number_format($totalRevenue) ?> BDT</p>
                    </div>

                    <div class="analytics-box">
                        <h3>BOOKING STATISTICS</h3>
                        
                        <p>Pending: <?= htmlspecialchars(getStatusCount('Pending')) ?></p>
                        <p>Confirmed: <?= htmlspecialchars(getStatusCount('Confirmed')) ?></p>
                        <p>Cancelled: <?= htmlspecialchars(getStatusCount('Cancelled')) ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>