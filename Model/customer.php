<?php
require_once 'dbConnect.php';


function getBookingsByUsername($username) {
    $conn = connect();
    $sql = "SELECT b.id, p.packagename, b.travel_date, b.status
            FROM booking b
            JOIN packages p ON b.package_id = p.id
            WHERE b.username = '$username'
            ORDER BY b.id DESC";
    $result = mysqli_query($conn, $sql);
    $bookings = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
    return $bookings;
}


function addBooking($username, $package_id, $travel_date) {
    $conn = connect();
    $sql = "INSERT INTO booking (username, package_id, travel_date, status)
            VALUES ('$username', $package_id, '$travel_date', 'Pending')";
    $result = mysqli_query($conn, $sql);
    return $result === true;
}


function cancelBooking($booking_id, $username) {
    $conn = connect();
    $sql = "UPDATE booking SET status='Cancelled'
            WHERE id=$booking_id AND username='$username' AND status='Pending'";
    $result = mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn) > 0;
}


function getAllAvailablePackages() {
    $conn = connect();
    $sql = "SELECT * FROM packages WHERE availability = 'Available' AND approval_status = 'Approved' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $packages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $packages[] = $row;
    }
    return $packages;
}
?>



