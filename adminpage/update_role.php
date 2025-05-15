<?php
include 'connect.php';

// Bật debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Nhận dữ liệu
$id = $_POST['id'] ?? null;
$newRole = $_POST['role'] ?? null;

// Validate
if (!$id || !ctype_digit($id)) {
    die("invalid: ID phải là số");
}

if (!in_array($newRole, ['buyer', 'seller'])) {
    die("invalid: Role không hợp lệ");
}

// Xử lý
try {
    $user_type = ($newRole === 'seller') ? 1 : 0;
    $stmt = $conn->prepare("UPDATE user SET user_type = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $user_type, $id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "fail: " . $stmt->error;
    }
} catch (Exception $e) {
    echo "error: " . $e->getMessage();
}
?>