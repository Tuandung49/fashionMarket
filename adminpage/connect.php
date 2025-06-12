<?php
$host = "localhost";
$username = "root"; // Đảm bảo user có đủ quyền
$password = "";
$dbname = "fashionmarket";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Đặt charset để tránh lỗi tiếng Việt (nếu có)
$conn->set_charset("utf8mb4");
?>
