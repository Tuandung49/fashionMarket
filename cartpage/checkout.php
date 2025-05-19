<?php
session_start();

// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "fashionmarket");
if ($conn->connect_error) die("Kết nối thất bại: " . $conn->connect_error);
// Kiểm tra người dùng đã đăng nhập chưa
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo "Bạn cần đăng nhập để thanh toán.";
    exit;
}
$cart_id = session_id();


// Lấy sản phẩm trong giỏ hàng
$sql = "SELECT * FROM product_in_cart WHERE cart_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cart_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Giỏ hàng trống.";
    exit;
}

// Tính tổng tiền
$total_price = 0;
$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
    $total_price += $row['price'] * $row['quantity'];
}

// Tạo đơn hàng
$sql_insert_order = "INSERT INTO orders (cart_id, user_id, order_date, total_price, status) VALUES (?, ?, NOW(), ?, 'pending')";
$insert_stmt = $conn->prepare($sql_insert_order);
$insert_stmt->bind_param("sid", $cart_id, $user_id, $total_price);
$insert_stmt->execute();

if ($insert_stmt->affected_rows > 0) {
    $order_id = $conn->insert_id;

    echo "<p>✅ Đơn hàng đã được tạo thành công!</p>";
    echo "<p><a href='../myorder/order_detail.php?id=$order_id'>Xem chi tiết đơn hàng</a></p>";
    echo "<a href='../homePage/HomePage.php' class='inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600'>🏠 Quay về Trang chủ</a>";


    // (Tuỳ chọn) Xóa giỏ hàng sau khi đặt hàng
    $clear_cart = $conn->prepare("DELETE FROM product_in_cart WHERE cart_id = ?");
    $clear_cart->bind_param("s", $cart_id);
    $clear_cart->execute();

    // (Tuỳ chọn) Reset cart_id (tạo session mới nếu cần)
    session_regenerate_id(true);

} else {
    echo "❌ Lỗi khi tạo đơn hàng. Vui lòng thử lại.";
}
?>
