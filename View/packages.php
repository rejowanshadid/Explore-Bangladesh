<?php
include '../Controller/session-check.php';

if ($_SESSION['role'] != "customer") {
    header("Location: dashboard.php");
    exit();
}

require_once '../Model/dbConnect.php'; 
$packages = getAllAvailablePackages();


$successMsg = isset($_SESSION['successMsg']) ? $_SESSION['successMsg'] : '';
$errorMsg   = isset($_SESSION['errorMsg']) ? $_SESSION['errorMsg'] : '';
unset($_SESSION['successMsg'], $_SESSION['errorMsg']);


$search = trim($_GET['search'] ?? '');
$min_duration = isset($_GET['min_duration']) && $_GET['min_duration'] !== '' ? (int)$_GET['min_duration'] : null;
$max_duration = isset($_GET['max_duration']) && $_GET['max_duration'] !== '' ? (int)$_GET['max_duration'] : null;
$sort = $_GET['sort'] ?? '';


if ($search !== '' || $min_duration !== null || $max_duration !== null) {
    $packages = array_filter($packages, function($p) use ($search, $min_duration, $max_duration) {
        $matchSearch = true;
        if ($search !== '') {
            $matchSearch = stripos($p['packagename'], $search) !== false;
        }
        
        $matchMin = true;
        if ($min_duration !== null) {
            $matchMin = (int)$p['duration'] >= $min_duration;
        }

        $matchMax = true;
        if ($max_duration !== null) {
            $matchMax = (int)$p['duration'] <= $max_duration;
        }

        return $matchSearch && $matchMin && $matchMax;
    });
}


if ($sort === 'duration_asc') {
    usort($packages, function($a, $b) {
        return (int)$a['duration'] <=> (int)$b['duration'];
    });
} elseif ($sort === 'duration_desc') {
    usort($packages, function($a, $b) {
        return (int)$b['duration'] <=> (int)$a['duration'];
    });
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Browse Packages</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="packages.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">

        <?php include 'sidebar.php'; ?>

        <div class="main">

            <h2>AVAILABLE PACKAGES</h2>
            
            
            <form method="GET" action="packages.php" style="margin-bottom:20px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <input type="text" name="search" placeholder="Search packages..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
                
                <input type="number" name="min_duration" placeholder="Min Days" min="1" value="<?= htmlspecialchars($_GET['min_duration'] ?? '') ?>" style="width: 100px;" />
                <input type="number" name="max_duration" placeholder="Max Days" min="1" value="<?= htmlspecialchars($_GET['max_duration'] ?? '') ?>" style="width: 100px;" />
                
                <select name="sort" style="padding: 8px;">
                    <option value="">Sort By...</option>
                    <option value="duration_asc" <?= ($sort === 'duration_asc') ? 'selected' : '' ?>>Duration: Low to High</option>
                    <option value="duration_desc" <?= ($sort === 'duration_desc') ? 'selected' : '' ?>>Duration: High to Low</option>
                </select>
                
                <button type="submit" style="padding: 8px 15px; background: #2b7a78; color: white; border: none; cursor: pointer;">Filter</button>
                <a href="packages.php" style="padding: 8px 15px; background: #ddd; text-decoration: none; color: black; border-radius: 3px;">Reset</a>
            </form>

            <?php if ($successMsg): ?>
                <p class="msg-success"><?= htmlspecialchars($successMsg) ?></p>
            <?php endif; ?>
            <?php if ($errorMsg): ?>
                <p class="msg-error"><?= htmlspecialchars($errorMsg) ?></p>
            <?php endif; ?>

            <?php if (empty($packages)): ?>
                <p>No packages match your search criteria.</p>
            <?php else: ?>
                <?php foreach ($packages as $pkg): ?>

                    <div class="package-box">

                        <div class="image">
                            <?php if (!empty($pkg['image_path']) && file_exists($pkg['image_path'])): ?>
                                <img src="<?= htmlspecialchars($pkg['image_path']) ?>" alt="<?= htmlspecialchars($pkg['packagename']) ?>">
                            <?php else: ?>
                                <div class="no-image">No Image</div>
                            <?php endif; ?>
                        </div>

                        <div class="info">
                            <h3><?= htmlspecialchars($pkg['packagename']) ?></h3>
                            <p><b>Price:</b> ৳<?= number_format($pkg['price']) ?></p>
                            <p><b>Duration:</b> <?= htmlspecialchars($pkg['duration']) ?> Days</p>
                            <p><b>Itinerary:</b> <?= nl2br(htmlspecialchars($pkg['itinerary'])) ?></p>

                            
                            <form action="../Controller/booking-controller.php" method="POST">
                                <input type="hidden" name="package_id" value="<?= $pkg['id'] ?>">
                                <label>Travel Date</label>
                                <input type="date" name="travel_date" required>
                                <button type="submit" class="book">BOOK NOW</button>
                            </form>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>