<?php 
require_once 'dbConnect.php';


function getAllBookings() {
    $conn = connect();
    
    $sql = "SELECT b.id, b.username, b.travel_date, b.status, p.packagename, p.price 
            FROM booking b
            JOIN packages p ON b.package_id = p.id 
            ORDER BY b.id DESC"; 
    $result = mysqli_query($conn, $sql);
    
    $bookings = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }
    }
    return $bookings;
}


function getBookingById($id) {
    $conn = connect();
    $sql = "SELECT b.*, p.packagename, p.price 
            FROM booking b
            JOIN packages p ON b.package_id = p.id 
            WHERE b.id = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}


function updateBookingStatus($id, $status) {
    $conn = connect();
    $sql = "UPDATE booking SET status = '$status' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    return $result === true;
}


function deleteBooking($id) {
    $conn = connect();
    $sql = "DELETE FROM booking WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    return $result === true;
}


function getTotalBookingsCount() {
    $conn = connect();
    $sql = "SELECT COUNT(*) as total FROM booking";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
}


function getStatusCount($status) {
    $conn = connect();
    $sql = "SELECT COUNT(*) as total FROM booking WHERE status = '$status'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
}


function getTotalRevenue() {
    $conn = connect();
    $sql = "SELECT SUM(p.price) as revenue FROM booking b JOIN packages p ON b.package_id = p.id WHERE b.status = 'Confirmed'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['revenue'] ?? 0;
}


function getTotalPackagesCount() {
    $conn = connect();
    $sql = "SELECT COUNT(*) as total FROM packages";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'] ?? 0;
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