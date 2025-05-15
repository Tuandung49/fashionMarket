<?php
include 'connect.php';

$search = $_GET['search'] ?? '';
$role = $_GET['role'] ?? 'all';

$sql = "SELECT 
            user_id,  
            CONCAT(first_name, ' ', last_name) as name, 
            email, 
            IF(user_type = 1, 'seller', 'buyer') as role,
            first_name,  
            last_name  
        FROM user 
        WHERE 1=1";

$params = [];

if (!empty($search)) {
    $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($role !== 'all') {
    $sql .= " AND user_type = ?";
    $params[] = ($role === 'seller') ? 1 : 0;
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
    $user[] = [
        'user_id' => $row['user_id'],  
        'name' => $row['name'],
        'email' => $row['email'],
        'role' => $row['role'],
        'first_name' => $row['first_name'],  
        'last_name' => $row['last_name']    
    ];
}

header('Content-Type: application/json');
echo json_encode($user);
?>