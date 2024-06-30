-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2024 at 08:00 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `overview` text COLLATE utf8mb4_general_ci,
  `poster_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `backdrop_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genres` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `category` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `release_date` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `movieDuration` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vote_average` float DEFAULT NULL
) ;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `userId`, `createdAt`, `title`, `overview`, `poster_path`, `backdrop_path`, `genres`, `category`, `release_date`, `trailer`, `movieDuration`, `vote_average`) VALUES
(700, 2, '2024-06-30 14:48:40', 'Sri Asih', 'Alana discover the truth about her origin: she’s not an ordinary human being. She may be the gift for humanity and become its protector as Sri Asih. Or a destruction, if she can’t control her anger.', 'https://image.tmdb.org/t/p/w500//wShcJSKMFg1Dy1yq7kEZuay6pLS.jpg', 'https://image.tmdb.org/t/p/w1280//oFAukXiMPrwLpbulGmB5suEZlrm.jpg', '[\"Action\",\" Adventure\",\" Science Fiction\",\" Fantasy\",\" Drama\"]', '[\"top movies\"]', '2022-11-17', 'https://www.youtube.com/watch?v=QeT6Ke2kQYo', '134', 6.236);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `movieId` int DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `userName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userEmail` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `feeAdmin` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `totalPrice` int DEFAULT NULL,
  `packageName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `methodPayment` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `promoCode` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expiredPayment` datetime DEFAULT NULL,
  `successPayment` datetime DEFAULT NULL,
  `room` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_card`
--

CREATE TABLE `payment_card` (
  `id` int NOT NULL,
  `numberCard` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nameCard` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imageCard` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoryInstitue` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imageQR` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan`
--

CREATE TABLE `payment_plan` (
  `id` int NOT NULL,
  `packageName` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `screenResolution` int DEFAULT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_promo`
--

CREATE TABLE `payment_promo` (
  `id` int NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `promoCode` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `priceDisc` int DEFAULT NULL,
  `usable` datetime DEFAULT NULL,
  `expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailVerified` datetime DEFAULT NULL,
  `user_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_email`, `user_password`, `emailVerified`, `user_image`, `user_role`, `createdAt`, `updatedAt`) VALUES
(1, 'a', 'a@gmail.com', '$2y$10$JQ7tC/.vzN9ThUr8x1tpO.EdJ9VljEKQwSF4InQIvhE5cSiQ3fkXq', NULL, 'https://example.com/default_image.jpg', 'admin', '2024-06-29 19:49:52', '2024-06-29 19:50:08'),
(2, 'as', 'as@gmail.com', '$2y$10$j1Mhkjh3QiRATUxYKonvtOdqKsr5reLUOhB/K.EhU0PGxhoiNb1WO', NULL, 'https://example.com/default_image.jpg', 'admin', '2024-06-30 14:47:15', '2024-06-30 14:47:35'),
(3, 'palkon', 'wildannoob354@gmail.com', '$2y$10$Kfku74OZb9fTSnc8C6dKfORaA50lna9flcwfB.jtiLjXJxgMFE.pi', NULL, 'https://example.com/default_image.jpg', 'user', '2024-06-30 14:55:23', NULL);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_card`
--
ALTER TABLE `payment_card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_plan`
--
ALTER TABLE `payment_plan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_promo`
--
ALTER TABLE `payment_promo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk_movie_user` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_movie` FOREIGN KEY (`movieId`) REFERENCES `movie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payment_user` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
