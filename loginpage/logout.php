<?php
session_start();
session_unset();     // Xóa biến session
session_destroy();   // Hủy session
header("Location: ../homePage/HomePage.php");
exit;
?>
