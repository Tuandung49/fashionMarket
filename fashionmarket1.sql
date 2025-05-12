-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 29, 2025 lúc 12:11 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fashionmarket`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `feedback_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `buy_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `promote_code_id_used` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_price` int(11) NOT NULL,
  `status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_instock`
--

CREATE TABLE `product_instock` (
  `product_id` int(11) NOT NULL,
  `product_display_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `colour` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_instock`
--

INSERT INTO `product_instock` (`product_id`, `product_display_name`, `description`, `quantity`, `price`, `colour`, `image`) VALUES
(0, 'product_display_name', 'description', 0, 0.00, 'color', 'image'),
(1163, 'Nike Sahara Team India Fanwear Round Neck Jersey', 'Sophisticated velvet blazer for evening events.', 48, 677.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/df30bc92249a83ec84b5ba682bf5a0fa_images.jpg'),
(1164, 'Nike Men Blue T20 Indian Cricket Jersey', 'Effortless wrap dress with a flattering silhouette.', 94, 707.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/021cc52e8426a3d983e4d7ec660a70b2_images.jpg'),
(1165, 'Nike Mean Team India Cricket Jersey', 'Chunky platform heels for a bold statement.', 55, 695.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/787b1a9dd9abb5279976bac35ab78c2d_images.jpg'),
(1525, 'Puma Deck Navy Blue Backpack', 'Polished pencil skirt with modern tailoring.', 30, 896.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/properties/2fc776b82eaaf82497f1a13cf63eb073_images.jpg'),
(1526, 'Puma Big Cat Backpack Black', 'Cozy oversized knit sweater with a chic twist.', 46, 388.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/9556d66f526ab7923d599fdddee1e4b9_images.jpg'),
(1528, 'Puma Men Ferrari Black Fleece Jacket', 'Polished pencil skirt with modern tailoring.', 87, 293.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/5dc5a3265be8eeefdbd7c06e43ff6cb9_images.jpg'),
(1529, 'Ferrari Tee', 'Breezy chiffon blouse with a bohemian flair.', 77, 295.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/74f42a1523d450362f6579f96b64b608_images.jpg'),
(1530, 'Puma Men Ferrari Track Jacket', 'Daring sequined jumpsuit for bold personalities.', 42, 282.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/54315bd731592e29d830218599d0a974_images.jpg'),
(1531, 'Puma Men Grey Solid Round Neck T-Shirt', 'Sophisticated velvet blazer for evening events.', 3, 855.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/11208e022cee193bc9ce69ae7601d11e_images.jpg'),
(1532, 'Puma Men Grey Leaping Cat T-shirt', 'Embellished clutch bag for dazzling evenings.', 57, 387.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/c683c989cc53d172a8d9b175d75d1294_images.jpg'),
(1533, 'Puma Men Cat Red T-shirt', 'Sophisticated velvet blazer for evening events.', 4, 818.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/a062e261b6d3e1349a6d2a6aa7371669_images.jpg'),
(1534, 'Puma Men Black Leaping Cat T-shirt', 'Soft fleece hoodie for cozy casual days.', 1, 873.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/Nike-Men-Grey-Melange-Track-Pants_ec04f71d66884cf587041154b74517c2_images.jpg'),
(1535, 'Puma Unisex Logo Cap', 'Edgy biker jacket with metallic hardware accents.', 61, 533.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/0ea46424229645fa229d38b0eff4afc5_images.jpg'),
(1536, 'Puma Men Black Net Jersey', 'Edgy biker jacket with metallic hardware accents.', 71, 673.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/8294dba13908524b577b295ca6282838_images.jpg'),
(1537, 'Puma Men Red Net Jersey', 'Elegant cashmere scarf for cold weather elegance.', 55, 618.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/7c92ff84d5e91203ba60b622e0431dec_images.jpg'),
(1538, 'Puma Men Ferrari Track Black T-shirt', 'Glamorous maxi dress with shimmering details.', 24, 816.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/4576528b60bdbec05893efe87d2c284b_images.jpg'),
(1539, 'Puma Men Ferrari Grey T-shirt', 'Lightweight cotton sundress with floral accents.', 52, 237.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/5cb54a4d277bd2dbfd7cb17832112c31_images.jpg'),
(1540, 'Puma Men Ferrari Vintage Black Polo T-shirt', 'Effortless wrap dress with a flattering silhouette.', 94, 494.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/9f87ee7f474418708b44f85560868489_images.jpg'),
(1541, 'Puma Men\'s Ballistic Spike White Green Shoe', 'Sophisticated velvet blazer for evening events.', 2, 420.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/Nike-Men-Black-Three-Quarter-Track-Pants_38fb020e318c77b678317fe9d16695a0_images.jpg'),
(1542, 'Puma Men\'s Ballistic Rubber Shoe', 'Vintage-inspired leather handbag with a modern edge.', 52, 599.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/b6a7fd3fd2f7ec8b6633854e4c10312f_images.jpg'),
(1543, 'Puma Men Basket-Biz Sneaker', 'Polished pencil skirt with modern tailoring.', 43, 279.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/87ae1ed282a5057fafbf1d693b247659_images.jpg'),
(1544, 'Puma Men\'s Basket Bump Sneaker', 'Versatile tailored trousers for work or leisure.', 72, 33.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/434ee4b4ee8cc7d9ed0f2e7e975960d8_images.jpg'),
(1545, 'Puma Men\'s Speed Cat Shoe', 'Elegant cashmere scarf for cold weather elegance.', 45, 425.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/dcdf10855cb9709e3ff034e62313a54c_images.jpg'),
(1546, 'Puma Men\'s Furore White Shoe', 'Timeless trench coat for all-weather style.', 86, 830.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/0dc04c9600a1bcb794629e743779bf35_images.jpg'),
(1547, 'Puma Men\'s Ducati Sneaker', 'High-waisted denim jeans for effortless cool.', 26, 951.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/888b6b3f4e53b64b22b4c836ecca0666_images.jpg'),
(1548, 'Puma Men\'s Cell Exsis Sneaker', 'High-waisted denim jeans for effortless cool.', 70, 360.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/7317c5199336e94d3501ffb607cc5b12_images.jpg'),
(1549, 'Puma Men\'s Jiyu Slip On Sneaker', 'Daring sequined jumpsuit for bold personalities.', 17, 235.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/cef2af04f8327e7d5dc432bc72ddda5f_images.jpg'),
(1550, 'Puma Cat Trainer-WBL Football', 'High-waisted denim jeans for effortless cool.', 66, 340.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/da791422b3800d0abcca75d600a83f79_images.jpg'),
(1551, 'Puma Power Cat Trainer-OB Football', 'Soft fleece hoodie for cozy casual days.', 8, 991.00, 'Orange', 'http://assets.myntassets.com/v1/images/style/properties/d099fee09179cfa2b806d8728cf4542a_images.jpg'),
(1552, 'Puma Power Cat Trainer-WR Football', 'Daring sequined jumpsuit for bold personalities.', 13, 480.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/cb273208c26f6ddaf749b9fb11b827b1_images.jpg'),
(1553, 'Puma Power Cat Hard Ground Football', 'High-waisted denim jeans for effortless cool.', 31, 262.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/8483c7e54ece0a2de025182f4b30e3b5_images.jpg'),
(1554, 'Quechua  Blue Sipper', 'Vintage-inspired leather handbag with a modern edge.', 29, 704.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/f891a7ec22ae36e8c14defd61bb0b7f3_images.jpg'),
(1555, 'Quechua Red Sipper', 'Glamorous maxi dress with shimmering details.', 75, 947.00, 'Purple', 'http://assets.myntassets.com/v1/images/style/properties/826d8f5d5e64a05b51c0afd3d5adb1ba_images.jpg'),
(1556, 'Quechua Forclaz Large  Backpack - 50 ltr Orange', 'Breezy chiffon blouse with a bohemian flair.', 29, 542.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/894025afc35ba6f9924867af75d608c4_images.jpg'),
(1557, 'Quechua Spacious Blue-Black Backpack', 'Classic white sneakers with a minimalist design.', 21, 893.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/612c8af18a9a4b6010fdd16dd80d5246_images.jpg'),
(1558, 'Quechua Easy-to-Carry Blue Water Bottle', 'Polished pencil skirt with modern tailoring.', 65, 878.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/ca06d73e7eabdfe68bcdee9c3a8739fc_images.jpg'),
(1559, 'Quechua Blue Light Backpack', 'Sophisticated velvet blazer for evening events.', 26, 512.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/c876491b1ad3bbece863d5bf29408446_images.jpg'),
(1561, 'Quechua Women Sweat Proof White T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 41, 435.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/8c7024fc08196b33759515ff1d542899_images.jpg'),
(1562, 'Quechua Men Sweat Proof Grey T-shirt', 'Sophisticated velvet blazer for evening events.', 9, 98.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/c2e91f240ec1503abde9529cdea2e434_images.jpg'),
(1563, 'Quechua Men Sweat Proof Blue T-shirt', 'Polished pencil skirt with modern tailoring.', 78, 748.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/0ce5fc38767b9140c4e2c5efe8dbbb31_images.jpg'),
(1565, 'Quechua Green Light Backpack', 'Soft fleece hoodie for cozy casual days.', 60, 231.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/fd92254d0f9006661bee76ac33f5c9bf_images.jpg'),
(1566, 'Artengo Men Black Cap', 'Daring sequined jumpsuit for bold personalities.', 43, 707.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/7f8898f2b88316fdc4cc970f08b56daf_images.jpg'),
(1567, 'Artengo Men Training Shorts', 'Timeless trench coat for all-weather style.', 88, 921.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/feee09d16daa4bd9f01bb6a87693aa84_images.jpg'),
(1569, 'Artengo Men Black Tennis Shorts', 'Embellished clutch bag for dazzling evenings.', 98, 234.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/74b69fbb1f5697af585c3ebc18315918_images.jpg'),
(1570, 'Artengo Women Tennis Singlet', 'Polished pencil skirt with modern tailoring.', 2, 170.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/eb6356e3915780613a7c3533ad3fdab0_images.jpg'),
(1571, 'Kalenji Men\'s Super Soft Sports Shoes', 'Lightweight cotton sundress with floral accents.', 91, 298.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/031fdac535f3c5630b6c63a1dbbbb859_images.jpg'),
(1572, 'Kalenji Mens Essential Training Track Pants', 'Cozy oversized knit sweater with a chic twist.', 7, 667.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/4c4c7f32dcf714a378b5fb818b84a57e_images.jpg'),
(1573, 'Kalenji Women Athletes Grey Track Pants', 'Soft fleece hoodie for cozy casual days.', 45, 382.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/a999c915f8b14dbff2b8d1709061c903_images.jpg'),
(1575, 'Kipsta Men Sports White T-shirt', 'Polished pencil skirt with modern tailoring.', 10, 159.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/74bc9f69684b61729b7950ff07114d49_images.jpg'),
(1577, 'Inesis  Slim Shady Cap', 'Daring sequined jumpsuit for bold personalities.', 81, 393.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/0a8c0bf5d6f680a4b712050a67c63c84_images.jpg'),
(1578, 'Domyos Men Good Stroke Red T-shirt', 'Glamorous maxi dress with shimmering details.', 24, 595.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/575ec204c6922cbdf81a7303d8bf8f23_images.jpg'),
(1579, 'Domyos Men Grey Second Skin Jacket', 'Timeless trench coat for all-weather style.', 4, 784.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/25e4db79314ebf7ae946ec496f7cced0_images.jpg'),
(1580, 'Nabaiji Women Cross-back Swimsuit', 'High-waisted denim jeans for effortless cool.', 99, 381.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/dd87d19692f01880e34a6cf2b0bd9b22_images.jpg'),
(1581, 'Nabaiji Unisex Silicone Swimming Cap', 'Glamorous maxi dress with shimmering details.', 88, 134.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/properties/6988d144f536d572a4a19cbfc3e49f98_images.jpg'),
(1582, 'Nabaiji Unisex Black Silicone Swimming Cap', 'Effortless wrap dress with a flattering silhouette.', 93, 949.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/7e75438fd1d569711ccdc49c3af0a7c8_images.jpg'),
(1583, 'Nabaiji Women Black Swimsuit', 'Relaxed fit linen trousers perfect for summer.', 96, 379.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/85edd9fe185b64067be2e2aa5f1e7d81_images.jpg'),
(1584, 'Domyos Unisex Feather-light Jacket', 'Relaxed fit linen trousers perfect for summer.', 95, 570.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/506e68ce21f4ee2dbfe8117c63d54aa1_images.jpg'),
(1587, 'Kipsta Men Superfit Football White Shoe', 'Cozy oversized knit sweater with a chic twist.', 70, 429.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/c9ea7b775dd14c52b71b265f4544fd17_images.jpg'),
(1588, 'Domyos Men White Dry-Fit T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 89, 343.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/9a1511e85d03032420c7dd0481707515_images.jpg'),
(1590, 'Kipsta Men\'s F300 Football Shoe', 'High-waisted denim jeans for effortless cool.', 58, 839.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/821d377e49f3aa198c1937e9793099a6_images.jpg'),
(1591, 'Kipsta Men Red Shorts', 'Timeless trench coat for all-weather style.', 45, 33.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/326621cc6459c808536e5229782ea491_images.jpg'),
(1592, 'Kipsta Men\'s Superfit Football Red Shoe', 'Edgy biker jacket with metallic hardware accents.', 64, 706.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/473df328352f5cc757a7e6734167c52a_images.jpg'),
(1594, 'Newfeel Unisex Grey Mesh Lightweight Shoe', 'Chunky platform heels for a bold statement.', 39, 614.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/ef754e63472dece06abfa6d6c1266d91_images.jpg'),
(1595, 'Domyos Men Good Stroke Black T-shirt', 'Edgy biker jacket with metallic hardware accents.', 67, 216.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/b9c52b5667d67014a17e00d31f001530_images.jpg'),
(1596, 'Quechua Easy-to-Carry Pink Sipper', 'Sophisticated velvet blazer for evening events.', 36, 523.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/properties/392f6b2acfb489b56a0e8d62d6f1fdef_images.jpg'),
(1597, 'Geonaute Women Black Outdoor Bag', 'Edgy biker jacket with metallic hardware accents.', 41, 835.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/69528f3383099e6013052b49ff5f6906_images.jpg'),
(1598, 'Geonaute Women Blue Outdoor Bag', 'Soft fleece hoodie for cozy casual days.', 73, 838.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/a992b89ffa8033dca43f58dd0106033a_images.jpg'),
(1599, 'Geonaute Women Green Outdoor Bag', 'Edgy biker jacket with metallic hardware accents.', 30, 883.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/cff49d4482569b840645af1766db33fe_images.jpg'),
(1603, 'Reebok Men Hoops Athletic Navy Sweatshirt', 'Polished pencil skirt with modern tailoring.', 6, 511.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/properties/8b99b044cc4272ddcd5aa6bda74c8a81_images.jpg'),
(1604, 'Reebok Track Pants Women Blue', 'Relaxed fit linen trousers perfect for summer.', 42, 637.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/4fb3ec9b0c071fd9b85213135e6fdfdf_images.jpg'),
(1605, 'Reebok Black Track Pant', 'Cozy oversized knit sweater with a chic twist.', 20, 541.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/e23ec316027fea04777a336ef8091706_images.jpg'),
(1607, 'Reebok Men trackpant- male Track Pants', 'Elegant cashmere scarf for cold weather elegance.', 32, 80.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/6dabe0a0503cb611e831111a26aedf6e_images.jpg'),
(1608, 'Reebok Track Pants Jet Black', 'Sophisticated velvet blazer for evening events.', 7, 418.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/87684581db1232150a9ffca2b05e16f6_images.jpg'),
(1609, 'Reebok Women Boat-Neck Wildberry Sweatshirt', 'Timeless trench coat for all-weather style.', 72, 296.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/properties/b70850d768383499cac7d0327a301656_images.jpg'),
(1610, 'Reebok Navy Jacket', 'Classic white sneakers with a minimalist design.', 17, 323.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/properties/d2aa2e147e9d44851450864dfd05c281_images.jpg'),
(1611, 'Reebok Knit Rib Women Black Jacket', 'Embellished clutch bag for dazzling evenings.', 16, 296.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/68be265f451f371dac65dc4f76a99f21_images.jpg'),
(1612, 'Reebok Orange & White Striped Polo T-shirt', 'Classic white sneakers with a minimalist design.', 55, 382.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/15017ddf96926014061a0b06525b554e_images.jpg'),
(1613, 'Reebok Men White Polo Tshirt', 'Sophisticated velvet blazer for evening events.', 98, 195.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/0543c05bce84b0fcbeeabb354a821fea_images.jpg'),
(1614, 'Reebok T-shirt White Polo Tshirt', 'High-waisted denim jeans for effortless cool.', 31, 214.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/7ebd5995024cda13732fe2bc5b59f63b_images.jpg'),
(1615, 'Reebok Men Navy Blue Polo T-shirt', 'High-waisted denim jeans for effortless cool.', 83, 932.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/properties/859b90da56eca0b45ca6022f2c6ce9d7_images.jpg'),
(1616, 'Reebok Men\'s Shoot White T-Shirt', 'Classic white sneakers with a minimalist design.', 69, 870.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/4dac018abe2b09b76c465624cb319e6f_images.jpg'),
(1617, 'Reebok Men Shoot T-Shirt Red', 'Relaxed fit linen trousers perfect for summer.', 17, 851.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/5835ec5fe9b308e4b838985212832b57_images.jpg'),
(1618, 'Reebok Men United Runner White', 'Effortless wrap dress with a flattering silhouette.', 29, 918.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/29bafa503018057b586e376213c8f7a9_images.jpg'),
(1619, 'Reebok Men Micro Shorts Grey and White', 'Edgy biker jacket with metallic hardware accents.', 63, 962.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/0c09e6d84d5a38033dc6574465a3f5af_images.jpg'),
(1620, 'Reebok Men Micro Shorts', 'Classic white sneakers with a minimalist design.', 94, 808.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/25f5a65c9c5dbf5f7631cf2d3f0d20f3_images.jpg'),
(1621, 'Reebok Men Micro Shorts Black and White', 'Timeless trench coat for all-weather style.', 15, 106.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/ab539228aaa6b834a99eef6cf339c057_images.jpg'),
(1622, 'Reebok Navy Knit Rib Jacket', 'Glamorous maxi dress with shimmering details.', 68, 625.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/properties/a947ceec9e8c493229417e1a1390417e_images.jpg'),
(1623, 'Reebok Unisex Red Backpack', 'Embellished clutch bag for dazzling evenings.', 19, 129.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/703a4bc156df5eb4719dc0dd2e871d82_images.jpg'),
(1624, 'Reebok Silver-Black Laptop Backpack', 'Chunky platform heels for a bold statement.', 50, 404.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/b9087cd7ae406a75259287725e05213b_images.jpg'),
(1625, 'Domyos Men Quick Dry T-shirt', 'Sleek leather ankle boots for any season.', 68, 330.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/19ec8f66795dfeae910c34973fa9b32f_images.jpg'),
(1626, 'Kipsta F300 Football Size 5 Football', 'Effortless wrap dress with a flattering silhouette.', 32, 865.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/c6b651c3474dc980106eadf223fc6422_images.jpg'),
(1627, 'Kipsta F300 Football', 'Daring sequined jumpsuit for bold personalities.', 59, 472.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/119c4e8d603f2504934a74d7cd846b82_images.jpg'),
(1628, 'Kipsta Xtra Bounce Basketball', 'Breezy chiffon blouse with a bohemian flair.', 58, 37.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/properties/0b36b904a338a58bb059a5277a088304_images.jpg'),
(1634, 'Inesis Water Repellent Canaveral Shoes', 'Polished pencil skirt with modern tailoring.', 60, 457.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/fdac2846ffd3a6fa3cf95b6f379591c1_images.jpg'),
(1635, 'Newfeel Unisex Red Comfy Shoes', 'Classic white sneakers with a minimalist design.', 92, 265.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/25b345388b1851b384f3a28ae1368f65_images.jpg'),
(1636, 'Nike Men Air Zoom Century Shoes', 'Lightweight cotton sundress with floral accents.', 51, 52.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/2c302276b47365707b2896a0d5798ad6_images.jpg'),
(1637, 'Nike Men White Cricket Shoes', 'Classic white sneakers with a minimalist design.', 31, 52.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/9fa4929c4fb0fba28aa035f2bd2b7326_images.jpg'),
(1638, 'Nabaiji Swimming Goggles Blue Black', 'Daring sequined jumpsuit for bold personalities.', 74, 337.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/20fc6e0f15e98e760f67d8c6f3a61ff3_images.jpg'),
(1641, 'Reebok Men\'s Hex Run Pure Silver Shoe', 'Classic white sneakers with a minimalist design.', 97, 155.00, 'Silver', 'http://assets.myntassets.com/v1/images/style/properties/2564fc4ea392445c307a9b044b049efd_images.jpg'),
(1642, 'Reebok Men Winning Stride White Red', 'Glamorous maxi dress with shimmering details.', 89, 659.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/d2e026c2f28ea294a9bac4e43e064e97_images.jpg'),
(1644, 'Kipsta Men Loose Fit Round Neck Jersey Red', 'Sophisticated velvet blazer for evening events.', 26, 745.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/18cb176598526b42bb238839fab11312_images.jpg'),
(1645, 'Kipsta Men Loose Fit Round Neck Jersey Black', 'Polished pencil skirt with modern tailoring.', 62, 611.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/Reebok-Unisex-Adventure-Black-Sports-Sandals_3a510d568ab22d7e1ab0d864e3311bd4_images.jpg'),
(1646, 'Quechua Ultralight Backpack 16 Ltr Grey Bag', 'Breezy chiffon blouse with a bohemian flair.', 25, 245.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/66ee14dc2f2d2e4f60fb31a4ce97242d_images.jpg'),
(1647, 'Quechua Unisex Ultralight 16 Ltr Green Backpack', 'Vintage-inspired leather handbag with a modern edge.', 3, 608.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/8e6ba4d2a8ed5f65521e0e67d1bb2bef_images.jpg'),
(1648, 'Quechua  Ultralight Backpack Purple 16 ltr Bag', 'Versatile tailored trousers for work or leisure.', 60, 469.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/properties/25d332924fd1d7fb7e35c7bb091fa5a6_images.jpg'),
(1649, 'Newfeel Unisex Comfy Cool Blue Shoe', 'Sophisticated velvet blazer for evening events.', 82, 886.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/5bd632ae93ce20be08bc552e86b9c1c9_images.jpg'),
(1651, 'Domyos Women Style Pink T-shirt', 'Glamorous maxi dress with shimmering details.', 48, 320.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/properties/7c4d882429035abd0bf0ae46b09bb367_images.jpg'),
(1653, 'Reebok Men\'s Ventilator Ubiq Shoe', 'Sleek leather ankle boots for any season.', 45, 431.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/properties/ce1b064b045d6df9b8bbcb950cb2f3ef_images.jpg'),
(1654, 'Reebok Men\'s Frisker LP Shoe', 'Classic white sneakers with a minimalist design.', 89, 355.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/253b5bb72db493adf8566e20aa2d944c_images.jpg'),
(1656, 'Nike Unisex Odi Day Cap', 'Sleek leather ankle boots for any season.', 99, 836.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/567603638c9e38f036df9d7c0cce416e_images.jpg'),
(1657, 'Reebok Men\'s White High Wire Shoe', 'Lightweight cotton sundress with floral accents.', 93, 922.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/86961a68126106e64d15f1f1b4e4e86b_images.jpg'),
(1658, 'Nike Men Windrunner Blue Jacket', 'Chunky platform heels for a bold statement.', 89, 807.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/aaa7587b878e7bff272fb836a83ee277_images.jpg'),
(1662, 'Nike Men Blue Windrunner Jacket', 'Polished pencil skirt with modern tailoring.', 54, 328.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/properties/e18f215064ce3161fe83a49ac6ce78ad_images.jpg'),
(1668, 'Reebok Men Playdry Full Sleeved T-shirt Red', 'Glamorous maxi dress with shimmering details.', 88, 311.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/71040e2921fe960b51feb6a3fc5483fe_images.jpg'),
(1670, 'Reebok Men Green Polo T-shirt', 'Embellished clutch bag for dazzling evenings.', 14, 309.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/4bf7493b8d26280f6df3389a604bac39_images.jpg'),
(1671, 'Reebok Men Black Polo T-shirt', 'Sophisticated velvet blazer for evening events.', 42, 273.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/313a4836b78d9987f36d669d295351c5_images.jpg'),
(1673, 'Reebok Mens Lagoon Black T-shirt', 'Polished pencil skirt with modern tailoring.', 45, 973.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/2fd1e51862bc8aa0d81e367449280608_images.jpg'),
(1678, 'Reebok Men Play Hard Cotton Green T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 54, 497.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/1c8e52c5c383ecd174fe422c38ad886d_images.jpg'),
(1689, 'Reebok Men Blue Polo T-shirt', 'Timeless trench coat for all-weather style.', 81, 934.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/f26a8d35cf22fcc130a8215fe0f93bff_images.jpg'),
(1697, 'Puma Deck Black Backpack', 'Soft fleece hoodie for cozy casual days.', 31, 358.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/c0761e1fe7c7ca7d034421271e629694_images.jpg'),
(1727, 'Newfeel Unisex Black Lightweight Shoes', 'Daring sequined jumpsuit for bold personalities.', 25, 127.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/a742fe134d718a3f6535c907d1c80c3e_images.jpg'),
(1728, 'Newfeel Unisex Green Sports Shoes', 'Daring sequined jumpsuit for bold personalities.', 50, 965.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/09cca0e5cc87f77adaf0ec45e330bc69_images.jpg'),
(1729, 'Newfeel Unisex White Shoes', 'Sleek leather ankle boots for any season.', 51, 230.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/a33cc4994484713b9bceb5fac4caf7fc_images.jpg'),
(1730, 'Reebok Women Black Pink Frisker Shoe', 'Breezy chiffon blouse with a bohemian flair.', 88, 731.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/ff3bc3d3018bd010ce347ba585225a99_images.jpg'),
(1731, 'Reebok Women White Blue Frisker Shoes', 'Polished pencil skirt with modern tailoring.', 38, 172.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/7d45e92fe52e1e0f85b81dbfd555d547_images.jpg'),
(1752, 'Lotto Men Red Epic T-shirt', 'Timeless trench coat for all-weather style.', 26, 863.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/f5dc17b6e6035d293922ca062b8d3641_images.jpg'),
(1754, 'Lotto Men Marcello Black T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 2, 706.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/2b801f0f6b385b9b3aaaf5e445bccacf_images.jpg'),
(1755, 'Lotto Men Jasper Street Red T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 77, 107.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/37913cff0e36326b4f964f50ebf9067f_images.jpg'),
(1756, 'Lotto Men White Polo T-shirt', 'Sophisticated velvet blazer for evening events.', 88, 982.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/931d26641e005c64a983c37564998773_images.jpg'),
(1757, 'Lotto Men Polo Slate Black Rugby T-shirt', 'Elegant cashmere scarf for cold weather elegance.', 89, 736.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/9bf6d021ae87e3b576ac4369b47e79c4_images.jpg'),
(1758, 'Lotto Men White Collared Jacket', 'Chunky platform heels for a bold statement.', 78, 244.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/3a6456cffaae2483cf9a8db88860a2be_images.jpg'),
(1759, 'Lotto Men Epic Grey T-shirt', 'Chunky platform heels for a bold statement.', 78, 659.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/912c45f1bcf50721a8b91267ce2a8771_images.jpg'),
(1760, 'Lotto Men Marcello White T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 90, 423.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/ec12c17eb739a89749e2019c4471b815_images.jpg'),
(1762, 'Lotto Women Cathy Blue T-shirt', 'Timeless trench coat for all-weather style.', 5, 759.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/aa4db93c374f1acb099335f866665d26_images.jpg'),
(1763, 'Lotto Women Cathy Pink T-shirt', 'Sophisticated velvet blazer for evening events.', 48, 68.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/properties/3573a259ea08979cca43a51ee8a92f77_images.jpg'),
(1764, 'Lotto Women Mid Cathy Track Pants', 'Soft fleece hoodie for cozy casual days.', 61, 715.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/70e2779975aff0a1013a6818d90ee2e5_images.jpg'),
(1765, 'Lotto Women White T-shirt', 'Versatile tailored trousers for work or leisure.', 88, 828.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/574b500f26efe790bce88c692f03adbe_images.jpg'),
(1766, 'Inesis Men Blue Polo T-shirt', 'Glamorous maxi dress with shimmering details.', 39, 650.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/33e9255f5e5f2296524d2485ec3c0275_images.jpg'),
(1782, 'Kalenji Men\'s Kapteren Black Shoe', 'Edgy biker jacket with metallic hardware accents.', 84, 818.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/710f1d1a11e75bf0dbda21f2abe49ed8_images.jpg'),
(1783, 'Quechua Men Grey Sandal', 'Effortless wrap dress with a flattering silhouette.', 4, 195.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/8f85a79062799ba1430e2cf3a79c0bde_images.jpg'),
(1784, 'Lotto Men\'s Melbourne White-Red Shoe', 'High-waisted denim jeans for effortless cool.', 53, 542.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/ac2fdc8f7c496c562d9f908bec3dda4e_images.jpg'),
(1785, 'Lotto Men Brighton White-Blue Shoe', 'Sophisticated velvet blazer for evening events.', 81, 294.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/ec3f78e59538b3d07c22285ed951ebeb_images.jpg'),
(1786, 'Lotto Men\'s Court Logo White Shoe', 'Versatile tailored trousers for work or leisure.', 46, 920.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/3f3e24c34b5139a7a4bc76025cfca17d_images.jpg'),
(1787, 'Lotto Men Court Logo White-Silver Shoe', 'Soft fleece hoodie for cozy casual days.', 83, 157.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/b2375bb794cd90dbbe609a6a3e507ba4_images.jpg'),
(1788, 'Lotto Men\'s Court-White-Blue Shoe', 'Versatile tailored trousers for work or leisure.', 37, 779.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/daa74af2c53029588991046e722eb275_images.jpg'),
(1789, 'Lotto Men OSLO Grey-Orange Shoe', 'Breezy chiffon blouse with a bohemian flair.', 3, 815.00, 'Orange', 'http://assets.myntassets.com/v1/images/style/properties/7a74c4a6abb89aaba4001f78a4b71535_images.jpg'),
(1790, 'Quechua Unisex Ultralight Beige Bag', 'Versatile tailored trousers for work or leisure.', 87, 786.00, 'Beige', 'http://assets.myntassets.com/v1/images/style/properties/ba5b76dbf5ed8166a6890e397c57c7e9_images.jpg'),
(1791, 'Quechua 10L Black Bag', 'Lightweight cotton sundress with floral accents.', 74, 617.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/711a5b54a3fefda367023a49ce26678d_images.jpg'),
(1792, 'Newfeel Marine Blue Bag', 'Sophisticated velvet blazer for evening events.', 41, 695.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/5453b88ec904e4d8f01f6182c1763072_images.jpg'),
(1793, 'Quechua 10L Green Bag', 'Breezy chiffon blouse with a bohemian flair.', 33, 739.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/c09a37d3bb783f407461cdc9ede81b4a_images.jpg'),
(1794, 'Newfeel Brown 22L Bag', 'Soft fleece hoodie for cozy casual days.', 69, 598.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/properties/1063e8d1167630e8debcf2343645039c_images.jpg'),
(1795, 'Newfeel 22L Black Bag', 'Daring sequined jumpsuit for bold personalities.', 18, 805.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/fc4ea7a39f7b828bcf2fc6dfd81a1eb0_images.jpg'),
(1796, 'Domyos Men Performance Blue T-shirt', 'Glamorous maxi dress with shimmering details.', 50, 400.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/9bb4c8d766374626e362652350fc9872_images.jpg'),
(1798, 'Domyos Men Slt Compression T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 9, 400.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/99239fea24f0845c090f8272d128e83f_images.jpg'),
(1799, 'Domyos Men Blue & White Tracksuit', 'Polished pencil skirt with modern tailoring.', 92, 550.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/e002f7fdb0f580ecb8092dcb4030e640_images.jpg'),
(1800, 'Quechua Unisex Black Solid Backpack', 'Timeless trench coat for all-weather style.', 31, 100.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/8cfa60f1e4a178d057336bcc08ccdc43_images.jpg'),
(1801, 'Quechua Women 10L Pink Bag', 'Relaxed fit linen trousers perfect for summer.', 60, 147.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/properties/91c125b5453d48ec9f0fbab4912b1fa8_images.jpg'),
(1802, 'Quechua Men\'s Arpenaz Flex Yellow Shoe', 'Glamorous maxi dress with shimmering details.', 60, 312.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/properties/abf212122486259ba302c810103970e6_images.jpg'),
(1803, 'Tribord Unisex Black T-shirt', 'Versatile tailored trousers for work or leisure.', 70, 86.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/e4fe151c492e20af58e47fc6ff83ed47_images.jpg'),
(1804, 'Kalenji Men Essential Baggy Black Shorts', 'High-waisted denim jeans for effortless cool.', 80, 547.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/37f9b90506b1ab65f6c78664f6130c2a_images.jpg'),
(1805, 'Quechua Men Forclaz 1OO Beige Shoe', 'Daring sequined jumpsuit for bold personalities.', 66, 911.00, 'Beige', 'http://assets.myntassets.com/v1/images/style/properties/2572c6b3e3a510677eca89373f45c8b0_images.jpg'),
(1806, 'Quechua Men Arpenaz Brown Sandal', 'Sophisticated velvet blazer for evening events.', 7, 463.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/properties/bfd34f4dd6f1e524ef923436cf220c62_images.jpg'),
(1807, 'Quechua Men G1 Techfresh Red T-shirt', 'Classic white sneakers with a minimalist design.', 37, 576.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/65309e66582be74faf20cbacb9abb81b_images.jpg'),
(1808, 'Quechua Aluminium Print Water Bottle', 'Soft fleece hoodie for cozy casual days.', 81, 352.00, 'Purple', 'http://assets.myntassets.com/v1/images/style/properties/ad402e6188d3c2cf138844300719afb1_images.jpg'),
(1809, 'Decathlon Profilter Women Blue T-shirt', 'Cozy oversized knit sweater with a chic twist.', 79, 67.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/2185c6c3f5d47abcb4bce0f492c9c13d_images.jpg'),
(1810, 'Tribord Profilter Red Men T-shirt', 'Elegant cashmere scarf for cold weather elegance.', 63, 909.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/c4f27e2296a69e0c2589a78ca37a44ab_images.jpg'),
(1811, 'Solognac Men Orange T-shirt', 'Timeless trench coat for all-weather style.', 81, 90.00, 'Orange', 'http://assets.myntassets.com/v1/images/style/properties/b4146cd57f7a1da6ab6fe64cbc108e7b_images.jpg'),
(1812, 'Solognac Men Green T-shirt', 'Sleek leather ankle boots for any season.', 39, 668.00, 'Green', 'http://assets.myntassets.com/v1/images/style/properties/68b5d902fbc8bb65253901d908fa94db_images.jpg'),
(1813, 'Solognac Men Dark Blue T-shirt', 'Edgy biker jacket with metallic hardware accents.', 20, 44.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/a4025cc617a1d4dd282961461b9e682a_images.jpg'),
(1814, 'Solognac Men Chocolate Brown  T-shirt', 'Sophisticated velvet blazer for evening events.', 6, 863.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/properties/33a5e91f28ed4764e183ff1bcff2a7e0_images.jpg'),
(1827, 'Nike Men\'s Downshifter White/Blue Shoe', 'High-waisted denim jeans for effortless cool.', 32, 713.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/c3d33dff0b91fd161e62177df1db02ee_images.jpg'),
(1828, 'Nike Men\'s Air Afterburner Shoe', 'Versatile tailored trousers for work or leisure.', 67, 482.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/bd9b63a2f3ee780ffe10dd71db928805_images.jpg'),
(1831, 'Nike Men\'s Air Impetus Shoe', 'Glamorous maxi dress with shimmering details.', 25, 454.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/85c94160d97302253a9a606e22aeeac2_images.jpg'),
(1832, 'Nike Lunarswift Shoe', 'Elegant cashmere scarf for cold weather elegance.', 43, 766.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/6a241cb727ac8f369ae15a2b06609d45_images.jpg'),
(1833, 'Nike Men\'s Ballista Shoe', 'Versatile tailored trousers for work or leisure.', 97, 751.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/49ee8a5856566b81f252ce39a0d97d3c_images.jpg'),
(1836, 'Nike Air Visi Sleek Shoes', 'Soft fleece hoodie for cozy casual days.', 20, 171.00, 'Silver', 'http://assets.myntassets.com/v1/images/style/properties/77021911579c9bd9aa868fe80cfa1d0b_images.jpg'),
(1841, 'Puma Men\'s Calibre Convertible Spike Shoe', 'Daring sequined jumpsuit for bold personalities.', 88, 977.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/e5550c3937f959d03e6de6f684e90432_images.jpg'),
(1842, 'Puma Men\'s Calibre Rubber Shoe', 'Vintage-inspired leather handbag with a modern edge.', 78, 581.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/cd2b7bd87c8caa143ccd388b07cc3f84_images.jpg'),
(1844, 'Inkfruit Mens D day T-shirt', 'Soft fleece hoodie for cozy casual days.', 54, 228.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/e0d679d95c506d75ebafbe5a5f691c66_images.jpg'),
(1845, 'Inkfruit Mens Surfer T-shirt', 'Effortless wrap dress with a flattering silhouette.', 6, 65.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/db58e608dad2c712e97b28c879670c51_images.jpg'),
(1846, 'Inkfruit Men Buddha Bless You T-shirt', 'High-waisted denim jeans for effortless cool.', 97, 417.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/2c2a92c1ece4816a1b486ed0494daec3_images.jpg'),
(1847, 'Inkfruit Mens Messy T-shirt', 'Polished pencil skirt with modern tailoring.', 2, 642.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/5de6fa98cbc2c133ed17577f7b99601f_images.jpg'),
(1848, 'Inkfruit Men Wolf', 'Polished pencil skirt with modern tailoring.', 26, 365.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/9afc8fe3b22b8059078a0a699abd4e04_images.jpg'),
(1849, 'Inkfruit Mens Unbreakable Mumbai T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 9, 216.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/2aeaca212fea5e6f7c0d17b0ea52e2cd_images.jpg'),
(1852, 'Inkfruit Men Ride It Or Die T-shirt', 'Elegant cashmere scarf for cold weather elegance.', 20, 986.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/4a9409cff57af3207d0846fb6751dc5b_images.jpg'),
(1853, 'Inkfruit Mens Little Bit More T-shirt', 'Chunky platform heels for a bold statement.', 15, 695.00, 'Yellow', 'http://assets.myntassets.com/v1/images/style/properties/e169071f36619892f9c1505a4e4fbf1a_images.jpg'),
(1854, 'Inkfruit Mens Pencho T-shirt', 'Daring sequined jumpsuit for bold personalities.', 89, 54.00, 'Purple', 'http://assets.myntassets.com/v1/images/style/properties/902b386e6a4d71b73fde87a76c7489cd_images.jpg'),
(1855, 'Inkfruit Mens Chain Reaction T-shirt', 'Versatile tailored trousers for work or leisure.', 89, 715.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/6a8c34a1ee804c481deaa3f9e0b390f6_images.jpg'),
(1856, 'Inkfruit Men Rebel Without a Clue T-shirt', 'Polished pencil skirt with modern tailoring.', 97, 96.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/b718af6ebf06ba1d8bba876507020ef8_images.jpg'),
(1857, 'Inkfruit Mens Life After Midnight T-shirt', 'Soft fleece hoodie for cozy casual days.', 87, 442.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/c91269b9b2e49e4c9c317bb1e255bdcc_images.jpg'),
(1859, 'Inkfruit Men Eye Opener T-shirt', 'Lightweight cotton sundress with floral accents.', 24, 35.00, 'Red', 'http://assets.myntassets.com/v1/images/style/properties/67f0c773c61d0d3f2bec47ba4eaa2e78_images.jpg'),
(1860, 'Inkfruit Mens Shiva T-shirt', 'Soft fleece hoodie for cozy casual days.', 20, 757.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/a0e289c3b0a364e68768ad1900e13023_images.jpg'),
(1861, 'Inkfruit Men Graff Wars T-shirt', 'Polished pencil skirt with modern tailoring.', 59, 199.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/0aa26686dc640c7c61502d00d282d192_images.jpg'),
(1862, 'Inkfruit Mens Urban Warfare T-shirt', 'Effortless wrap dress with a flattering silhouette.', 51, 846.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/properties/c2f01d4cbeb82dd9390ce5322ab6c72d_images.jpg'),
(1863, 'Inkfruit Men Night Wolf T-shirt', 'Daring sequined jumpsuit for bold personalities.', 54, 253.00, 'Black', 'http://assets.myntassets.com/v1/images/style/properties/0dc8401c5d335866c815ed06a629ad9e_images.jpg'),
(1865, 'Inkfruit Men Operation Kick', 'Elegant cashmere scarf for cold weather elegance.', 42, 546.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/6e5ab73efa65884df6f17a0e818f5ed6_images.jpg'),
(1866, 'Inkfruit Mens My Pet T-shirt', 'Polished pencil skirt with modern tailoring.', 80, 923.00, 'Maroon', 'http://assets.myntassets.com/v1/images/style/properties/43d54846d88471aef838ea72f8770d65_images.jpg'),
(1867, 'Inkfruit Men Nayak Nahi T-shirt', 'Relaxed fit linen trousers perfect for summer.', 52, 995.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/properties/e08cdf8c3edf37279065473c279e6d89_images.jpg'),
(1868, 'Inkfruit Mens Facebook Like T-shirt', 'Embellished clutch bag for dazzling evenings.', 2, 143.00, 'White', 'http://assets.myntassets.com/v1/images/style/properties/7c46ea1fd95794b0fb7bfc4037397bda_images.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_in_cart`
--

CREATE TABLE `product_in_cart` (
  `incart_product_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promo_code`
--

CREATE TABLE `promo_code` (
  `promo_code_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `time_use` int(11) NOT NULL,
  `limited` int(11) NOT NULL,
  `discount` decimal(3,2) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `gender` bit(1) NOT NULL,
  `birth` datetime NOT NULL,
  `create_acc_day` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` bit(1) NOT NULL,
  `used_promote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
