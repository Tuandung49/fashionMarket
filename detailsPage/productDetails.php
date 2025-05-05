<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fashionmarket"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);
$product_id = $_GET['id'];
$query = "SELECT * FROM product_instock WHERE product_id = $product_id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

$conn->close();

?>

<?php 
    include'../layouts/head.php'
?>

<body>

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <img src="<?= $product['image'] ?>" class="w-full h-64 object-cover rounded-md">
        <h2 class="text-2xl font-bold mt-4"><?= $product['product_display_name'] ?></h2>
        <p class="text-gray-600 mt-2"><?= $product['description'] ?></p>
        <span class="text-lg font-semibold text-green-500">$<?= $product['price'] ?></span>
    </div>


</body>

</html>