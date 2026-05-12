<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="page-wrapper">
        <div class="auth-card">
            <h1>Create Account</h1>
            <p class="subtitle">Register as a new user</p>

            <form action="php/register_process.php" method="post" id="registerForm">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                    <small id="emailFeedback"></small>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-group">
                    <button type="submit">Sign Up</button>
                </div>
            </form>

            <p class="switch-link">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

    <footer>
        CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
