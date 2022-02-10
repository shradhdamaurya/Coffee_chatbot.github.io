-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 04:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_pass`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `crt_id` int(11) NOT NULL,
  `cst_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`crt_id`, `cst_id`, `p_id`) VALUES
(1, 2, 3),
(2, 2, 3),
(4, 1, 4),
(5, 1, 4),
(14, 2, 21),
(15, 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Desserts'),
(2, 'Hot Drinks'),
(3, 'Cold Coffee'),
(4, 'All Time Classics');

-- --------------------------------------------------------

--
-- Table structure for table `coffeeshop`
--

CREATE TABLE `coffeeshop` (
  `cst_id` int(20) NOT NULL,
  `shop_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cst_id` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pswd` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cst_id`, `userName`, `email`, `pswd`) VALUES
(1, 'arpitha', 'arpitha@gmail.com', '123'),
(2, 'ffsdf', 'dsf@gdf.fgh', 'fdsfsd'),
(3, 'hry', 'hi@hml.cmo', 'efds');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `o_id` int(11) NOT NULL,
  `p_date` date NOT NULL,
  `cst_id` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `image`, `cat_id`, `product_name`, `price`) VALUES
(20, 'Tropical Iceberg.jpg', 3, 'Tropical Iceberg', 125),
(21, 'Vegan shake.jpg', 3, 'Vegan Shake', 144),
(22, 'cafe frappe.jpg', 3, 'Cafe Frappe', 144),
(23, 'drink frappe.jpg', 3, 'Drink Frappe', 191),
(24, 'kaapi nirvana.jpg', 3, 'Kappi Nirvana', 202),
(25, 'Eye-opener espresso.jpg', 4, 'Eye-opener Espresso', 98),
(26, 'cappuccino.jpg', 4, 'Classic Cappuccino', 110),
(27, 'filter coffee.jpg', 4, 'Filter Coffee', 110),
(28, 'inverted cappuccino.jpg', 4, 'Inverted Cappuccino', 139),
(29, 'Toffee cappuccino.jpg', 4, 'Toffee Cappuccino', 133),
(30, 'Toffee latte.jpg', 4, 'Toffee Latte', 144),
(31, 'vanila latte.jpg', 4, 'Vanilla Latte', 144),
(32, 'icead coffee.jpg', 3, 'Icead Coffee', 146),
(33, 'hot chocolate.jpg', 2, 'Hot Chocolate', 155),
(34, 'hot tea.jpg', 2, 'Hot Tea', 120),
(35, 'fruit tea.jpg', 2, 'Fruit Tea', 165),
(36, 'green tea.jpg', 2, 'Green Tea', 60),
(37, 'Vanila tea.jpg', 2, 'Vanila Tea', 170),
(38, 'White chocolate.jpg', 2, 'White Chocolate', 125),
(39, 'dessert nachos.jpg', 1, 'Dessert Nachos', 195),
(40, 'Apple pie.jpg', 1, 'Apple pie', 55),
(41, 'banana cream pie.jpg', 1, 'Banana cream pie', 120),
(42, 'tiramisu.jpg', 1, 'Tiramisu', 40),
(43, 'cheese cake.jpg', 1, 'Cheese Cake', 75),
(44, 'triple chocolate.jpg', 1, 'Triple chocolate', 85);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`crt_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `coffeeshop`
--
ALTER TABLE `coffeeshop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cst_id`);

--
-- Indexes for table `order_histroy`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `crt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coffeeshop`
--
ALTER TABLE `coffeeshop`
  MODIFY `shop_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_histroy`
--
ALTER TABLE `order_history`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
