<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý hành động thêm/xóa
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'add' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $name = $_GET['name'];
        $price = $_GET['price'];

        // Nếu sản phẩm đã có thì tăng số lượng
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => 1
            ];
        }
    }

    if ($action === 'remove' && isset($_GET['id'])) {
        unset($_SESSION['cart'][$_GET['id']]);
    }

    if ($action === 'clear') {
        $_SESSION['cart'] = [];
    }

    // Quay lại chính trang cart
    header('Location: cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f9f9f9; }
        table { width: 100%; background: white; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background: #eee; }
        a.button { padding: 6px 10px; text-decoration: none; background: #3498db; color: white; border-radius: 5px; }
        a.button.red { background: #e74c3c; }
    </style>
</head>
<body>

    <h1>Giỏ hàng của bạn</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Giỏ hàng đang trống. <a href="../homePage/HomePage.php">Tiếp tục mua sắm</a></p>
    <?php else: ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Xoá</th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $id => $item):
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= number_format($item['price']) ?>đ</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($itemTotal) ?>đ</td>
                <td><a class="button red" href="cart.php?action=remove&id=<?= $id ?>">Xoá</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="3">Tổng cộng</th>
                <th colspan="2"><?= number_format($total) ?>đ</th>
            </tr>
        </table>
        <a class="button" href="homepage.php">← Tiếp tục mua</a>
        <a class="button red" href="cart.php?action=clear">🗑 Xoá toàn bộ</a>
    <?php endif; ?>

</body>
</html>
