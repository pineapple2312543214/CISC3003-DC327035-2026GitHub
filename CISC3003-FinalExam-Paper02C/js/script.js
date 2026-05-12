document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("registerForm");
    const emailInput = document.getElementById("email");
    const feedback = document.getElementById("emailFeedback");

    if (registerForm) {
        registerForm.addEventListener("submit", function (event) {
            const fullname = document.getElementById("fullname").value.trim();
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;

            if (fullname.length < 3) {
                alert("Full name must be at least 3 characters.");
                event.preventDefault();
                return;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters.");
                event.preventDefault();
                return;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                event.preventDefault();
                return;
            }
        });
    }

    if (emailInput) {
        emailInput.addEventListener("blur", function () {
            const email = emailInput.value.trim();

            if (email !== "") {
                fetch("php/check_email.php?email=" + encodeURIComponent(email))
                    .then(response => response.text())
                    .then(data => {
                        feedback.innerHTML = data;
                    });
            }
        });
    }
});
