<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fashionmarket";

// Kết nối
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn = new mysqli($servername, $username, $password, $database);
$product_id = $_GET['id'];
$query = "SELECT * FROM product_instock WHERE product_id = $product_id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

$conn->close();

// Truy vấn đánh giá sản phẩm
// $sql_reviews = "SELECT * FROM reviews WHERE product_id = ?";
// $stmt_reviews = $conn->prepare($sql_reviews);
// $stmt_reviews->bind_param("i", $product_id);
// $stmt_reviews->execute();
// $reviews = $stmt_reviews->get_result();
?>

<?php
include '../layouts/head.php'
?>

<?php
include '../layouts/header_nav.php'
?>



<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Left side - Main Image -->
            <div class="md:w-1/2">
                <div class="mb-4">
                    <img src="<?= $product['image'] ?>"
                        alt="<?= $product['product_display_name'] ?>"
                        class="w-full max-h-[500px] object-contain rounded-lg">
                </div>
            </div>

            <!-- Right side - Product Details -->
            <div class="md:w-1/2">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold mb-3"><?= $product['product_display_name'] ?></h1>
                        <p class="text-gray-600 mb-3">MÃ SP: TSN<?= $product['product_id'] ?></p>
                        <p class="text-xl font-bold mb-4">$<?= $product['price'] ?></p>
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
                <button class="w-full bg-gray-900 text-white py-3 rounded-md hover:bg-gray-800 mb-6">
                    THÊM VÀO GIỎ HÀNG
                </button>

                <!-- Product Description -->
                <div>
                    <h2 class="font-bold mb-2">MÔ TẢ</h2>
                    <p class="text-gray-600">
                        Áo thun kiểu dáng body fit tôn dáng người mặc.<br>
                        Màu sắc trẻ trung, năng động.<br>
                        Chất liệu: 57% Cotton, 38% Polyester, 5% Spandex
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php
    include '../layouts/footer.php'
    ?>

</body>

</html>