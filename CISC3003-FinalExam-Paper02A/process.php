<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "connect.php";

// =========================
// Check Request Method
// =========================
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request.");
}

// =========================
// Get and Validate Form Data
// =========================
$fullname = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
$message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
$programme = filter_input(INPUT_POST, "programme", FILTER_SANITIZE_SPECIAL_CHARS);
$gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);

$interests = "";
if (isset($_POST["interests"]) && is_array($_POST["interests"])) {
    $clean_interests = array_map(function ($item) {
        return htmlspecialchars($item);
    }, $_POST["interests"]);
    $interests = implode(", ", $clean_interests);
}

// =========================
// Basic Validation
// =========================
$errors = [];

if (empty($fullname)) {
    $errors[] = "Full name is required.";
}

if (!$email) {
    $errors[] = "Valid email is required.";
}

if (empty($phone)) {
    $errors[] = "Phone number is required.";
}

if (empty($message)) {
    $errors[] = "Message is required.";
}

if (empty($programme)) {
    $errors[] = "Programme is required.";
}

if (empty($gender)) {
    $errors[] = "Gender is required.";
}

// =========================
// Show Errors if Any
// =========================
if (!empty($errors)) {
    echo "<h2>Form Validation Errors</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
    echo '<p><a href="index.php">Go Back</a></p>';
    echo '<footer style="margin-top:30px; text-align:center;">CISC3003 Web Programming: Xu Wusiyuan DC327035 2026</footer>';
    exit;
}

// =========================
// Insert Data Using Prepared Statement
// =========================
$sql = "INSERT INTO contacts (fullname, email, phone, message, programme, gender, interests)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssss", $fullname, $email, $phone, $message, $programme, $gender, $interests);

if ($stmt->execute()) {
    echo "<h2>Form submitted successfully!</h2>";
    echo "<p>The record has been inserted into the database.</p>";

    echo "<h3>Submitted Data</h3>";
    echo "<p><strong>Full Name:</strong> " . htmlspecialchars($fullname) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($message) . "</p>";
    echo "<p><strong>Programme:</strong> " . htmlspecialchars($programme) . "</p>";
    echo "<p><strong>Gender:</strong> " . htmlspecialchars($gender) . "</p>";
    echo "<p><strong>Interests:</strong> " . htmlspecialchars($interests) . "</p>";

    echo '<p><a href="index.php">Submit Another Response</a></p>';
} else {
    echo "<h2>Error inserting record:</h2>";
    echo "<p>" . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>

<footer style="margin-top:30px; text-align:center;">
    CISC3003 Web Programming: Xu Wusiyuan DC327035 2026
</footer>

