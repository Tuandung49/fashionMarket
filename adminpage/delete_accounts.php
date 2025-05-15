<?php
include 'connect.php';

// Bật debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Nhận dữ liệu
$input = file_get_contents("php://input");
parse_str($input, $data);
$id = $data['id'] ?? $_POST['id'] ?? null;

// Debug log
file_put_contents('delete_debug.log', 
    "ID received: " . var_export($id, true) . "\n" .
    "POST data: " . print_r($_POST, true) . "\n",
    FILE_APPEND
);

// Validate
if (!$id || !ctype_digit($id)) {
    die("invalid: ID không hợp lệ (" . gettype($id) . ")");
}

// Thực hiện xóa
try {
    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "fail: " . $stmt->error;
    }
} catch (Exception $e) {
    echo "error: " . $e->getMessage();
}
?>