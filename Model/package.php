<?php 
require_once 'dbConnect.php';

function addPackage($packagename, $price, $duration, $image_path, $itinerary) {
    $conn = connect();
    $sql = "INSERT INTO packages (packagename, price, duration, image_path, itinerary) 
            VALUES ('$packagename', $price, '$duration', '$image_path', '$itinerary')";
    $result = mysqli_query($conn, $sql);
    return $result === true;
}

function getPackageById($id) {
    $conn = connect();
    $sql = "SELECT * FROM packages WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function updatePackage($id, $packagename, $price, $duration, $image_path, $itinerary) {
    $conn = connect();
    if ($image_path !== "") {
        $sql = "UPDATE packages SET packagename='$packagename', price=$price, duration='$duration', image_path='$image_path', itinerary='$itinerary' WHERE id=$id";
    } else {
        $sql = "UPDATE packages SET packagename='$packagename', price=$price, duration='$duration', itinerary='$itinerary' WHERE id=$id";
    }
    $result = mysqli_query($conn, $sql);
    return $result === true;
}
function deletePackage($id) {
    $conn = connect();
    $sql = "DELETE FROM packages WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return $result === true;
}

function getPendingPackages() {
    $conn = connect();
    $sql = "SELECT * FROM packages WHERE approval_status = 'Pending' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $packages = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $packages[] = $row;
        }
    }
    return $packages;
}


function setPackageApprovalStatus($id, $status) {
    $conn = connect();
    $sql = "UPDATE packages SET approval_status = '$status' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return $result === true;
}
?>