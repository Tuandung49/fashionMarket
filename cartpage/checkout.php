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

    echo '
    <div style="max-width: 600px; margin: 40px auto; padding: 30px; background: #e8f5e9; border: 1px solid #c8e6c9; border-radius: 12px; font-family: sans-serif; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <h2 style="color: #2e7d32; font-size: 24px; margin-bottom: 16px;">✅ Đơn hàng đã được đặt thành công!</h2>
        <p style="font-size: 16px; margin-bottom: 24px;">Cảm ơn bạn đã mua sắm tại <strong>FashionMarket</strong>.</p>

        <a href="buyerorder_detail.php?id=' . $order_id . '" 
        style="display: inline-block; margin: 8px; padding: 12px 24px; background-color: #43a047; color: white; text-decoration: none; border-radius: 8px; font-weight: bold;">
            🧾 Xem chi tiết đơn hàng
        </a>

        <a href="../homePage/HomePage.php" 
        style="display: inline-block; margin: 8px; padding: 12px 24px; background-color: #66bb6a; color: white; text-decoration: none; border-radius: 8px; font-weight: bold;">
            🏠 Quay về Trang chủ
        </a>
    </div>';


    // Reset session ID nếu muốn tạo giỏ mới
    session_regenerate_id(true);

} else {
    echo "❌ Lỗi khi tạo đơn hàng. Vui lòng thử lại.";
}
?>
