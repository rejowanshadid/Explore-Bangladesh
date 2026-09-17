<?php
include '../Controller/session-check.php';
require_once '../Model/user.php';

if (strtolower(trim($_SESSION['role'])) != "admin") {
    header("Location: dashboard.php");
    exit();
}

$allUsers = getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="admin-user-management.css">
    
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="main">
            <h2>USER MANAGEMENT</h2>
            
            <?php if (isset($_SESSION['userMsg'])): ?>
                <p style="color: green; font-weight: bold;"><?php echo $_SESSION['userMsg']; unset($_SESSION['userMsg']); ?></p>
            <?php endif; ?>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($allUsers)): ?>
                        <tr><td colspan="6">No users found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($allUsers as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['id']) ?></td>
                                <td><?= htmlspecialchars($u['username']) ?></td>
                                <td><?= htmlspecialchars(trim($u['first_name'] . ' ' . $u['last_name'])) ?></td>
                                <td><strong><?= htmlspecialchars(ucfirst($u['role'])) ?></strong></td>
                                <td><?= htmlspecialchars($u['email'] ?? 'N/A') ?></td>
                                <td style="display: flex; gap: 10px;">
                                    <a href="admin-edit-user.php?id=<?= $u['id'] ?>" class="update-btn">UPDATE USER</a>
                                    
                                    <?php if (strtolower(trim($u['role'])) !== 'admin'): ?>
                                        <a href="admin-delete-user.php?id=<?= $u['id'] ?>" class="suspend-btn" onclick="return confirm('Delete this user completely?');">SUSPEND / DELETE</a>
                                    <?php endif; ?>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>