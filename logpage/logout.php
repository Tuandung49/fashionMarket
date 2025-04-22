<?php
session_start();
session_unset();     // Xóa biến session
session_destroy();   // Hủy session
header("Location: index.php"); // Quay về trang chính
exit;
?>
