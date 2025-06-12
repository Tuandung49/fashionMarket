<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "fashionmarket";

// Kết nối 1 lần duy nhất
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Xử lý xóa feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_feedback_id'])) {
    if (isset($_SESSION['user_id'])) {
        $fb_id = intval($_POST['delete_feedback_id']);
        $user_id = $_SESSION['user_id'];
        // Chỉ xóa nếu là feedback của user hiện tại
        $sql_check = "SELECT * FROM feedback WHERE feedback_id = ? AND user_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("ii", $fb_id, $user_id);
        $stmt_check->execute();
        $res = $stmt_check->get_result();
        if ($res && $res->num_rows > 0) {
            $sql_delete = "DELETE FROM feedback WHERE feedback_id = ?";
            $stmt_del = $conn->prepare($sql_delete);
            $stmt_del->bind_param("i", $fb_id);
            $stmt_del->execute();
            $stmt_del->close();
        }
        $stmt_check->close();
    }
    // Reload trang
    header("Location: productDetails.php?id=" . $product_id);
    exit();
}

// Xử lý thêm feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    if (!empty($_POST['comment']) && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $comment = trim($_POST['comment']);

        $sql_add_fb = "INSERT INTO feedback (product_id, user_id, comment, feedback_time) VALUES (?, ?, ?, NOW())";
        $stmt_add = $conn->prepare($sql_add_fb);
        $stmt_add->bind_param("iis", $product_id, $user_id, $comment);
        $stmt_add->execute();
        $stmt_add->close();

        // Reload lại trang để tránh gửi lại form khi F5
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Lấy sản phẩm
$query = "SELECT * FROM product_instock WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

// Lấy feedback (đủ trường)
$sql_feedback = "
    SELECT f.feedback_id, f.user_id, f.comment, f.feedback_time, f.buy_time, u.fullname
    FROM feedback f
    JOIN user u ON f.user_id = u.user_id
    WHERE f.product_id = ?
    ORDER BY f.feedback_time DESC   
";
$stmt_fb = $conn->prepare($sql_feedback);
$stmt_fb->bind_param("i", $product_id);
$stmt_fb->execute();
$result_fb = $stmt_fb->get_result();

$feedbacks = [];
while ($row = $result_fb->fetch_assoc()) {
    $feedbacks[] = $row;
}
$stmt_fb->close();

$conn->close();
?>

<?php include '../layouts/head.php'; ?>
<?php include '../layouts/header_nav.php'; ?>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Left side - Main Image -->
            <div class="md:w-1/2">
                <div class="mb-4">
                    <img src="<?= htmlspecialchars($product['image']) ?>"
                        alt="<?= htmlspecialchars($product['product_display_name']) ?>"
                        class="w-full max-h-[500px] object-contain rounded-lg">
                </div>
            </div>

            <!-- Right side - Product Details -->
            <div class="md:w-1/2">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold mb-3"><?= htmlspecialchars($product['product_display_name']) ?></h1>
                        <p class="text-gray-600 mb-3">MÃ SP: TSN<?= htmlspecialchars($product['product_id']) ?></p>
                        <p class="text-xl font-bold mb-4">$<?= htmlspecialchars($product['price']) ?></p>
                    </div>
                    <button class="text-2xl">❤️</button>
                </div>

                <!-- Color Selection -->
                <div class="mb-4">
                    <p class="font-medium mb-2">Màu sắc:</p>
                    <div class="flex gap-2">
                        <div class="w-8 h-8 bg-red-900 rounded-full border-2 border-black hover:border-black cursor-pointer"></div>
                        <div class="w-8 h-8 bg-navy-900 rounded-full border-2 border-gray-300 hover:border-black cursor-pointer"></div>
                        <div class="w-8 h-8 bg-gray-700 rounded-full border-2 border-gray-300 hover:border-black cursor-pointer"></div>
                        <div class="w-8 h-8 bg-green-800 rounded-full border-2 border-gray-300 hover:border-black cursor-pointer"></div>
                    </div>
                </div>

                <!-- Size Selection -->
                <div class="mb-6">
                    <p class="font-medium mb-2">Kích cỡ:</p>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black">S</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black">M</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black">L</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black">XL</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black">XXL</button>
                    </div>
                    <a href="#" class="text-blue-600 text-sm flex items-center mt-2">
                        📏 Hướng dẫn chọn size
                    </a>
                </div>

                <!-- Add to Cart Button -->
                <a
                    href="../cartpage/cart.php?id=<?= htmlspecialchars($product['product_id']) ?>"
                    class="w-full bg-gray-900 text-white py-3 rounded-md hover:bg-gray-800 mb-6 block text-center font-semibold transition">
                    THÊM VÀO GIỎ HÀNG
                </a>

                <!-- Product Description -->
                <div>
                    <h2 class="font-bold mb-2">MÔ TẢ</h2>
                    <p class="text-gray-600">
                        <?= nl2br(htmlspecialchars($product['description'])) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM THÊM ĐÁNH GIÁ -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="mt-8 mb-4 p-4 bg-white rounded-lg shadow">
            <form method="POST">
                <h3 class="font-bold mb-2">Viết đánh giá của bạn</h3>
                <textarea name="comment" rows="3" class="w-full border rounded p-2 mb-2" maxlength="200" required></textarea>
                <button type="submit" name="submit_feedback" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Gửi đánh giá</button>
            </form>
        </div>
    <?php else: ?>
        <p class="text-sm text-gray-500 mt-4">Hãy <a href="../loginpage/index.php" class="text-blue-600 underline">đăng nhập</a> để gửi đánh giá.</p>
    <?php endif; ?>

    <!-- DANH SÁCH ĐÁNH GIÁ -->
    <div class="mt-8">
        <h2 class="font-bold text-lg mb-3">Đánh giá sản phẩm</h2>
        <?php if (empty($feedbacks)): ?>
            <p class="text-gray-500">Chưa có đánh giá nào cho sản phẩm này.</p>
        <?php else: ?>
            <div class="space-y-4">
                <?php foreach ($feedbacks as $fb): ?>
                    <div class="border rounded-lg p-4 bg-white">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-semibold"><?= htmlspecialchars($fb['fullname']) ?></span>
                            <span class="text-gray-400 text-sm ml-2">
                                <?= date('d/m/Y H:i', strtotime($fb['feedback_time'])) ?>
                            </span>
                            
                            <!-- Nút XÓA -->
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $fb['user_id']): ?>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete_feedback_id" value="<?= $fb['feedback_id'] ?>">
                                    <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa đánh giá này?');"
                                        class="ml-2 text-red-500 hover:underline text-xs">Xóa</button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <div class="text-gray-700"><?= nl2br(htmlspecialchars($fb['comment'])) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include '../layouts/footer.php'; ?>
</body>
</html>
