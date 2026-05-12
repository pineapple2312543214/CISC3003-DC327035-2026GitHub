<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "connect.php";
require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';

$config = require __DIR__ . '/config.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if (!$email) {
    die("Invalid email.");
}

$sql = "SELECT id, fullname FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    $token = bin2hex(random_bytes(32));

    $updateSql = "UPDATE users SET reset_token = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $token, $user['id']);
    $updateStmt->execute();

    $reset_link = "http://localhost/CISC3003-FinalExam-Paper02C/php/reset_password.php?token=" . $token;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = $config['smtp_secure'];
        $mail->Port = $config['smtp_port'];
        $mail->CharSet = 'UTF-8';

        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($email, $user['fullname']);

        $mail->isHTML(true);
        $mail->Subject = "Password Reset Request";
        $mail->Body = "
            <h2>Password Reset</h2>
            <p>Hello {$user['fullname']},</p>
            <p>Click the link below to reset your password:</p>
            <p><a href='$reset_link'>$reset_link</a></p>
        ";

        $mail->send();

        echo "<h2>Reset email sent successfully.</h2>";
        echo "<p>Please check your email inbox.</p>";
        echo "<p><strong>Test reset link:</strong> <a href='$reset_link'>$reset_link</a></p>";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "No user found with that email.";
}
?>
