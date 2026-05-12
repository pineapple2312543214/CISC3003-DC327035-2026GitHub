<?php
require_once "connect.php";

$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Invalid verification token.");
}

$sql = "SELECT id FROM users WHERE verification_token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $sql = "UPDATE users SET is_verified = 1, verification_token = NULL WHERE id = ?";
    $updateStmt = $conn->prepare($sql);
    $updateStmt->bind_param("i", $row['id']);
    $updateStmt->execute();

    header("Location: ../login.php?message=Email verified successfully. You can now login.");
    exit;
} else {
    echo "Invalid or expired verification link.";
}
?>
