<?php
include '../Controller/session-check.php';
require_once '../Model/booking.php'; 
if (strtolower(trim($_SESSION['role'])) != "admin") {
    header("Location: dashboard.php");
    exit();
}

$pendingPackages = getPendingPackages();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Package Approvals</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="admin-user-management.css"> 
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="main">
            <div class="user-management">
                <h2>PENDING PACKAGES</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Package Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pendingPackages)): ?>
                            <tr><td colspan="4" style="text-align: center;">No pending packages.</td></tr>
                        <?php else: ?>
                            <?php foreach ($pendingPackages as $p): ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['id']) ?></td>
                                    <td><?= htmlspecialchars($p['packagename']) ?></td>
                                    <td><?= number_format($p['price']) ?> BDT</td>
                                    <td class="action-links" style="display: flex; gap: 10px;">
                                        
                                        <a href="../Controller/admin-package-action.php?id=<?= $p['id'] ?>&action=approve" style="background-color: #3aafa9; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">APPROVE</a>
                                        <a href="../Controller/admin-package-action.php?id=<?= $p['id'] ?>&action=reject" style="background-color: #d9534f; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;" onclick="return confirm('Reject this package?');">REJECT</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>