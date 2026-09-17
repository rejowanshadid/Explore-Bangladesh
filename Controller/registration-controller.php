<?php
session_start();
require_once __DIR__ . '/registration-php-validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'registration-php-validation.php';

    if ($valid) {
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $gender = trim($_POST['Gender']); 
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $country = trim($_POST['country']);
        $division = trim($_POST['division']);
        $road = trim($_POST['road']);
        $postcode = trim($_POST['postcode']);
        $username = trim($_POST['userName']);
        
        
        $password = trim($_POST['password']);
        $role = "customer";

        
        $host = "localhost";
        $dbUsername = "root"; 
        $dbPassword = ""; 
        $dbName = "bdtour"; 

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, gender, email, phone, country, division, road_street, post_code, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $firstName, $lastName, $gender, $email, $phone, $country, $division, $road, $postcode, $username, $password, $role);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            if (isset($_POST['remember'])) {
                setcookie("user_login", $username, time() + (86400 * 30), "/");
                setcookie("user_role", $_SESSION['role'], time() + (86400 * 30), "/");
            }

            $stmt->close();
            $conn->close();

            header("Location: ../View/dashboard.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>