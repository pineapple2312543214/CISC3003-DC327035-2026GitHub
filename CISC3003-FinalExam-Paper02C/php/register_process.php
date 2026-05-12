<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connect.php";

$fullname = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$password = $_POST["password"] ?? '';
$confirm_password = $_POST["confirm_password"] ?? '';

$errors = [];

if (empty($fullname) || strlen($fullname) < 3) {
    $errors[] = "Full name must be at least 3 characters.";
}

if (!$email) {
    $errors[] = "Valid email is required.";
}

if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters.";
}

if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
}

$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $errors[] = "Email already exists.";
}
$stmt->close();

if (!empty($errors)) {
    echo "<h2>Registration Errors</h2><ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul><p><a href='../register.php'>Go Back</a></p>";
    echo "<footer style='margin-top:30px;text-align:center;'>CISC3003 Web Programming: Xu Wusiyuan DC327035 2026</footer>";
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$verification_token = bin2hex(random_bytes(32));

$sql = "INSERT INTO users (fullname, email, password, verification_token, is_verified)
        VALUES (?, ?, ?, ?, 0)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $email, $hashed_password, $verification_token);

if ($stmt->execute()) {
    echo "<h2>Registration successful!</h2>";
    echo "<p>Your account has been created.</p>";
    echo "<p><strong>Email verification link (for testing):</strong></p>";
    echo "<p><a href='verify.php?token=$verification_token'>Click here to verify your email</a></p>";
    echo "<p>After verification, you can log in.</p>";
    echo "<p><a href='../login.php'>Go to Login</a></p>";
} else {
    echo "<h2>Error:</h2><p>" . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>

<footer style="margin-top:30px; text-align:center;">
    CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
</footer>
