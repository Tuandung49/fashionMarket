<?php
include 'connect.php';

$id = $_POST['id'] ?? null;
$newRole = $_POST['role'] ?? null;

if ($id && ($newRole === 'buyer' || $newRole === 'seller')) {
    $stmt = $conn->prepare("UPDATE user SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $newRole, $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "fail";
    }
} else {
    echo "invalid";
}
?>
