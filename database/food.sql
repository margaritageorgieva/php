-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time:  8 май 2020 в 23:13
-- Версия на сървъра: 10.4.11-MariaDB
-- PHP Version: 7.4.1

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
-- Структура на таблица `food_types`
--

CREATE TABLE `food_types` (
  `food_type_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `type` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Вид продукт'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `food_types`
--

INSERT INTO `food_types` (`food_type_id`, `type`) VALUES
(1, 'Стекове'),
(2, 'Бургери'),
(3, 'Салати'),
(4, 'Десерти'),
(5, 'Напитки');

-- --------------------------------------------------------

--
-- Структура на таблица `people`
--

CREATE TABLE `people` (
  `person_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `username` varchar(16) CHARACTER SET utf8 NOT NULL COMMENT 'Потребителско име',
  `person_type` tinyint(1) NOT NULL COMMENT 'Тип потребител: 1-администратор',
  `pass` varchar(16) CHARACTER SET utf8 NOT NULL COMMENT 'Парола',
  `name` varchar(128) CHARACTER SET utf8 NOT NULL COMMENT 'Име'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `people`
--

INSERT INTO `people` (`person_id`, `username`, `person_type`, `pass`, `name`) VALUES
(123, 'admin', 1, 'admin', 'Ibrahim');

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL COMMENT 'ПК',
  `food_type_id` int(10) UNSIGNED NOT NULL COMMENT 'ВК към вид храна',
  `name` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT 'Име на продукт',
  `weight` smallint(6) NOT NULL COMMENT 'Грамаж',
  `price` float DEFAULT NULL COMMENT 'Цена',
  `info` text CHARACTER SET utf8 NOT NULL COMMENT 'Описание',
  `picture` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Снимка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`product_id`, `food_type_id`, `name`, `weight`, `price`, `info`, `picture`) VALUES
(11, 1, 'Рибай стек ', 350, 38, 'Рибай стек с медено-горчичен винегрет - висококачествено говеждо месо с масло, овкусено с билки и чесън', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\рибай_стек.png'),
(12, 1, 'Т-боун стек', 400, 44, 'Kрехко месо от контрафилето и по-малката част на бонфилето, поднесено с билки и зеленчуци', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\т-боун.png'),
(13, 1, 'Филе Миньон', 250, 35, ' изключително крехко телешко филе с подправки, пресни зеленчуци и картофки ', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\филе_миньон.png'),
(14, 1, 'Стек Розини', 200, 30, ' Tелешко бон филе от блек ангъс,поднесено с печени зеленчуци,билки и чесън', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\стек_розини.png'),
(21, 2, 'Шефс Бургер', 250, 8.5, 'Първокачествено  говеждо кюфте в комбинация с разтопен чедър,кисели краставички, айсберг, майонеза  и специален сос ', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\2-1.png'),
(22, 2, 'Бийф Бургер', 350, 9.5, 'Телешко кюфте, разтoпен английски чедър, хрупкав бекон,  сос и халапеньо', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\3-1.png'),
(23, 2, 'Веджи Бургер', 300, 8, 'Бриош питка, домашно приготвен бъргър от картоф и нахут, печена тиквички, айсберг , лук  и Miso Mayo сос', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\4-1.png'),
(24, 2, 'Порки Бургер', 400, 9, 'Пухкава домашна питка, пикантно свинско кюфте, айсберг, Chefs сос и запържени парченска месо с лук', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\5-1.png'),
(31, 3, 'Салата цезар', 400, 8.5, 'Хрупкаво пилешко филе, микс зелени салати, хрупкав бекон, пармезан, крутони, сос Цезар', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\цезар.png'),
(32, 3, 'Селска салата', 500, 8, 'Домати, краставици, сирене, мариновани печени зеленчуци, магданоз, лук', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\селска салата.png'),
(33, 3, 'Пролетна салата', 300, 6, 'Зелена салата, краставица, зелен лук, яйце, репички, маслини и сос Винегрет', '   C:\\xampp\\htdocs\\php-master\\images\\foodpics\\пролетна.png'),
(34, 3, 'Панцанела с авокадо', 350, 7.8, 'Домати, краставици, авокадо, маслини, сирене, магданоз, лук, босилек, хрупкави крутони и зехтин', '   C:\\xampp\\htdocs\\php-master\\images\\foodpics\\панцанела.png'),
(41, 4, ' Чийзкейк с ягоди', 140, 6, 'Чийзкейк с хрупкави бисквитени блатове, Рикота и сирене Филаделфия, пресни ягоди', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\чийзкейк.png'),
(42, 4, 'Бисквитена торта с Нутела', 200, 5, 'Домашна торта с бисквити, крем от маскарпоне, заквасена сметана и шоколад нутела ', ' C:\\xampp\\htdocs\\php-master\\images\\foodpics\\торта_нутела.png'),
(43, 4, 'Профитероли', 200, 5.6, 'Профитероли с ягоди , пухкав крем и шоколад.', '   C:\\xampp\\htdocs\\php-master\\images\\foodpics\\профитероли.png'),
(44, 4, 'Кейк с Фереро', 180, 6.4, 'Шоколадова торта с хрупкави вафлички, шоколадов мус и натрошени бадеми.', '   C:\\xampp\\htdocs\\php-master\\images\\foodpics\\фереро.png'),
(51, 5, 'Лимонада с бъз', 500, 3.99, 'Негазирана лимонада със сироп от бъз, мента и лимон', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\lim_buz.png'),
(52, 5, 'Лимонада с манго', 500, 4.99, 'Лимонада с прясно манго, босилек, портокал, лимон и сода', 'C:\\xampp\\htdocs\\php-master\\images\\foodpics\\lim_mango.png'),
(53, 5, 'PIXELS розе', 750, 11.49, 'Слабо таниново вино ', ' C:\\xampp\\htdocs\\php-master\\images\\foodpics\\розе.png'),
(54, 5, 'Мерло Мезек', 750, 9.89, 'Отличава се с интензивно червен цвят, пълнота и  хармоничност на вкуса', ' C:\\xampp\\htdocs\\php-master\\images\\foodpics\\мерло.png');

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
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`food_type_id`) REFERENCES `food_types` (`food_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
