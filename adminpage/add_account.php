<?php
include 'connect.php';

header('Content-Type: application/json');

// Kiểm tra phương thức POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Chỉ chấp nhận phương thức POST']);
    exit;
}

// Lấy và validate dữ liệu
$required_fields = ['username', 'password', 'email', 'first_name', 'birth', 'accountType'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['status' => 'error', 'message' => "Thiếu trường bắt buộc: $field"]);
        exit;
    }
}

// Xử lý dữ liệu
$username = trim($_POST['username']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if (!$email) {
    echo json_encode(['status' => 'error', 'message' => 'Email không hợp lệ']);
    exit;
}

// Kiểm tra trùng lặp
$check = $conn->prepare("SELECT user_id FROM user WHERE username = ? OR email = ?");
$check->bind_param("ss", $username, $email);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập hoặc email đã tồn tại']);
    exit;
}

// Chuẩn bị dữ liệu
$user_type = ($_POST['accountType'] === 'admin') ? 2 : 1;
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$birth_date = date('Y-m-d', strtotime($_POST['birth']));

// Thêm vào database
try {
    $stmt = $conn->prepare("INSERT INTO user (username, password, email, first_name, last_name, gender, birth, user_type, user_level, create_acc_day) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())");
    $stmt->bind_param("sssssis", 
        $username,
        $hashed_password,
        $email,
        $_POST['first_name'],
        $_POST['last_name'] ?? '',
        $_POST['gender'] ?? 1,
        $birth_date,
        $user_type
    );
    
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Thêm tài khoản thành công',
            'user_id' => $stmt->insert_id // Trả về ID mới tạo
        ]);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Lỗi database: ' . $e->getMessage()]);
}
?>