<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please login first.");
    exit;
}

$fullname = $_SESSION['fullname'];
$created_at = $_SESSION['created_at'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <div class="dashboard-wrapper">
        <div class="dashboard-card">
            <h1>Welcome, <?php echo htmlspecialchars($fullname); ?>!</h1>
            <p>You became a user on: <strong><?php echo htmlspecialchars($created_at); ?></strong></p>

            <div class="services">
                <div class="service-box">Profile Management</div>
                <div class="service-box">Email Preferences</div>
                <div class="service-box">Account Security</div>
            </div>

            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <footer>
        CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
    </footer>

</body>
</html>
