<?php
session_start();

// Nếu chưa đăng nhập, chuyển về trang chính
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Home page</title>
</head>
<body>
    <h1>Đây là trang home</h1>
  <a href="logout.php">Đăng xuất</a>
</body>
</html>
