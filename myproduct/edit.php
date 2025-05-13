<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<?php
require 'config.php';

// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy thông tin sản phẩm từ DB
$product = $conn->query("SELECT * FROM product_instock WHERE product_id = $id")->fetch_assoc();

if (!$product) {
    echo "<p>Sản phẩm không tồn tại.</p>";
    exit;
}

// Xử lý khi submit form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_display_name'];
    $desc = $_POST['description'];
    $qty = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $colour = $_POST['colour'];
    $image = $_POST['image']; // Link ảnh nhập từ form

    // Cập nhật vào database
    $stmt = $conn->prepare("UPDATE product_instock SET product_display_name=?, description=?, quantity=?, price=?, colour=?, image=? WHERE product_id=?");
    $stmt->bind_param("ssidssi", $name, $desc, $qty, $price, $colour, $image, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<h2>Sửa sản phẩm</h2>
<form method="POST">
    Tên: <input name="product_display_name" value="<?= htmlspecialchars($product['product_display_name']) ?>"><br>
    Mô tả: <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea><br>
    Số lượng: <input type="number" name="quantity" value="<?= $product['quantity'] ?>"><br>
    Giá: <input type="text" name="price" value="<?= $product['price'] ?>"><br>
    Màu: <input name="colour" value="<?= htmlspecialchars($product['colour']) ?>"><br>
    Link ảnh: <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>"><br>

    <?php if (!empty($product['image'])): ?>
        <img src="<?= htmlspecialchars($product['image']) ?>" width="80" onerror="this.style.display='none'"><br>
    <?php endif; ?>

    <button type="submit">Cập nhật</button>
</form>
<a href="index.php">Quay lại</a>
</body>
</html>
