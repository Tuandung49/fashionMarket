<?php

include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        // Kiểm tra xem ID có tồn tại không trước khi xóa
        $check = mysqli_query($conn, "SELECT promo_code_id FROM promo_code WHERE promo_code_id = $id");
        if (mysqli_num_rows($check) > 0) {
            $sql = "DELETE FROM promo_code WHERE promo_code_id = $id";
            if (mysqli_query($conn, $sql)) {
                header("Location: promo_management.php");
                exit();
            } else {
                echo "Xóa thất bại: " . mysqli_error($conn);
            }
        } else {
            echo "Không tìm thấy mã khuyến mãi để xóa.";
        }
    } else {
        echo "ID không hợp lệ.";
    }
} else {
    echo "Không có ID để xóa.";
}
?>