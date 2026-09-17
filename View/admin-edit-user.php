<?php
include '../Controller/session-check.php';
require_once '../Model/user.php';

if (strtolower(trim($_SESSION['role'])) != "admin") {
    header("Location: dashboard.php");
    exit();
}

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$editUser = getUserById($user_id);

if (!$editUser) {
    header("Location: admin-user-management.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="common-account.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="main">
            <div class="profile-card">
                <h2>EDIT USER: <?= htmlspecialchars($editUser['username']) ?></h2>

                <form action="../Controller/admin-edit-user-validation.php" method="POST">
                    <input type="hidden" name="id" value="<?= $editUser['id'] ?>">

                    <div class="form-grid">
                        <div class="input-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="<?= htmlspecialchars($editUser['first_name'] ?? '') ?>" required>
                        </div>
                        <div class="input-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="<?= htmlspecialchars($editUser['last_name'] ?? '') ?>" required>
                        </div>
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($editUser['email'] ?? '') ?>" required>
                        </div>
                        <div class="input-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="<?= htmlspecialchars($editUser['phone'] ?? '') ?>" required>
                        </div>
                        <div class="input-group">
                            <label>Role</label>
                            <select name="role" style="width: 100%; padding: 8px;">
                                <option value="admin" <?= $editUser['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="sales" <?= $editUser['role'] == 'sales' ? 'selected' : '' ?>>Sales</option>
                                <option value="customer" <?= $editUser['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
                            </select>
                        </div>
                    </div>

                    <div class="button-group" style="margin-top: 20px; display: flex; gap: 10px; align-items: center;">
    <button type="submit" class="btn btn-blue">UPDATE USER</button>
    <a href="admin-user-management.php" class="btn btn-red" style="text-decoration:none; display:inline-block; text-align:center; padding: 10px 20px; line-height: normal;">CANCEL</a>
</div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>