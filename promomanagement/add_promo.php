<?php
include 'db_connection.php';

$code = $_POST['code'];
$discount = $_POST['discount'] / 100; // chuyển về dạng 0.10
$limited = $_POST['limited'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$active = isset($_POST['active']) ? 1 : 0;

// Ban đầu số lần sử dụng = 0
$sql = "INSERT INTO promo_code (code, discount, limited, time_use, start_time, end_time, active)
        VALUES ('$code', '$discount', '$limited', 0, '$start_time', '$end_time', $active)";

if (mysqli_query($conn, $sql)) {
    header("Location: promo_management.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
?>
