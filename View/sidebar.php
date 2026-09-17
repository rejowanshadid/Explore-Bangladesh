<div class="sidebar">

    <h3>MENU</h3>

    <?php if ($_SESSION['role'] == "customer") { ?>

        <a href="dashboard.php">Dashboard</a>
        <a href="packages.php">Packages</a>
        <a href="booking-history.php">My Bookings</a>
        <a href="common-account.php">Profile</a>

    <?php } elseif ($_SESSION['role'] == "sales") { ?>

        <a href="sales-dashboard.php">Dashboard</a>
        <a href="sales-package.php">Add/Edit Package</a>
        <a href="common-account.php">Profile</a>

    <?php } elseif ($_SESSION['role'] == "admin") { ?>

        <a href="admin-dashboard.php">Dashboard</a>
        <a href="admin-user-management.php">User Management</a>
        <a href="admin-package-approval.php">Package Approvals</a> 
        <a href="common-account.php">Profile</a>

    <?php } ?>

    <a href="../Controller/logout.php">Logout</a>

</div>