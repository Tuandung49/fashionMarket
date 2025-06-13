<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header style="background-color: #4caf50; padding: 10px;">
    <nav style="display: flex; gap: 20px;">
        <a href="../homePage/HomePage.php" style="color: white; text-decoration: none; font-weight: bold;">🏠 Trang chủ</a>
        <a href="myorder.php" style="color: white; text-decoration: none; font-weight: bold;">📦 Đơn hàng của tôi</a>
    </nav>
</header>

<?php
require 'config.php';

// Lấy dữ liệu từ GET
$keyword = trim($_GET['q'] ?? '');
$keyword_escaped = $conn->real_escape_string($keyword);
$sort = $_GET['sort'] ?? 'product_id';
$order = $_GET['order'] ?? 'asc';
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;

// Validate
$allowed = ['product_display_name', 'quantity', 'price'];
$sort = in_array($sort, $allowed) ? $sort : 'product_id';
$order = ($order === 'desc') ? 'desc' : 'asc';

// Phân trang
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Xây dựng điều kiện lọc
$where = "WHERE (product_display_name LIKE '%$keyword_escaped%' OR description LIKE '%$keyword_escaped%')";
if ($min_price > 0) {
    $where .= " AND price >= $min_price";
}
if ($max_price > 0) {
    $where .= " AND price <= $max_price";
}

// Đếm tổng kết quả
$count_sql = "SELECT COUNT(*) AS total FROM product_instock $where";
$total_result = $conn->query($count_sql);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

// Truy vấn chính
$sql = "SELECT * FROM product_instock $where ORDER BY $sort $order LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Hàm tạo liên kết sắp xếp
function sort_link($field, $label, $current_sort, $current_order, $params) {
    $next_order = ($current_sort === $field && $current_order === 'asc') ? 'desc' : 'asc';
    $query = http_build_query(array_merge($params, ['sort' => $field, 'order' => $next_order]));
    return "<a href='?$query'>$label</a>";
}
?>

<h2>Kết quả tìm kiếm cho: <em><?= htmlspecialchars($keyword) ?></em></h2>
<a href="index.php">← Quay lại danh sách</a>

<!-- Form tìm kiếm & lọc -->
<form method="GET" action="search.php" style="margin-top:10px;">
    <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>" placeholder="Tìm kiếm...">
    <input type="number" name="min_price" value="<?= $min_price ?>" placeholder="Giá từ" min="0">
    <input type="number" name="max_price" value="<?= $max_price ?>" placeholder="Đến" min="0">
    <button type="submit">Lọc</button>
</form>

<?php if ($total_products == 0): ?>
    <p>Không tìm thấy sản phẩm nào.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px;">
        <tr>
            <th>ID</th>
            <th><?= sort_link('product_display_name', 'Tên sản phẩm', $sort, $order, $_GET) ?></th>
            <th>Mô tả</th>
            <th><?= sort_link('quantity', 'Số lượng', $sort, $order, $_GET) ?></th>
            <th><?= sort_link('price', 'Giá', $sort, $order, $_GET) ?></th>
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

    <!-- Phân trang -->
    <div style="margin-top: 20px;">
        <strong>Trang:</strong>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php
                $query = http_build_query(array_merge($_GET, ['page' => $i]));
                if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="?<?= $query ?>"><?= $i ?></a>
            <?php endif; ?>
            <?php if ($i < $total_pages): ?> | <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

</body>
</html>
