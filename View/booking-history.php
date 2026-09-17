<?php
include '../Controller/session-check.php';

if ($_SESSION['role'] != "customer") {
    header("Location: dashboard.php");
    exit();
}

require_once '../Model/dbConnect.php';
$bookings = getBookingsByUsername($_SESSION['username']);


$statusFilter = $_GET['status'] ?? '';
if ($statusFilter) {
    $bookings = array_filter($bookings, function($b) use ($statusFilter) {
        return strtolower($b['status']) === strtolower($statusFilter);
    });
}


$successMsg = isset($_SESSION['successMsg']) ? $_SESSION['successMsg'] : '';
$errorMsg   = isset($_SESSION['errorMsg']) ? $_SESSION['errorMsg'] : '';
unset($_SESSION['successMsg'], $_SESSION['errorMsg']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="booking-history.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <?php include 'sidebar.php'; ?>

        <div class="right-side">

            <h2>MY BOOKINGS</h2>

            <?php if ($successMsg): ?>
                <p class="msg-success"><?= htmlspecialchars($successMsg) ?></p>
            <?php endif; ?>
            <?php if ($errorMsg): ?>
                <p class="msg-error"><?= htmlspecialchars($errorMsg) ?></p>
            <?php endif; ?>

            <div class="panel my-bookings">

                <?php if (empty($bookings)): ?>
<?php if (isset($_GET['status']) && strtolower($_GET['status']) === 'confirmed'): ?>
                    <p>You have no confirmed bookings.</p>
                <?php else: ?>
                    <p>You have no bookings yet. <a href="packages.php">Browse packages</a></p>
                <?php endif; ?>
                <?php else: ?>

                    <table>

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Travel Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($bookings as $i => $b): ?>
                                <tr>

                                    <td><?= $i + 1 ?></td>

                                    <td><?= htmlspecialchars($b['packagename']) ?></td>

                                    <td><?= htmlspecialchars($b['travel_date']) ?></td>

                                    <td>
                                        <span class="status <?= strtolower($b['status']) ?>">
                                            <?= htmlspecialchars($b['status']) ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?php if ($b['status'] === 'Pending'): ?>
                                            <a href="../Controller/cancel-booking.php?id=<?= $b['id'] ?>"
                                               class="action-link cancel"
                                               onclick="return confirm('Cancel this booking?')">
                                                Cancel
                                            </a>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                <?php endif; ?>

            </div>

            <p><a href="packages.php" class="btn-new">+ New Booking</a></p>

        </div>

    </div>

</body>

</html>