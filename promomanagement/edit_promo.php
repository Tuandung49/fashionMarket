<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM promo_code WHERE promo_code_id = $id");
    $promo = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $code = $_POST['code'];
    $discount = $_POST['discount'] / 100;
    $limited = $_POST['limited'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $active = isset($_POST['active']) ? 1 : 0;

    $sql = "UPDATE promo_code SET 
        code='$code',
        discount=$discount,
        limited=$limited,
        start_time='$start_time',
        end_time='$end_time',
        active=$active
        WHERE promo_code_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: promo_management.php");
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Promo</title>
</head>
<body>
    <h2>Sửa Promo Code</h2>
    <form action="" method="POST">
        <label>Mã:</label>
        <input type="text" name="code" value="<?= $promo['code'] ?>" required><br>

        <label>Giảm giá (%):</label>
        <input type="number" step="0.01" name="discount" value="<?= $promo['discount'] * 100 ?>" required><br>

        <label>Giới hạn sử dụng:</label>
        <input type="number" name="limited" value="<?= $promo['limited'] ?>" required><br>

        <label>Ngày bắt đầu:</label>
        <input type="datetime-local" name="start_time" value="<?= date('Y-m-d\TH:i', strtotime($promo['start_time'])) ?>" required><br>

        <label>Ngày kết thúc:</label>
        <input type="datetime-local" name="end_time" value="<?= date('Y-m-d\TH:i', strtotime($promo['end_time'])) ?>" required><br>

        <label>
            <input type="checkbox" name="active" <?= $promo['active'] ? 'checked' : '' ?>> Kích hoạt
        </label><br>

        <button type="submit" name="update">Cập nhật</button>
    </form>
</body>
</html>
