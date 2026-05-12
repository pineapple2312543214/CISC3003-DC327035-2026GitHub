<?php
require_once "connect.php";

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<span style='color:red;'>Email already exists.</span>";
    } else {
        echo "<span style='color:green;'>Email is available.</span>";
    }

    $stmt->close();
    $conn->close();
}
?>
