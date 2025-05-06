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

// Lấy ID sản phẩm từ URL
$product_id = $_GET['product_id'] ?? 1;

// Truy vấn sản phẩm
$sql = "SELECT * FROM product_instock WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

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

<!DOCTYPE html>
<html lang="en">

<head data-llama-id="0" data-llama-editable="true">
    <meta charset="UTF-8" data-llama-id="1" data-llama-editable="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" data-llama-id="2" data-llama-editable="true">
    <title data-llama-id="3" data-llama-editable="true">Product Overview - T-Shirt</title>
    <script src="https://cdn.tailwindcss.com" data-llama-id="4" data-llama-editable="true"></script>
</head>

<body class="bg-gray-50" data-llama-id="5" data-llama-editable="true">
    <div class="container mx-auto px-4 py-8" data-llama-id="6" data-llama-editable="true">
        <div class="flex flex-col md:flex-row gap-8" data-llama-id="7" data-llama-editable="true">
            <!-- Left side - Main Image -->
            <div class="md:w-1/2" data-llama-id="8" data-llama-editable="true">
                <div class="mb-4" data-llama-id="9" data-llama-editable="true">
                    <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab" alt="Red T-shirt main view" class="w-full max-h-[500px] object-contain rounded-lg" data-llama-id="10" data-llama-editable="true">
                </div>
            </div>

            <!-- Right side - Product Details -->
            <div class="md:w-1/2" data-llama-id="11" data-llama-editable="true">
                <div class="flex justify-between items-start" data-llama-id="12" data-llama-editable="true">
                    <div data-llama-id="13" data-llama-editable="true">
                        <h1 class="text-3xl font-bold mb-3" data-llama-id="14" data-llama-editable="true">ÁO T-SHIRT - TSN253669</h1>
                        <p class="text-gray-600 mb-3" data-llama-id="15" data-llama-editable="true">MÃ SP: TSN253669</p>
                        <p class="text-xl font-bold mb-4" data-llama-id="16" data-llama-editable="true">395.000 đ</p>
                    </div>
                    <button class="text-2xl" data-llama-id="17" data-llama-editable="true">❤️</button>
                </div>

                <!-- Color Selection -->
                <div class="mb-4" data-llama-id="18" data-llama-editable="true">
                    <p class="font-medium mb-2" data-llama-id="19" data-llama-editable="true">Màu sắc:</p>
                    <div class="flex gap-2" data-llama-id="20" data-llama-editable="true">
                        <div class="w-8 h-8 bg-red-900 rounded-full border-2 border-black hover:border-black cursor-pointer" data-llama-id="21" data-llama-editable="true"></div>
                        <div class="w-8 h-8 bg-navy-900 rounded-full border-2 border-gray-300 hover:border-black cursor-pointer" data-llama-id="22" data-llama-editable="true"></div>
                        <div class="w-8 h-8 bg-gray-700 rounded-full border-2 border-gray-300 hover:border-black cursor-pointer" data-llama-id="23" data-llama-editable="true"></div>
                        <div class="w-8 h-8 bg-green-800 rounded-full border-2 border-gray-300 hover:border-black cursor-pointer" data-llama-id="24" data-llama-editable="true"></div>
                    </div>
                </div>

                <!-- Size Selection -->
                <div class="mb-6" data-llama-id="25" data-llama-editable="true">
                    <p class="font-medium mb-2" data-llama-id="26" data-llama-editable="true">Kích cỡ:</p>
                    <div class="flex gap-2" data-llama-id="27" data-llama-editable="true">
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black" data-llama-id="28" data-llama-editable="true">S</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black" data-llama-id="29" data-llama-editable="true">M</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black" data-llama-id="30" data-llama-editable="true">L</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black" data-llama-id="31" data-llama-editable="true">XL</button>
                        <button class="px-4 py-2 border-2 border-gray-300 rounded hover:border-black" data-llama-id="32" data-llama-editable="true">XXL</button>
                    </div>
                    <a href="#" class="text-blue-600 text-sm flex items-center mt-2" data-llama-id="33" data-llama-editable="true">
                        📏 Hướng dẫn chọn size
                    </a>
                </div>

                <!-- Add to Cart Button -->
                <button class="w-full bg-gray-900 text-white py-3 rounded-md hover:bg-gray-800 mb-6" data-llama-id="34" data-llama-editable="true">
                    THÊM VÀO GIỎ HÀNG
                </button>

                <!-- Product Description -->
                <div data-llama-id="35" data-llama-editable="true">
                    <h2 class="font-bold mb-2" data-llama-id="36" data-llama-editable="true">MÔ TẢ</h2>
                    <p class="text-gray-600" data-llama-id="37" data-llama-editable="true">
                        Áo thun kiểu dáng body fit tôn dáng người mặc.<br data-llama-id="38" data-llama-editable="true">
                        Màu sắc trẻ trung, năng động.<br data-llama-id="39" data-llama-editable="true">
                        Chất liệu: 57% Cotton, 38% Polyester, 5% Spandex
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php 
        include'../layouts/footer.php'
    ?>

</body>

</html>