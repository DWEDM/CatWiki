-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 08:53 AM
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
-- Database: `catwiki_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `breeds`
--

CREATE TABLE `breeds` (
  `breed_id` int(11) NOT NULL,
  `breed_name` varchar(50) NOT NULL,
  `breed_description` text NOT NULL,
  `average_lifespan` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `breeds`
--

INSERT INTO `breeds` (`breed_id`, `breed_name`, `breed_description`, `average_lifespan`, `origin`) VALUES
(2, 'Siamese', 'The Siamese cat is one of the first distinctly recognised breeds of Asian cat. The Siamese Cat derived from the Wichianmat landrace. They are one of several varieties of cats native to Thailand, the original Siamese became one of the most popular breeds in Europe and North America in the 19th century.', '15', 'Pwetey'),
(5, 'British Shorthair', 'The British Shorthair is the pedigreed version of the traditional British domestic cat, with a distinctively stocky body, thick coat, and broad face. The most familiar colour variant is the \"British Blue\", with a solid grey-blue coat, pineapple eyes, and a medium-sized tail', '9', 'Great Britain');

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `cat_id` int(11) NOT NULL,
  `cat_profile` blob NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `breed_id` int(11) DEFAULT NULL,
  `cat_description` text DEFAULT NULL,
  `cat_image_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cat_image_url`)),
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`cat_id`, `cat_profile`, `cat_name`, `breed_id`, `cat_description`, `cat_image_url`, `created_by`) VALUES
(6, '', 'Julia', 5, 'asdasdasd', NULL, 'jm'),
(7, '', 'Juju', 2, 'asdasd\r\n', NULL, 'aj');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `profile` blob NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(50) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile`, `username`, `email`, `password`, `role`, `date_created`) VALUES
(20, '', 'aj', 'aj@gmail.com', '$2y$10$yEqVAzu/e0jB9avbZ3gp7OCFwGJxaUzUzsr3ywPbvDpdWJ81BOn92', 'Admin', '2024-09-30'),
(27, '', 'jm', 'jm@gmail.com', '$2y$10$yBMIXRogfITIY58qEJXS7OJnDxDzC3ont34k/yKXAAgfH6VCdrota', 'Admin', '2024-10-04'),
(28, '', 'bagat', 'bagat@gmail.com', '$2y$10$TgH6bPAK6lQJoSC/CFDBFe6D3LQDAqkAXzlkOpWMWyu9x93fwu6zC', 'Admin', '2024-10-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breeds`
--
ALTER TABLE `breeds`
  ADD PRIMARY KEY (`breed_id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `breed_id` (`breed_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breeds`
--
ALTER TABLE `breeds`
  MODIFY `breed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cats`
--
ALTER TABLE `cats`
  ADD CONSTRAINT `cats_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `breeds` (`breed_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
