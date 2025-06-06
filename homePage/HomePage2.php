<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fashionmarket"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM product_instock LIMIT 6"; // Replace 'products' with your table name
$result = $conn->query($sql);

$products = []; // Initialize an empty array
$products_bsl = []; // Initialize an empty array

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Add each product to the array
    }
}

$sql = "SELECT * FROM product_instock ORDER BY price DESC LIMIT 4"; // Replace 'products' with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products_bsl[] = $row; // Add each product to the array
    }
}

// Close the connection
$conn->close();
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

        <form class="max-w-128 mx-auto">
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
        </form>

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
                <div class="mt-4">
                    <nav aria-label="Page navigation flex justify-center items-center">
                        <ul class="flex -space-x-px text-base h-10 justify-center">

                            <!-- <nav class="bg-blue-500 h-16 flex justify-center items-center">
                        <ul class="flex space-x-4 text-white"> -->
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                            </li>
                            <li>
                                <a href="#" aria-current="page"
                                    class="flex items-center justify-center px-4 h-10 text-white-600 border border-gray-300 bg-green-200 hover:bg-blue-100 hover:text-blue-700">3</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">5</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

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