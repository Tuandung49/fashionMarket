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
$conn->query("DELETE FROM product_instock WHERE product_id = $id");
header("Location: index.php");
?>
