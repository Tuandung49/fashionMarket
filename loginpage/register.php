<?php
require '../config/db.php';

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO user (fullname, username, email, password)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $username, $email, $password);

if ($stmt->execute()) {
    echo "success";
} else {
    http_response_code(401);
    echo "Lỗi: " . $stmt->error;
}
?>
