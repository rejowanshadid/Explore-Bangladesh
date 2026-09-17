<?php

require_once 'dbConnect.php';

function loginUser($username, $password) {
    $conn = connect();
    $sql = "SELECT username, role FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function getUserProfile($username) {
    $conn = connect();
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function updateProfile($id, $first_name, $last_name, $email, $phone) {
    $conn = connect();
    $sql = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    return $result === true;
}

function deleteUser($id) {
    $conn = connect();
    $sql = "DELETE FROM user WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    return $result === true;
}

function updatePassword($id, $newPassword) {
    $conn = connect();
    $sql = "UPDATE user SET password='$newPassword' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    return $result === true;
}


function getTotalUsersCount() {
    $conn = connect();
    $sql = "SELECT COUNT(*) as total FROM user";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
}


function getAllUsers() {
    $conn = connect();
    $sql = "SELECT * FROM user ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    
    $users = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    return $users;
}


function getUserById($id) {
    $conn = connect();
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}


function adminUpdateUser($id, $first_name, $last_name, $email, $phone, $role) {
    $conn = connect();
    $sql = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', role='$role' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    
    return $result === true;
}
?>