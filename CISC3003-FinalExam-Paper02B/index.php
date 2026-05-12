<?php
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenario B - Contact Form</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="contact-card">
            <h1>Contact Us</h1>
            <p class="subtitle">Scenario B - Send Email with PHPMailer</p>

            <?php if ($success === '1'): ?>
                <div class="alert success">Your message has been sent successfully.</div>
            <?php endif; ?>

            <?php if ($error === '1'): ?>
                <div class="alert error">Sorry, there was a problem sending your message.</div>
            <?php endif; ?>

            <form action="php/send_mail.php" method="post" id="contactForm">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required minlength="2">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required minlength="3">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required minlength="10"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
    </footer>

    <script src="js/script.js"></script>
</body>
</html>

