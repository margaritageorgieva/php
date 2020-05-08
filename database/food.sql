-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 02:41 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `food_type_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `type` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Вид продукт'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_types`
--

INSERT INTO `food_types` (`food_type_id`, `type`) VALUES
(1, 'Стекове');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `person_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `username` varchar(16) CHARACTER SET utf8 NOT NULL COMMENT 'Потребителско име',
  `person_type` tinyint(1) NOT NULL COMMENT 'Тип потребител: 1-администратор',
  `pass` varchar(16) CHARACTER SET utf8 NOT NULL COMMENT 'Парола',
  `name` varchar(128) CHARACTER SET utf8 NOT NULL COMMENT 'Име'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`person_id`, `username`, `person_type`, `pass`, `name`) VALUES
(123, 'admin', 1, 'admin', 'Ibrahim');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `food_type_id` int(10) UNSIGNED NOT NULL COMMENT 'ВК към вид храна',
  `name` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT 'Име на продукт',
  `weight` smallint(6) NOT NULL COMMENT 'Грамаж',
  `price` float DEFAULT NULL COMMENT 'Цена',
  `info` text CHARACTER SET utf8 NOT NULL COMMENT 'Описание',
  `picture` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Снимка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `food_type_id`, `name`, `weight`, `price`, `info`, `picture`) VALUES
(11, 1, 'нещо', 234, 2, 'нещо', ''),
(21, 1, 'нещо', 234, 2, 'нещо', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`food_type_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`person_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `food_type_id` (`food_type_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`food_type_id`) REFERENCES `food_types` (`food_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
