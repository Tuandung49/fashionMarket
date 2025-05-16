<?php
include 'connect.php';

$search = $_GET['search'] ?? '';
$role = $_GET['role'] ?? 'all';

$sql = "SELECT 
            u.user_id,  
            CONCAT(u.first_name, ' ', u.last_name) as name, 
            u.email, 
            CASE 
                WHEN u.user_type = 0 THEN 'buyer'
                WHEN u.user_type = 1 THEN 'seller'
                WHEN u.user_type = 2 THEN 'admin'
            END as role,
            u.first_name,  
            u.last_name,
            u.user_type,
            u.user_level  -- Thêm trường user_level
        FROM user u
        WHERE 1=1";

$params = [];

if (!empty($search)) {
    $sql .= " AND (u.first_name LIKE ? OR u.last_name LIKE ? OR u.email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($role !== 'all') {
    $user_type = ($role === 'buyer') ? 0 : (($role === 'seller') ? 1 : 2);
    $sql .= " AND u.user_type = ?";
    $params[] = $user_type;
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$users = []; // Đổi tên biến cho rõ ràng
while ($row = $result->fetch_assoc()) {
    $users[] = [
        'user_id' => $row['user_id'],  
        'name' => $row['name'],
        'email' => $row['email'],
        'role' => $row['role'],
        'first_name' => $row['first_name'],
        'last_name' => $row['last_name'],
        'user_type' => $row['user_type'],
        'user_level' => $row['user_level'] // Thêm user_level vào kết quả
    ];
}

echo json_encode($users);
?>