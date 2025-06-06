<?php
include 'connect.php';

header('Content-Type: application/json');

// Nhận dữ liệu từ FormData
$userId = $_POST['id'] ?? null;
$newRole = $_POST['role'] ?? null;

// Validate input
if (!$userId || !$newRole) {
    echo json_encode(['status' => 'error', 'message' => 'Thiếu thông tin id hoặc role']);
    exit;
}

// Chuyển role thành số
$roleMapping = [
    'buyer' => 0,
    'seller' => 1,
    'admin' => 2
];

if (!array_key_exists(strtolower($newRole), $roleMapping)) {
    echo json_encode(['status' => 'error', 'message' => 'Role không hợp lệ']);
    exit;
}

$roleValue = $roleMapping[strtolower($newRole)];

try {
    // Cập nhật database
    $stmt = $conn->prepare("UPDATE user SET user_type = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $roleValue, $userId);
    $stmt->execute();
    
    echo json_encode([
        'status' => 'success', 
        'message' => 'Cập nhật thành công',
        'newRole' => $newRole
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>