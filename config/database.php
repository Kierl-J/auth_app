<?php
$host = "localhost";
$user = "root"; // Default XAMPP user
$pass = ""; // Default XAMPP password
$db_name = "auth_app";

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
