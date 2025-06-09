<?php
session_start();

// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "fashionmarket");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);

// Kiểm tra người dùng đăng nhập
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo "Bạn cần đăng nhập để xem lịch sử đơn hàng.";
    exit;
}

// Lấy danh sách đơn hàng của người dùng
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch sử đơn hàng</title>
    <link rel="stylesheet" href="../style1.css"> <!-- Thay bằng file CSS nếu có -->
</head>
<body>
    <h2>Lịch sử đơn hàng của bạn</h2>

    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền (VNĐ)</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
            </tr>
            <?php while ($order = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $order['order_id'] ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                    <td><?= number_format($order['total_price'], 0, ',', '.') ?> đ</td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><a href="order_detail.php?id=<?= $order['order_id'] ?>">Xem</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Không có đơn hàng nào.</p>
    <?php endif; ?>

    <p><a href="../homePage/HomePage.php">🏠 Quay về Trang chủ</a></p>
</body>
</html>
