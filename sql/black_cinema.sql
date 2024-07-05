-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 05, 2024 at 04:47 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pending_payments` ()   BEGIN
    UPDATE payment
    SET status = 'canceled'
    WHERE status = 'pending' AND expiredPayment <= NOW();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `movie_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `movie_id`, `created_at`) VALUES
(13, 4, 700, '2024-07-01 19:21:59');

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
(700, 2, '2024-06-30 14:48:40', 'Sri Asih', 'Alana discover the truth about her origin: she’s not an ordinary human being. She may be the gift for humanity and become its protector as Sri Asih. Or a destruction, if she can’t control her anger.', 'https://image.tmdb.org/t/p/w500//wShcJSKMFg1Dy1yq7kEZuay6pLS.jpg', 'https://image.tmdb.org/t/p/w1280//oFAukXiMPrwLpbulGmB5suEZlrm.jpg', '[\"Action\",\" Adventure\",\" Science Fiction\",\" Fantasy\",\" Drama\"]', '[\"top movies\"]', '2022-11-17', 'https://www.youtube.com/watch?v=QeT6Ke2kQYo', '134', 6.236),
(701, 2, '2024-06-30 18:31:07', 'Kung Fu Hustle', 'It\\\'s the 1940s, and the notorious Axe Gang terrorizes Shanghai. Small-time criminals Sing and Bone hope to join, but they only manage to make lots of very dangerous enemies. Fortunately for them, kung fu masters and hidden strength can be found in unlikely places. Now they just have to take on the entire Axe Gang.', 'https://image.tmdb.org/t/p/w500//exbyTbrvRUDKN2mcNEuVor4VFQW.jpg', 'https://image.tmdb.org/t/p/w1280//zNOfW35hBXPIzM5BIl7gptuW0EA.jpg', '[\"Action\",\" Comedy\",\" Crime\",\" Fantasy\"]', '[\"popular movies\"]', '2004-02-10', 'https://www.youtube.com/watch?v=-m3IB7N_PRk', '99', 7.44);

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

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `userId`, `movieId`, `createdAt`, `userName`, `userEmail`, `startTime`, `endTime`, `feeAdmin`, `price`, `totalPrice`, `packageName`, `methodPayment`, `promoCode`, `status`, `expiredPayment`, `successPayment`, `room`) VALUES
(23, 4, 701, '2024-07-01 20:40:06', 'qq', 'qq@gmail.com', '2024-07-01 20:40:00', '2024-07-01 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'success', '2024-07-01 21:10:06', '2024-07-04 18:21:36', 1),
(24, 4, 701, '2024-07-01 20:40:19', 'qq', 'qq@gmail.com', '2024-07-01 20:40:00', '2024-07-01 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'success', '2024-07-01 21:10:19', '2024-07-04 18:33:17', 2),
(25, 4, 701, '2024-07-01 20:40:20', 'qq', 'qq@gmail.com', '2024-07-01 20:40:00', '2024-07-01 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'success', '2024-07-01 21:10:20', '2024-07-04 18:34:54', 3),
(26, 4, 701, '2024-07-01 20:40:22', 'qq', 'qq@gmail.com', '2024-07-01 20:40:00', '2024-07-01 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:10:22', NULL, 4),
(27, 4, 701, '2024-07-01 20:40:27', 'qq', 'qq@gmail.com', '2024-07-16 20:40:00', '2024-07-16 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:10:27', NULL, 5),
(28, 4, 701, '2024-07-01 20:42:12', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:12:12', NULL, 1),
(29, 4, 701, '2024-07-01 20:42:27', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:12:27', NULL, 2),
(30, 4, 701, '2024-07-01 20:43:58', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:13:58', NULL, 3),
(31, 4, 701, '2024-07-01 20:44:01', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:14:01', NULL, 4),
(32, 4, 701, '2024-07-01 20:44:02', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:14:02', NULL, 5),
(33, 4, 701, '2024-07-01 20:44:04', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:14:04', NULL, 6),
(34, 4, 701, '2024-07-01 20:44:06', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:14:06', NULL, 7),
(35, 4, 701, '2024-07-01 20:47:30', 'qq', 'qq@gmail.com', '2024-07-24 20:40:00', '2024-07-24 22:19:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-01 21:17:30', NULL, 8),
(36, 5, 701, '2024-07-04 18:35:36', 'palkon', 'jossfajar22@gmail.com', '2024-07-12 18:35:00', '2024-07-12 20:14:00', 5000, 1200000, 1205000, 'reguler', '', '', 'success', '2024-07-04 19:05:36', '2024-07-04 19:23:36', 1),
(37, 5, 701, '2024-07-04 18:46:06', 'palkon', 'jossfajar22@gmail.com', '2024-07-04 18:46:00', '2024-07-04 20:25:00', 5000, 1200000, 1205000, 'reguler', '', '', 'success', '2024-07-04 19:16:06', '2024-07-04 19:19:22', 1),
(38, 4, 701, '2024-07-04 19:32:39', 'qq', 'qq@gmail.com', '2024-07-11 19:32:00', '2024-07-11 21:11:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-04 20:02:39', NULL, 1),
(39, 4, 700, '2024-07-04 20:03:21', 'qq', 'qq@gmail.com', '2024-07-16 20:03:00', '2024-07-16 22:17:00', 5000, 1200000, 1205000, 'reguler', '', '', 'canceled', '2024-07-04 20:33:21', NULL, 1);

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

--
-- Dumping data for table `payment_card`
--

INSERT INTO `payment_card` (`id`, `numberCard`, `nameCard`, `imageCard`, `categoryInstitue`, `imageQR`) VALUES
(1, '123434', 'BRI', 'https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/BRI-512.png', 'ewallet', 'https://www.techopedia.com/wp-content/uploads/2023/03/aee977ce-f946-4451-8b9e-bba278ba5f13.png'),
(2, '453564574', 'Dana', 'https://cdn.antaranews.com/cache/1200x800/2022/04/25/dana.jpg', 'ewallet', 'https://www.techopedia.com/wp-content/uploads/2023/03/aee977ce-f946-4451-8b9e-bba278ba5f13.png'),
(3, '123', 'as', 'https://alfamart.co.id/storage/page/January2022/CNKpimFu30rDwGT22iJl.jpg', 'ewallet', 'https://alfamart.co.id/storage/page/January2022/CNKpimFu30rDwGT22iJl.jpg');

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

--
-- Dumping data for table `payment_plan`
--

INSERT INTO `payment_plan` (`id`, `packageName`, `capacity`, `screenResolution`, `price`) VALUES
(1, 'reguler', 23, 50, 1200000);

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
  `user_telepon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_email`, `user_password`, `emailVerified`, `user_image`, `user_telepon`, `user_role`, `createdAt`, `updatedAt`) VALUES
(1, 'a', 'a@gmail.com', '$2y$10$JQ7tC/.vzN9ThUr8x1tpO.EdJ9VljEKQwSF4InQIvhE5cSiQ3fkXq', NULL, 'https://example.com/default_image.jpg', NULL, 'admin', '2024-06-29 19:49:52', '2024-06-29 19:50:08'),
(2, 'as', 'as@gmail.com', '$2y$10$j1Mhkjh3QiRATUxYKonvtOdqKsr5reLUOhB/K.EhU0PGxhoiNb1WO', NULL, 'https://example.com/default_image.jpg', NULL, 'admin', '2024-06-30 14:47:15', '2024-06-30 14:47:35'),
(3, 'palkon', 'wildannoob354@gmail.com', '$2y$10$Kfku74OZb9fTSnc8C6dKfORaA50lna9flcwfB.jtiLjXJxgMFE.pi', NULL, 'https://example.com/default_image.jpg', NULL, 'user', '2024-06-30 14:55:23', NULL),
(4, 'qq', 'qq@gmail.com', '$2y$10$G/y9t9Ms7gAP3mS/4XQG5OfHxhc7m7qGkVoV7rbjiF2Gdaq6Z9teC', NULL, 'https://deepgrouplondon.com/wp-content/uploads/2019/06/person-placeholder-5.png', NULL, 'user', '2024-06-30 15:26:59', '2024-07-01 18:00:15'),
(5, 'palkon', 'jossfajar22@gmail.com', '$2y$10$t.N7twQczIVLAdRKV/HZ7.TwL3X9djPk7Bh.YvOkemQUSWriW3iOG', NULL, 'https://example.com/default_image.jpg', NULL, 'user', '2024-07-04 18:35:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favorite` (`user_id`,`movie_id`),
  ADD KEY `fk_favorites_movie` (`movie_id`);

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
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `payment_card`
--
ALTER TABLE `payment_card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_plan`
--
ALTER TABLE `payment_plan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_promo`
--
ALTER TABLE `payment_promo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_favorites_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favorites_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `cancel_pending_payments` ON SCHEDULE EVERY 10 MINUTE STARTS '2024-07-04 16:58:29' ON COMPLETION NOT PRESERVE ENABLE DO CALL update_pending_payments()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
