<?php

include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM promo_code WHERE promo_code_id = $id");
    $promo = mysqli_fetch_assoc($result);
    if (!$promo) {
        die('Không tìm thấy mã giảm giá.');
    }
} else {
    die('Thiếu ID.');
}

if (isset($_POST['update'])) {
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $discount = floatval($_POST['discount']); // Không chia 100
    $limited = intval($_POST['limited']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
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
        exit();
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
    <style>
        body {
            background: #f6f8fa;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 28px 24px 28px;
        }
        h2 {
            text-align: center;
            color: #0066cc;
            margin-bottom: 24px;
            letter-spacing: 1px;
        }
        form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #333;
        }
        form input[type="text"],
        form input[type="number"],
        form input[type="datetime-local"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 18px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
            background: #f9fafb;
            transition: border-color 0.2s;
        }
        form input[type="text"]:focus,
        form input[type="number"]:focus,
        form input[type="datetime-local"]:focus {
            border-color: #0066cc;
            outline: none;
            background: #fff;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #0066cc;
        }
        button[type="submit"] {
            width: 100%;
            padding: 12px 0;
            background: linear-gradient(90deg, #0066cc 60%, #0099ff 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
        }
        button[type="submit"]:hover {
            background: linear-gradient(90deg, #005bb5 60%, #0088cc 100%);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #0066cc;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #004e99;
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .container {
                padding: 18px 6px 12px 6px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sửa Mã Giảm Giá</h2>
        <form action="" method="POST">
            <label>Mã giảm giá:</label>
            <input type="text" name="code" value="<?= htmlspecialchars($promo['code']) ?>" required>

            <label>Giảm giá (%):</label>
            <input type="number" step="0.01" name="discount" value="<?= htmlspecialchars($promo['discount']) ?>" required>

            <label>Giới hạn sử dụng:</label>
            <input type="number" name="limited" value="<?= htmlspecialchars($promo['limited']) ?>" required>

            <label>Ngày bắt đầu:</label>
            <input type="datetime-local" name="start_time" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($promo['start_time']))) ?>" required>

            <label>Ngày kết thúc:</label>
            <input type="datetime-local" name="end_time" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($promo['end_time']))) ?>" required>

            <div class="checkbox-group">
                <input type="checkbox" name="active" <?= $promo['active'] ? 'checked' : '' ?>>
                <label style="margin:0;">Kích hoạt</label>
            </div>

            <button type="submit" name="update">Cập nhật</button>
        </form>
        <a href="promo_management.php" class="back-link">← Quay lại danh sách</a>
    </div>
</body>
</html>