<!-- Top Bar -->
<div class="bg-green-700 text-white text-center py-2 text-sm">
    Enjoy Free Shipping On All Orders
</div>
<!-- Header -->
<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 flex items-center justify-between py-4">
        <!-- <div class="text-2xl font-bold">
            Fashion.
            <span class="text-sm font-normal">
                Market
            </span>
        </div> -->
        <a href="../homePage/HomePage.php" class="block">
            <div class="text-2xl font-bold">
                Fashion.
                <span class="text-sm font-normal">
                    Market
                </span>
            </div>
        </a>

        <nav class="flex space-x-6 text-gray-700">
            <a class="hover:text-green-700" href="#">
                Collection
            </a>
            <a class="hover:text-green-700" href="#">
                New In
            </a>
            <a class="hover:text-green-700" href="#">
                Store nearby
            </a>
        </nav>

        <div class="flex items-center space-x-4">

            <!-- <div>
                <button type="cart"
                    class="text-gray-700  bottom-2.5 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">&#128722</button>
            </div> -->

            <div>
                <a href="../cartpage/cart.php"
                    class="text-gray-700 bottom-2.5 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none 
        focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 flex items-center">
                    🛒 Cart
                </a>
            </div>


            <!-- <div>
                <button type="user"
                    class="text-gray-700  bottom-2.5 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">User</button>
            </div> -->

            <!-- <div>
                <a href="user.php"
                    class="text-gray-700 bottom-2.5 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none 
        focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                    👤 Account
                </a>
            </div> -->

            <!-- Login/account button -->
            <div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- If logged in, display Account button -->
                    <span class="mr-4 text-green-600">Xin chào, <?= htmlspecialchars($_SESSION['fullname']) ?></span>
                    <a href="../accountpage/account.php"
                        class="text-gray-700 bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none 
           focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                        👤 Account
                    </a>

                    <!-- If logged in, display logout button -->
                    <a href="../loginpage/logout.php"
                        class="text-gray-700 bg-red-500 hover:bg-blue-800 focus:ring-4 focus:outline-none 
           focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        Logout
                    </a>

                <?php else: ?>
                    <!-- If not logged in, display login button -->
                    <a href="../loginpage/index.php"
                        class="text-gray-700 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none 
           focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        🔐 Login
                    </a>

                <?php endif; ?>
            </div>


        </div>
    </div>
</header>