-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `r10_ecommerce`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCustomerAndProductNames` ()   BEGIN
    SELECT c.customer_name, p.product_name
    FROM reviews r
    JOIN customers c ON r.customer_id = c.customer_id
    JOIN products p ON r.product_id = p.product_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductDetails` ()   BEGIN
    SELECT c.customer_name, p.product_name, r.review_text, r.rating
    FROM reviews r
    JOIN customers c ON r.customer_id = c.customer_id
    JOIN products p ON r.product_id = p.product_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `audittrail`
--

CREATE TABLE `audittrail` (
  `audit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(225) NOT NULL,
  `category_slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_slug`) VALUES
(1, 'Laptops', 'laptops'),
(2, 'Smartwatches', 'smartwatches'),
(3, 'Cellphones', 'cellphones'),
(4, 'Cameras', 'cameras'),
(5, 'Headphones', 'headphones');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `email`, `shipping_address`, `contact_number`, `password`) VALUES
(71, 'Kate Nicole Magpulong', 'Magpulong.KateNicole123@gmail.com', 'Sambulawan, Laguindingan Mis. Or.', '09512577905', '$2y$10$sENcmzx.u4KHj1wSEmWHHOi9nl4S3Ed4vLNMq2z3lBwmXqjOZJBlG'),
(72, 'Ommayah Malim', 'Ommayah@gmail.com', 'Macanhan, Cagayan de Oro City', '09226663529', '$2y$10$T2P5..j1jfSNceijFZZeQuG1DIU7afojR5ZdLkA3PZm3.lCDkAAUa'),
(73, 'Asminah Angni', 'asminah@gmail.com', 'Cagayan', '09512577900', '$2y$10$40D1BgEfqvynMCrMHllViuwAiK12TqV2/qEbUVo1U9suxsiYC/3za'),
(74, 'Jonalyn T. Adalin', 'jona@gmail.com', 'Lumbia', '09754676671', '$2y$10$h6U5GOiWZAD7beK6NI.D8e5tMUdmg9kcQjeIrKK/3.cD/vXD62QEW'),
(75, 'Lindy Juarez', 'LindyJuarez@gmail.com', 'Lumbia', '09754676671', '$2y$10$q3.c4ovvHwKYKbuT1UGoeelUPBgL8G8mIlUdi4Iy/VMeEwHVg8Q8a');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_amount` decimal(10,0) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discount_id`, `product_id`, `discount_amount`, `start_date`, `end_date`) VALUES
(84, 279, 0, '0000-00-00', '0000-00-00'),
(85, 280, 0, '0000-00-00', '0000-00-00'),
(86, 281, 0, '0000-00-00', '0000-00-00'),
(87, 282, 1999, '2023-06-12', '2023-06-15'),
(88, 283, 999, '2023-06-26', '2023-06-30'),
(89, 284, 500, '2023-06-23', '2023-06-30'),
(90, 285, 0, '0000-00-00', '0000-00-00'),
(91, 286, 0, '0000-00-00', '0000-00-00'),
(92, 287, 0, '0000-00-00', '0000-00-00'),
(94, 289, 599, '2023-06-29', '2023-07-14'),
(95, 290, 500, '2023-06-15', '2023-06-22'),
(96, 291, 130, '2023-06-14', '2023-06-16'),
(97, 292, 0, '0000-00-00', '0000-00-00'),
(98, 293, 0, '0000-00-00', '0000-00-00'),
(99, 294, 0, '0000-00-00', '0000-00-00'),
(100, 295, 0, '0000-00-00', '0000-00-00'),
(101, 296, 0, '0000-00-00', '0000-00-00'),
(102, 297, 0, '0000-00-00', '0000-00-00'),
(103, 298, 299, '2023-06-22', '2023-07-08'),
(104, 299, 323, '2023-06-30', '2023-07-13'),
(105, 300, 500, '2023-06-28', '2023-07-19'),
(106, 301, 990, '2023-06-30', '2023-07-15'),
(107, 302, 1699, '2023-06-28', '2023-07-08'),
(108, 303, 500, '2023-06-25', '2023-07-05'),
(109, 304, 0, '0000-00-00', '0000-00-00'),
(110, 305, 0, '0000-00-00', '0000-00-00'),
(111, 306, 0, '0000-00-00', '0000-00-00'),
(112, 307, 0, '0000-00-00', '0000-00-00'),
(113, 308, 0, '0000-00-00', '0000-00-00'),
(114, 309, 0, '0000-00-00', '0000-00-00'),
(115, 310, 42000, '0000-00-00', '0000-00-00'),
(116, 311, 0, '0000-00-00', '0000-00-00'),
(117, 312, 0, '0000-00-00', '0000-00-00'),
(118, 313, 0, '0000-00-00', '0000-00-00'),
(119, 314, 0, '0000-00-00', '0000-00-00'),
(120, 315, 500, '2023-06-30', '2023-07-08'),
(121, 316, 1500, '2023-06-22', '2023-07-14'),
(122, 317, 150, '2023-07-06', '2023-07-21'),
(123, 318, 1000, '2023-06-21', '2023-06-30'),
(124, 319, 999, '2023-06-30', '2023-07-10'),
(125, 320, 2000, '2023-06-15', '2023-06-16'),
(126, 321, 0, '0000-00-00', '0000-00-00'),
(127, 322, 0, '0000-00-00', '0000-00-00'),
(128, 323, 0, '0000-00-00', '0000-00-00'),
(129, 324, 0, '0000-00-00', '0000-00-00'),
(130, 325, 200, '2023-06-15', '2023-06-20'),
(131, 326, 300, '2023-06-20', '2023-06-25'),
(132, 327, 0, '0000-00-00', '0000-00-00'),
(133, 328, 0, '0000-00-00', '0000-00-00'),
(134, 329, 0, '0000-00-00', '0000-00-00'),
(135, 330, 300, '2023-06-19', '2023-06-28'),
(136, 331, 200, '2023-06-30', '2023-07-22'),
(137, 332, 500, '2023-07-05', '2023-07-14'),
(138, 333, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`product_id`, `quantity`) VALUES
(279, 1),
(280, 1),
(281, 1),
(282, 1),
(283, 1),
(284, 1),
(285, 1),
(286, 1),
(287, 1),
(289, 1),
(290, 1),
(291, 1),
(292, 1),
(293, 1),
(294, 1),
(295, 1),
(296, 1),
(297, 1),
(298, 1),
(299, 1),
(300, 1),
(301, 1),
(302, 1),
(303, 1),
(304, 1),
(305, 1),
(306, 1),
(307, 1),
(308, 1),
(311, 1),
(313, 1),
(314, 1),
(315, 1),
(316, 1),
(317, 1),
(318, 1),
(319, 1),
(320, 1),
(327, 1),
(328, 1),
(329, 1),
(330, 1),
(331, 1),
(332, 1),
(333, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_amount`, `status`) VALUES
(18, 71, '2023-06-13', 10700, 'pending'),
(19, 73, '2023-06-13', 31909, 'pending'),
(20, 74, '2023-06-13', 6359, 'pending'),
(21, 72, '2023-06-13', 43899, 'pending'),
(22, 75, '2023-06-13', 35199, 'pending'),
(23, 71, '2023-06-13', 52990, 'pending'),
(24, 73, '2023-06-13', 29399, 'pending'),
(25, 72, '2023-06-13', 2130, 'pending'),
(26, 1, '2023-06-13', 22980, 'pending'),
(27, 74, '2023-06-13', 5500, 'pending'),
(28, 74, '2023-06-13', 5500, 'pending'),
(29, 74, '2023-06-13', 29999, 'pending'),
(30, 74, '2023-06-13', 3405, 'pending'),
(31, 74, '2023-06-13', 2899, 'pending'),
(32, 74, '2023-06-13', 2999, 'pending'),
(33, 74, '2023-06-13', 5500, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `order_id`, `payment_date`, `amount`, `payment_method`) VALUES
(9, 18, '2023-06-13', 10700, 'cod'),
(10, 19, '2023-06-13', 31909, 'cod'),
(11, 20, '2023-06-13', 6359, 'cod'),
(12, 21, '2023-06-13', 43899, 'cod'),
(13, 22, '2023-06-13', 35199, 'cod'),
(14, 23, '2023-06-13', 52990, 'cod'),
(15, 24, '2023-06-13', 29399, 'cod'),
(16, 25, '2023-06-13', 2130, 'cod'),
(17, 26, '2023-06-13', 22980, 'cod'),
(18, 27, '2023-06-13', 5500, 'cod'),
(19, 28, '2023-06-13', 5500, 'cod'),
(20, 29, '2023-06-13', 29999, 'cod'),
(21, 30, '2023-06-13', 3405, 'cod'),
(22, 31, '2023-06-13', 2899, 'cod'),
(23, 32, '2023-06-13', 2999, 'cod'),
(24, 33, '2023-06-13', 5500, 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `category_id`, `supplier_id`, `price`, `description`) VALUES
(279, 'Canon Eos5d', '../img/img_6486874a9c816.png', 4, 112, 23200, ' Professional-grade DSLR camera known for its exceptional image quality and versatility.\r\n\r\nFeatures a full-frame sensor that captures high-resolution images with rich colors and fine details.'),
(280, 'Canon EosC', '../img/img_648696adb86cf.png', 4, 112, 0, 'These cameras offer exceptional image quality, cinematic capabilities, and advanced video features.\r\n\r\nFeature large sensors, allowing for high-resolution video capture with wide dynamic range and low noise.'),
(281, 'POLO D7200', '../img/img_6486973e8f7bf.png', 4, 113, 22980, 'Features a DX-format sensor that delivers high-resolution images with excellent detail and color accuracy.\r\n\r\nThe camera offers a wide ISO range, enabling quality performance in different lighting conditions'),
(282, 'Samsung Galaxy Z ', '../img/img_64869d4698b44.png', 3, 114, 29999, '6.7-inch Dynamic AMOLED display\r\n\r\nA high-quality viewing experience and multitasking capabilities.'),
(283, 'Huawei Mate 40', '../img/img_64869e27b3436.png', 3, 115, 25399, '6.2-inch Dynamic AMOLED display\r\n- powered by a powerful processor and ample RAM\r\n\r\nWith features like wireless charging, water resistance, and an in-display fingerprint sensor.'),
(284, 'TECNO POVA 4 Pro', '../img/img_6486a00655e4b.png', 3, 116, 10599, 'Features a large 6.9-inch display that provides an immersive viewing experience. \r\n\r\nPowered by a MediaTek Helio G85 processor and ample RAM, it delivers smooth performance for daily tasks and gaming. '),
(285, 'Huawei Nova 10', '../img/img_6486a0f4df55e.png', 3, 115, 25399, 'Features a large 6.7-inch display with vibrant colors and sharp visuals.\r\n\r\nBoasts a high-resolution quad-camera system that captures stunning photos and videos in various lighting \r\nconditions. '),
(286, 'Marshall', '../img/img_6486a32d0e7b2.png', 5, 117, 3300, 'Unrivaled convenience with ultra-slim profile and lightweight design\r\n\r\nDurable aluminum construction for on-the-go lifestyle\')'),
(287, 'JBL4 Headphone', '../img/img_6486a3d35d91e.png', 5, 118, 2500, 'Ultimate convenience with sleek and lightweight design\r\n\r\nDiscounted price for a limited time (30% off)'),
(289, 'Acer Aspire 5', '../img/img_6486a5450b53f.png', 1, 120, 33000, 'Powered by a capable processor and sufficient RAM, the Aspire 5 handles everyday tasks and multitasking with ease.\r\n\r\nThe laptop also comes with a range of connectivity options and ports for seamless device integration.'),
(290, 'HP Pavilion 15', '../img/img_6486a61f2c134.png', 1, 121, 33699, 'Features a sleek design with a slim profile, making it portable and stylish.\r\n \r\nDelivers smooth performance and handles multitasking efficiently.'),
(291, 'Rire 7ty', '../img/img_6486a6f13afad.png', 2, 122, 2130, 'Ultra-slim profile and lightweight design.\r\n\r\nDurable aluminum construction for on-the-go convenience).'),
(292, 'Amazfit GTR 4', '../img/img_6486a8631bae9.png', 2, 123, 4859, 'Sleek and lightweight with ultimate convenience\r\n\r\nUnmatched portability with durable aluminum construction'),
(293, 'Samsung 3TTY', '../img/img_6486aafbcf4c4.png', 2, 119, 3859, 'Sleek, lightweight, and durable\r\n\r\nPerfect companion for a portable lifestyle'),
(294, 'Samsung Galaxy A14', '../img/img_6486b0d00db79.png', 3, 119, 20699, 'Features a 6.5-inch Infinity-V display that provides a large viewing area for multimedia content.\r\n\r\nComes with a dual-camera system that captures decent photos and videos'),
(295, 'Soundcore', '../img/img_6486b1c4614dd.png', 5, 124, 2399, 'Unrivaled convenience with sleek and lightweight design\r\n\r\nDurable aluminum construction for portability'),
(296, 'Beats EP Red', '../img/img_6486b293222e0.png', 5, 124, 2110, 'Experience unrivaled convenience with ultra-slim profile and lightweight design\r\n\r\nNew product with a competitive price'),
(297, 'Canon Eos750D', '../img/img_6486b36fbe28e.png', 4, 112, 30090, 'User-friendly DSLR camera that combines advanced imaging technology with ease of use.\r\n\r\nFeatures a high-resolution sensor that captures detailed images with accurate colors'),
(298, 'Nikon D750', '../img/img_6486b45a703df.png', 4, 125, 21220, 'Full-frame DSLR camera renowned for its excellent image quality and versatility.\r\n \r\nFeatures a high-resolution sensor that produces detailed images with rich colors and wide dynamic range'),
(299, 'Canon Eos6D', '../img/img_6486b542e51fe.png', 4, 112, 21000, 'The camera offers a wide ISO range, allowing for versatile shooting in various lighting conditions\r\n\r\nFull-frame DSLR camera known for its excellent image quality and compact design'),
(300, 'Canon Efs', '../img/img_6486b5c358a1d.png', 4, 112, 24000, 'Canon EFS typically refers to a range of lenses designed specifically for Canon APS-C sensor cameras. \r\n\r\nThese lenses are ideal for users looking to expand their photography options with versatile and high-quality lenses'),
(301, 'Asus Vivobook X413JA', '../img/img_6486b747e61d8.png', 1, 126, 37990, 'A stylish and feature-rich laptop designed for productivity and entertainment. \r\n\r\nFeatures a sleek and modern design with slim bezels, maximizing the screen-to-body ratio. '),
(302, 'Acer Aspire 7', '../img/img_6486b83d4c99d.png', 1, 120, 52990, 'Versatile laptop that combines performance, style, and affordability.\r\n\r\nPowered by a high-performance processor and ample RAM, the Aspire 7 handles demanding tasks and multitasking with ease.'),
(303, 'Apple Watch SE2', '../img/img_6486b910e899b.png', 2, 127, 9500, 'Sleek, lightweight, and durable design\r\n\r\nIdeal companion for a portable lifestyle'),
(304, 'Beat S66f', '../img/img_6486baeae7484.png', 5, 128, 2500, 'Unrivaled convenience with sleek and lightweight design\r\n\r\nDurable aluminum construction for portability'),
(305, 'Tecno POVA 2', '../img/img_6486bbdc0a6b5.png', 3, 116, 10990, '- features a large 6.9-inch display that provides an immersive viewing experience. \r\n- Powered by a MediaTek Helio G85 processor and ample RAM, it delivers smooth performance for daily tasks and gaming. '),
(306, 'Fitbit Sens', '../img/img_6486bd2e58f5b.png', 2, 129, 5766, '-Lightweight, sleek, and durable design\r\n-The ultimate companion for your on-the-go lifestyle'),
(307, 'Apple Watch Ultra', '../img/img_6486c1dbd58ca.png', 2, 127, 5999, '-Lightweight, durable, and sleek design\r\n-Your perfect portable companion'),
(308, 'Lenovo IdeaPad Slim ', '../img/img_6486c2d57b203.png', 1, 130, 29799, '- is a lightweight and budget-friendly laptop designed for everyday computing needs. \r\n- offers a decent display for comfortable viewing and includes essential connectivity options for seamless device integration. '),
(311, 'ASUS_Vivobook', '../img/img_6486c60992e0d.png', 1, 126, 42000, '- offer a blend of performance, style, and affordability. \r\n- feature sleek designs, compact form factors, and a range of processor options to cater to different user needs'),
(313, 'Canon Efs', '../img/img_6486c93b8dbd3.png', 4, 112, 24000, '-  Canon EFS typically refers to a range of lenses designed specifically for Canon APS-C sensor cameras. \r\n- These lenses are ideal for users looking to expand their photography options with versatile and high-quality lenses'),
(314, 'CameraS08', '../img/img_6486c9c7a04fa.png', 4, 112, 25000, '- sleek, lightweight, and durable, perfect for your on-the-go lifestyle.\r\n- These lenses are ideal for users looking to expand their photography options with versatile and high-quality lenses'),
(315, 'Samsung Galaxy S22', '../img/img_6486cafd98822.png', 3, 119, 29399, '- features a large and immersive display, likely around 6.8 inches, with a high refresh rate and vibrant colors.\r\n- The S22 Ultra is expected to have an advanced camera system with multiple lenses for capturing stunning photos and videos. '),
(316, 'Huawei Nova Y70', '../img/img_6486cb7f5b39a.png', 3, 115, 21990, '- features a 6.5-inch IPS LCD display that provides a large viewing area for multimedia content.\r\n- Powered by a capable processor and sufficient RAM, the Nova Y70 handles everyday tasks with ease and offers smooth multitasking. '),
(317, 'Samsung J7', '../img/img_6486ccb1839e1.png', 3, 119, 9405, '- features a 5.5-inch Super AMOLED display that provides vibrant colors and sharp visuals. \r\n- offers expandable storage, a long-lasting battery, and a user-friendly interface'),
(318, 'HP Laptop 15', '../img/img_6486cdeba869b.png', 1, 121, 26999, '- features a sturdy build quality and a traditional design that emphasizes functionality.\r\n- The laptop also provides ample storage space for files and documents.'),
(319, 'Hp HQHovies', '../img/img_6486ce90ef8f2.png', 1, 121, 31990, '- features a high-resolution display that delivers crisp visuals and vibrant colors.\r\n- comes with a range of connectivity options, including USB ports and HDMI, allowing users to connect external devices.\r\n'),
(320, 'K9 Samsung Laptop', '../img/img_6486cfdf63d63.png', 1, 119, 25199, '- versatile and powerful device designed for productivity and entertainment.\r\n- offers a comfortable keyboard and a responsive touchpad for easy navigation. '),
(327, 'Beat 6e', '../img/img_6486dca106976.png', 5, 128, 1899, '-Sleek, lightweight, and durable for on-the-go lifestyle\r\n-Perfect companion for your daily activities'),
(328, 'Aspire Bluetooth Headphone', '../img/img_6486dde94b7ee.png', 5, 118, 5200, '-Unrivaled convenience with sleek and lightweight design\r\n-Durable aluminum construction for portability'),
(329, 'Tic Watch Pro3', '../img/img_6486df672294e.png', 2, 116, 2899, '-Ultra-slim, lightweight, and durable design\r\n-Convenient for on-the-go living'),
(330, 'Fitbit Versa3', '../img/img_6486e0060a866.png', 2, 129, 2999, '-Sleek, lightweight, and durable design\r\n-Perfect for your on-the-go lifestyle'),
(331, 'Tera G5 Headphone', '../img/img_6486e4984fb77.png', 5, 135, 3405, '-Experience convenience with ultra-slim profile and lightweight design\r\n-Discounted price for a limited time (30% off)'),
(332, 'Aspire Headphone', '../img/img_6486e53e0b6b3.png', 5, 119, 5200, ' -Experience unrivaled convenience with the Asus Vivobook X413JA ultra-slim profile and lightweight design. \r\n -durability and portability, making it the perfect companion for your on-the-go lifestyle'),
(333, 'Tic Watch E3', '../img/img_6486e62eddccb.png', 2, 127, 5500, '-Sleek design and lightweight build\r\n-Durable construction for a mobile lifestyle');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `RemoveProductQuantity` AFTER DELETE ON `products` FOR EACH ROW BEGIN
    DELETE FROM inventory
    WHERE product_id = OLD.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_add_product` AFTER INSERT ON `products` FOR EACH ROW BEGIN

    IF EXISTS (SELECT 1 FROM inventory WHERE product_id = NEW.product_id) THEN
        UPDATE inventory
        SET quantity = quantity + 1
        WHERE product_id = NEW.product_id;
    ELSE
        INSERT INTO inventory (product_id, quantity)
        VALUES (NEW.product_id, 1);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `customer_id`, `review_text`, `rating`, `review_date`) VALUES
(11, 302, 71, 'A good item!', 5, '2023-06-13'),
(12, 315, 73, 'This cellphone has a nice camera! I love it!', 5, '2023-06-13'),
(13, 286, 72, 'This headphone is excellent!', 4, '2023-06-13'),
(14, 291, 72, 'Nice watch. I love it!', 4, '2023-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shipping_date` date NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `order_id`, `shipping_date`, `address`) VALUES
(12, 18, '2023-06-13', 'Sambulawan, Laguindingan  Misamis Oriental Philippines 9019'),
(13, 19, '2023-06-13', 'Macanhan Cagayan de Oro City Philippines 9000'),
(14, 20, '2023-06-13', 'Lumbia Cagayan de Oro City Philippines 9000'),
(15, 21, '2023-06-13', 'Macanhan Cagayan de Oro City Philippines 9000'),
(16, 22, '2023-06-13', 'Lumbia Cagayan de Oro City Philippines 9000'),
(17, 23, '2023-06-13', 'Sambulawan, Laguindingan  Misamis Oriental Philippines 9019'),
(18, 24, '2023-06-13', 'Cagayan Misamis Oriental Philippines 9000'),
(19, 25, '2023-06-13', 'Macanhan, Cagayan de Oro City Cagayan de Oro City Philippines 9000'),
(20, 26, '2023-06-13', '   '),
(21, 27, '2023-06-13', '   '),
(22, 28, '2023-06-13', 'Mambatangan, Manolo Fortich Bukidnon Philippines 8703'),
(23, 29, '2023-06-13', 'Mambatangan, Manolo Fortich Bukidnon Philippines 8703'),
(24, 30, '2023-06-13', 'Mambatangan, Manolo Fortich Bukidnon Philippines 8703'),
(25, 31, '2023-06-13', 'Mambatangan, Manolo Fortich Bukidnon Philippines 8703'),
(26, 32, '2023-06-13', 'Mambatangan, Manolo Fortich Bukidnon Philippines 8703'),
(27, 33, '2023-06-13', 'Mambatangan, Manolo Fortich Bukidnon Philippines 8703');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `supplier_address` varchar(225) NOT NULL,
  `contact_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `email`, `supplier_address`, `contact_number`) VALUES
(112, 'Canon Incorporate', 'canon@gmail.com', 'Sampaloc, Manila', '0908764677'),
(113, 'Sony Incorporated', 'sony.Inc@gmail.com', 'Quezon City', '0987787878'),
(114, 'Samsung Incorporated', 'sumsung.inc@gmail.com', 'Antipolo City', '09996672453'),
(115, 'Huawei Incorporated', 'huawei.inc@gmail.com', 'Makati City', '09478577321'),
(116, 'Tecno Incorporated', 'tecno.inc@gmail.com', 'Pasay City', '09774562976'),
(117, 'Axus Incorporated', 'axus.inc@gmail.com', 'Davao City', '09922546768'),
(118, 'JBL incorporated', 'jbk.inc@gmail.com', 'Iloilo City', '09346723146'),
(119, 'Samsung Incorporated', 'samsung.inc@gmail.com', 'Antipolo City', '09996672453'),
(120, 'Acer Incorporated', 'acer.inc@gmail.com', 'Metro Manila', '09863457718'),
(121, 'HP Incorporated', 'hp.inc@gmail.com', 'Panggasinan City', '09775569341'),
(122, 'Rire Incorporated', 'rire.inc@gmail.com', 'Cebu City', '09479221048'),
(123, 'Reu Incorporated', 'reu.incorporated@gmail.com', 'Baguio City', '09543765123'),
(124, 'Soundcore Incorporated', 'soundcore.inc@gmail.com', 'Cavite City', '09787543215'),
(125, 'Nikon Incorporated', 'nikon.inc@gmail.com', 'Batangas City', '09034568729'),
(126, 'Asus Incorporated', 'asus.inc@gmail.com', 'Bacolod City', '09055847561'),
(127, 'Apple Incorporated', 'apple.inc@gmail.com', 'Cagayan De Oro City', '09668932251'),
(128, 'JYP Incorporated', 'jyp.inc@gmail.com', 'Mandaluyong City', '09447925786'),
(129, 'Fit Incorporated', 'fit.inc@gmail.com', 'Sampaloc, Manila', '09673456231'),
(130, 'Lenovo Incorporated', 'lenovo.inc@gmail.com', 'Dumaguete City', '09996672453'),
(131, 'KBJ sound Incorporated', 'kbj.inc@gmail.com', 'Zamboanga Del Sur', '0965321876'),
(132, 'Asus Incorporated', 'asus.inc@gmail.com', 'Davao City', '09922546768'),
(133, 'Apple Incorporated', 'apple.inc@gmail.com', 'Cagayan De Oro City', '0966893225'),
(134, 'Tic Incorporated', 'tic.inc@gmail.com', 'General Santos City', '09886452215'),
(135, 'Jujubeat Incorporated', 'jujubeat@gmail.com', 'Sampaloc, Manila', '0935256753');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audittrail`
--
ALTER TABLE `audittrail`
  ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audittrail`
--
ALTER TABLE `audittrail`
  MODIFY `audit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
