<?php
// config.php - File cấu hình hệ thống

// Bật báo lỗi (chỉ dùng khi phát triển)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cấu hình database
$db_host = 'localhost'; // Host database
$db_name = 'fashionmarket1'; // Tên database
$db_user = 'root'; // Username database
$db_pass = ''; // Password database

// Cấu hình base URL (nếu cần)
define('BASE_URL', 'http://localhost/fashionmarket');

// Cấu hình múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Khởi tạo session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hàm chuyển hướng
function redirect($url) {
    header("Location: $url");
    exit();
}

// Hàm hiển thị thông báo
function flash_message($message, $type = 'success') {
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

// Hàm hiển thị flash message (nếu có)
function display_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'] ?? 'success';
        echo "<div class='alert alert-$type'>$message</div>";
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
    }
}
?>