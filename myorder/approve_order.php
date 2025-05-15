<?php
require 'config.php';

if (isset($_GET['id'])) {
    $order_id = (int)$_GET['id'];

    // Cập nhật trạng thái đơn hàng thành 'approved'
    $sql = "UPDATE orders SET status = 'approved' WHERE order_id = $order_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: myorder.php?message=Duyệt thành công");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Thiếu ID đơn hàng.";
}
?>