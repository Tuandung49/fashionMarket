<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../loginpage/index.php');
    exit;
}

$username = $_SESSION['username'];
$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($fullname) || empty($email)) {
    echo "Vui lòng không để trống.";
    exit;
}

$sql = "UPDATE users SET fullname = ?, email = ? WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $fullname, $email, $username);

if ($stmt->execute()) {
    echo "Cập nhật thành công.";
    $_SESSION['fullname'] = $fullname;
} else {
    echo "Lỗi khi cập nhật.";
}

header("Location: ../accountpage/account.php");
exit;
?>
