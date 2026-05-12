<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.php");
    exit;
}

$config = require __DIR__ . '/config.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

if (empty($name) || !$email || empty($subject) || empty($message)) {
    header("Location: ../index.php?error=1");
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 0; //  2
    $mail->isSMTP();
    $mail->Host       = $config['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['smtp_username'];
    $mail->Password   = $config['smtp_password'];
    $mail->SMTPSecure = $config['smtp_secure'];
    $mail->Port       = $config['smtp_port'];
    $mail->CharSet    = 'UTF-8';
    
    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress($config['to_email'], $config['to_name']);
    $mail->addReplyTo($email, $name);
    
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "
        <div style='font-family: Arial, sans-serif; line-height: 1.8; color: #333;'>
            <h2 style='color:#1d4ed8;'>New Contact Form Message</h2>
            <p><strong>Full Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
        </div>
    ";
    
    $mail->AltBody = "New Contact Form Message\n\n"
        . "Full Name: {$name}\n"
        . "Email: {$email}\n"
        . "Subject: {$subject}\n"
        . "Message: {$message}";
        
        $mail->send();
        
        // Post / Redirect / Get
        header("Location: ../index.php?success=1");
        exit;
        
} catch (Exception $e) {
    header("Location: ../index.php?error=1");
    exit;
}
?>

