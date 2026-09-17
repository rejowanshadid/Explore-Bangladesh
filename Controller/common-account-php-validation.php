<?php 
session_start();
require_once '../Model/dbConnect.php';

$_SESSION['fullnameErrMsg'] = "";
$_SESSION['emailErrMsg'] = "";
$_SESSION['phoneErrMsg'] = "";
$_SESSION['globalErrMsg'] = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';

    if ($action === 'delete') {
        if (deleteUser($user_id)) {
            session_destroy();
            header("Location: ../View/login.php");
            exit();
        } else {
            header("Location: ../View/common-account.php");
            exit();
        }
    } 
    elseif ($action === 'edit') {
        $fullname = htmlspecialchars(trim($_POST['fullname']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        
        $flag = true;

        if (empty($fullname)) { $flag = false; $_SESSION['fullnameErrMsg'] = "Required"; }
        if (empty($email)) { $flag = false; $_SESSION['emailErrMsg'] = "Required"; }
        if (empty($phone)) { $flag = false; $_SESSION['phoneErrMsg'] = "Required"; }

        if ($flag) {
            $nameParts = explode(" ", $fullname, 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

            $isValid = updateProfile($user_id, $firstName, $lastName, $email, $phone);
            
            if ($isValid) {
                
                $_SESSION['updateSuccess'] = "Profile updated successfully!";
                header("Location: ../View/common-account.php");
                exit();
            } else {
                $_SESSION['globalErrMsg'] = "Database error.";
                header("Location: ../View/common-account.php");
                exit();
            }
        } else {
            header("Location: ../View/common-account.php");
            exit();
        }
    }
} else {
    header("Location: ../View/common-account.php");
    exit();
}
?>