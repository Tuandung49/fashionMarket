<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<header style="background-color: #4caf50; padding: 10px;">
    <nav style="display: flex; gap: 20px;">
        <a href="../homePage/HomePage.php" style="color: white; text-decoration: none; font-weight: bold;">🏠 Trang chủ</a>
        <a href="../myorder/myorder.php" style="color: white; text-decoration: none; font-weight: bold;">📦 Đơn hàng của tôi</a>
    </nav>
</header>
</body>
<?php
require 'config.php';

$sort = $_GET['sort'] ?? 'product_id';
$order = $_GET['order'] ?? 'asc';

$allowed = ['product_display_name', 'quantity', 'price'];
$sort = in_array($sort, $allowed) ? $sort : 'product_id';
$order = ($order === 'desc') ? 'desc' : 'asc';

$sql = "SELECT * FROM product_instock ORDER BY $sort $order";
$result = $conn->query($sql);

// Phân trang
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Tổng số sản phẩm
$total_result = $conn->query("SELECT COUNT(*) AS total FROM product_instock");
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

// Truy vấn có sắp xếp và phân trang
$sql = "SELECT * FROM product_instock ORDER BY $sort $order LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
function sort_link($field, $label, $current_sort, $current_order) {
    $next_order = ($current_sort === $field && $current_order === 'asc') ? 'desc' : 'asc';
    return "<a href='?sort=$field&order=$next_order'>$label</a>";
}
?>

<h2>Danh sách sản phẩm</h2>
<a href="add.php">Thêm sản phẩm</a>
<form method="GET" action="search.php" style="margin-top:10px;">
    <input type="text" name="q" placeholder="Tìm kiếm...">
    <button type="submit">Tìm</button>
</form>

<table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px;">
    <tr>
        <th>ID</th>
        <th><?= sort_link('product_display_name', 'Tên sản phẩm', $sort, $order) ?></th>
        <th>Mô tả</th>
        <th><?= sort_link('quantity', 'Số lượng', $sort, $order) ?></th>
        <th><?= sort_link('price', 'Giá', $sort, $order) ?></th>
        <th>Màu</th>
        <th>Ảnh</th>
        <th>Hành động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['product_id'] ?></td>
        <td><?= htmlspecialchars($row['product_display_name']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td><?= $row['quantity'] ?></td>
        <td><?= number_format($row['price'], 0, ',', '.') ?> đ</td>
        <td><?= htmlspecialchars($row['colour']) ?></td>
        <td>
            <?php if (!empty($row['image'])): ?>
                <img src="<?= htmlspecialchars($row['image']) ?>" width="60">
            <?php else: ?>
                Không có ảnh
            <?php endif; ?>
        </td>
        <td>
            <a href="edit.php?id=<?= $row['product_id'] ?>">Sửa</a> |
            <a href="delete.php?id=<?= $row['product_id'] ?>" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>


<!-- Hiển thị phân trang -->
<div style="margin-top: 20px;">
    <strong>Trang:</strong>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i == $page): ?>
            <strong><?= $i ?></strong>
        <?php else: ?>
            <a href="?sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
        <?php if ($i < $total_pages): ?> | <?php endif; ?>
    <?php endfor; ?>
</div>

</body>
</html>