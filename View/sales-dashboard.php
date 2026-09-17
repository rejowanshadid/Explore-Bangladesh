<?php
include '../Controller/session-check.php';
require_once '../Model/booking.php'; 

 
if (strtolower(trim($_SESSION['role'])) != "sales") {
    header("Location: dashboard.php");
    exit();
}


$totalBookings = getTotalBookingsCount();
$confirmedCount = getStatusCount('Confirmed');
$cancelledCount = getStatusCount('Cancelled');
$totalRevenue = getTotalRevenue();


$allBookings = getAllBookings();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sales Dashboard</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="sales-dashboard.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <?php include 'sidebar.php'; ?>

        <div class="main">

            <h1>SALES DASHBOARD</h1>
            <h2>Welcome, Sales!</h2>

            <div class="dashboard-boxes">
                <div class="dashboard-box">
                    <h3>TOTAL BOOKINGS</h3>
                    <p><?= htmlspecialchars($totalBookings) ?></p>
                </div>

                <div class="dashboard-box">
                    <h3>CONFIRMED</h3>
                    <p><?= htmlspecialchars($confirmedCount) ?></p>
                </div>

                <div class="dashboard-box">
                    <h3>CANCELLED</h3>
                    <p><?= htmlspecialchars($cancelledCount) ?></p>
                </div>

                <div class="dashboard-box">
                    <h3>REVENUE</h3>
                    <p><?= number_format($totalRevenue) ?> BDT</p>
                </div>
            </div>

            <div class="recent-bookings">
                <h3>RECENT CUSTOMER BOOKINGS</h3>
                <table>
                    <tr>
                        <th>Customer</th>
                        <th>Package</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php if (empty($allBookings)): ?>
                        <tr><td colspan="4">No bookings found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($allBookings as $b): ?>
                            <tr>
                                <td><?= htmlspecialchars($b['username'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($b['packagename']) ?></td>
                                <td><?= htmlspecialchars($b['status']) ?></td>
                                <td>
                                    <?php if (strtolower($b['status']) === 'pending'): ?>
                                        <a href="../Controller/confirm-booking.php?id=<?= $b['id'] ?>"><button class="confirm">Confirm</button></a>
                                        <a href="../Controller/sales-cancel-booking.php?id=<?= $b['id'] ?>" onclick="return confirm('Cancel this booking?');"><button class="cancel">Cancel</button></a>
                                    <?php else: ?>
                                        <a href="view-booking.php?id=<?= $b['id'] ?>"><button class="view">View</button></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </table>
            </div>
        </div>
    </div>
</body>
</html>