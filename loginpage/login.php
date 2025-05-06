<?php
session_start();
require '../config/db.php';
$requestMethod = $_SERVER['REQUEST_METHOD'];

if($requestMethod === 'POST' ){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Lưu thông tin user vào session
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        echo "success";
    } else {
        http_response_code(400);
        echo "Sai tài khoản hoặc mật khẩu";
    }

} else {
    http_response_code(405);
    echo "Chỉ chấp nhận phương thức POST";
}
?>
