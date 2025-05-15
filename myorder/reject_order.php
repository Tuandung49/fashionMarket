<?php
require 'config.php';

if (isset($_GET['id'])) {
    $order_id = (int)$_GET['id'];

    // Cập nhật trạng thái đơn hàng thành 'rejected'
    $sql = "UPDATE orders SET status = 'rejected' WHERE order_id = $order_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: myorder.php?message=Đã từ chối đơn hàng");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Thiếu ID đơn hàng.";
}
?>