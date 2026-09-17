<?php 
session_start();

require '../Model/package.php';

$_SESSION['packagenameErrMsg'] = "";
$_SESSION['priceErrMsg'] = "";
$_SESSION['durationErrMsg'] = "";
$_SESSION['imageErrMsg'] = "";
$_SESSION['itineraryErrMsg'] = "";
$_SESSION['globalErrMsg'] = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    
    $package_id = isset($_POST['package_id']) ? trim($_POST['package_id']) : '';
    $isUpdate = !empty($package_id);

    $packagename = isset($_POST['packagename']) ? trim($_POST['packagename']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $duration = isset($_POST['duration']) ? trim($_POST['duration']) : '';
    $itinerary = isset($_POST['itinerary']) ? trim($_POST['itinerary']) : '';
    
    $flag = true;

    if (empty($packagename)) {
        $flag = false;
        $_SESSION['packagenameErrMsg'] = "Please fill up the package name properly";
    } else {
        $_SESSION['packagename'] = $packagename;
    }

    if (empty($price)) {
        $flag = false;
        $_SESSION['priceErrMsg'] = "Please fill up the price properly";
    } else {
        $_SESSION['price'] = $price;
    }

    if (empty($duration)) {
        $flag = false;
        $_SESSION['durationErrMsg'] = "Please fill up the duration properly";
    } else {
        $_SESSION['duration'] = $duration;
    }

    if (empty($itinerary)) {
        $flag = false;
        $_SESSION['itineraryErrMsg'] = "Please fill up the itinerary properly";
    } else {
        $_SESSION['itinerary'] = $itinerary;
    }

    $imageUploaded = !empty($_FILES['image']['name']);
    $targetFilePath = "";

    
    if (!$isUpdate && !$imageUploaded) {
        $flag = false;
        $_SESSION['imageErrMsg'] = "Please select an image";
    } else if ($imageUploaded) {
        $targetDir = "../View/uploads/";
        if (!is_dir($targetDir)) { mkdir($targetDir, 0777, true); }
        $fileName = basename($_FILES["image"]["name"]);
        $dbPath = "uploads/" . time() . "_" . $fileName;
        $physicalPath = $targetDir . time() . "_" . $fileName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $physicalPath);
        $targetFilePath = $dbPath;
    }

    if ($flag) {
        if ($isUpdate) {
            $isValid = updatePackage($package_id, $packagename, $price, $duration, $targetFilePath, $itinerary);
            echo "Update successful. <a href='sales-package.php'>Go Back</a>"; 
        } else {
            $isValid = addPackage($packagename, $price, $duration, $targetFilePath, $itinerary);
            echo "Registration successful. <a href='sales-package.php'>Go Back</a>"; 
        }
    } else {
        echo "Please check again. <a href='sales-package.php" . ($isUpdate ? "?edit_id=$package_id" : "") . "'>Go Back</a>";
    }	
}
else {
    $_SESSION['globalErrMsg'] = "Something went wrong.";
    header("Location: ../View/sales-package.php");
    exit();
}
?>