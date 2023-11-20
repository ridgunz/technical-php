-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2023 at 05:56 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technical_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', '2023-11-13 13:50:42', '2023-11-13 13:50:42'),
(2, 'Tees', '2023-11-13 13:50:42', '2023-11-13 13:50:42'),
(3, 'Home and Garden', '2023-11-13 13:50:42', '2023-11-13 13:50:42'),
(4, 'Book', '2023-11-13 13:50:42', '2023-11-13 13:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `image`, `description`, `created_at`, `updated_at`) VALUES
(25, 1, 'Iphone XR', '2200000', '../../images/image-20231115045515.jpeg', 'IPH NEW', '2023-11-15 04:55:15', '2023-11-15 11:55:15'),
(26, 1, 'Samsul', '1500000', '../../images/image-20231115045532.jpeg', 'Samsul S23', '2023-11-15 04:55:32', '2023-11-15 11:55:32'),
(27, 4, 'Harry Potters Deadly Hollows', '1500000', '../../images/image-20231115045550.jpeg', 'New Books', '2023-11-15 04:55:50', '2023-11-15 11:55:50'),
(28, 1, 'Iphone 15', '17000000', '../../images/image-20231115045606.jpg', 'IPH NEW', '2023-11-15 04:56:06', '2023-11-15 11:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(5, 'ridgunz', 'ridwanmhmmd18@gmail.com', '$2y$10$Qr1db5kJpN6raIKXIFKeE.eTml1hkUAWAro5BDMMuIK1FyzJ51hjm', 'member', '2023-11-13 17:25:18', '2023-11-13 17:25:18'),
(6, 'iwan', 'rid6unz@gmail.com', '$2y$10$Qr1db5kJpN6raIKXIFKeE.eTml1hkUAWAro5BDMMuIK1FyzJ51hjm', 'admin', '2023-11-13 17:31:27', '2023-11-13 17:31:27'),
(7, 'Budi', 'Budioke@gmail.com', '$2y$10$0w7sHunSrU.AlwKNEF93wugD8P1NXc6gjVlVjPkikMHWOdMcO/BgC', 'member', '2023-11-15 04:49:41', '2023-11-15 04:49:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
