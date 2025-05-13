<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="container">
<?php
require 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $conn->query("SELECT * FROM product_instock WHERE product_id = $id")->fetch_assoc();

if (!$product) {
    echo "<p class='error'>Sản phẩm không tồn tại.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_display_name'];
    $desc = $_POST['description'];
    $qty = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $colour = $_POST['colour'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("UPDATE product_instock SET product_display_name=?, description=?, quantity=?, price=?, colour=?, image=? WHERE product_id=?");
    $stmt->bind_param("ssidssi", $name, $desc, $qty, $price, $colour, $image, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<h2>Sửa sản phẩm</h2>
<form method="POST">
    <div class="form-group">
        <label for="product_display_name">Tên:</label>
        <input type="text" id="product_display_name" name="product_display_name" value="<?= htmlspecialchars($product['product_display_name']) ?>">
    </div>

    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description"><?= htmlspecialchars($product['description']) ?></textarea>
    </div>

    <div class="form-group">
        <label for="quantity">Số lượng:</label>
        <input type="number" id="quantity" name="quantity" value="<?= $product['quantity'] ?>">
    </div>

    <div class="form-group">
        <label for="price">Giá:</label>
        <input type="text" id="price" name="price" value="<?= $product['price'] ?>">
    </div>

    <div class="form-group">
        <label for="colour">Màu:</label>
        <input type="text" id="colour" name="colour" value="<?= htmlspecialchars($product['colour']) ?>">
    </div>

    <div class="form-group">
        <label for="image">Link ảnh:</label>
        <input type="text" id="image" name="image" value="<?= htmlspecialchars($product['image']) ?>">
    </div>

    <?php if (!empty($product['image'])): ?>
        <div class="form-group">
            <img src="<?= htmlspecialchars($product['image']) ?>" width="80" onerror="this.style.display='none'">
        </div>
    <?php endif; ?>

    <button type="submit">Cập nhật</button>
</form>
<a href="index.php">Quay lại</a>
</div>
</body>
</html>
