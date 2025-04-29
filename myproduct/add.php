<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<body></body>
<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_display_name'];
    $desc = $_POST['description'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $colour = $_POST['colour'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);

    $stmt = $conn->prepare("INSERT INTO products (product_display_name, description, quantity, price, colour, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssidss", $name, $desc, $qty, $price, $colour, $image);
    $stmt->execute();
    header("Location: index.php");
}
?>

<h2>Thêm sản phẩm</h2>
<form method="POST" enctype="multipart/form-data">
    Tên: <input name="product_display_name"><br>
    Mô tả: <textarea name="description"></textarea><br>
    Số lượng: <input type="number" name="quantity"><br>
    Giá: <input type="text" name="price"><br>
    Màu: <input name="colour"><br>
    Ảnh: <input type="file" name="image"><br>
    <button type="submit">Thêm</button>
</form>
<a href="index.php">Quay lại</a>
