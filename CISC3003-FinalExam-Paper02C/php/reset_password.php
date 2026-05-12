<?php
require_once "connect.php";

$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (strlen($new_password) < 6) {
        die("Password must be at least 6 characters.");
    }

    if ($new_password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $sql = "SELECT id FROM users WHERE reset_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $updateSql = "UPDATE users SET password = ?, reset_token = NULL WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $hashed_password, $user['id']);
        $updateStmt->execute();

        header("Location: ../login.php?message=Password reset successful. Please login.");
        exit;
    } else {
        die("Invalid or expired reset token.");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="page-wrapper">
    <div class="auth-card">
        <h1>Reset Password</h1>
        <p class="subtitle">Enter your new password</p>

        <form method="post">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</div>

<footer>
    CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
</footer>

</body>
</html>
