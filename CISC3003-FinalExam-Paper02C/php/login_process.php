<?php
session_start();
require_once "connect.php";

$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$password = $_POST["password"] ?? '';

if (!$email || empty($password)) {
    header("Location: ../login.php?error=Invalid login input.");
    exit;
}

$sql = "SELECT id, fullname, password, is_verified, created_at FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (!$user['is_verified']) {
        header("Location: ../login.php?error=Please verify your email before login.");
        exit;
    }

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['created_at'] = $user['created_at'];

        header("Location: ../dashboard.php");
        exit;
    }
}

header("Location: ../login.php?error=Invalid email or password.");
exit;
?>
