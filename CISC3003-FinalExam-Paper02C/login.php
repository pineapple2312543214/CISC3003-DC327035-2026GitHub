<?php
session_start();
$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="page-wrapper">
        <div class="auth-card">
            <h1>Login</h1>
            <p class="subtitle">Sign in to access your dashboard</p>

            <?php if ($message): ?>
                <div class="alert success"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="php/login_process.php" method="post" id="loginForm">
                <div class="form-group">
                    <label for="login_email">Email Address</label>
                    <input type="email" id="login_email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="login_password">Password</label>
                    <input type="password" id="login_password" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>

            <p class="switch-link"><a href="php/forgot_password.php">Forgot Password?</a></p>
            <p class="switch-link">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    <footer>
        CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
