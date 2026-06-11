-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2026 at 06:43 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Dumping data for table `cameras`
--

INSERT INTO `cameras` (`id`, `name`, `ip`, `status`, `last_seen`) VALUES
(1, 'NeoRootsCam', '192.168.1.8', 'online', '2026-06-10 04:24:40');

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
(16, '#ab3f3f', 'Carton', 'En este contenedor de ___ color se va a guardar el carton'),
(18, '#24ff50', 'Plastico', 'En este contenedor de color ___ se van a guardar los residuos plÃ¡sticos.'),
(19, '#1492e1', 'Vidrio', 'En este contenedor de color ___ va el vidrio'),
(22, '#ff0000', 'Metal', 'En este contenedor de color ___ van los residuos metÃ¡licos');

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

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`point_id`, `amount`, `date`, `user_id`) VALUES
(0, 20, '2026-06-11 02:55:42', 18),
(0, 20, '2026-06-11 02:57:39', 18),
(0, 20, '2026-06-11 03:18:28', 18),
(0, 20, '2026-06-11 03:28:06', 18),
(0, 10, '2026-06-11 03:40:01', 18),
(0, 10, '2026-06-11 03:40:06', 18),
(0, 10, '2026-06-11 03:40:14', 18),
(0, 10, '2026-06-12 03:52:58', 18),
(0, 10, '2026-06-12 03:53:41', 18),
(0, 10, '2026-06-12 03:53:52', 18),
(0, 10, '2026-06-12 03:53:57', 18),
(0, 10, '2026-06-12 03:54:03', 18),
(0, 10, '2026-06-12 03:55:08', 18),
(0, 20, '2026-06-12 04:10:15', 18),
(0, 20, '2026-06-12 04:12:03', 18),
(0, 20, '2026-06-12 04:13:54', 18),
(0, 20, '2026-06-12 04:17:07', 18),
(0, 20, '2026-06-12 04:17:12', 18),
(0, 20, '2026-06-12 04:17:18', 18),
(0, 10, '2026-06-12 04:17:35', 18),
(0, 10, '2026-06-12 04:17:40', 18),
(0, 10, '2026-06-12 04:18:28', 18),
(0, 10, '2026-06-12 04:20:11', 18),
(0, 10, '2026-06-12 04:20:16', 18),
(0, 10, '2026-06-12 04:20:22', 18),
(0, 10, '2026-06-12 04:20:27', 18),
(0, 10, '2026-06-12 04:24:14', 18),
(0, 10, '2026-06-12 04:24:21', 18),
(0, 10, '2026-06-12 04:29:44', 18),
(0, 10, '2026-06-12 04:30:24', 18),
(0, 20, '2026-06-12 04:30:35', 18),
(0, 10, '2026-06-12 04:30:43', 18),
(0, 10, '2026-06-12 04:41:55', 0),
(0, 20, '2026-06-12 04:42:14', 0);

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

--
-- Dumping data for table `recycling_log`
--

INSERT INTO `recycling_log` (`id`, `user_id`, `container_id`, `waste_id`, `points_earned`, `date`) VALUES
(0, 18, 16, NULL, 20, '2026-06-11 02:55:42'),
(0, 18, 16, NULL, 20, '2026-06-11 02:57:39'),
(0, 18, 16, NULL, 20, '2026-06-11 03:18:28'),
(0, 18, 16, NULL, 20, '2026-06-11 03:28:06'),
(0, 18, 18, NULL, 10, '2026-06-11 03:40:01'),
(0, 18, 18, NULL, 10, '2026-06-11 03:40:06'),
(0, 18, 18, NULL, 10, '2026-06-11 03:40:14'),
(0, 18, 18, 1, 10, '2026-06-12 03:52:58'),
(0, 18, 18, 1, 10, '2026-06-12 03:53:41'),
(0, 18, 18, 1, 10, '2026-06-12 03:53:52'),
(0, 18, 18, 1, 10, '2026-06-12 03:53:57'),
(0, 18, 18, 1, 10, '2026-06-12 03:54:03'),
(0, 18, 18, 1, 10, '2026-06-12 03:55:08'),
(0, 18, 16, 2, 20, '2026-06-12 04:10:15'),
(0, 18, 16, 2, 20, '2026-06-12 04:12:03'),
(0, 18, 16, 2, 20, '2026-06-12 04:13:54'),
(0, 18, 16, 2, 20, '2026-06-12 04:17:07'),
(0, 18, 16, 2, 20, '2026-06-12 04:17:12'),
(0, 18, 16, 2, 20, '2026-06-12 04:17:18'),
(0, 18, 18, 1, 10, '2026-06-12 04:17:35'),
(0, 18, 18, 1, 10, '2026-06-12 04:17:40'),
(0, 18, 18, 1, 10, '2026-06-12 04:18:28'),
(0, 18, 18, 1, 10, '2026-06-12 04:20:11'),
(0, 18, 18, 1, 10, '2026-06-12 04:20:16'),
(0, 18, 18, 1, 10, '2026-06-12 04:20:22'),
(0, 18, 18, 1, 10, '2026-06-12 04:20:27'),
(0, 18, 18, 1, 10, '2026-06-12 04:24:14'),
(0, 18, 18, 1, 10, '2026-06-12 04:24:21'),
(0, 18, 18, 1, 10, '2026-06-12 04:29:44'),
(0, 18, 18, 1, 10, '2026-06-12 04:30:24'),
(0, 18, 16, 2, 20, '2026-06-12 04:30:35'),
(0, 18, 18, 1, 10, '2026-06-12 04:30:43'),
(0, 0, 18, 1, 10, '2026-06-12 04:41:55'),
(0, 0, 16, 2, 20, '2026-06-12 04:42:14');

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
(18, 'EuL', 'E2222@gmail.com', '$2y$10$UxAgM3x1jKNCNGNqPT0RNO/SFpNMOT997Pax6fOH6SesLz9MOMCnC', 'usuario', '69ee86cb0d9fe_ChatGPT Image Apr 20, 2026, 09_08_56 PM.png'),
(19, 'admin', '232@gmail.com', '$2y$10$v4IqmfgnQf2QjNvE5X0xWezykI09CtNXRcEXwxkvMFj.w9qI4h1MC', 'admin', NULL),
(0, 'User', 'usuario@gmail.com', '$2y$10$BjUgwH/npRwA0khlG6I8GOAKOK57j4CeQSPVaxJy7Y99gsUlQh01y', 'usuario', NULL),
(0, '4dmin', 'administrador@gmail.com', '$2y$10$1U0vRqsCSU47SJAhSzHqJebTSwY4UTmeKoJUEiSs.t3WwYeaQdaXm', 'admin', NULL);

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
-- Dumping data for table `waste`
--

INSERT INTO `waste` (`waste_id`, `waste_name`, `description`, `container_id`) VALUES
(1, 'Botella plástica', 'Botella PET', 18),
(2, 'Libro', 'Libro de papel', 16),
(3, 'Vaso plástico', 'Vaso desechable', 18),
(4, 'Celular', 'Residuo electrónico', 22),
(5, 'Copa de vidrio', 'Vidrio reciclable', 19);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cameras`
--
ALTER TABLE `cameras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
