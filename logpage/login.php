<?php
session_start();
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // Lưu thông tin user vào session
    $_SESSION['username'] = $user['username'];
    $_SESSION['fullname'] = $user['fullname'];
    echo "success";
} else {
    echo "Sai tài khoản hoặc mật khẩu";
}
?>
