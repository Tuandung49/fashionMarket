<?php

include 'connect.php';

$search = $_GET['search'] ?? '';
$role = $_GET['role'] ?? 'all';

$sql = "SELECT 
            u.user_id,  
            u.fullname as name, 
            u.email, 
            CASE 
                WHEN u.user_type = 0 THEN 'buyer'
                WHEN u.user_type = 1 THEN 'seller'
                WHEN u.user_type = 2 THEN 'admin'
            END as role,
            u.user_type
        FROM user u
        WHERE 1=1";

$params = [];

if (!empty($search)) {
    $sql .= " AND (u.fullname LIKE ? OR u.email LIKE ?)";
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

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = [
        'user_id' => $row['user_id'],  
        'name' => $row['name'],
        'email' => $row['email'],
        'role' => $row['role'],
        'user_type' => $row['user_type']
    ];
}

echo json_encode($users);
?>