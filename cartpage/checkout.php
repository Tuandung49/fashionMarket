<?php
session_start();

// Kết nối CSDL
require 'config.php';

// Kiểm tra đăng nhập
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo "Bạn cần đăng nhập để thanh toán.";
    exit;
}

// Lấy cart_id theo session
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

// Tạo đơn hàng mới
$sql_insert_order = "INSERT INTO orders (cart_id, user_id, order_date, total_price, status) VALUES (?, ?, NOW(), ?, 'pending')";
$insert_stmt = $conn->prepare($sql_insert_order);
$insert_stmt->bind_param("sid", $cart_id, $user_id, $total_price);
$insert_stmt->execute();

if ($insert_stmt->affected_rows > 0) {
    $order_id = $conn->insert_id;

    // Lưu từng sản phẩm vào order_items
    $insert_item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($items as $item) {
        $insert_item_stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
        $insert_item_stmt->execute();
    }

    // Xoá giỏ hàng sau khi thanh toán
    $clear_cart = $conn->prepare("DELETE FROM product_in_cart WHERE cart_id = ?");
    $clear_cart->bind_param("s", $cart_id);
    $clear_cart->execute();

    // Giao diện phản hồi
    echo "<p>✅ Đơn hàng đã được tạo thành công!</p>";
    echo "<p><a href='buyerorder_detail.php?id=$order_id'>🧾 Xem chi tiết đơn hàng</a></p>";
    echo "<a href='../homePage/HomePage.php' class='inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600'>🏠 Quay về Trang chủ</a>";

    // Reset session ID nếu muốn tạo giỏ mới
    session_regenerate_id(true);

} else {
    echo "❌ Lỗi khi tạo đơn hàng. Vui lòng thử lại.";
}
?>
