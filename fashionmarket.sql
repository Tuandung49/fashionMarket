-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 29, 2025 lúc 11:53 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_instock`
--

INSERT INTO `product_instock` (`product_id`, `product_display_name`, `description`, `quantity`, `price`, `colour`, `image`) VALUES
(1163, 'Nike Sahara Team India Fanwear Round Neck Jersey', 'Sophisticated velvet blazer for evening events.', 48, 677.00, 'Blue', '0'),
(1164, 'Nike Men Blue T20 Indian Cricket Jersey', 'Effortless wrap dress with a flattering silhouette.', 94, 707.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1165, 'Nike Mean Team India Cricket Jersey', 'Chunky platform heels for a bold statement.', 55, 695.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1525, 'Puma Deck Navy Blue Backpack', 'Polished pencil skirt with modern tailoring.', 30, 896.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1526, 'Puma Big Cat Backpack Black', 'Cozy oversized knit sweater with a chic twist.', 46, 388.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1528, 'Puma Men Ferrari Black Fleece Jacket', 'Polished pencil skirt with modern tailoring.', 87, 293.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1529, 'Ferrari Tee', 'Breezy chiffon blouse with a bohemian flair.', 77, 295.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1530, 'Puma Men Ferrari Track Jacket', 'Daring sequined jumpsuit for bold personalities.', 42, 282.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1531, 'Puma Men Grey Solid Round Neck T-Shirt', 'Sophisticated velvet blazer for evening events.', 3, 855.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1532, 'Puma Men Grey Leaping Cat T-shirt', 'Embellished clutch bag for dazzling evenings.', 57, 387.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1533, 'Puma Men Cat Red T-shirt', 'Sophisticated velvet blazer for evening events.', 4, 818.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1534, 'Puma Men Black Leaping Cat T-shirt', 'Soft fleece hoodie for cozy casual days.', 1, 873.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1535, 'Puma Unisex Logo Cap', 'Edgy biker jacket with metallic hardware accents.', 61, 533.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1536, 'Puma Men Black Net Jersey', 'Edgy biker jacket with metallic hardware accents.', 71, 673.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1537, 'Puma Men Red Net Jersey', 'Elegant cashmere scarf for cold weather elegance.', 55, 618.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1538, 'Puma Men Ferrari Track Black T-shirt', 'Glamorous maxi dress with shimmering details.', 24, 816.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1539, 'Puma Men Ferrari Grey T-shirt', 'Lightweight cotton sundress with floral accents.', 52, 237.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1540, 'Puma Men Ferrari Vintage Black Polo T-shirt', 'Effortless wrap dress with a flattering silhouette.', 94, 494.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1541, 'Puma Men\'s Ballistic Spike White Green Shoe', 'Sophisticated velvet blazer for evening events.', 2, 420.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1542, 'Puma Men\'s Ballistic Rubber Shoe', 'Vintage-inspired leather handbag with a modern edge.', 52, 599.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1543, 'Puma Men Basket-Biz Sneaker', 'Polished pencil skirt with modern tailoring.', 43, 279.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1544, 'Puma Men\'s Basket Bump Sneaker', 'Versatile tailored trousers for work or leisure.', 72, 33.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1545, 'Puma Men\'s Speed Cat Shoe', 'Elegant cashmere scarf for cold weather elegance.', 45, 425.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1546, 'Puma Men\'s Furore White Shoe', 'Timeless trench coat for all-weather style.', 86, 830.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1547, 'Puma Men\'s Ducati Sneaker', 'High-waisted denim jeans for effortless cool.', 26, 951.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1548, 'Puma Men\'s Cell Exsis Sneaker', 'High-waisted denim jeans for effortless cool.', 70, 360.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1549, 'Puma Men\'s Jiyu Slip On Sneaker', 'Daring sequined jumpsuit for bold personalities.', 17, 235.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1550, 'Puma Cat Trainer-WBL Football', 'High-waisted denim jeans for effortless cool.', 66, 340.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1551, 'Puma Power Cat Trainer-OB Football', 'Soft fleece hoodie for cozy casual days.', 8, 991.00, 'Orange', 'http://assets.myntassets.com/v1/images/style/prope'),
(1552, 'Puma Power Cat Trainer-WR Football', 'Daring sequined jumpsuit for bold personalities.', 13, 480.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1553, 'Puma Power Cat Hard Ground Football', 'High-waisted denim jeans for effortless cool.', 31, 262.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1554, 'Quechua  Blue Sipper', 'Vintage-inspired leather handbag with a modern edge.', 29, 704.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1555, 'Quechua Red Sipper', 'Glamorous maxi dress with shimmering details.', 75, 947.00, 'Purple', 'http://assets.myntassets.com/v1/images/style/prope'),
(1556, 'Quechua Forclaz Large  Backpack - 50 ltr Orange', 'Breezy chiffon blouse with a bohemian flair.', 29, 542.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1557, 'Quechua Spacious Blue-Black Backpack', 'Classic white sneakers with a minimalist design.', 21, 893.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1558, 'Quechua Easy-to-Carry Blue Water Bottle', 'Polished pencil skirt with modern tailoring.', 65, 878.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1559, 'Quechua Blue Light Backpack', 'Sophisticated velvet blazer for evening events.', 26, 512.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1561, 'Quechua Women Sweat Proof White T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 41, 435.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1562, 'Quechua Men Sweat Proof Grey T-shirt', 'Sophisticated velvet blazer for evening events.', 9, 98.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1563, 'Quechua Men Sweat Proof Blue T-shirt', 'Polished pencil skirt with modern tailoring.', 78, 748.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1565, 'Quechua Green Light Backpack', 'Soft fleece hoodie for cozy casual days.', 60, 231.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1566, 'Artengo Men Black Cap', 'Daring sequined jumpsuit for bold personalities.', 43, 707.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1567, 'Artengo Men Training Shorts', 'Timeless trench coat for all-weather style.', 88, 921.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1569, 'Artengo Men Black Tennis Shorts', 'Embellished clutch bag for dazzling evenings.', 98, 234.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1570, 'Artengo Women Tennis Singlet', 'Polished pencil skirt with modern tailoring.', 2, 170.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1571, 'Kalenji Men\'s Super Soft Sports Shoes', 'Lightweight cotton sundress with floral accents.', 91, 298.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1572, 'Kalenji Mens Essential Training Track Pants', 'Cozy oversized knit sweater with a chic twist.', 7, 667.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1573, 'Kalenji Women Athletes Grey Track Pants', 'Soft fleece hoodie for cozy casual days.', 45, 382.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1575, 'Kipsta Men Sports White T-shirt', 'Polished pencil skirt with modern tailoring.', 10, 159.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1577, 'Inesis  Slim Shady Cap', 'Daring sequined jumpsuit for bold personalities.', 81, 393.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1578, 'Domyos Men Good Stroke Red T-shirt', 'Glamorous maxi dress with shimmering details.', 24, 595.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1579, 'Domyos Men Grey Second Skin Jacket', 'Timeless trench coat for all-weather style.', 4, 784.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1580, 'Nabaiji Women Cross-back Swimsuit', 'High-waisted denim jeans for effortless cool.', 99, 381.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1581, 'Nabaiji Unisex Silicone Swimming Cap', 'Glamorous maxi dress with shimmering details.', 88, 134.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/prope'),
(1582, 'Nabaiji Unisex Black Silicone Swimming Cap', 'Effortless wrap dress with a flattering silhouette.', 93, 949.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1583, 'Nabaiji Women Black Swimsuit', 'Relaxed fit linen trousers perfect for summer.', 96, 379.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1584, 'Domyos Unisex Feather-light Jacket', 'Relaxed fit linen trousers perfect for summer.', 95, 570.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1587, 'Kipsta Men Superfit Football White Shoe', 'Cozy oversized knit sweater with a chic twist.', 70, 429.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1588, 'Domyos Men White Dry-Fit T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 89, 343.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1590, 'Kipsta Men\'s F300 Football Shoe', 'High-waisted denim jeans for effortless cool.', 58, 839.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1591, 'Kipsta Men Red Shorts', 'Timeless trench coat for all-weather style.', 45, 33.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1592, 'Kipsta Men\'s Superfit Football Red Shoe', 'Edgy biker jacket with metallic hardware accents.', 64, 706.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1594, 'Newfeel Unisex Grey Mesh Lightweight Shoe', 'Chunky platform heels for a bold statement.', 39, 614.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1595, 'Domyos Men Good Stroke Black T-shirt', 'Edgy biker jacket with metallic hardware accents.', 67, 216.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1596, 'Quechua Easy-to-Carry Pink Sipper', 'Sophisticated velvet blazer for evening events.', 36, 523.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/prope'),
(1597, 'Geonaute Women Black Outdoor Bag', 'Edgy biker jacket with metallic hardware accents.', 41, 835.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1598, 'Geonaute Women Blue Outdoor Bag', 'Soft fleece hoodie for cozy casual days.', 73, 838.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1599, 'Geonaute Women Green Outdoor Bag', 'Edgy biker jacket with metallic hardware accents.', 30, 883.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1603, 'Reebok Men Hoops Athletic Navy Sweatshirt', 'Polished pencil skirt with modern tailoring.', 6, 511.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1604, 'Reebok Track Pants Women Blue', 'Relaxed fit linen trousers perfect for summer.', 42, 637.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1605, 'Reebok Black Track Pant', 'Cozy oversized knit sweater with a chic twist.', 20, 541.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1607, 'Reebok Men trackpant- male Track Pants', 'Elegant cashmere scarf for cold weather elegance.', 32, 80.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1608, 'Reebok Track Pants Jet Black', 'Sophisticated velvet blazer for evening events.', 7, 418.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1609, 'Reebok Women Boat-Neck Wildberry Sweatshirt', 'Timeless trench coat for all-weather style.', 72, 296.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/prope'),
(1610, 'Reebok Navy Jacket', 'Classic white sneakers with a minimalist design.', 17, 323.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1611, 'Reebok Knit Rib Women Black Jacket', 'Embellished clutch bag for dazzling evenings.', 16, 296.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1612, 'Reebok Orange & White Striped Polo T-shirt', 'Classic white sneakers with a minimalist design.', 55, 382.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1613, 'Reebok Men White Polo Tshirt', 'Sophisticated velvet blazer for evening events.', 98, 195.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1614, 'Reebok T-shirt White Polo Tshirt', 'High-waisted denim jeans for effortless cool.', 31, 214.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1615, 'Reebok Men Navy Blue Polo T-shirt', 'High-waisted denim jeans for effortless cool.', 83, 932.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1616, 'Reebok Men\'s Shoot White T-Shirt', 'Classic white sneakers with a minimalist design.', 69, 870.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1617, 'Reebok Men Shoot T-Shirt Red', 'Relaxed fit linen trousers perfect for summer.', 17, 851.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1618, 'Reebok Men United Runner White', 'Effortless wrap dress with a flattering silhouette.', 29, 918.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1619, 'Reebok Men Micro Shorts Grey and White', 'Edgy biker jacket with metallic hardware accents.', 63, 962.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1620, 'Reebok Men Micro Shorts', 'Classic white sneakers with a minimalist design.', 94, 808.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1621, 'Reebok Men Micro Shorts Black and White', 'Timeless trench coat for all-weather style.', 15, 106.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1622, 'Reebok Navy Knit Rib Jacket', 'Glamorous maxi dress with shimmering details.', 68, 625.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1623, 'Reebok Unisex Red Backpack', 'Embellished clutch bag for dazzling evenings.', 19, 129.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1624, 'Reebok Silver-Black Laptop Backpack', 'Chunky platform heels for a bold statement.', 50, 404.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1625, 'Domyos Men Quick Dry T-shirt', 'Sleek leather ankle boots for any season.', 68, 330.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1626, 'Kipsta F300 Football Size 5 Football', 'Effortless wrap dress with a flattering silhouette.', 32, 865.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1627, 'Kipsta F300 Football', 'Daring sequined jumpsuit for bold personalities.', 59, 472.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1628, 'Kipsta Xtra Bounce Basketball', 'Breezy chiffon blouse with a bohemian flair.', 58, 37.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/prope'),
(1634, 'Inesis Water Repellent Canaveral Shoes', 'Polished pencil skirt with modern tailoring.', 60, 457.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1635, 'Newfeel Unisex Red Comfy Shoes', 'Classic white sneakers with a minimalist design.', 92, 265.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1636, 'Nike Men Air Zoom Century Shoes', 'Lightweight cotton sundress with floral accents.', 51, 52.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1637, 'Nike Men White Cricket Shoes', 'Classic white sneakers with a minimalist design.', 31, 52.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1638, 'Nabaiji Swimming Goggles Blue Black', 'Daring sequined jumpsuit for bold personalities.', 74, 337.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1641, 'Reebok Men\'s Hex Run Pure Silver Shoe', 'Classic white sneakers with a minimalist design.', 97, 155.00, 'Silver', 'http://assets.myntassets.com/v1/images/style/prope'),
(1642, 'Reebok Men Winning Stride White Red', 'Glamorous maxi dress with shimmering details.', 89, 659.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1644, 'Kipsta Men Loose Fit Round Neck Jersey Red', 'Sophisticated velvet blazer for evening events.', 26, 745.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1645, 'Kipsta Men Loose Fit Round Neck Jersey Black', 'Polished pencil skirt with modern tailoring.', 62, 611.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1646, 'Quechua Ultralight Backpack 16 Ltr Grey Bag', 'Breezy chiffon blouse with a bohemian flair.', 25, 245.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1647, 'Quechua Unisex Ultralight 16 Ltr Green Backpack', 'Vintage-inspired leather handbag with a modern edge.', 3, 608.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1648, 'Quechua  Ultralight Backpack Purple 16 ltr Bag', 'Versatile tailored trousers for work or leisure.', 60, 469.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/prope'),
(1649, 'Newfeel Unisex Comfy Cool Blue Shoe', 'Sophisticated velvet blazer for evening events.', 82, 886.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1651, 'Domyos Women Style Pink T-shirt', 'Glamorous maxi dress with shimmering details.', 48, 320.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/prope'),
(1653, 'Reebok Men\'s Ventilator Ubiq Shoe', 'Sleek leather ankle boots for any season.', 45, 431.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/prope'),
(1654, 'Reebok Men\'s Frisker LP Shoe', 'Classic white sneakers with a minimalist design.', 89, 355.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1656, 'Nike Unisex Odi Day Cap', 'Sleek leather ankle boots for any season.', 99, 836.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1657, 'Reebok Men\'s White High Wire Shoe', 'Lightweight cotton sundress with floral accents.', 93, 922.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1658, 'Nike Men Windrunner Blue Jacket', 'Chunky platform heels for a bold statement.', 89, 807.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1662, 'Nike Men Blue Windrunner Jacket', 'Polished pencil skirt with modern tailoring.', 54, 328.00, 'Navy Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1668, 'Reebok Men Playdry Full Sleeved T-shirt Red', 'Glamorous maxi dress with shimmering details.', 88, 311.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1670, 'Reebok Men Green Polo T-shirt', 'Embellished clutch bag for dazzling evenings.', 14, 309.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1671, 'Reebok Men Black Polo T-shirt', 'Sophisticated velvet blazer for evening events.', 42, 273.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1673, 'Reebok Mens Lagoon Black T-shirt', 'Polished pencil skirt with modern tailoring.', 45, 973.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1678, 'Reebok Men Play Hard Cotton Green T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 54, 497.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1689, 'Reebok Men Blue Polo T-shirt', 'Timeless trench coat for all-weather style.', 81, 934.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1697, 'Puma Deck Black Backpack', 'Soft fleece hoodie for cozy casual days.', 31, 358.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1727, 'Newfeel Unisex Black Lightweight Shoes', 'Daring sequined jumpsuit for bold personalities.', 25, 127.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1728, 'Newfeel Unisex Green Sports Shoes', 'Daring sequined jumpsuit for bold personalities.', 50, 965.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1729, 'Newfeel Unisex White Shoes', 'Sleek leather ankle boots for any season.', 51, 230.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1730, 'Reebok Women Black Pink Frisker Shoe', 'Breezy chiffon blouse with a bohemian flair.', 88, 731.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1731, 'Reebok Women White Blue Frisker Shoes', 'Polished pencil skirt with modern tailoring.', 38, 172.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1752, 'Lotto Men Red Epic T-shirt', 'Timeless trench coat for all-weather style.', 26, 863.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1754, 'Lotto Men Marcello Black T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 2, 706.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1755, 'Lotto Men Jasper Street Red T-shirt', 'Vintage-inspired leather handbag with a modern edge.', 77, 107.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1756, 'Lotto Men White Polo T-shirt', 'Sophisticated velvet blazer for evening events.', 88, 982.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1757, 'Lotto Men Polo Slate Black Rugby T-shirt', 'Elegant cashmere scarf for cold weather elegance.', 89, 736.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1758, 'Lotto Men White Collared Jacket', 'Chunky platform heels for a bold statement.', 78, 244.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1759, 'Lotto Men Epic Grey T-shirt', 'Chunky platform heels for a bold statement.', 78, 659.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1760, 'Lotto Men Marcello White T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 90, 423.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1762, 'Lotto Women Cathy Blue T-shirt', 'Timeless trench coat for all-weather style.', 5, 759.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1763, 'Lotto Women Cathy Pink T-shirt', 'Sophisticated velvet blazer for evening events.', 48, 68.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/prope'),
(1764, 'Lotto Women Mid Cathy Track Pants', 'Soft fleece hoodie for cozy casual days.', 61, 715.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1765, 'Lotto Women White T-shirt', 'Versatile tailored trousers for work or leisure.', 88, 828.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1766, 'Inesis Men Blue Polo T-shirt', 'Glamorous maxi dress with shimmering details.', 39, 650.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1782, 'Kalenji Men\'s Kapteren Black Shoe', 'Edgy biker jacket with metallic hardware accents.', 84, 818.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1783, 'Quechua Men Grey Sandal', 'Effortless wrap dress with a flattering silhouette.', 4, 195.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1784, 'Lotto Men\'s Melbourne White-Red Shoe', 'High-waisted denim jeans for effortless cool.', 53, 542.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1785, 'Lotto Men Brighton White-Blue Shoe', 'Sophisticated velvet blazer for evening events.', 81, 294.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1786, 'Lotto Men\'s Court Logo White Shoe', 'Versatile tailored trousers for work or leisure.', 46, 920.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1787, 'Lotto Men Court Logo White-Silver Shoe', 'Soft fleece hoodie for cozy casual days.', 83, 157.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1788, 'Lotto Men\'s Court-White-Blue Shoe', 'Versatile tailored trousers for work or leisure.', 37, 779.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1789, 'Lotto Men OSLO Grey-Orange Shoe', 'Breezy chiffon blouse with a bohemian flair.', 3, 815.00, 'Orange', 'http://assets.myntassets.com/v1/images/style/prope'),
(1790, 'Quechua Unisex Ultralight Beige Bag', 'Versatile tailored trousers for work or leisure.', 87, 786.00, 'Beige', 'http://assets.myntassets.com/v1/images/style/prope'),
(1791, 'Quechua 10L Black Bag', 'Lightweight cotton sundress with floral accents.', 74, 617.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1792, 'Newfeel Marine Blue Bag', 'Sophisticated velvet blazer for evening events.', 41, 695.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1793, 'Quechua 10L Green Bag', 'Breezy chiffon blouse with a bohemian flair.', 33, 739.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1794, 'Newfeel Brown 22L Bag', 'Soft fleece hoodie for cozy casual days.', 69, 598.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/prope'),
(1795, 'Newfeel 22L Black Bag', 'Daring sequined jumpsuit for bold personalities.', 18, 805.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1796, 'Domyos Men Performance Blue T-shirt', 'Glamorous maxi dress with shimmering details.', 50, 400.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1798, 'Domyos Men Slt Compression T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 9, 400.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1799, 'Domyos Men Blue & White Tracksuit', 'Polished pencil skirt with modern tailoring.', 92, 550.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1800, 'Quechua Unisex Black Solid Backpack', 'Timeless trench coat for all-weather style.', 31, 100.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1801, 'Quechua Women 10L Pink Bag', 'Relaxed fit linen trousers perfect for summer.', 60, 147.00, 'Pink', 'http://assets.myntassets.com/v1/images/style/prope'),
(1802, 'Quechua Men\'s Arpenaz Flex Yellow Shoe', 'Glamorous maxi dress with shimmering details.', 60, 312.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/prope'),
(1803, 'Tribord Unisex Black T-shirt', 'Versatile tailored trousers for work or leisure.', 70, 86.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1804, 'Kalenji Men Essential Baggy Black Shorts', 'High-waisted denim jeans for effortless cool.', 80, 547.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1805, 'Quechua Men Forclaz 1OO Beige Shoe', 'Daring sequined jumpsuit for bold personalities.', 66, 911.00, 'Beige', 'http://assets.myntassets.com/v1/images/style/prope'),
(1806, 'Quechua Men Arpenaz Brown Sandal', 'Sophisticated velvet blazer for evening events.', 7, 463.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/prope'),
(1807, 'Quechua Men G1 Techfresh Red T-shirt', 'Classic white sneakers with a minimalist design.', 37, 576.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1808, 'Quechua Aluminium Print Water Bottle', 'Soft fleece hoodie for cozy casual days.', 81, 352.00, 'Purple', 'http://assets.myntassets.com/v1/images/style/prope'),
(1809, 'Decathlon Profilter Women Blue T-shirt', 'Cozy oversized knit sweater with a chic twist.', 79, 67.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1810, 'Tribord Profilter Red Men T-shirt', 'Elegant cashmere scarf for cold weather elegance.', 63, 909.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1811, 'Solognac Men Orange T-shirt', 'Timeless trench coat for all-weather style.', 81, 90.00, 'Orange', 'http://assets.myntassets.com/v1/images/style/prope'),
(1812, 'Solognac Men Green T-shirt', 'Sleek leather ankle boots for any season.', 39, 668.00, 'Green', 'http://assets.myntassets.com/v1/images/style/prope'),
(1813, 'Solognac Men Dark Blue T-shirt', 'Edgy biker jacket with metallic hardware accents.', 20, 44.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1814, 'Solognac Men Chocolate Brown  T-shirt', 'Sophisticated velvet blazer for evening events.', 6, 863.00, 'Brown', 'http://assets.myntassets.com/v1/images/style/prope'),
(1827, 'Nike Men\'s Downshifter White/Blue Shoe', 'High-waisted denim jeans for effortless cool.', 32, 713.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1828, 'Nike Men\'s Air Afterburner Shoe', 'Versatile tailored trousers for work or leisure.', 67, 482.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1831, 'Nike Men\'s Air Impetus Shoe', 'Glamorous maxi dress with shimmering details.', 25, 454.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1832, 'Nike Lunarswift Shoe', 'Elegant cashmere scarf for cold weather elegance.', 43, 766.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1833, 'Nike Men\'s Ballista Shoe', 'Versatile tailored trousers for work or leisure.', 97, 751.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1836, 'Nike Air Visi Sleek Shoes', 'Soft fleece hoodie for cozy casual days.', 20, 171.00, 'Silver', 'http://assets.myntassets.com/v1/images/style/prope'),
(1841, 'Puma Men\'s Calibre Convertible Spike Shoe', 'Daring sequined jumpsuit for bold personalities.', 88, 977.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1842, 'Puma Men\'s Calibre Rubber Shoe', 'Vintage-inspired leather handbag with a modern edge.', 78, 581.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1844, 'Inkfruit Mens D day T-shirt', 'Soft fleece hoodie for cozy casual days.', 54, 228.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1845, 'Inkfruit Mens Surfer T-shirt', 'Effortless wrap dress with a flattering silhouette.', 6, 65.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1846, 'Inkfruit Men Buddha Bless You T-shirt', 'High-waisted denim jeans for effortless cool.', 97, 417.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1847, 'Inkfruit Mens Messy T-shirt', 'Polished pencil skirt with modern tailoring.', 2, 642.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1848, 'Inkfruit Men Wolf', 'Polished pencil skirt with modern tailoring.', 26, 365.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1849, 'Inkfruit Mens Unbreakable Mumbai T-shirt', 'Breezy chiffon blouse with a bohemian flair.', 9, 216.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1852, 'Inkfruit Men Ride It Or Die T-shirt', 'Elegant cashmere scarf for cold weather elegance.', 20, 986.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1853, 'Inkfruit Mens Little Bit More T-shirt', 'Chunky platform heels for a bold statement.', 15, 695.00, 'Yellow', 'http://assets.myntassets.com/v1/images/style/prope'),
(1854, 'Inkfruit Mens Pencho T-shirt', 'Daring sequined jumpsuit for bold personalities.', 89, 54.00, 'Purple', 'http://assets.myntassets.com/v1/images/style/prope'),
(1855, 'Inkfruit Mens Chain Reaction T-shirt', 'Versatile tailored trousers for work or leisure.', 89, 715.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1856, 'Inkfruit Men Rebel Without a Clue T-shirt', 'Polished pencil skirt with modern tailoring.', 97, 96.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1857, 'Inkfruit Mens Life After Midnight T-shirt', 'Soft fleece hoodie for cozy casual days.', 87, 442.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1859, 'Inkfruit Men Eye Opener T-shirt', 'Lightweight cotton sundress with floral accents.', 24, 35.00, 'Red', 'http://assets.myntassets.com/v1/images/style/prope'),
(1860, 'Inkfruit Mens Shiva T-shirt', 'Soft fleece hoodie for cozy casual days.', 20, 757.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1861, 'Inkfruit Men Graff Wars T-shirt', 'Polished pencil skirt with modern tailoring.', 59, 199.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1862, 'Inkfruit Mens Urban Warfare T-shirt', 'Effortless wrap dress with a flattering silhouette.', 51, 846.00, 'Grey', 'http://assets.myntassets.com/v1/images/style/prope'),
(1863, 'Inkfruit Men Night Wolf T-shirt', 'Daring sequined jumpsuit for bold personalities.', 54, 253.00, 'Black', 'http://assets.myntassets.com/v1/images/style/prope'),
(1865, 'Inkfruit Men Operation Kick', 'Elegant cashmere scarf for cold weather elegance.', 42, 546.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope'),
(1866, 'Inkfruit Mens My Pet T-shirt', 'Polished pencil skirt with modern tailoring.', 80, 923.00, 'Maroon', 'http://assets.myntassets.com/v1/images/style/prope'),
(1867, 'Inkfruit Men Nayak Nahi T-shirt', 'Relaxed fit linen trousers perfect for summer.', 52, 995.00, 'Blue', 'http://assets.myntassets.com/v1/images/style/prope'),
(1868, 'Inkfruit Mens Facebook Like T-shirt', 'Embellished clutch bag for dazzling evenings.', 2, 143.00, 'White', 'http://assets.myntassets.com/v1/images/style/prope');

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
