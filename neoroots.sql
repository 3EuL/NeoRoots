-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 05:20 AM
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
-- Database: `neoroots`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_session`
--

CREATE TABLE `active_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `container_id` int(11) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cameras`
--

CREATE TABLE `cameras` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` enum('online','offline') DEFAULT 'online',
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `containers`
--

CREATE TABLE `containers` (
  `container_id` int(11) NOT NULL,
  `colour` varchar(7) NOT NULL,
  `waste_type` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `containers`
--

INSERT INTO `containers` (`container_id`, `colour`, `waste_type`, `description`) VALUES
(16, '#ab3f3f', 'Cartón', 'En este contenedor de ___ color se va a guardar el cartón'),
(18, '#24ff50', 'Plástico', 'En este contenedor de color ___ se van a guardar los residuos plásticos.'),
(19, '#1492e1', 'Vidrio', 'En este contenedor de color ___ va el vídrio'),
(22, '#ff0000', 'Metal', 'En este contenedor de color ___ van los residuos metálicos');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `point_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recycling_log`
--

CREATE TABLE `recycling_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `container_id` int(11) DEFAULT NULL,
  `waste_id` int(11) DEFAULT NULL,
  `points_earned` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scan_log`
--

CREATE TABLE `scan_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `container_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `rol` enum('usuario','admin') NOT NULL,
  `pfp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user`, `email`, `pass`, `rol`, `pfp`) VALUES
(16, 'DillanVallejos', 'dil4n@gmail.com', '$2y$10$KtJj2aMSYMOBPocVZxmXsOGIDxbjeqVklUqNJmn/SRZbkuF04xxAS', 'usuario', NULL),
(17, 'esteban.urbano.6', '123444@gmail.com', '$2y$10$abR3/crRmisvPtQQcy0r9eCcX6aol92cP8zt0635kSBKgDcWh8N1e', 'usuario', NULL),
(18, 'EuL', 'E2222@gmail.com', '$2y$10$ZBAQzwTzN8WeCmcL2GrSkOauAo5lkUehhbDS3nowIsKabuxCyB3p.', 'usuario', '69ee86cb0d9fe_ChatGPT Image Apr 20, 2026, 09_08_56 PM.png'),
(19, 'admin', '232@gmail.com', '$2y$10$v4IqmfgnQf2QjNvE5X0xWezykI09CtNXRcEXwxkvMFj.w9qI4h1MC', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `waste`
--

CREATE TABLE `waste` (
  `waste_id` int(11) NOT NULL,
  `waste_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `container_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_session`
--
ALTER TABLE `active_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_session_user` (`user_id`),
  ADD KEY `fk_session_container` (`container_id`);

--
-- Indexes for table `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `containers`
--
ALTER TABLE `containers`
  ADD PRIMARY KEY (`container_id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD KEY `fk_points_user` (`user_id`);

--
-- Indexes for table `recycling_log`
--
ALTER TABLE `recycling_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_log_user` (`user_id`),
  ADD KEY `fk_log_container` (`container_id`),
  ADD KEY `fk_log_waste` (`waste_id`);

--
-- Indexes for table `scan_log`
--
ALTER TABLE `scan_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_scan_user` (`user_id`),
  ADD KEY `fk_scan_container` (`container_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `waste`
--
ALTER TABLE `waste`
  ADD PRIMARY KEY (`waste_id`),
  ADD KEY `fk_waste_container` (`container_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_session`
--
ALTER TABLE `active_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cameras`
--
ALTER TABLE `cameras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `containers`
--
ALTER TABLE `containers`
  MODIFY `container_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `recycling_log`
--
ALTER TABLE `recycling_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scan_log`
--
ALTER TABLE `scan_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `waste`
--
ALTER TABLE `waste`
  MODIFY `waste_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active_session`
--
ALTER TABLE `active_session`
  ADD CONSTRAINT `fk_session_container` FOREIGN KEY (`container_id`) REFERENCES `containers` (`container_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_session_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `fk_points_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `recycling_log`
--
ALTER TABLE `recycling_log`
  ADD CONSTRAINT `fk_log_container` FOREIGN KEY (`container_id`) REFERENCES `containers` (`container_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_log_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_log_waste` FOREIGN KEY (`waste_id`) REFERENCES `waste` (`waste_id`) ON DELETE CASCADE;

--
-- Constraints for table `scan_log`
--
ALTER TABLE `scan_log`
  ADD CONSTRAINT `fk_scan_container` FOREIGN KEY (`container_id`) REFERENCES `containers` (`container_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_scan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `waste`
--
ALTER TABLE `waste`
  ADD CONSTRAINT `fk_waste_container` FOREIGN KEY (`container_id`) REFERENCES `containers` (`container_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
