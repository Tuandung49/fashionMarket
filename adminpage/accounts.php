<?php
include 'connect.php';

$search = $_GET['search'] ?? '';
$role = $_GET['role'] ?? 'all';

$sql = "SELECT * FROM user WHERE 1=1"; // luôn đúng
$params = []; // khởi tạo mảng

if (!empty($search)) {
    $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($role !== 'all') {
    $sql .= " AND role = ?";
    $params[] = $role;
}

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$user = [];
while ($row = $result->fetch_assoc()) {
    $user[] = $row;
}

header('Content-Type: application/json');
echo json_encode($user);
