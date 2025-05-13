<?php
session_start();

// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "fashionmarket");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$cart_id = session_id(); // Dùng session ID làm cart_id

// Xử lý thêm sản phẩm
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    // Kiểm tra sản phẩm đã có trong giỏ chưa
    $check = $conn->prepare("SELECT * FROM product_in_cart WHERE cart_id = ? AND product_id = ?");
    $check->bind_param("si", $cart_id, $product_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Nếu đã có thì tăng quantity
        $conn->query("UPDATE product_in_cart SET quantity = quantity + 1 WHERE cart_id = '$cart_id' AND product_id = $product_id");
    } else {
        // Nếu chưa có thì thêm mới
        $conn->query("INSERT INTO product_in_cart (cart_id, product_id, quantity) VALUES ('$cart_id', $product_id, 1)");
    }
}

// Xóa sản phẩm
if (isset($_GET['remove'])) {
    $product_id = (int)$_GET['remove'];
    $conn->query("DELETE FROM product_in_cart WHERE cart_id = '$cart_id' AND product_id = $product_id");
}

// Xoá toàn bộ giỏ
if (isset($_GET['clear'])) {
    $conn->query("DELETE FROM product_in_cart WHERE cart_id = '$cart_id'");
}

// Lấy sản phẩm trong giỏ
$sql = "SELECT pic.*, p.product_display_name, p.image, p.price
        FROM product_in_cart pic
        JOIN product_instock p ON pic.product_id = p.product_id
        WHERE pic.cart_id = '$cart_id'";
$items = $conn->query($sql);

$total = 0;
?>

<?php include '../layouts/head.php'; ?>
<body>
<?php include '../layouts/header_nav.php'; ?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Giỏ hàng của bạn</h1>

    <?php if ($items->num_rows > 0): ?>
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Ảnh</th>
                    <th class="border p-2">Tên sản phẩm</th>
                    <th class="border p-2">Giá</th>
                    <th class="border p-2">Số lượng</th>
                    <th class="border p-2">Tổng</th>
                    <th class="border p-2">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $items->fetch_assoc()): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                    <tr class="text-center">
                        <td class="border p-2"><img src="<?= htmlspecialchars($item['image']) ?>" class="h-16 mx-auto"></td>
                        <td class="border p-2"><?= htmlspecialchars($item['product_display_name']) ?></td>
                        <td class="border p-2">$<?= $item['price'] ?></td>
                        <td class="border p-2"><?= $item['quantity'] ?></td>
                        <td class="border p-2">$<?= $subtotal ?></td>
                        <td class="border p-2">
                            <a href="cart.php?remove=<?= $item['product_id'] ?>" class="text-red-500 hover:underline">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="mt-4 text-right">
            <p class="text-xl font-bold">Tổng cộng: $<?= $total ?></p>
            <a href="checkout.php" class="inline-block mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Thanh toán</a>
            <a href="cart.php?clear=1" class="inline-block mt-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Xóa giỏ hàng</a>
        </div>

    <?php else: ?>
        <p class="text-gray-600">Giỏ hàng trống.</p>
    <?php endif; ?>
</main>

<?php include '../layouts/footer.php'; ?>
</body>
</html>
