<?php
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(50));

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, verification_token) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $token);

    if ($stmt->execute()) {
        // Send verification email (mock, replace with actual email sending)
        $verify_link = "http://localhost/auth_app/auth/verify.php?email=$email&token=$token";
        echo "Verification link: <a href='$verify_link'>$verify_link</a>"; // Simulating email sending
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
