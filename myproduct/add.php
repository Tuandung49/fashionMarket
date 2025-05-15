<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="container">
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_display_name'];
    $desc = $_POST['description'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $colour = $_POST['colour'];
    $image = trim($_POST['image']);

    if (!filter_var($image, FILTER_VALIDATE_URL)) {
        echo "<p class='error'>Link ảnh không hợp lệ!</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO product_instock (product_display_name, description, quantity, price, colour, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssidss", $name, $desc, $qty, $price, $colour, $image);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}
?>

    <h2>Thêm sản phẩm</h2>
    <form method="POST">
        <div class="form-group">
            <label for="product_display_name">Tên:</label>
            <input type="text" id="product_display_name" name="product_display_name">
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng:</label>
            <input type="number" id="quantity" name="quantity">
        </div>

        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="text" id="price" name="price">
        </div>

        <div class="form-group">
            <label for="colour">Màu:</label>
            <input type="text" id="colour" name="colour">
        </div>

        <div class="form-group">
            <label for="image">Ảnh (link):</label>
            <input type="text" id="image" name="image" placeholder="http://..." required>
        </div>

        <button type="submit">Thêm</button>
    </form>

    <a href="index.php">← Quay lại</a>
</div>
</body>
</html>
