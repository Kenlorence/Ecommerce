-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 06:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce_db`
--
CREATE DATABASE IF NOT EXISTS `e_commerce_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e_commerce_db`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image`, `created_at`) VALUES
(9, 'Matcha', 'milktea', 20.00, 16, 'image.png', '2025-05-21 01:38:27'),
(11, 'Matcha', 'Milktea', 50.00, 48, 'image.png', '2025-05-21 01:40:02'),
(14, 'Matcha', 'Try', 50.00, 48, 'img_68333168a65953.30958833.png', '2025-05-25 15:04:08'),
(15, 'Choco', 'Choco', 70.00, 999, 'img_683331ba614b18.18412253.png', '2025-05-25 15:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `role`, `created_at`) VALUES
(1, '123', '$2y$10$ABhdHY6FYUNAoIYiw/AtcOGeE0taV06BWwvWsn0pS67oUWuNnmBIu', 'customer', '2025-04-29 03:52:45'),
(3, 'ken', '$2y$10$433HHKzam8kFruEzDXI5Ke8mlL7zOZJzkxF6sHcWgqXo9n6tZ85CW', 'admin', '2025-04-29 04:01:48'),
(5, 'ken1', '$2y$10$5aNdRrf0BuPYCbKzHtDoMu3aSyXC4vNQ3dqkWElWI4ucSfF3oKn56', 'customer', '2025-05-03 03:56:44'),
(9, 'ken2', '$2y$10$wdswip0IIxx9MNCqOgXqRO6FyVjocFmMswWWeBeoroSFPUGmS7rHa', 'customer', '2025-05-26 02:22:04'),
(11, 'kenny', '$2y$10$GyMY0O1YyxjMzWDvQMFESOuY7/iLRNMoX5hNsPIRWGYJt5m95ktoW', 'customer', '2025-05-26 02:23:01'),
(12, 'user', '$2y$10$mqQeomXwTdAl9l9feKbReO16pqVieZ5ofXsSm8WVda5umTpyig4Ji', 'customer', '2025-05-26 02:25:50'),
(13, 'user1', '$2y$10$ufOu6r5Iz0ZnbI0Ntbh/det704FmqtUDA1raoa3vqJ/ELqVPDGGca', 'customer', '2025-05-26 02:27:43'),
(15, 'kenn', '$2y$10$LHgFWt64PNILuXetF3gktuCwinvosraa42d2Dl0mkWD5mytA2LBO6', 'customer', '2025-06-04 08:39:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
