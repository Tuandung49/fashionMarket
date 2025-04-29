<?php
include 'dbconnect.php';

$sql = "SELECT * FROM products LIMIT 6"; // Replace 'products' with your table name
$result = $conn->query($sql);

$products = []; // Initialize an empty array
$products_bsl = []; // Initialize an empty array

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Add each product to the array
    }
}

$sql = "SELECT * FROM products ORDER BY pdt_price DESC LIMIT 4"; // Replace 'products' with your table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products_bsl[] = $row; // Add each product to the array
    }
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Modimal - Women Clothing
    </title>
    <script src="3.4.16">
    </script>
    <!-- <link href="all.min.css" rel="stylesheet" /> -->
</head>

<body class="font-sans">
    <!-- Multiplatform chat button-->
    <div class="fixed bottom-6 right-6 flex-col gap-4 z-50">
        <!-- Telegram Button -->
        <a
            href="https://t.me/hkd31092"
            target="_blank"
            class="h-16 w-16 rounded-full shadow-lg bg-[#0088cc] flex items-center justify-center"
            title="Chat on Telegram">
            <img
                src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg"
                alt="Telegram Logo"
                class="h-8 w-8" />
        </a>

        <!-- Zalo Button -->
        <a
            href="https://zalo.me/0392236213"
            target="_blank"
            class="h-16 w-16 rounded-full shadow-lg bg-[#1b74e4] flex items-center justify-center"
            title="Chat on Zalo">
            <img
                src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg"
                alt="Zalo Logo"
                class="h-8 w-8" />
        </a>
    </div>



    <!-- Top Bar -->
    <div class="bg-green-700 text-white text-center py-2 text-sm">
        Enjoy Free Shipping On All Orders
    </div>
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 flex items-center justify-between py-4">
            <div class="text-2xl font-bold">
                modimal.
                <span class="text-sm font-normal">
                    women clothing
                </span>
            </div>
            <nav class="flex space-x-6 text-gray-700">
                <a class="hover:text-green-700" href="#">
                    Collection
                </a>
                <a class="hover:text-green-700" href="#">
                    New In
                </a>
                <a class="hover:text-green-700" href="#">
                    Modiweek
                </a>
            </nav>

            <div class="flex items-center space-x-4">

                <div>
                    <button type="user"
                        class="text-gray-700  bottom-2.5 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">&#128722</button>
                </div>

                <div>
                    <button type="user"
                        class="text-gray-700  bottom-2.5 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">User</button>
                </div>
            </div>
        </div>
    </header>



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
        <div class="bannerz-100 w-full h-64 bg-blue-300">
            <div class="w-full">
                <img src="https://placehold.co/1920x300" alt="Banner" class="w-full h-100">
            </div>
        </div>

        <div class="flex relative z-0">
            <!-- Filters -->
            <aside class="w-1/4 pr-8">
                <h2 class="text-lg font-bold mb-4">
                    Filters
                </h2>
                <div class="space-y-4">

                    <!-- Dropdown Filter -->
                    <div class="mb-6">
                        <label for="filter" class="block text-gray-700 font-medium mb-2">Select Category:</label>
                        <select id="filter"
                            class="block w-64 px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="all">All</option>
                            <option value="category1">Category 1</option>
                            <option value="category2">Category 2</option>
                            <option value="category3">Category 3</option>
                            <option value="category4">Category 4</option>
                            <option value="category5">Category 5</option>
                        </select>
                    </div>

                    <!-- Dropdown Filter -->
                    <div class="mb-6">
                        <label for="filter" class="block text-gray-700 font-medium mb-2">Select Category:</label>
                        <select id="filter"
                            class="block w-64 px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="all">All</option>
                            <option value="category1">Category 1</option>
                            <option value="category2">Category 2</option>
                            <option value="category3">Category 3</option>
                            <option value="category4">Category 4</option>
                            <option value="category5">Category 5</option>
                        </select>
                    </div>

                    <div>
                        <button class="flex justify-between w-full text-left text-gray-700 font-medium">
                            Sort By
                            <span>
                                +
                            </span>
                        </button>
                    </div>
                    <div>
                        <button class="flex justify-between w-full text-left text-gray-700 font-medium">
                            Size
                            <span>
                                +
                            </span>
                        </button>
                    </div>
                    <div>
                        <button class="flex justify-between w-full text-left text-gray-700 font-medium">
                            Color
                            <span>
                                +
                            </span>
                        </button>
                    </div>
                    <div>
                        <button class="flex justify-between w-full text-left text-gray-700 font-medium">
                            Collection
                            <span>
                                +
                            </span>
                        </button>
                    </div>
                    <div>
                        <button class="flex justify-between w-full text-left text-gray-700 font-medium">
                            Fabric
                            <span>
                                +
                            </span>
                        </button>
                    </div>
                </div>
            </aside>
            <!-- Product Grid -->
            <section class="w-3/4">
                <h2 class="text-lg font-bold mb-6">
                    6 Items
                </h2>
                <div class="grid grid-cols-3 gap-8">
                    <!-- Product Card -->

                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo "<div>";
                            echo "<img alt='Elastic Waist Pants' class='w-full'";
                            echo "src='http://assets.myntassets.com/v1/images/style/properties/7a5b82d1372a7a5c6de67ae7a314fd91_images.jpg'/>";
                            echo "<div class='mt-4'>";
                            echo "<h3 class='text-gray-700 font-bold'> " . htmlspecialchars($product['pdt_name']) . "</h3>";
                            echo "<p class='text-gray-500'>" . htmlspecialchars($product['pdt_price']) . "</p>";
                            echo "<p class='text-gray-700 font-bold'>" . htmlspecialchars($product['pdt_des']) . "</p>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No products available.</p>";
                    }
                    ?>

                    <!-- <div>
                        <img alt="Elastic Waist Pants" class="w-full"
                            src="http://assets.myntassets.com/v1/images/style/properties/7a5b82d1372a7a5c6de67ae7a314fd91_images.jpg" />
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold">
                                Turtle Check Men Navy Blue Shirt
                            </h3>
                            <p class="text-gray-500">
                                Navy Blue
                            </p>
                            <p class="text-gray-700 font-bold">
                                $110//Random
                            </p>
                        </div>
                    </div>
                    <div>
                        <img alt="Tailored Stretch Pants" class="w-full" src="https://placehold.co/400x500" />
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold">
                                Tailored Stretch
                            </h3>
                            <p class="text-gray-500">
                                Turn It Up Pants
                            </p>
                            <p class="text-gray-700 font-bold">
                                $150
                            </p>
                        </div>
                    </div>
                    <div>
                        <img alt="Tailored Stretch Pants in Beige" class="w-full" src="https://placehold.co/400x500" />
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold">
                                Tailored Stretch
                            </h3>
                            <p class="text-gray-500">
                                Turn It Up Pants
                            </p>
                            <p class="text-gray-700 font-bold">
                                $140
                            </p>
                        </div>
                    </div>
                    <div>
                        <img alt="High Tillie Pants" class="w-full" src="https://placehold.co/400x500" />
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold">
                                High Tillie
                            </h3>
                            <p class="text-gray-500">
                                Turn It Up Pants
                            </p>
                            <p class="text-gray-700 font-bold">
                                $110
                            </p>
                        </div>
                    </div>
                    <div>
                        <img alt="Casual Wild Leg Pants" class="w-full" src="https://placehold.co/400x500" />
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold">
                                Casual Wild Leg
                            </h3>
                            <p class="text-gray-500">
                                Turn It Up Pants
                            </p>
                            <p class="text-gray-700 font-bold">
                                $130
                            </p>
                        </div>
                    </div>
                    <div>
                        <img alt="Linen Wide Leg Pants" class="w-full" src="https://placehold.co/400x500" />
                        <div class="mt-4">
                            <h3 class="text-gray-700 font-bold">
                                Linen Wide Leg
                            </h3>
                            <p class="text-gray-500">
                                Turn It Up Pants
                            </p>
                            <p class="text-gray-700 font-bold">
                                $180
                            </p>
                        </div>
                    </div>  -->
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
                                echo "<div>";
                                echo "<img alt='Elastic Waist Pants' class='w-full'";
                                echo "src='https://placehold.co/400x500'/>";
                                echo "<div class='mt-4'>";
                                echo "<h3 class='text-gray-700 font-bold'> " . htmlspecialchars($product['pdt_name']) . "</h3>";
                                echo "<p class='text-gray-500'>" . htmlspecialchars($product['pdt_price']) . "</p>";
                                echo "<p class='text-gray-700 font-bold'>" . htmlspecialchars($product['pdt_des']) . "</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No products available.</p>";
                        }
                        ?>
                        <!-- <div>
                            <img alt="Linen Wide Leg Pants" class="w-full" src="https://placehold.co/400x500" />
                            <div class="mt-4">
                                <h3 class="text-gray-700 font-bold">
                                    Linen Wide Leg
                                </h3>
                                <p class="text-gray-700 font-bold">
                                    $180
                                </p>
                            </div>
                        </div>
                        <div>
                            <img alt="Linen Wide Leg Pants" class="w-full" src="https://placehold.co/400x500" />
                            <div class="mt-4">
                                <h3 class="text-gray-700 font-bold">
                                    Linen Wide Leg
                                </h3>
                                </p>
                                <p class="text-gray-700 font-bold">
                                    $180
                                </p>
                            </div>
                        </div>
                        <div>
                            <img alt="Linen Wide Leg Pants" class="w-full" src="https://placehold.co/400x500" />
                            <div class="mt-4">
                                <h3 class="text-gray-700 font-bold">
                                    Linen Wide Leg
                                </h3>
                                <p class="text-gray-700 font-bold">
                                    $180
                                </p>
                            </div>
                        </div>
                        <div>
                            <img alt="Linen Wide Leg Pants" class="w-full" src="https://placehold.co/400x500" />
                            <div class="mt-4">
                                <h3 class="text-gray-700 font-bold">
                                    Linen Wide Leg
                                </h3>
                                <p class="text-gray-500">
                                    Turn It Up Pants
                                </p>
                                <p class="text-gray-700 font-bold">
                                    $180
                                </p>
                            </div>
                        </div> -->

                    </div>

                </section>

            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 grid grid-cols-4 gap-8">
            <div>
                <h3 class="font-bold mb-4">
                    Join Our Club, Get 15% Off For Your Birthday
                </h3>
                <form class="flex items-center space-x-2">
                    <input class="w-full px-4 py-2 text-gray-700" placeholder="Enter Your Email Address" type="email" />
                    <button class="bg-green-700 px-4 py-2 text-white">
                        →
                    </button>
                </form>
                <p class="text-sm mt-2">
                    By Submitting your email, you agree to receive advertising emails from Modimal.
                </p>
            </div>
            <div>
                <h3 class="font-bold mb-4">
                    About Modimal
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a class="hover:underline" href="#">
                            Collection
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Sustainability
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Support System
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Terms &amp; Condition
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Copyright Notice
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-4">
                    Help &amp; Support
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a class="hover:underline" href="#">
                            Orders &amp; Shipping
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Returns &amp; Refunds
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            FAQs
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-4">
                    Join Up
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a class="hover:underline" href="#">
                            Modimal Club
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Careers
                        </a>
                    </li>
                    <li>
                        <a class="hover:underline" href="#">
                            Visit Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-center text-sm mt-8">
            © 2023 Modimal. All Rights Reserved.
        </div>
    </footer>
</body>

</html>