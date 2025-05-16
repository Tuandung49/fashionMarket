<?php
include 'connect.php';

header('Content-Type: application/json');

// Kiểm tra phương thức
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Chỉ chấp nhận phương thức POST']);
    exit;
}

// Lấy và validate ID
$userId = $_POST['id'] ?? null;

if ($userId === null) {
    echo json_encode(['status' => 'error', 'message' => 'Thiếu thông tin ID']);
    exit;
}

// Chuyển đổi sang kiểu số
$numericId = filter_var($userId, FILTER_VALIDATE_INT);

if ($numericId === false || $numericId <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ID không hợp lệ (phải là số nguyên dương)']);
    exit;
}

try {
    // Kiểm tra tài khoản tồn tại trước khi xóa
    $checkStmt = $conn->prepare("SELECT user_id FROM user WHERE user_id = ?");
    $checkStmt->bind_param("i", $numericId);
    $checkStmt->execute();
    
    if ($checkStmt->get_result()->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy tài khoản với ID: ' . $numericId]);
        exit;
    }

    // Bắt đầu transaction
    $conn->begin_transaction();

    // 1. Xóa các bản ghi liên quan (nếu có)
    // $conn->query("DELETE FROM user_permissions WHERE user_id = $numericId");
    
    // 2. Xóa tài khoản chính
    $deleteStmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    $deleteStmt->bind_param("i", $numericId);
    $deleteStmt->execute();

    // Kiểm tra kết quả
    if ($deleteStmt->affected_rows === 0) {
        throw new Exception("Không thể xóa tài khoản");
    }

    $conn->commit();
    echo json_encode(['status' => 'success', 'message' => 'Xóa tài khoản thành công']);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống: ' . $e->getMessage()]);
}
?>