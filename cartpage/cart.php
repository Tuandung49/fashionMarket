<?php
session_start();

// Kết nối CSDL
require 'config.php';

$cart_id = session_id();

// Thêm sản phẩm vào giỏ
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    // Kiểm tra xem sản phẩm đã có trong giỏ chưa
    $check = $conn->prepare("SELECT quantity FROM product_in_cart WHERE cart_id = ? AND product_id = ?");
    $check->bind_param("si", $cart_id, $product_id);
    $check->execute();
    $result = $check->get_result();

    if ($result && $result->num_rows > 0) {
        // Đã tồn tại → Tăng số lượng
        $update = $conn->prepare("UPDATE product_in_cart SET quantity = quantity + 1 WHERE cart_id = ? AND product_id = ?");
        $update->bind_param("si", $cart_id, $product_id);
        $update->execute();
    } else {
        // Chưa có → Lấy giá sản phẩm từ kho
        $price_stmt = $conn->prepare("SELECT price FROM product_instock WHERE product_id = ?");
        $price_stmt->bind_param("i", $product_id);
        $price_stmt->execute();
        $price_result = $price_stmt->get_result();

        if ($price_result && $price_result->num_rows > 0) {
            $price_row = $price_result->fetch_assoc();
            $price = (float)$price_row['price'];

            // Thêm mới sản phẩm vào giỏ
            $insert = $conn->prepare("INSERT INTO product_in_cart (cart_id, product_id, quantity, price) VALUES (?, ?, 1, ?)");
            $insert->bind_param("sid", $cart_id, $product_id, $price);
            $insert->execute();
        }
    }
}

// Xóa sản phẩm
if (isset($_GET['remove'])) {
    $product_id = (int)$_GET['remove'];
    $delete = $conn->prepare("DELETE FROM product_in_cart WHERE cart_id = ? AND product_id = ?");
    $delete->bind_param("si", $cart_id, $product_id);
    $delete->execute();
}

// Xóa toàn bộ giỏ hàng
if (isset($_GET['clear'])) {
    $clear = $conn->prepare("DELETE FROM product_in_cart WHERE cart_id = ?");
    $clear->bind_param("s", $cart_id);
    $clear->execute();
}

// Lấy thông tin giỏ hàng
$sql = "
    SELECT pic.*, p.product_display_name, p.image
    FROM product_in_cart pic
    JOIN product_instock p ON pic.product_id = p.product_id
    WHERE pic.cart_id = ?
";
$cart_stmt = $conn->prepare($sql);
$cart_stmt->bind_param("s", $cart_id);
$cart_stmt->execute();
$items = $cart_stmt->get_result();

$total = 0;
?>

<?php include '../layouts/head.php'; ?>
<body>
<?php include '../layouts/header_nav.php'; ?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">🛒 Giỏ hàng của bạn</h1>

    <?php if ($items->num_rows > 0): ?>
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-green-100 text-center">
                    <th class="border p-2">Ảnh</th>
                    <th class="border p-2">Tên sản phẩm</th>
                    <th class="border p-2">Giá</th>
                    <th class="border p-2">Số lượng</th>
                    <th class="border p-2">Thành tiền</th>
                    <th class="border p-2">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $items->fetch_assoc()): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr class="text-center">
                        <td class="border p-2">
                            <img src="<?= htmlspecialchars($item['image']) ?>" class="h-16 mx-auto" alt="Ảnh sản phẩm">
                        </td>
                        <td class="border p-2"><?= htmlspecialchars($item['product_display_name']) ?></td>
                        <td class="border p-2"><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                        <td class="border p-2"><?= $item['quantity'] ?></td>
                        <td class="border p-2"><?= number_format($subtotal, 0, ',', '.') ?> đ</td>
                        <td class="border p-2">
                            <a href="cart.php?remove=<?= $item['product_id'] ?>" class="text-red-500 hover:underline">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="mt-4 text-right">
            <p class="text-xl font-bold text-green-700">Tổng cộng: <?= number_format($total, 0, ',', '.') ?> đ</p>
            <a href="checkout.php" class="inline-block mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">✅ Thanh toán</a>
            <a href="cart.php?clear=1" class="inline-block mt-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 ml-2">🗑 Xóa giỏ hàng</a>
        </div>
    <?php else: ?>
        <p class="text-gray-600">Giỏ hàng trống.</p>
    <?php endif; ?>
</main>

<?php include '../layouts/footer.php'; ?>
</body>
</html>
