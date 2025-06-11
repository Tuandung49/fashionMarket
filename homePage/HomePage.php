<?php
session_start();
require '../config/db.php';


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Tiếp tục xử lý nếu người dùng đã đăng nhập
} else {
    $username = null; // hoặc bạn có thể xử lý khác, ví dụ redirect
}

$stmt = $conn->prepare("SELECT fullname, email FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


// Pagination & Filter & Search
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$items_per_page = 6;
$offset = ($page - 1) * $items_per_page;

// Search & Filter
$search   = isset($_GET['search'])   ? trim($_GET['search'])   : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$colour   = isset($_GET['colour'])   ? trim($_GET['colour'])   : '';

// Build WHERE
$where  = [];
$params = [];
$types  = '';

// Search by name, description, colour
if ($search !== '') {
    $where[]  = "(product_display_name LIKE ? OR description LIKE ? OR colour LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types   .= 'sss';
}

// Category (by keyword in name, description, or image)
if ($category !== '') {
    $where[]  = "(product_display_name LIKE ? OR description LIKE ? OR image LIKE ?)";
    $params[] = "%$category%";
    $params[] = "%$category%";
    $params[] = "%$category%";
    $types   .= 'sss';
}

// Filter by colour
if ($colour !== '') {
    $where[]  = "colour = ?";
    $params[] = $colour;
    $types   .= 's';
}

$where_sql = (!empty($where)) ? 'WHERE ' . implode(' AND ', $where) : '';

// Total count
$sql_count = "SELECT COUNT(*) FROM product_instock $where_sql";
$stmt_count = $conn->prepare($sql_count);
if (!empty($params)) {
    $stmt_count->bind_param($types, ...$params);
}
$stmt_count->execute();
$stmt_count->bind_result($total_items);
$stmt_count->fetch();
$stmt_count->close();
$total_pages = max(1, ceil($total_items / $items_per_page));

// Products for current page
$sql = "SELECT * FROM product_instock $where_sql LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$final_types = $types . 'ii';
$params2 = $params;
$params2[] = $items_per_page;
$params2[] = $offset;
$stmt->bind_param($final_types, ...$params2);
$stmt->execute();
$result = $stmt->get_result();
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$stmt->close();

// Bestseller
$sql_bsl = "SELECT * FROM product_instock ORDER BY price DESC LIMIT 4";
$result_bsl = $conn->query($sql_bsl);
$products_bsl = [];
if ($result_bsl->num_rows > 0) {
    while ($row = $result_bsl->fetch_assoc()) {
        $products_bsl[] = $row;
    }
}

// Lấy danh sách màu sắc duy nhất (cho dropdown filter)
$colours = [];
$res_col = $conn->query("SELECT DISTINCT colour FROM product_instock");
while ($row = $res_col->fetch_assoc()) {
    $colours[] = $row['colour'];
}
?>



<?php
include '../layouts/head.php';
?>

<body class="font-sans">
    <?php
    include '../layouts/multiplatform_chat.php'
    ?>

    <?php
    include '../layouts/header_nav.php';
    ?>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">

        <!-- search -->
        <!-- <form class="max-w-128 mx-auto">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-500 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                    placeholder="Search Mockups, Logos..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </form> -->

        <!-- Banner -->
        <div class="bannerz-100 w-full h-64 bg-black-300">
            <div class="w-full">
                <img src="../image/1920x300_cates_banner_1.jpg  " alt="Banner" class="w-full h-100">
            </div>
        </div>

        <div class="flex relative z-0">
            <!-- Filters -->
            <?php
            include '../homePage/filter.php'
            ?>
            <!-- Product Grid -->
            <section class="w-3/4">
                <h2 class="text-lg font-bold mb-6">
                    6 Items
                </h2>

                <!-- Product Card -->

                <div class="grid grid-cols-3 gap-8">
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            // Wrap the entire product card in an anchor tag.
                            // echo "<a href='../detailsPage/productdetails.php?id=" . htmlspecialchars($product['product_id']) . "' class='block'>";
                            // echo "<div class='bg-white p-4 rounded-lg shadow hover:shadow-lg transition duration-200'>";
                            // echo "<img alt='Elastic Waist Pants' class='w-full object-cover' src='" . htmlspecialchars($product['image']) . "'>";
                            // echo "<div class='mt-4'>";
                            // echo "<h3 class='text-gray-700 font-bold'>" . htmlspecialchars($product['product_display_name']) . "</h3>";
                            // echo "<p class='text-gray-500'>" . htmlspecialchars($product['price']) . "</p>";
                            // echo "<p class='text-gray-700 font-bold'>" . htmlspecialchars($product['description']) . "</p>";
                            // echo "</div>";
                            // echo "</div>";
                            // echo "</a>";

                            //
                            echo "<div class='max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden border border-gray-300 p-4'>";

                            // Product details area wrapped in a link to the product overview page
                            echo "<a href='../detailsPage/productdetails.php?id=" . htmlspecialchars($product['product_id']) . "' class='block'>";
                            echo "<img alt='" . htmlspecialchars($product['product_display_name']) . "' class='w-full h-64 object-contain rounded-md' src='" . htmlspecialchars($product['image']) . "'>";
                            echo "<div class='mt-4 text-center'>";
                            echo "<h3 class='text-gray-800 font-semibold text-lg'>" . htmlspecialchars($product['product_display_name']) . "</h3>";
                            echo "<p class='text-gray-600 text-xl font-bold'>$" . htmlspecialchars($product['price']) . "</p>";
                            echo "</div>";
                            echo "</a>";

                            // Add to Cart button linking directly to the cart page
                            echo "<div class='mt-4 text-center'>";
                            echo "<a href='../cartpage/cart.php?id=" . htmlspecialchars($product['product_id']) . "' class='inline-block px-6 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 hover:shadow-lg transition-all'>";
                            echo "🛒 Add to Cart";
                            echo "</a>";
                            echo "</div>";

                            echo "</div>";
                        }
                    } else {
                        echo "<p>No products available.</p>";
                    }
                    ?>
                </div>


                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4 flex justify-center">
                    <ul class="flex -space-x-px text-base h-10">

                        <?php
                        // Tính toán cho range số trang hiển thị
                        $max_show = 10;
                        $start = max(1, $page - intval($max_show / 2));
                        $end = $start + $max_show - 1;
                        if ($end > $total_pages) {
                            $end = $total_pages;
                            $start = max(1, $end - $max_show + 1);
                        }
                        ?>

                        <?php if ($page > 1): ?>
                            <li>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>"
                                    class="px-4 h-10 flex items-center bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php if ($start > 1): ?>
                            <li>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>"
                                    class="px-4 h-10 flex items-center border border-gray-300 bg-white">1</a>
                            </li>
                            <?php if ($start > 2): ?>
                                <li>
                                    <span class="px-2 h-10 flex items-center text-gray-400">...</span>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php for ($i = $start; $i <= $end; $i++): ?>
                            <li>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                                    class="px-4 h-10 flex items-center border border-gray-300 <?= $i == $page ? 'bg-green-200 font-bold' : 'bg-white' ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($end < $total_pages): ?>
                            <?php if ($end < $total_pages - 1): ?>
                                <li>
                                    <span class="px-2 h-10 flex items-center text-gray-400">...</span>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $total_pages])) ?>"
                                    class="px-4 h-10 flex items-center border border-gray-300 bg-white"><?= $total_pages ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if ($page < $total_pages): ?>
                            <li>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>"
                                    class="px-4 h-10 flex items-center bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>



                <!-- Bestseller//recommended to buy -->
                <section>
                    <h2 class="text-lg font-bold mb-6">
                        Bestsellers
                    </h2>
                    <div class="grid grid-cols-4 gap-8">
                        <?php
                        if (!empty($products_bsl)) {
                            foreach ($products_bsl as $product) {
                                echo "<a href='../detailsPage/productdetails.php?id=" . htmlspecialchars($product['product_id']) . "' class='block'>";
                                echo "<div>";
                                echo "<img alt='Elastic Waist Pants' class='w-full'";
                                echo "src=" . htmlspecialchars($product['image']) . ">";
                                echo "<div class='mt-4'>";
                                echo "<h3 class='text-gray-700 font-bold'> " . htmlspecialchars($product['product_display_name']) . "</h3>";
                                echo "<p class='text-gray-500'>" . htmlspecialchars($product['price']) . "</p>";
                                echo "<p class='text-gray-700 font-bold'>" . htmlspecialchars($product['description']) . "</p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</a>";
                            }
                        } else {
                            echo "<p>No products available.</p>";
                        }
                        ?>
                    </div>

                </section>

            </section>
        </div>
    </main>

    <?php
    include '../layouts/footer.php'
    ?>
</body>

</html>