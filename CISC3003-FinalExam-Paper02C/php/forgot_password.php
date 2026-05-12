<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="page-wrapper">
    <div class="auth-card">
        <h1>Forgot Password</h1>
        <p class="subtitle">Enter your email to receive a reset link</p>

        <form action="send_reset.php" method="post">
            <div class="form-group">
                <label for="reset_email">Email Address</label>
                <input type="email" id="reset_email" name="email" required>
            </div>

            <div class="form-group">
                <button type="submit">Send Reset Link</button>
            </div>
        </form>

        <p class="switch-link"><a href="../login.php">Back to Login</a></p>
    </div>
</div>

<footer>
    CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
</footer>

</body>
</html>
