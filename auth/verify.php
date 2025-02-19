<?php
require '../config/database.php';

if (isset($_GET["email"]) && isset($_GET["token"])) {
    $email = $_GET["email"];
    $token = $_GET["token"];

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND verification_token = ?");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $update = $conn->prepare("UPDATE users SET email_verified = 1, verification_token = NULL WHERE email = ?");
        $update->bind_param("s", $email);
        $update->execute();

        echo "Email verified! <a href='../login.php'>Login here</a>";
    } else {
        echo "Invalid verification link!";
    }

    $stmt->close();
}
?>
