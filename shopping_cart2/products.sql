-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 12:20 AM
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
-- Database: `codespace`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(9, 'Evil Cat', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\n<h3>Features</h3>\n<ul>\n<li>Powered by Android with built-in apps.</li>\n<li>Adjustable to fit most.</li>\n<li>Long battery life, continuous wear for up to 2 days.</li>\n<li>Lightweight design, comfort on your wrist.</li>\n</ul>', 29.99, 0.00, 10, 'evil_cat.jpg', '2023-03-13 17:55:22'),
(10, 'Bad Dog', '', 14.99, 19.99, 34, 'bad_dog.jpg', '2023-03-13 18:52:49'),
(11, 'Cocker Spaniel', '', 19.99, 0.00, 23, 'cocker_spaniel.jpg', '2023-03-13 18:47:56'),
(12, 'Lovely Husky', '', 69.99, 0.00, 7, 'husky.jpg', '2019-03-13 17:42:04'),
(13, 'Surprised Cat', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Powered by Android with built-in apps.</li>\r\n<li>Adjustable to fit most.</li>\r\n<li>Long battery life, continuous wear for up to 2 days.</li>\r\n<li>Lightweight design, comfort on your wrist.</li>\r\n</ul>', 29.99, 0.00, 10, 'surprised_cat.jpg', '2022-03-13 17:55:22'),
(14, 'Raven In a Hat', '', 14.99, 19.99, 34, 'raven_in_a_hat.jpg', '2023-03-13 18:52:49'),
(15, 'Terrifying Cats & Dogs', '', 19.99, 0.00, 23, 'terrifying_cat_dog_circle.jpg', '2019-03-13 18:47:56'),
(16, 'Dog with Eyebrows', '', 69.99, 0.00, 7, 'dog_with_eyebrows', '2023-03-13 17:42:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
