<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body></body>
<?php
require 'config.php';

$id = $_GET['id'];
$product = $conn->query("SELECT * FROM product_instock WHERE product_id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_display_name'];
    $desc = $_POST['description'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $colour = $_POST['colour'];
    $image = $product['image'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $stmt = $conn->prepare("UPDATE product_instock SET product_display_name=?, description=?, quantity=?, price=?, colour=?, image=? WHERE product_id=?");
    $stmt->bind_param("ssidsii", $name, $desc, $qty, $price, $colour, $image, $id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<h2>Sửa sản phẩm</h2>
<form method="POST" enctype="multipart/form-data">
    Tên: <input name="product_display_name" value="<?= $product['product_display_name'] ?>"><br>
    Mô tả: <textarea name="description"><?= $product['description'] ?></textarea><br>
    Số lượng: <input type="number" name="quantity" value="<?= $product['quantity'] ?>"><br>
    Giá: <input type="text" name="price" value="<?= $product['price'] ?>"><br>
    Màu: <input name="colour" value="<?= $product['colour'] ?>"><br>
    Ảnh: <input type="file" name="image"><br>
    <img src="uploads/<?= $product['image'] ?>" width="80"><br>
    <button type="submit">Cập nhật</button>
</form>
<a href="index.php">Quay lại</a>
