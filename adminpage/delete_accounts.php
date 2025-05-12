<?php
include 'connect.php';

$id = $_POST['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM accounts WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "fail: " . $stmt->error;  // Hiển thị lỗi SQL nếu có
    }
} else {
    echo "invalid";
}
?>