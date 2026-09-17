<?php

$valid = true;
$errors = []; 
if (empty($_POST['firstName'])) {
    $errors[] = "First name field is empty";
    $valid = false;
}

if (empty($_POST['lastName'])) {
    $errors[] = "Last name is empty";
    $valid = false;
}

if (empty($_POST['Gender'])) {
    $errors[] = "Gender is empty";
    $valid = false;
}

if (empty($_POST['email'])) {
    $errors[] = "Email is empty";
    $valid = false;
} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
    $valid = false;
}

if (empty($_POST['phone'])) {
    $errors[] = "Phone number is empty";
    $valid = false;
}

if (empty($_POST['country']) || $_POST['country'] == "select country") {
    $errors[] = "Country is empty";
    $valid = false;
}

if (empty($_POST['division']) || $_POST['division'] == "select devision") {
    $errors[] = "Division is empty";
    $valid = false;
}

if (empty($_POST['road'])) {
    $errors[] = "Road/Street is empty";
    $valid = false;
}

if (empty($_POST['postcode'])) {
    $errors[] = "Post code is empty";
    $valid = false;
}

if (empty($_POST['userName'])) {
    $errors[] = "Username is empty";
    $valid = false;
}

if (empty($_POST['password'])) {
    $errors[] = "Password is empty";
    $valid = false;
}

if (empty($_POST['confirmPassword'])) {
    $errors[] = "Confirm password is empty";
    $valid = false;
} else if ($_POST['password'] != $_POST['confirmPassword']) {
    $errors[] = "Passwords do not match";
    $valid = false;
}

?>