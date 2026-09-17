<?php
include '../Controller/session-check.php';

require_once '../Model/dbConnect.php';
$bookings = getBookingsByUsername($_SESSION['username']);

$total     = count($bookings);
$pending   = count(array_filter($bookings, fn($b) => $b['status'] === 'Pending'));
$confirmed = count(array_filter($bookings, fn($b) => $b['status'] === 'Confirmed'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <?php include 'sidebar.php'; ?>

        <div class="main">

            <div class="welcome-box">
                <h3>WELCOME</h3>
                <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
            </div>

            <div class="dashboard-sections">

                <div class="dashboard-box">
                    <h3>TOTAL BOOKINGS</h3>
                    <h4><?= $total ?></h4>
                    <a href="booking-history.php"><button>VIEW ALL</button></a>
                </div>

                <div class="dashboard-box">
                    <h3>PENDING</h3>
                    <h4><?= $pending ?></h4>
                    <a href="booking-history.php?status=Pending"><button>VIEW</button></a>
                </div>

                <div class="dashboard-box">
                    <h3>CONFIRMED</h3>
                    <h4><?= $confirmed ?></h4>
                    <a href="booking-history.php?status=Confirmed"><button>VIEW</button></a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>