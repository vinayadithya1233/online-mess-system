-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 08:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `preferred_time` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `address` text NOT NULL,
  `tiffin_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `mobileno`, `preferred_time`, `start_date`, `end_date`, `address`, `tiffin_id`, `user_id`) VALUES
(29, 'Pratik Dhikale', '08767068528', 'morning', '2024-03-19', '2024-03-29', 'hj', 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tiffins`
--

CREATE TABLE `tiffins` (
  `tiffin_id` int(11) NOT NULL,
  `tiffin_name` varchar(255) NOT NULL,
  `tiffin_description` text NOT NULL,
  `tiffin_image` varchar(255) NOT NULL,
  `tiffin_price` decimal(10,2) NOT NULL,
  `tiffin_style` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiffins`
--

INSERT INTO `tiffins` (`tiffin_id`, `tiffin_name`, `tiffin_description`, `tiffin_image`, `tiffin_price`, `tiffin_style`) VALUES
(30, 'Regular Box', 'rugular box ', 'uploads/tiffine3.jpeg', 5.00, '1'),
(31, 'regualr boxes', 'we provide all the tiifin service at time and we maintain putre hygenic', 'uploads/AdobeStock_143492217_Preview.jpeg', 50.00, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tiffin_items`
--

CREATE TABLE `tiffin_items` (
  `item_id` int(11) NOT NULL,
  `tiffin_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiffin_items`
--

INSERT INTO `tiffin_items` (`item_id`, `tiffin_id`, `item_name`, `item_quantity`) VALUES
(31, 30, 'roti', 3),
(32, 30, 'rice', 1),
(33, 31, 'roti', 5),
(34, 31, 'bhaji', 2),
(35, 31, 'rice', 1),
(36, 31, 'dal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tiffin_prices`
--

CREATE TABLE `tiffin_prices` (
  `price_id` int(11) NOT NULL,
  `tiffin_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiffin_prices`
--

INSERT INTO `tiffin_prices` (`price_id`, `tiffin_id`, `price`) VALUES
(20, 30, 5.00),
(21, 31, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passworld` varchar(255) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `it_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `passworld`, `avatar`, `it_admin`) VALUES
(1, 'Pratik', 'Dhikale', 'pratik@2004', 'pratikdhikale556@gmail.com', '$2y$10$WOUf6o6OQsTx2ZVY2xwHQecgHqGhXZqhrAj9LUYKPDZnchWZTjCQC', '1709395547IMG-20240225-WA0001.jpg', 1),
(2, 'Pratik', 'Dhikale', 'jack@123', 'gegiwi1289@lureens.com', '$2y$10$ye/NjZypTno9wazIytyG9eI1PXTjT.osyKHJQDraLtgqg503h5zny', '1709470442person1.jpg', 1),
(3, 'vinay', 'aditya', 'vinay@123', 'vinay@gmail.com', '$2y$10$HRGmCgVZar.x6iNFMquZvO3iJHvCgQs59bSmYHdNmO76evyDWG75C', '1709531723fort.jpg', 1),
(4, 'jack@123', 'Dhikale', 'pratik@123', 'paratik@gmail.com', '$2y$10$7L8q7.xKaGONUhLNHG3Gbe49mR7IRiU8GFVP3LJ5cqA/Hdrw1U1HO', '1709532074fort.jpg', 0),
(5, 'vinay', 'aa', 'mack@12', 'vinay11@gmail.com', '$2y$10$gajNmsV/Fvq75RrkNA5Yc.u06X0aYlFfC0NAXNATBkVsrNhle/r6.', '1709711543tiffine3.jpeg', 0),
(6, 'Pratik', 'Dhikale', 'xcvx', 'mackmohan@gmail.com', '$2y$10$YB0YeF4PRBGSXW5U28ioPOjziFzUVJe5qFobzqyNmZs5PlDa4Wlva', '1712724155download (2).jpeg', 0),
(7, 'raman', 'darma', 'darma', 'darma@gmai.com', '$2y$10$etIsy5CVcJxcxUCgHxlUxuZkeNDrR3etHDBv04CmTcAJdmxf637F2', '1712724289image-1-1024x683.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiffins`
--
ALTER TABLE `tiffins`
  ADD PRIMARY KEY (`tiffin_id`);

--
-- Indexes for table `tiffin_items`
--
ALTER TABLE `tiffin_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `tiffin_id` (`tiffin_id`);

--
-- Indexes for table `tiffin_prices`
--
ALTER TABLE `tiffin_prices`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `tiffin_id` (`tiffin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tiffins`
--
ALTER TABLE `tiffins`
  MODIFY `tiffin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tiffin_items`
--
ALTER TABLE `tiffin_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tiffin_prices`
--
ALTER TABLE `tiffin_prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tiffin_items`
--
ALTER TABLE `tiffin_items`
  ADD CONSTRAINT `tiffin_items_ibfk_1` FOREIGN KEY (`tiffin_id`) REFERENCES `tiffins` (`tiffin_id`);

--
-- Constraints for table `tiffin_prices`
--
ALTER TABLE `tiffin_prices`
  ADD CONSTRAINT `tiffin_prices_ibfk_1` FOREIGN KEY (`tiffin_id`) REFERENCES `tiffins` (`tiffin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
