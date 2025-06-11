<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "fashionmarket");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($order_id <= 0) {
    echo "ID đơn hàng không hợp lệ.";
    exit;
}

// Lấy thông tin đơn hàng
$sql_order = "SELECT * FROM orders WHERE order_id = ?";
$stmt_order = $conn->prepare($sql_order);
$stmt_order->bind_param("i", $order_id);
$stmt_order->execute();
$order_result = $stmt_order->get_result();

if ($order_result->num_rows === 0) {
    echo "Không tìm thấy đơn hàng.";
    exit;
}

$order = $order_result->fetch_assoc();

// Lấy sản phẩm từ order_items
$sql_items = "
    SELECT oi.*, p.product_display_name, p.image
    FROM order_items oi
    JOIN product_instock p ON oi.product_id = p.product_id
    WHERE oi.order_id = ?
";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng #<?= $order['order_id'] ?></title>
    <link rel="stylesheet" href="style1.css">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        img { max-width: 60px; max-height: 60px; }
        .button { margin-top: 20px; display: inline-block; padding: 10px 20px; background: #007BFF; color: white; text-decoration: none; border-radius: 5px; }
        .button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h2>Chi tiết đơn hàng #<?= $order['order_id'] ?></h2>
    <p><strong>Cart ID:</strong> <?= $order['cart_id'] ?></p>
    <p><strong>User ID:</strong> <?= $order['user_id'] ?></p>
    <p><strong>Ngày đặt:</strong> <?= $order['order_date'] ?></p>
    <p><strong>Tổng tiền:</strong> <?= number_format($order['total_price'], 0, ',', '.') ?> đ</p>
    <p><strong>Trạng thái:</strong> <?= htmlspecialchars($order['status']) ?></p>

    <h3>Sản phẩm trong đơn hàng</h3>
    <table>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá (USD)</th>
            <th>Thành tiền (USD)</th>
        </tr>
        <?php if ($items_result->num_rows > 0): ?>
            <?php while ($item = $items_result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php if (!empty($item['image'])): ?>
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="">
                        <?php else: ?>
                            Không có ảnh
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($item['product_display_name']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">Không có sản phẩm trong đơn hàng.</td></tr>
        <?php endif; ?>
    </table>

</body>
</html>
