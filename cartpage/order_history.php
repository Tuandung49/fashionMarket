<?php
session_start();
require 'config.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo "Bạn cần đăng nhập để xem lịch sử đơn hàng.";
    exit;
}

// Phân trang
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Đếm tổng số đơn hàng
$count_sql = "SELECT COUNT(*) AS total FROM orders WHERE user_id = ?";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("i", $user_id);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_orders = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_orders / $limit);

// Lấy đơn hàng theo trang
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch sử đơn hàng</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <h2>Lịch sử đơn hàng của bạn</h2>

    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
            </tr>
            <?php while ($order = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $order['order_id'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                    <td><?= number_format($order['total_price'], 0, ',', '.') ?> đ</td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><a href="buyerorder_detail.php?id=<?= $order['order_id'] ?>">Xem</a></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Phân trang -->
        <div style="margin-top: 20px;">
            <strong>Trang:</strong>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <strong><?= $i ?></strong>
                <?php else: ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
                <?php if ($i < $total_pages): ?> | <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <p>Không có đơn hàng nào.</p>
    <?php endif; ?>

    <p><a href="../homePage/HomePage.php">🏠 Quay về Trang chủ</a></p>
</body>
</html>
