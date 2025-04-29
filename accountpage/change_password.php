<?php
session_start();
require '../loginpage/db.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../loginpage/index.php');
    exit;
}

$username = $_SESSION['username'];
$old = $_POST['old_password'] ?? '';
$new = $_POST['new_password'] ?? '';

if (empty($old) || empty($new)) {
    echo "Vui lòng điền đầy đủ mật khẩu.";
    exit;
}

// Kiểm tra mật khẩu cũ
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($old, $user['password'])) {
    echo "Mật khẩu cũ không đúng.";
    exit;
}

// Cập nhật mật khẩu mới
$newHashed = password_hash($new, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt->bind_param("ss", $newHashed, $username);
$stmt->execute();

echo "Đổi mật khẩu thành công.";
header("Location: account.php");
exit;
?>
