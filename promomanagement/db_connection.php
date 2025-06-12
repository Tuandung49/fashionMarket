<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'fashionmarket';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
