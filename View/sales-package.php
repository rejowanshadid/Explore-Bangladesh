<?php
include '../Controller/session-check.php';
require_once '../Model/package.php';

if (!isset($_SESSION['role']) || strtolower(trim($_SESSION['role'])) != "sales") {
    header("Location: dashboard.php");
    exit();
}

$editData = null;
if (isset($_GET['edit_id'])) {
    $editData = getPackageById($_GET['edit_id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Package Management</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="sales-package.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="main">
            
            <div class="package-form">
                <h2><?php echo $editData ? "EDIT PACKAGE" : "ADD PACKAGE"; ?></h2>
                <form action="../Controller/sales-package-php-validation.php" method="POST" enctype="multipart/form-data" onsubmit="return validate(this)">
                
                <input type="hidden" name="package_id" value="<?php echo $editData ? $editData['id'] : ''; ?>">

                <div class="form">
                    <label for="packagename">Package Name</label>
                    <input type="text" id="packagename" name="packagename" value="<?php echo $editData ? htmlspecialchars($editData['packagename']) : ($_SESSION['packagename'] ?? ''); ?>">
                    <span id="packagenameErrMsg" class="error-msg"><?php echo $_SESSION['packagenameErrMsg'] ?? ''; ?></span>

                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="<?php echo $editData ? htmlspecialchars($editData['price']) : ($_SESSION['price'] ?? ''); ?>">
                    <span id="priceErrMsg" class="error-msg"><?php echo $_SESSION['priceErrMsg'] ?? ''; ?></span>

                    <label for="duration">Duration</label>
                    <input type="number" id="duration" name="duration" value="<?php echo $editData ? htmlspecialchars($editData['duration']) : ($_SESSION['duration'] ?? ''); ?>">
                    <span id="durationErrMsg" class="error-msg"><?php echo $_SESSION['durationErrMsg'] ?? ''; ?></span>

                    <label for="image">Image <?php echo $editData ? "(Leave blank to keep current)" : ""; ?></label>
                    <input type="file" id="image" name="image">
                    <span id="imageErrMsg" class="error-msg"><?php echo $_SESSION['imageErrMsg'] ?? ''; ?></span>

                    <label for="itinerary">Itinerary</label>
                    <textarea id="itinerary" name="itinerary"><?php echo $editData ? htmlspecialchars($editData['itinerary']) : ($_SESSION['itinerary'] ?? ''); ?></textarea>
                    <span id="itineraryErrMsg" class="error-msg"><?php echo $_SESSION['itineraryErrMsg'] ?? ''; ?></span>

                    <button type="submit" class="save-btn">
                        <?php echo $editData ? "UPDATE PACKAGE" : "SAVE PACKAGE"; ?>
                    </button>
                </div>
                </form>
            </div>

            <div class="existing-packages">
                <h2>EXISTING PACKAGES</h2>
                <table>
                    <tr>
                        <th>Image</th>
                        <th>Package</th>
                        <th>Price (BDT)</th>
                        <th>Duration</th>
                        <th>Approval Status</th> 
                        <th>Action</th>
                    </tr>
                    <?php
                    $conn = connect();
                    
                    $sql = "SELECT id, packagename, price, duration, image_path, approval_status FROM packages";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Package Image' width='80' height='auto' style='border-radius: 4px;'></td>";
                            echo "<td>" . htmlspecialchars($row['packagename']) . "</td>";
                            echo "<td>" . number_format($row['price']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['duration']) . "</td>";
                            
                            
                            $status = htmlspecialchars($row['approval_status']);
                            $statusColor = '';
                            if ($status === 'Approved') $statusColor = 'color: green; font-weight: bold;';
                            if ($status === 'Pending') $statusColor = 'color: orange; font-weight: bold;';
                            if ($status === 'Rejected') $statusColor = 'color: red; font-weight: bold;';
                            
                            echo "<td style='$statusColor'>" . $status . "</td>";
                            
                           
                            echo "<td>
                                    <a href='sales-package.php?edit_id=" . $row['id'] . "' class='edit-btn' style='text-decoration:none; display:inline-block; padding:5px 10px; color:black; background:#f0f0f0; border:1px solid #ccc; border-radius:3px;'>Edit</a>
                                    
                                    <a href='../Controller/delete-package.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this package?');\" style='text-decoration:none; display:inline-block; padding:5px 10px; color:white; background:#cc0000; border:1px solid #990000; border-radius:3px; margin-left:5px;'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No packages found.</td></tr>"; 
                    }
                    mysqli_close($conn);
                    ?>
                </table>
            </div>
        </div>
    </div>
<?php include 'sales-package-js-validation.php'; ?>
</body>
</html>