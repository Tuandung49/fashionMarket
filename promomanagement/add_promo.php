<?php

include 'db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $discount = floatval($_POST['discount']); // Không chia 100
    $limited = intval($_POST['limited']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
    $active = isset($_POST['active']) ? 1 : 0;

    $sql = "INSERT INTO promo_code (code, discount, limited, time_use, start_time, end_time, active)
            VALUES ('$code', $discount, $limited, 0, '$start_time', '$end_time', $active)";

    if (mysqli_query($conn, $sql)) {
        header("Location: promo_management.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>