-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 04:10 PM
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
-- Database: `e_commerce_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `order_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `d_id` int(11) DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `product_cost` decimal(10,2) NOT NULL,
  `delivery_fee` decimal(10,2) NOT NULL,
  `order_datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`order_id`, `c_id`, `d_id`, `status`, `product_cost`, `delivery_fee`, `order_datetime`) VALUES
(42, 3, 4, 'delivered', 134999.00, 200.00, '2026-01-06 22:28:43'),
(43, 3, 4, 'delivered', 54999.00, 200.00, '2026-01-06 22:31:41'),
(44, 3, 4, 'delivered', 54999.00, 200.00, '2026-01-06 22:32:02'),
(45, 3, NULL, 'ordered', 48999.00, 200.00, '2026-01-06 22:34:52'),
(46, 3, NULL, 'ordered', 1699.00, 200.00, '2026-01-07 00:48:36'),
(47, 48, 4, 'delivered', 88499.00, 200.00, '2026-01-07 01:18:20'),
(48, 3, NULL, 'ordered', 134999.00, 200.00, '2026-01-07 11:24:21'),
(49, 50, NULL, 'ordered', 54999.00, 200.00, '2026-01-07 13:59:07'),
(50, 50, NULL, 'ordered', 129999.00, 200.00, '2026-01-07 14:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `price` double NOT NULL,
  `image_url` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `price`, `image_url`, `stock`, `category`) VALUES
(2, 'General AC', 54999, 'ac.jpg', 496, 'AC'),
(3, 'Haier Refrigerator', 34999, 'fridge.jpg', 493, 'Fridge'),
(4, 'Iphone 16', 129999, 'iphone.jpg', 480, 'Mobile'),
(5, 'Dell Inspiron', 84999, 'laptop.jpg', 470, 'Laptop'),
(6, 'Asus ROG', 1699, 'mouse.jpg', 472, 'Mouse'),
(7, 'Play Station 5', 65400, 'ps5.jpg', 496, 'Console'),
(8, 'Pixel Watch', 48999, 'smartwatch.jpg', 500, 'Smart Watch'),
(9, 'NVMe SSD', 7900, 'ssd.jpg', 503, 'SSD'),
(10, 'Starlink Kit', 49500, 'starlink.jpg', 501, 'Router'),
(11, 'Samsung Tablet', 24999, 'tab.jpg', 501, 'Tablet'),
(13, 'Gree AC', 49999, 'ac2.jpg', 501, 'AC'),
(14, 'Sharp Refrigerator', 74599, 'fridge2.jpg', 502, 'Fridge'),
(15, 'Iphone 16 Pro max', 134999, 'iphone2.jpg', 498, 'Mobile'),
(16, 'Asus Tuf', 94999, 'laptop2.jpg', 505, 'Laptop'),
(17, 'Asus TUF', 1599, 'mouse2.jpg', 498, 'Mouse'),
(18, 'Sony PS4', 44999, 'ps4.jpg', 503, 'Console'),
(19, 'Apple Watch', 88499, 'smartwatch2.jpg', 498, 'Smart Watch'),
(20, 'Dell SSD', 5499, 'ssd2.jpg', 500, 'SSD'),
(21, 'IPAD', 68999, 'tab2.jpg', 501, 'Tablet');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `nid` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `user_name`, `password`, `type`, `address`, `email`, `nid`, `user_image`) VALUES
(3, 'Tuli', 'Tuli@123', 'Customer', 'Mirpur 7', 'tuli@gmail.com', '01303611382', 'cus1.png'),
(4, 'Mahin', 'Mahin@123', 'DeliveryMan', 'Mirpur, Dhaka', 'mahin@gmail.com', '01754592939', 'del1.png'),
(5, 'Alamin', 'Alamin@123', 'Admin', 'Bashundhara, Dhaka', 'alamin@gmail.com', '01587456931', 'admin1.png'),
(48, 'hasan', 'Hasan@123', 'Customer', 'Basundhara R/A', 'hasan@gmail.com', '01754592939', ''),
(49, 'toki', 'Toki@123', 'Admin', 'uttara', 'toki@gmail.com', '01754592978', 'admin1.png'),
(50, 'hena', 'Hena@123', 'Customer', 'mirpur 7', 'hena@gmail.com', '01716619937', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `d_id` (`d_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_name` (`p_name`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`),
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`);

--
-- Constraints for table `order_info`
--
ALTER TABLE `order_info`
  ADD CONSTRAINT `order_info_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `order_info_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `user_info` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
