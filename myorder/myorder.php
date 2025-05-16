<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng cần duyệt</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<header style="background-color: #4caf50; padding: 10px;">
    <nav style="display: flex; gap: 20px;">
        <a href="../homePage/HomePage.php" style="color: white; text-decoration: none; font-weight: bold;">🏠 Trang chủ</a>
        <a href="../myproduct/index.php" style="color: white; text-decoration: none; font-weight: bold;">📦 Danh sách sản phẩm</a>
    </nav>
</header>

<h2>Danh sách đơn hàng</h2>

<?php if (isset($_GET['message'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
<?php endif; ?>

<!-- Form lọc trạng thái -->
<form method="GET" style="margin-top: 10px;">
    <label for="status">Lọc theo trạng thái: </label>
    <select name="status" id="status" onchange="this.form.submit()">
        <option value="">-- Tất cả --</option>
        <option value="pending" <?= (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : '' ?>>Chờ duyệt</option>
        <option value="approved" <?= (isset($_GET['status']) && $_GET['status'] == 'approved') ? 'selected' : '' ?>>Đã duyệt</option>
        <option value="rejected" <?= (isset($_GET['status']) && $_GET['status'] == 'rejected') ? 'selected' : '' ?>>Đã từ chối</option>
    </select>
</form>

<?php
require 'config.php';

// Phân trang
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Lọc trạng thái nếu có
$status_filter = '';
$status_param = '';
if (isset($_GET['status']) && in_array($_GET['status'], ['pending', 'approved', 'rejected'])) {
    $status = $_GET['status'];
    $status_filter = "WHERE status = '$status'";
    $status_param = "&status=$status";
}

// Đếm tổng số đơn hàng để tính tổng số trang
$count_sql = "SELECT COUNT(*) AS total FROM orders $status_filter";
$count_result = $conn->query($count_sql);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

// Lấy danh sách đơn hàng
$sql = "SELECT * FROM orders $status_filter ORDER BY order_date DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<table border="1" cellpadding="8" cellspacing="0" style="margin-top: 10px;">
    <tr>
        <th>ID đơn hàng</th>
        <th>Cart ID</th>
        <th>User ID</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['order_id'] ?></td>
                <td><?= $row['cart_id'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['order_date'] ?></td>
                <td><?= number_format($row['total_price'], 0, ',', '.') ?> USD</td>
                <td><?= $row['status'] ?></td>
                <td>
                    <a href="order_detail.php?id=<?= $row['order_id'] ?>">Chi tiết</a> |
                    <?php if ($row['status'] === 'pending'): ?>
                        <a href="approve_order.php?id=<?= $row['order_id'] ?>" onclick="return confirm('Duyệt đơn hàng này?')">Duyệt</a> |
                        <a href="reject_order.php?id=<?= $row['order_id'] ?>" onclick="return confirm('Từ chối đơn hàng này?')">Từ chối</a>
                    <?php else: ?>
                        Không khả dụng
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="7">Không có đơn hàng nào.</td></tr>
    <?php endif; ?>
</table>

<!-- Phân trang -->
<?php if ($total_pages > 1): ?>
    <div style="margin-top: 20px;">
        <strong>Trang:</strong>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="?page=<?= $i . $status_param ?>"><?= $i ?></a>
            <?php endif; ?>
            <?php if ($i < $total_pages): ?> | <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

</body>
</html>
