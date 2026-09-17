<?php
session_start();

require_once '../Model/dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'login-php-validation.php';

    if ($valid) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $userData = loginUser($username, $password);

        if ($userData) {
            $_SESSION['username'] = $userData['username'];
            $_SESSION['role'] = $userData['role'];


            if (isset($_POST['remember'])) {
                setcookie("user_login", $_SESSION['username'], time() + (86400 * 30), "/");
                setcookie("user_role", $_SESSION['role'], time() + (86400 * 30), "/");
            }

            $userRole = strtolower(trim($_SESSION['role']));

            if ($userRole == "admin") {
                header("Location: ../View/admin-dashboard.php");
            }
            else if ($userRole == "sales") { 
                header("Location: ../View/sales-dashboard.php");
            }
            else if ($userRole == "customer") {
                header("Location: ../View/dashboard.php");
            }
            exit();
        }
        else {
           
            $_SESSION['globalErrMsg'] = "Invalid username or password.";
            header("Location: ../View/login.php");
            exit();
        }   
    }
    else {
        
        header("Location: ../View/login.php");
        exit();
    }
}
else {
    $_SESSION['globalErrMsg'] = "Something went wrong.";
    header("Location: ../View/login.php");
    exit();
}

?>