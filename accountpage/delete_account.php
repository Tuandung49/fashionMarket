<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../loginpage/index.php');
    exit;
}

$username = $_SESSION['username'];

// Xóa tài khoản
$stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

// Xoá session và quay về trang chính
session_unset();
session_destroy();

echo "Tài khoản đã bị xóa.";
header("Location: ../loginpage/index.php");
exit;
?>
