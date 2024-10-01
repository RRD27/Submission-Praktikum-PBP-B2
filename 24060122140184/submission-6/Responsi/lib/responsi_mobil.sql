-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2024 at 05:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

USE `responsi_mobil`;
  
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `responsi_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_code` int UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_code`, `brand_name`) VALUES
(11, 'Chevrolet'),
(12, 'Daihatsu'),
(13, 'Ford'),
(14, 'Honda'),
(15, 'Hyundai'),
(16, 'Isuzu'),
(17, 'Kia'),
(18, 'Mazda'),
(19, 'Nissan'),
(20, 'Suzuki'),
(21, 'Toyota');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `model_code` int UNSIGNED NOT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_code` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`model_code`, `model_name`, `brand_code`) VALUES
(1101, 'Spark', 11),
(1102, 'Aveo', 11),
(1103, 'Trax', 11),
(1201, 'Ayla', 12),
(1202, 'Sigra', 12),
(1203, 'Terios', 12),
(1301, 'Fiesta', 13),
(1302, 'Focus', 13),
(1303, 'Escape', 13),
(1401, 'Civic', 14),
(1402, 'Accord', 14),
(1403, 'CR-V', 14),
(1501, 'i10', 15),
(1502, 'Elantra', 15),
(1503, 'Tucson', 15),
(1601, 'D-Max', 16),
(1602, 'Mu-X', 16),
(1701, 'Picanto', 17),
(1702, 'Seltos', 17),
(1703, 'Sportage', 17),
(1801, 'Mazda2', 18),
(1802, 'Mazda3', 18),
(1803, 'CX-5', 18),
(1901, 'March', 19),
(1902, 'Juke', 19),
(1903, 'X-Trail', 19),
(2001, 'Ignis', 20),
(2002, 'Ertiga', 20),
(2003, 'Swift', 20),
(2101, 'Avanza', 21),
(2102, 'Camry', 21),
(2103, 'Corolla', 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `brand_code` int UNSIGNED NOT NULL,
  `model_code` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_code`) USING BTREE;

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`model_code`) USING BTREE,
  ADD KEY `FK_BRAND_MODEL` (`brand_code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `FK_BRAND_MODEL` FOREIGN KEY (`brand_code`) REFERENCES `brands` (`brand_code`);
COMMIT;

ALTER TABLE `orders`
  ADD CONSTRAINT `FK_BRAND_ORDER` FOREIGN KEY (`brand_code`) REFERENCES `brands` (`brand_code`);
COMMIT;

ALTER TABLE `orders`
  ADD CONSTRAINT `FK_MODEL_ORDER` FOREIGN KEY (`model_code`) REFERENCES `models` (`model_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
