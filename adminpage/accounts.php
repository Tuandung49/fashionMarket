
<?php
include 'connect.php';

$search = $_GET['search'] ?? '';
$role = $_GET['role'] ?? 'all';

$sql = "SELECT * FROM accounts WHERE (name LIKE ? OR email LIKE ?)";
$params = ["%$search%", "%$search%"];

if ($role !== 'all') {
    $sql .= " AND role = ?";
    $params[] = $role;
}

$stmt = $conn->prepare($sql);
$types = str_repeat('s', count($params));
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$accounts = [];
while ($row = $result->fetch_assoc()) {
    $accounts[] = $row;
}

echo json_encode($accounts);
?>
