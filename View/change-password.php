<?php
include '../Controller/session-check.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
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
                <h2>CHANGE PASSWORD</h2>
                
                <form action="../Controller/change-password-php-validation.php" method="POST">
                    <div class="form-grid" style="display:block;"> 
                        
                        <div class="input-group" style="margin-bottom: 20px;">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password" style="width: 100%; max-width: 400px;">
                            <span class="error-msg" style="color: red; display: block; margin-top: 5px;"><?php echo $_SESSION['currentPwdErr'] ?? ''; ?></span>
                        </div>

                        <div class="input-group" style="margin-bottom: 20px;">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" style="width: 100%; max-width: 400px;">
                            <span class="error-msg" style="color: red; display: block; margin-top: 5px;"><?php echo $_SESSION['newPwdErr'] ?? ''; ?></span>
                        </div>

                        <div class="input-group" style="margin-bottom: 20px;">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" style="width: 100%; max-width: 400px;">
                            <span class="error-msg" style="color: red; display: block; margin-top: 5px;"><?php echo $_SESSION['confirmPwdErr'] ?? ''; ?></span>
                        </div>

                    </div>

                    <div class="button-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-green">UPDATE PASSWORD</button>
                        <a href="common-account.php" class="btn btn-blue" style="text-decoration:none; display:inline-block; text-align:center; padding: 10px 20px; line-height: normal;">CANCEL</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    
    <?php if (isset($_SESSION['pwdSuccess'])): ?>
        <script>
            alert("<?php echo $_SESSION['pwdSuccess']; ?>");
        </script>
        <?php unset($_SESSION['pwdSuccess']); ?>
    <?php endif; ?>
    
   
    <?php 
        unset($_SESSION['currentPwdErr']);
        unset($_SESSION['newPwdErr']);
        unset($_SESSION['confirmPwdErr']);
    ?>
</body>
</html>