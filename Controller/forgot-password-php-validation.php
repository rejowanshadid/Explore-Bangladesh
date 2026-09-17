<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);
    
    $errors = [];
    $valid = true;

    if (empty($username)) {
        $errors[] = "Username is empty";
        $valid = false;
    }

    if (empty($newPassword)) {
        $errors[] = "New password is empty";
        $valid = false;
    }

    if (empty($confirmPassword)) {
        $errors[] = "Confirm password is empty";
        $valid = false;
    } else if ($newPassword != $confirmPassword) {
        $errors[] = "Passwords do not match";
        $valid = false;
    }

    if ($valid) {
        $host = "localhost";
        $dbUsername = "root"; 
        $dbPassword = ""; 
        $dbName = "bdtour"; // Update this

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Verify if the username exists in the database
        $checkStmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $checkStmt->close();

          
            $updateStmt = $conn->prepare("UPDATE user SET password = ? WHERE username = ?");
            $updateStmt->bind_param("ss", $newPassword, $username);

            if ($updateStmt->execute()) {
                $updateStmt->close();
                $conn->close();
                
               
                header("Location: ../View/login.php");
                exit();
            } else {
                echo "<p style='color:red;'>Error updating password: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Username not found.</p>";
        }

        $conn->close();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>