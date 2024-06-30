-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 04:28 AM
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
-- Database: `black_cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` varchar(255) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `title` varchar(255) DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `backdrop_path` varchar(255) DEFAULT NULL,
  `genres` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`genres`)),
  `category` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`category`)),
  `release_date` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `movieDuration` varchar(255) DEFAULT NULL,
  `vote_average` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` varchar(255) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `movieId` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `userName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `feeAdmin` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `totalPrice` int(11) DEFAULT NULL,
  `packageName` varchar(255) DEFAULT NULL,
  `methodPayment` varchar(255) DEFAULT NULL,
  `promoCode` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `expiredPayment` datetime DEFAULT NULL,
  `successPayment` datetime DEFAULT NULL,
  `room` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_card`
--

CREATE TABLE `payment_card` (
  `id` varchar(255) NOT NULL,
  `numberCard` varchar(255) DEFAULT NULL,
  `nameCard` varchar(255) DEFAULT NULL,
  `imageCard` varchar(255) DEFAULT NULL,
  `categoryInstitue` varchar(255) DEFAULT NULL,
  `imageQR` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan`
--

CREATE TABLE `payment_plan` (
  `id` varchar(255) NOT NULL,
  `packageName` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `screenResolution` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_promo`
--

CREATE TABLE `payment_promo` (
  `id` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `promoCode` varchar(255) DEFAULT NULL,
  `priceDisc` int(11) DEFAULT NULL,
  `usable` datetime DEFAULT NULL,
  `expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(255) NOT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `emailVerified` datetime DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_email`, `user_password`, `emailVerified`, `user_image`, `user_role`, `createdAt`, `updatedAt`) VALUES
('', 'a', 'a@gmail.com', 'a', NULL, NULL, 'admin', '2024-06-29 09:13:07', '2024-06-29 09:13:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `payment_card`
--
ALTER TABLE `payment_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_plan`
--
ALTER TABLE `payment_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_promo`
--
ALTER TABLE `payment_promo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`user_email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`movieId`) REFERENCES `movie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
