<?php

include 'db_connection.php';

// Fetch promo codes
$query = "SELECT * FROM promo_code ORDER BY promo_code_id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Promo Code</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f6f8fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 36px auto;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            padding: 32px 24px 24px 24px;
        }

        h1,
        h2 {
            text-align: center;
            color: #0066cc;
            margin-bottom: 24px;
            letter-spacing: 1px;
        }

        .form-section {
            margin-bottom: 32px;
        }

        .form-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-group {
            width: 100%;
            margin-bottom: 0;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 4px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"] {
            width: 100%;
            padding: 10px 12px;
            font-size: 15px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: #f9fafb;
            margin-bottom: 8px;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="datetime-local"]:focus {
            border-color: #0066cc;
            outline: none;
            background: #fff;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            accent-color: #0066cc;
        }

        button {
            padding: 12px 28px;
            background: linear-gradient(90deg, #0066cc 60%, #0099ff 100%);
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 12px;
            transition: background 0.2s;
        }

        button:hover {
            background: linear-gradient(90deg, #005bb5 60%, #0088cc 100%);
        }

        .table-section {
            margin-top: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        table th,
        table td {
            border: 1px solid #e5e7eb;
            padding: 12px 8px;
            text-align: center;
            font-size: 15px;
        }

        table th {
            background: #f0f4f8;
            color: #0066cc;
            font-weight: 600;
        }

        table tr:nth-child(even) {
            background: #f9fafb;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .action-buttons a {
            padding: 7px 16px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .action-buttons .edit {
            background-color: #f0ad4e;
        }

        .action-buttons .edit:hover {
            background-color: #ec971f;
        }

        .action-buttons .delete {
            background-color: #d9534f;
        }

        .action-buttons .delete:hover {
            background-color: #b52b27;
        }

        @media (max-width: 700px) {
            .container {
                padding: 10px 2px;
            }

            .form-grid {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-section">
            <h1>Thêm Mã Giảm Giá Mới</h1>
            <form method="POST" action="add_promo.php">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Mã giảm giá</label>
                        <input type="text" name="code" required>
                    </div>
                    <div class="form-group">
                        <label>Giảm giá (%)</label>
                        <input type="number" step="0.01" name="discount" required>
                    </div>
                    <div class="form-group">
                        <label>Giới hạn sử dụng (0 = không giới hạn)</label>
                        <input type="number" name="limited" required>
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu</label>
                        <input type="datetime-local" name="start_time" required>
                    </div>
                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="datetime-local" name="end_time" required>
                    </div>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="active" checked>
                    <label>Kích hoạt</label>
                </div>
                <button type="submit">Thêm mới</button>
            </form>
        </div>

        <div class="table-section">
            <h2>Danh sách mã giảm giá</h2>
            <table>
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Giảm giá</th>
                        <th>Đã dùng</th>
                        <th>Bắt đầu</th>
                        <th>HSD</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['code']); ?></td>
                            <td><?php echo $row['discount'] . '%'; ?></td>
                            <td><?php echo $row['time_use'] . '/' . ($row['limited'] == 0 ? '∞' : $row['limited']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['start_time'])); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['end_time'])); ?></td>
                            <td>
                                <?php
                                if (!$row['active']) {
                                    echo 'Ngừng kích hoạt';
                                } else if (strtotime($row['end_time']) < time()) {
                                    echo 'Hết hạn';
                                } else {
                                    echo 'Kích hoạt';
                                }
                                ?>
                            </td>
                            <td class="action-buttons">
                                <?php if (isset($row['promo_code_id']) && is_numeric($row['promo_code_id'])): ?>
                                    <a href="edit_promo.php?id=<?php echo (int)$row['promo_code_id']; ?>" class="edit">Sửa</a>
                                    <a href="delete_promo.php?id=<?php echo (int)$row['promo_code_id']; ?>" class="delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                                <?php else: ?>
                                    <span>Không hợp lệ</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>