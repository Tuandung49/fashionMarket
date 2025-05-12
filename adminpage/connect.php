<?php
$host = "localhost";      
$username = "root";       
$password = "";           
$dbname = "fashionmarket1";

// Tạo kết nối
$conn = new mysqli($host, $username, $password, $dbname);

// Kiểm tra lỗi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>