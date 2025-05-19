<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $sql = "DELETE FROM promo_code WHERE promo_code_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: promo_management.php");
        exit(); // rất quan trọng: ngăn việc chạy tiếp lệnh sau header
    } else {
        echo "Xóa thất bại: " . mysqli_error($conn);
    }
} else {
    echo "Không có ID để xóa.";
}
?>
