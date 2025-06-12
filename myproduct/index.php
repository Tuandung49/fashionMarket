<?php
require 'config.php';

$search = $_GET['q'] ?? '';
$quantity_filter = $_GET['quantity_filter'] ?? '';
$price_filter = $_GET['price_filter'] ?? '';
$name_filter = $_GET['name_filter'] ?? '';
$min_price = is_numeric($_GET['min_price'] ?? '') ? (int)$_GET['min_price'] : '';
$max_price = is_numeric($_GET['max_price'] ?? '') ? (int)$_GET['max_price'] : '';

$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// WHERE conditions
$where_clauses = [];
if (!empty($search)) {
    $search_escaped = $conn->real_escape_string($search);
    $where_clauses[] = "(product_display_name LIKE '%$search_escaped%' OR description LIKE '%$search_escaped%')";
}
if ($min_price !== '' && $max_price !== '') {
    $where_clauses[] = "price BETWEEN $min_price AND $max_price";
} elseif ($min_price !== '') {
    $where_clauses[] = "price >= $min_price";
} elseif ($max_price !== '') {
    $where_clauses[] = "price <= $max_price";
}
$where = count($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) : '';

// ORDER BY logic
$order_by = "ORDER BY product_id ASC";
if ($name_filter) {
    $order_by = "ORDER BY product_display_name " . strtoupper($name_filter);
} elseif ($quantity_filter) {
    $order_by = "ORDER BY quantity " . strtoupper($quantity_filter);
} elseif ($price_filter) {
    $order_by = "ORDER BY price " . strtoupper($price_filter);
}

// Tổng số sản phẩm
$total_sql = "SELECT COUNT(*) AS total FROM product_instock $where";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

// Lấy dữ liệu sản phẩm
$sql = "SELECT * FROM product_instock $where $order_by LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

function sort_link($field, $label, $current_sort, $current_order) {
    $next_order = ($current_sort === $field && $current_order === 'asc') ? 'desc' : 'asc';
    return "<a href='?sort=$field&order=$next_order'>$label</a>";
}
?>
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
<h2>Danh sách sản phẩm</h2>
<a href="add.php">Thêm sản phẩm</a>
<form method="GET" action="" style="margin-top:10px;">
    <input type="text" name="q" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($search) ?>">

    <select name="quantity_filter">
        <option value="">-- Số lượng --</option>
        <option value="asc" <?= $quantity_filter === 'asc' ? 'selected' : '' ?>>Tăng dần</option>
        <option value="desc" <?= $quantity_filter === 'desc' ? 'selected' : '' ?>>Giảm dần</option>
    </select>

    <select name="price_filter">
        <option value="">-- Giá --</option>
        <option value="asc" <?= $price_filter === 'asc' ? 'selected' : '' ?>>Tăng dần</option>
        <option value="desc" <?= $price_filter === 'desc' ? 'selected' : '' ?>>Giảm dần</option>
    </select>

    <select name="name_filter">
        <option value="">-- Tên A-Z --</option>
        <option value="asc" <?= $name_filter === 'asc' ? 'selected' : '' ?>>A-Z</option>
        <option value="desc" <?= $name_filter === 'desc' ? 'selected' : '' ?>>Z-A</option>
    </select>

    Giá từ: <input type="number" name="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>" style="width:80px;">
    đến <input type="number" name="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>" style="width:80px;">

    <button type="submit">Lọc</button>
</form>

<table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px;">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Mô tả</th>
        <th>Số lượng</th>
        <th>Giá</th>
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
            <a href="?page=<?= $i ?>&q=<?= urlencode($search) ?>&quantity_filter=<?= $quantity_filter ?>&price_filter=<?= $price_filter ?>&name_filter=<?= $name_filter ?>&min_price=<?= $min_price ?>&max_price=<?= $max_price ?>"><?= $i ?></a>
        <?php endif; ?>
        <?php if ($i < $total_pages): ?> | <?php endif; ?>
    <?php endfor; ?>
</div>

</body>
</html>
