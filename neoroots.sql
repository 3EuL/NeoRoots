-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2026 a las 00:32:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `neoroots`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `active_session`
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
-- Estructura de tabla para la tabla `cameras`
--

CREATE TABLE `cameras` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` enum('online','offline') DEFAULT 'online',
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `containers`
--

CREATE TABLE `containers` (
  `container_id` int(11) NOT NULL,
  `colour` varchar(7) NOT NULL,
  `waste_type` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `containers`
--

INSERT INTO `containers` (`container_id`, `colour`, `waste_type`, `description`) VALUES
(16, '#ab3f3f', 'Cartón', 'En este contenedor de ___ color se va a guardar el cartón'),
(18, '#24ff50', 'Plástico', 'En este contenedor de color ___ se van a guardar los residuos plásticos.'),
(19, '#1492e1', 'Vidrio', 'En este contenedor de color ___ va el vídrio'),
(22, '#ff0000', 'Metal', 'En este contenedor de color ___ van los residuos metálicos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `points`
--

CREATE TABLE `points` (
  `point_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recycling_log`
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
-- Estructura de tabla para la tabla `scan_log`
--

CREATE TABLE `scan_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `container_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user`, `email`, `pass`, `rol`, `pfp`) VALUES
(16, 'DillanVallejos', 'dil4n@gmail.com', '$2y$10$KtJj2aMSYMOBPocVZxmXsOGIDxbjeqVklUqNJmn/SRZbkuF04xxAS', 'usuario', NULL),
(17, 'esteban.urbano.6', '123444@gmail.com', '$2y$10$abR3/crRmisvPtQQcy0r9eCcX6aol92cP8zt0635kSBKgDcWh8N1e', 'usuario', NULL),
(18, 'EuL', 'E2222@gmail.com', '$2y$10$ZBAQzwTzN8WeCmcL2GrSkOauAo5lkUehhbDS3nowIsKabuxCyB3p.', 'usuario', '69ee86cb0d9fe_ChatGPT Image Apr 20, 2026, 09_08_56 PM.png'),
(19, 'admin', '232@gmail.com', '$2y$10$v4IqmfgnQf2QjNvE5X0xWezykI09CtNXRcEXwxkvMFj.w9qI4h1MC', 'admin', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `waste`
--

CREATE TABLE `waste` (
  `waste_id` int(11) NOT NULL,
  `waste_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `container_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `active_session`
--
ALTER TABLE `active_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_session_user` (`user_id`),
  ADD KEY `fk_session_container` (`container_id`);

--
-- Indices de la tabla `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cameras`
--
ALTER TABLE `cameras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
