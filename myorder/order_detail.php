<?php
require 'config.php';

$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($order_id <= 0) {
    echo "ID đơn hàng không hợp lệ.";
    exit;
}

// Lấy thông tin đơn hàng
$sql_order = "SELECT * FROM orders WHERE order_id = $order_id";
$order_result = $conn->query($sql_order);

if ($order_result->num_rows === 0) {
    echo "Không tìm thấy đơn hàng.";
    exit;
}

$order = $order_result->fetch_assoc();
$cart_id = $order['cart_id'];

// Lấy sản phẩm trong đơn hàng + thông tin sản phẩm từ bảng product_instock
$sql_items = "
    SELECT pic.*, p.product_display_name, p.image 
    FROM product_in_cart pic
    JOIN product_instock p ON pic.product_id = p.product_id
    WHERE pic.cart_id = $cart_id
";
$items_result = $conn->query($sql_items);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng #<?= $order['order_id'] ?></title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h2>Chi tiết đơn hàng #<?= $order['order_id'] ?></h2>
    <p><strong>Cart ID:</strong> <?= $order['cart_id'] ?></p>
    <p><strong>User ID:</strong> <?= $order['user_id'] ?></p>
    <p><strong>Ngày đặt:</strong> <?= $order['order_date'] ?></p>
    <p><strong>Tổng tiền:</strong> <?= number_format($order['total_price'], 0, ',', '.') ?> đ</p>
    <p><strong>Trạng thái:</strong> <?= htmlspecialchars($order['status']) ?></p>

    <h3>Sản phẩm trong đơn hàng</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá (USD)</th>
            <th>Thành tiền (USD)</th>
        </tr>
        <?php if ($items_result && $items_result->num_rows > 0): ?>
            <?php while ($item = $items_result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php if (!empty($item['image'])): ?>
                            <img src="<?= htmlspecialchars($item['image']) ?>" width="60">
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

    <p><a href="myorder.php">⬅ Quay lại danh sách đơn hàng</a></p>
</body>
</html>
