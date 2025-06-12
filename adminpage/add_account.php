<?php
include 'connect.php';

header('Content-Type: application/json');

// Debug: Ghi lại dữ liệu POST nhận được để kiểm tra
file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

// Chỉ chấp nhận POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Chỉ chấp nhận phương thức POST']);
    exit;
}

// Các trường bắt buộc theo DB
$required_fields = ['username', 'password', 'email', 'fullname', 'birth', 'address', 'user_type'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['status' => 'error', 'message' => "Thiếu trường bắt buộc: $field"]);
        exit;
    }
}

// Lấy dữ liệu
$username = trim($_POST['username']);
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
if (!$email) {
    echo json_encode(['status' => 'error', 'message' => 'Email không hợp lệ']);
    exit;
}
$fullname = trim($_POST['fullname']);
$address = trim($_POST['address']);
$gender = isset($_POST['gender']) ? intval($_POST['gender']) : 1;
$birth = $_POST['birth'];
$user_type = isset($_POST['user_type']) ? intval($_POST['user_type']) : 1; // 0: buyer, 1: seller, 2: admin
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Kiểm tra trùng username/email
$check = $conn->prepare("SELECT user_id FROM user WHERE username = ? OR email = ?");
$check->bind_param("ss", $username, $email);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Tên đăng nhập hoặc email đã tồn tại']);
    exit;
}

// Thêm vào DB
try {
    $stmt = $conn->prepare("INSERT INTO user (username, password, address, email, gender, birth, user_type, used_promote, fullname, create_acc_day) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?, NOW())");
    $params = [
        $username,
        $hashed_password,
        $address,
        $email,
        (int)$gender,
        $birth,
        (int)$user_type,
        $fullname
    ];
    $stmt->bind_param("ssssisss", ...$params);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Thêm tài khoản thành công',
            'user_id' => $stmt->insert_id
        ]);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Lỗi database: ' . $e->getMessage()]);
}
?>