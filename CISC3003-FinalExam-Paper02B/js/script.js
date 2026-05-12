document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");

    form.addEventListener("submit", function (event) {
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const subject = document.getElementById("subject").value.trim();
        const message = document.getElementById("message").value.trim();

        if (name.length < 2) {
            alert("Name must be at least 2 characters long.");
            event.preventDefault();
            return;
        }

        if (!email.includes("@")) {
            alert("Please enter a valid email address.");
            event.preventDefault();
            return;
        }

        if (subject.length < 3) {
            alert("Subject must be at least 3 characters long.");
            event.preventDefault();
            return;
        }

        if (message.length < 10) {
            alert("Message must be at least 10 characters long.");
            event.preventDefault();
            return;
        }
    });
});
