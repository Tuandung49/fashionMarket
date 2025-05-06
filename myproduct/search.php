<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require 'config.php';

// Lấy từ khóa tìm kiếm
$keyword = trim($_GET['q'] ?? '');
$keyword_escaped = $conn->real_escape_string($keyword);

// Lấy sắp xếp
$sort = $_GET['sort'] ?? 'product_id';
$order = $_GET['order'] ?? 'asc';

$allowed = ['product_display_name', 'quantity', 'price'];
$sort = in_array($sort, $allowed) ? $sort : 'product_id';
$order = ($order === 'desc') ? 'desc' : 'asc';

// Phân trang
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Đếm tổng số kết quả
$count_sql = "SELECT COUNT(*) AS total FROM product_instock 
              WHERE product_display_name LIKE '%$keyword_escaped%' 
                 OR description LIKE '%$keyword_escaped%'";
$total_result = $conn->query($count_sql);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

// Truy vấn kết quả tìm kiếm
$sql = "SELECT * FROM product_instock 
        WHERE product_display_name LIKE '%$keyword_escaped%' 
           OR description LIKE '%$keyword_escaped%' 
        ORDER BY $sort $order 
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Hàm tạo liên kết sắp xếp
function sort_link($field, $label, $current_sort, $current_order, $keyword, $page) {
    $next_order = ($current_sort === $field && $current_order === 'asc') ? 'desc' : 'asc';
    return "<a href='?q=" . urlencode($keyword) . "&sort=$field&order=$next_order&page=$page'>$label</a>";
}
?>

<h2>Kết quả tìm kiếm cho: <em><?= htmlspecialchars($keyword) ?></em></h2>
<a href="index.php">← Quay lại danh sách</a>

<form method="GET" action="search.php" style="margin-top:10px;">
    <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>" placeholder="Tìm kiếm...">
    <button type="submit">Tìm</button>
</form>

<?php if ($total_products == 0): ?>
    <p>Không tìm thấy sản phẩm nào.</p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top:10px;">
        <tr>
            <th>ID</th>
            <th><?= sort_link('product_display_name', 'Tên sản phẩm', $sort, $order, $keyword, $page) ?></th>
            <th>Mô tả</th>
            <th><?= sort_link('quantity', 'Số lượng', $sort, $order, $keyword, $page) ?></th>
            <th><?= sort_link('price', 'Giá', $sort, $order, $keyword, $page) ?></th>
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
            <?php if ($i == $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="?q=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&order=<?= $order ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php endif; ?>
            <?php if ($i < $total_pages): ?> | <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

</body>
</html>