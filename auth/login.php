<?php
session_start(); // Start session
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // Store user data in session
        $_SESSION["user_id"] = $id;
        $_SESSION["name"] = $name;
        header("Location: ../dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
}
?>
