<?php
include '../Controller/session-check.php';
require_once '../Model/dbConnect.php'; 

$loggedInUser = $_SESSION['username'] ?? '';
$userData = null;
$fullName = "";

if (!empty($loggedInUser)) {
    $userData = getUserProfile($loggedInUser);
    
    if ($userData) {
        $fullName = trim($userData['first_name'] . " " . $userData['last_name']);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile Page</title>
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
                <h2>PROFILE</h2>

                <form id="profileForm" action="../Controller/common-account-php-validation.php" method="POST">
                    
                    <input type="hidden" name="user_id" value="<?php echo $userData ? $userData['id'] : ''; ?>">

                    <div class="form-grid">
                        <div class="input-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="fullname" value="<?php echo htmlspecialchars($fullName); ?>">
                            <span id="fullnameErrMsg" class="error-msg"><?php echo $_SESSION['fullnameErrMsg'] ?? ''; ?></span>
                        </div>

                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo $userData ? htmlspecialchars($userData['email']) : ''; ?>">
                            <span id="emailErrMsg" class="error-msg"><?php echo $_SESSION['emailErrMsg'] ?? ''; ?></span>
                        </div>

                        <div class="input-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" value="<?php echo $userData ? htmlspecialchars($userData['phone']) : ''; ?>">
                            <span id="phoneErrMsg" class="error-msg"><?php echo $_SESSION['phoneErrMsg'] ?? ''; ?></span>
                        </div>

                        <div class="input-group">
                            <label for="role">Role</label>
                            <input type="text" id="role" name="role" value="<?php echo $userData ? htmlspecialchars(ucfirst($userData['role'])) : ''; ?>" readonly style="background-color: #f0f0f0;">
                            <span id="roleErrMsg" class="error-msg"></span>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" id="editBtn" name="action" value="edit" class="btn btn-blue">EDIT PROFILE</button>
                        
                        
                        <button type="button" id="changePasswordBtn" class="btn btn-green" onclick="window.location.href='change-password.php';">CHANGE PASSWORD</button>
                        
                        <button type="submit" id="deleteBtn" name="action" value="delete" class="btn btn-red" onclick="return confirm('Are you sure you want to delete your account?');">DELETE</button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    
   
    <?php if (isset($_SESSION['updateSuccess'])): ?>
        <script>
            alert("<?php echo $_SESSION['updateSuccess']; ?>");
        </script>
        <?php unset($_SESSION['updateSuccess']); 
   
endif; ?>

</body>
</html>