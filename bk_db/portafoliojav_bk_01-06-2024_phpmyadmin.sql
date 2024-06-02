-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: b4qlhpendfkxoin7dohh-mysql.services.clever-cloud.com:3306
-- Tiempo de generación: 02-06-2024 a las 00:54:35
-- Versión del servidor: 8.0.15-5
-- Versión de PHP: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `b4qlhpendfkxoin7dohh`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`uw47ohbu63avvj7m`@`%` PROCEDURE `get_log_ips` ()   BEGIN
select 
ev.id, ev.created_at event_created_at, ev.ip, c.name, co.name, c.created_at city_created_at, ev.longitud, ev.latitud 
from events ev
inner join cities c on c.id = ev.city_id
inner join countries co on co.id = ev.country_id
order by ev.id desc;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `name`, `timezone`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Bogotá', 'America/Bogota', 1, '2024-05-14 20:16:09', '2024-05-14 20:16:09'),
(2, 'Sandston', 'America/New_York', 2, '2024-05-14 20:17:14', '2024-05-14 20:17:14'),
(3, 'Fort Worth', 'America/Chicago', 2, '2024-05-14 20:17:19', '2024-05-14 20:17:19'),
(4, '', '', 25, '2024-05-14 21:21:29', '2024-05-14 21:21:29'),
(5, 'Boydton', 'America/New_York', 2, '2024-05-20 13:48:26', '2024-05-20 13:48:26'),
(6, 'Chicago', 'America/Chicago', 2, '2024-05-28 07:56:11', '2024-05-28 07:56:11'),
(7, 'Villavicencio', 'America/Bogota', 1, '2024-05-28 16:02:50', '2024-05-28 16:02:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `countryCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `countryCode`, `name`, `zip`, `created_at`, `updated_at`) VALUES
(1, 'CO', 'Colombia', '111411', '2023-06-04 19:21:45', '2023-06-04 19:21:45'),
(2, 'US', 'United States', '43017', '2023-06-04 19:34:24', '2023-06-04 19:34:24'),
(3, 'AT', 'Austria', '1010', '2023-06-19 21:56:39', '2023-06-19 21:56:39'),
(4, 'CZ', 'Czechia', '110', '2023-06-26 02:20:44', '2023-06-26 02:20:44'),
(5, 'IE', 'Ireland', '0', '2023-06-29 04:51:50', '2023-06-29 04:51:50'),
(6, 'RU', 'Russia', '144700', '2023-07-05 10:25:59', '2023-07-05 10:25:59'),
(7, 'FR', 'France', '75001', '2023-07-10 13:30:31', '2023-07-10 13:30:31'),
(8, 'DE', 'Germany', '60313', '2023-07-24 03:00:19', '2023-07-24 03:00:19'),
(9, 'NL', 'Netherlands', '1012', '2023-07-25 22:43:29', '2023-07-25 22:43:29'),
(10, 'LV', 'Latvia', '0', '2023-07-26 21:38:36', '2023-07-26 21:38:36'),
(11, 'NO', 'Norway', '581', '2023-08-23 00:30:59', '2023-08-23 00:30:59'),
(12, 'EE', 'Estonia', '0', '2023-08-24 18:39:52', '2023-08-24 18:39:52'),
(13, 'GB', 'United Kingdom', '0', '2023-08-26 15:35:57', '2023-08-26 15:35:57'),
(14, 'SE', 'Sweden', '311', '2023-08-30 10:28:58', '2023-08-30 10:28:58'),
(15, 'FI', 'Finland', '2630', '2023-09-02 02:59:47', '2023-09-02 02:59:47'),
(16, 'BY', 'Belarus', '220004', '2023-09-07 09:46:29', '2023-09-07 09:46:29'),
(17, 'LT', 'Lithuania', '2011', '2023-09-21 12:04:52', '2023-09-21 12:04:52'),
(18, 'BE', 'Belgium', '1000', '2023-09-23 07:05:40', '2023-09-23 07:05:40'),
(19, 'AL', 'Albania', '0', '2023-10-02 16:03:53', '2023-10-02 16:03:53'),
(20, 'CH', 'Switzerland', '8042', '2023-10-08 05:53:49', '2023-10-08 05:53:49'),
(21, 'PL', 'Poland', '0', '2023-12-02 13:42:40', '2023-12-02 13:42:40'),
(22, 'UA', 'Ukraine', '1011', '2023-12-08 20:37:08', '2023-12-08 20:37:08'),
(23, 'NL', 'The Netherlands', '1012', '2023-12-20 08:34:40', '2023-12-20 08:34:40'),
(24, 'DK', 'Denmark', '2600', '2024-03-24 01:09:24', '2024-03-24 01:09:24'),
(25, '', '', '', '2024-05-14 21:21:28', '2024-05-14 21:21:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `rut` varchar(20) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `rut`, `nom`, `status`) VALUES
(1, '45436546', 'IMCOABHER', 'A'),
(2, '466574', 'Sporthealth', 'A'),
(3, '543654', 'Amoblando', 'A'),
(4, '4535', 'Sena', 'A'),
(5, '5464', 'Transportes', 'A'),
(6, '564365', 'FrutExpres', 'A'),
(7, '563', 'Sicloud-dev', 'A'),
(8, '2345423', 'Soluciones integrales mallorca España', ''),
(9, NULL, 'Alegra', 'A'),
(10, NULL, 'openTecnología', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nom_equipo` varchar(25) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `obsevacion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nom_equipo`, `fecha_creacion`, `obsevacion`) VALUES
(1, 'Desarrollo', '2021-03-01 13:27:57', NULL),
(2, 'Cliente externo', '2021-03-01 13:27:57', NULL),
(3, 'Institución ', '2021-03-01 13:27:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `type_event_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `latitud` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitud` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proyect_id` int(11) NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `type_event_id`, `created_at`, `updated_at`, `ip`, `city_id`, `country_id`, `latitud`, `longitud`, `proyect_id`) VALUES
(1, 1, '2024-05-14 19:57:48', '2024-05-14 19:57:48', '186.155.33.191', 1, 1, NULL, NULL, 7),
(2, 1, '2024-05-14 19:57:49', '2024-05-14 19:57:49', '186.155.33.191', 1, 1, NULL, NULL, 7),
(3, 1, '2024-05-14 20:16:09', '2024-05-14 20:16:09', '186.155.33.191', 1, 1, NULL, NULL, 7),
(4, 1, '2024-05-14 20:16:11', '2024-05-14 20:16:11', '186.155.33.191', 1, 1, NULL, NULL, 7),
(5, 1, '2024-05-14 20:17:14', '2024-05-14 20:17:14', '2a03:2880:22ff:78::face:b00c', 2, 2, NULL, NULL, 7),
(6, 1, '2024-05-14 20:17:15', '2024-05-14 20:17:15', '2a03:2880:22ff:78::face:b00c', 2, 2, NULL, NULL, 7),
(7, 1, '2024-05-14 20:17:15', '2024-05-14 20:17:15', '186.155.33.191', 1, 1, NULL, NULL, 7),
(8, 1, '2024-05-14 20:17:17', '2024-05-14 20:17:17', '186.155.33.191', 1, 1, NULL, NULL, 7),
(9, 1, '2024-05-14 20:17:20', '2024-05-14 20:17:20', '2a03:2880:11ff:74::face:b00c', 3, 2, NULL, NULL, 7),
(10, 1, '2024-05-14 20:17:20', '2024-05-14 20:17:20', '2a03:2880:11ff:e::face:b00c', 3, 2, NULL, NULL, 7),
(11, 1, '2024-05-14 20:17:21', '2024-05-14 20:17:21', '2a03:2880:11ff:74::face:b00c', 3, 2, NULL, NULL, 7),
(223, 1, '2024-05-15 20:39:12', '2024-05-15 20:39:12', '186.155.33.191', 1, 1, NULL, NULL, 7),
(224, 1, '2024-05-15 20:39:14', '2024-05-15 20:39:14', '186.155.33.191', 1, 1, NULL, NULL, 7),
(225, 1, '2024-05-15 20:39:47', '2024-05-15 20:39:47', '186.155.33.191', 1, 1, NULL, NULL, 7),
(226, 1, '2024-05-16 11:50:18', '2024-05-16 11:50:18', '186.155.33.191', 1, 1, NULL, NULL, 7),
(227, 1, '2024-05-16 11:50:19', '2024-05-16 11:50:19', '186.155.33.191', 1, 1, NULL, NULL, 7),
(228, 1, '2024-05-16 20:49:56', '2024-05-16 20:49:56', '186.155.33.191', 1, 1, NULL, NULL, 7),
(229, 1, '2024-05-16 20:49:57', '2024-05-16 20:49:57', '186.155.33.191', 1, 1, NULL, NULL, 7),
(230, 1, '2024-05-16 20:51:40', '2024-05-16 20:51:40', '186.155.33.191', 1, 1, NULL, NULL, 7),
(231, 1, '2024-05-16 20:51:41', '2024-05-16 20:51:41', '186.155.33.191', 1, 1, NULL, NULL, 7),
(232, 1, '2024-05-16 21:46:03', '2024-05-16 21:46:03', '186.155.33.191', 1, 1, NULL, NULL, 7),
(233, 1, '2024-05-16 21:46:05', '2024-05-16 21:46:05', '186.155.33.191', 1, 1, NULL, NULL, 7),
(234, 1, '2024-05-17 19:11:47', '2024-05-17 19:11:47', '186.155.33.197', 1, 1, NULL, NULL, 7),
(235, 1, '2024-05-17 19:11:48', '2024-05-17 19:11:48', '186.155.33.197', 1, 1, NULL, NULL, 7),
(236, 1, '2024-05-17 20:27:16', '2024-05-17 20:27:16', '186.155.33.197', 1, 1, NULL, NULL, 7),
(237, 1, '2024-05-17 20:27:17', '2024-05-17 20:27:17', '186.155.33.197', 1, 1, NULL, NULL, 7),
(238, 1, '2024-05-17 20:27:27', '2024-05-17 20:27:27', '186.155.33.197', 1, 1, NULL, NULL, 7),
(239, 1, '2024-05-17 20:27:29', '2024-05-17 20:27:29', '186.155.33.197', 1, 1, NULL, NULL, 7),
(240, 1, '2024-05-17 20:27:39', '2024-05-17 20:27:39', '186.155.33.197', 1, 1, NULL, NULL, 7),
(241, 1, '2024-05-17 20:27:40', '2024-05-17 20:27:40', '186.155.33.197', 1, 1, NULL, NULL, 7),
(242, 1, '2024-05-19 00:32:26', '2024-05-19 00:32:26', '186.155.33.188', 1, 1, NULL, NULL, 7),
(243, 1, '2024-05-19 00:32:27', '2024-05-19 00:32:27', '186.155.33.188', 1, 1, NULL, NULL, 7),
(244, 1, '2024-05-20 11:39:27', '2024-05-20 11:39:27', '186.29.183.251', 1, 1, NULL, NULL, 7),
(245, 1, '2024-05-20 11:39:29', '2024-05-20 11:39:29', '186.29.183.251', 1, 1, NULL, NULL, 7),
(246, 1, '2024-05-20 11:41:44', '2024-05-20 11:41:44', '186.29.183.251', 1, 1, NULL, NULL, 7),
(247, 1, '2024-05-20 11:41:45', '2024-05-20 11:41:45', '186.29.183.251', 1, 1, NULL, NULL, 7),
(248, 1, '2024-05-20 11:42:31', '2024-05-20 11:42:31', '186.29.183.251', 1, 1, NULL, NULL, 7),
(249, 1, '2024-05-20 11:42:32', '2024-05-20 11:42:32', '186.29.183.251', 1, 1, NULL, NULL, 7),
(250, 1, '2024-05-20 11:42:42', '2024-05-20 11:42:42', '186.29.183.251', 1, 1, NULL, NULL, 7),
(251, 1, '2024-05-20 11:42:44', '2024-05-20 11:42:44', '186.29.183.251', 1, 1, NULL, NULL, 7),
(252, 1, '2024-05-20 12:05:01', '2024-05-20 12:05:01', '186.29.183.251', 1, 1, NULL, NULL, 7),
(253, 1, '2024-05-20 12:05:02', '2024-05-20 12:05:02', '186.29.183.251', 1, 1, NULL, NULL, 7),
(254, 1, '2024-05-20 13:37:43', '2024-05-20 13:37:43', '186.29.183.251', 1, 1, NULL, NULL, 7),
(255, 1, '2024-05-20 13:37:45', '2024-05-20 13:37:45', '186.29.183.251', 1, 1, NULL, NULL, 7),
(256, 1, '2024-05-20 13:37:59', '2024-05-20 13:37:59', '186.29.183.251', 1, 1, NULL, NULL, 7),
(257, 1, '2024-05-20 13:38:00', '2024-05-20 13:38:00', '186.29.183.251', 1, 1, NULL, NULL, 7),
(258, 1, '2024-05-20 13:38:11', '2024-05-20 13:38:11', '186.29.183.251', 1, 1, NULL, NULL, 7),
(259, 1, '2024-05-20 13:38:12', '2024-05-20 13:38:12', '186.29.183.251', 1, 1, NULL, NULL, 7),
(260, 1, '2024-05-20 13:48:26', '2024-05-20 13:48:26', '52.167.144.161', 5, 2, NULL, NULL, 7),
(261, 1, '2024-05-20 13:48:27', '2024-05-20 13:48:27', '52.167.144.161', 5, 2, NULL, NULL, 7),
(262, 1, '2024-05-21 11:20:03', '2024-05-21 11:20:03', '186.29.183.251', 1, 1, NULL, NULL, 7),
(263, 1, '2024-05-21 11:20:04', '2024-05-21 11:20:04', '186.29.183.251', 1, 1, NULL, NULL, 7),
(264, 1, '2024-05-21 17:09:29', '2024-05-21 17:09:29', '186.29.183.251', 1, 1, NULL, NULL, 7),
(265, 1, '2024-05-21 17:09:30', '2024-05-21 17:09:30', '186.29.183.251', 1, 1, NULL, NULL, 7),
(266, 1, '2024-05-21 17:09:47', '2024-05-21 17:09:47', '186.29.183.251', 1, 1, NULL, NULL, 7),
(267, 1, '2024-05-21 17:09:49', '2024-05-21 17:09:49', '186.29.183.251', 1, 1, NULL, NULL, 7),
(268, 1, '2024-05-21 17:17:05', '2024-05-21 17:17:05', '186.29.183.251', 1, 1, NULL, NULL, 7),
(269, 1, '2024-05-21 17:17:07', '2024-05-21 17:17:07', '186.29.183.251', 1, 1, NULL, NULL, 7),
(270, 1, '2024-05-21 21:59:14', '2024-05-21 21:59:14', '186.155.33.27', 1, 1, NULL, NULL, 7),
(271, 1, '2024-05-21 21:59:16', '2024-05-21 21:59:16', '186.155.33.27', 1, 1, NULL, NULL, 7),
(272, 1, '2024-05-21 23:22:39', '2024-05-21 23:22:39', '186.155.33.27', 1, 1, NULL, NULL, 7),
(273, 1, '2024-05-21 23:22:40', '2024-05-21 23:22:40', '186.155.33.27', 1, 1, NULL, NULL, 7),
(274, 1, '2024-05-22 13:26:10', '2024-05-22 13:26:10', '186.155.33.6', 1, 1, NULL, NULL, 7),
(275, 1, '2024-05-22 13:26:11', '2024-05-22 13:26:11', '186.155.33.6', 1, 1, NULL, NULL, 7),
(276, 1, '2024-05-22 13:27:48', '2024-05-22 13:27:48', '186.155.33.6', 1, 1, NULL, NULL, 7),
(277, 1, '2024-05-22 13:27:49', '2024-05-22 13:27:49', '186.155.33.6', 1, 1, NULL, NULL, 7),
(278, 1, '2024-05-22 13:27:52', '2024-05-22 13:27:52', '186.155.33.6', 1, 1, NULL, NULL, 7),
(279, 1, '2024-05-22 13:27:54', '2024-05-22 13:27:54', '186.155.33.6', 1, 1, NULL, NULL, 7),
(280, 1, '2024-05-22 13:52:07', '2024-05-22 13:52:07', '186.155.33.6', 1, 1, NULL, NULL, 7),
(281, 1, '2024-05-22 13:52:08', '2024-05-22 13:52:08', '186.155.33.6', 1, 1, NULL, NULL, 7),
(282, 1, '2024-05-22 13:52:25', '2024-05-22 13:52:25', '186.155.33.6', 1, 1, NULL, NULL, 7),
(283, 1, '2024-05-22 13:52:26', '2024-05-22 13:52:26', '186.155.33.6', 1, 1, NULL, NULL, 7),
(284, 1, '2024-05-22 13:52:50', '2024-05-22 13:52:50', '186.155.33.6', 1, 1, NULL, NULL, 7),
(285, 1, '2024-05-22 13:52:51', '2024-05-22 13:52:51', '186.155.33.6', 1, 1, NULL, NULL, 7),
(286, 1, '2024-05-22 14:57:43', '2024-05-22 14:57:43', '186.155.33.6', 1, 1, NULL, NULL, 7),
(287, 1, '2024-05-22 14:57:45', '2024-05-22 14:57:45', '186.155.33.6', 1, 1, NULL, NULL, 7),
(288, 1, '2024-05-22 15:18:30', '2024-05-22 15:18:30', '::1', 4, 25, NULL, NULL, 7),
(289, 1, '2024-05-22 15:18:32', '2024-05-22 15:18:32', '::1', 4, 25, NULL, NULL, 7),
(290, 1, '2024-05-22 15:56:58', '2024-05-22 15:56:58', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(291, 1, '2024-05-22 15:57:00', '2024-05-22 15:57:00', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(292, 1, '2024-05-22 16:42:43', '2024-05-22 16:42:43', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(293, 1, '2024-05-22 16:42:45', '2024-05-22 16:42:45', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(294, 1, '2024-05-22 16:42:54', '2024-05-22 16:42:54', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(295, 1, '2024-05-22 16:42:55', '2024-05-22 16:42:55', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(296, 1, '2024-05-22 16:46:52', '2024-05-22 16:46:52', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(297, 1, '2024-05-22 16:46:53', '2024-05-22 16:46:53', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(298, 1, '2024-05-22 16:50:45', '2024-05-22 16:50:45', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(299, 1, '2024-05-22 16:52:14', '2024-05-22 16:52:14', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(300, 1, '2024-05-22 16:53:19', '2024-05-22 16:53:19', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(301, 1, '2024-05-22 16:54:15', '2024-05-22 16:54:15', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(302, 1, '2024-05-22 16:55:37', '2024-05-22 16:55:37', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(303, 1, '2024-05-22 16:58:46', '2024-05-22 16:58:46', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(304, 1, '2024-05-22 16:58:49', '2024-05-22 16:58:49', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(305, 1, '2024-05-22 17:01:17', '2024-05-22 17:01:17', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(306, 1, '2024-05-22 17:02:26', '2024-05-22 17:02:26', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(307, 1, '2024-05-22 17:02:27', '2024-05-22 17:02:27', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(308, 1, '2024-05-22 17:02:33', '2024-05-22 17:02:33', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(309, 1, '2024-05-22 17:02:40', '2024-05-22 17:02:40', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(310, 1, '2024-05-22 17:02:50', '2024-05-22 17:02:50', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(311, 1, '2024-05-22 17:04:36', '2024-05-22 17:04:36', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(312, 1, '2024-05-22 17:04:50', '2024-05-22 17:04:50', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(313, 1, '2024-05-22 17:05:07', '2024-05-22 17:05:07', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(314, 1, '2024-05-22 17:10:49', '2024-05-22 17:10:49', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(315, 1, '2024-05-22 17:10:59', '2024-05-22 17:10:59', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(316, 1, '2024-05-22 17:11:00', '2024-05-22 17:11:00', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(317, 1, '2024-05-22 17:11:02', '2024-05-22 17:11:02', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(318, 1, '2024-05-22 17:11:11', '2024-05-22 17:11:11', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(319, 1, '2024-05-22 17:12:10', '2024-05-22 17:12:10', '52.167.144.5', 5, 2, '36.677696', '-78.37471', 7),
(320, 1, '2024-05-22 17:12:11', '2024-05-22 17:12:11', '52.167.144.5', 5, 2, '36.677696', '-78.37471', 7),
(321, 1, '2024-05-22 17:13:35', '2024-05-22 17:13:35', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(322, 1, '2024-05-22 17:13:50', '2024-05-22 17:13:50', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(323, 1, '2024-05-22 17:13:57', '2024-05-22 17:13:57', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(324, 1, '2024-05-22 17:14:12', '2024-05-22 17:14:12', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(325, 1, '2024-05-22 17:14:15', '2024-05-22 17:14:15', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(326, 1, '2024-05-22 17:20:26', '2024-05-22 17:20:26', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(327, 1, '2024-05-22 17:20:40', '2024-05-22 17:20:40', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(328, 1, '2024-05-22 17:37:03', '2024-05-22 17:37:03', '40.77.167.49', 5, 2, '36.677696', '-78.37471', 7),
(329, 1, '2024-05-22 17:53:16', '2024-05-22 17:53:16', '40.77.167.14', 5, 2, '36.677696', '-78.37471', 7),
(330, 1, '2024-05-22 17:59:53', '2024-05-22 17:59:53', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(331, 1, '2024-05-22 18:18:57', '2024-05-22 18:18:57', '52.167.144.212', 5, 2, '36.677696', '-78.37471', 7),
(332, 1, '2024-05-22 18:21:13', '2024-05-22 18:21:13', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(333, 1, '2024-05-22 18:47:00', '2024-05-22 18:47:00', '52.167.144.18', 5, 2, '36.677696', '-78.37471', 7),
(334, 1, '2024-05-22 19:42:05', '2024-05-22 19:42:05', '52.167.144.189', 5, 2, '36.677696', '-78.37471', 7),
(335, 1, '2024-05-23 09:16:16', '2024-05-23 09:16:16', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(336, 1, '2024-05-23 09:37:20', '2024-05-23 09:37:20', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(337, 1, '2024-05-23 09:57:45', '2024-05-23 09:57:45', '52.167.144.192', 5, 2, '36.677696', '-78.37471', 7),
(338, 1, '2024-05-23 10:09:28', '2024-05-23 10:09:28', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(339, 1, '2024-05-23 10:27:49', '2024-05-23 10:27:49', '52.167.144.16', 5, 2, '36.677696', '-78.37471', 7),
(340, 1, '2024-05-23 10:37:41', '2024-05-23 10:37:41', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(341, 1, '2024-05-23 10:57:31', '2024-05-23 10:57:31', '40.77.167.136', 5, 2, '36.677696', '-78.37471', 7),
(342, 1, '2024-05-23 11:36:25', '2024-05-23 11:36:25', '52.167.144.238', 5, 2, '36.677696', '-78.37471', 7),
(343, 1, '2024-05-23 11:46:12', '2024-05-23 11:46:12', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(344, 1, '2024-05-23 11:47:36', '2024-05-23 11:47:36', '186.155.33.6', 1, 1, '4.6012', '-74.0695', 7),
(345, 1, '2024-05-23 12:22:59', '2024-05-23 12:22:59', '40.77.167.132', 5, 2, '36.677696', '-78.37471', 7),
(346, 1, '2024-05-23 13:23:34', '2024-05-23 13:23:34', '52.167.144.176', 5, 2, '36.677696', '-78.37471', 7),
(347, 1, '2024-05-24 11:12:56', '2024-05-24 11:12:56', '186.29.183.254', 1, 1, '4.6115', '-74.0833', 7),
(348, 1, '2024-05-24 11:14:03', '2024-05-24 11:14:03', '186.29.183.254', 1, 1, '4.6115', '-74.0833', 7),
(349, 1, '2024-05-24 11:14:04', '2024-05-24 11:14:04', '186.29.183.254', 1, 1, '4.6115', '-74.0833', 7),
(350, 1, '2024-05-24 11:14:06', '2024-05-24 11:14:06', '186.29.183.254', 1, 1, '4.6115', '-74.0833', 7),
(351, 1, '2024-05-24 11:15:45', '2024-05-24 11:15:45', '186.29.183.254', 1, 1, '4.6115', '-74.0833', 7),
(359, 1, '2024-05-27 15:20:48', '2024-05-27 15:20:48', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 10),
(360, 1, '2024-05-27 15:21:34', '2024-05-27 15:21:34', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(361, 1, '2024-05-27 15:21:46', '2024-05-27 15:21:46', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(362, 1, '2024-05-27 15:22:00', '2024-05-27 15:22:00', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(363, 1, '2024-05-27 15:24:15', '2024-05-27 15:24:15', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(364, 1, '2024-05-27 17:22:19', '2024-05-27 17:22:19', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 9),
(365, 1, '2024-05-27 17:22:38', '2024-05-27 17:22:38', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 9),
(366, 1, '2024-05-27 17:22:48', '2024-05-27 17:22:48', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 9),
(367, 1, '2024-05-27 17:31:08', '2024-05-27 17:31:08', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(368, 1, '2024-05-27 17:35:18', '2024-05-27 17:35:18', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 9),
(369, 1, '2024-05-27 17:35:20', '2024-05-27 17:35:20', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 9),
(370, 1, '2024-05-27 17:40:33', '2024-05-27 17:40:33', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 9),
(371, 1, '2024-05-27 17:57:44', '2024-05-27 17:57:44', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(372, 1, '2024-05-27 17:58:02', '2024-05-27 17:58:02', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(373, 1, '2024-05-27 18:00:40', '2024-05-27 18:00:40', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(374, 1, '2024-05-27 18:04:55', '2024-05-27 18:04:55', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(375, 1, '2024-05-27 18:07:58', '2024-05-27 18:07:58', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(376, 1, '2024-05-27 18:09:14', '2024-05-27 18:09:14', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 10),
(377, 1, '2024-05-27 18:19:23', '2024-05-27 18:19:23', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(378, 1, '2024-05-27 18:34:54', '2024-05-27 18:34:54', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(379, 1, '2024-05-27 19:17:00', '2024-05-27 19:17:00', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(380, 1, '2024-05-27 19:53:56', '2024-05-27 19:53:56', '186.155.33.182', 1, 1, '4.6012', '-74.0695', 7),
(381, 1, '2024-05-27 19:59:34', '2024-05-27 19:59:34', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(382, 1, '2024-05-27 21:00:09', '2024-05-27 21:00:09', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(383, 1, '2024-05-27 21:00:21', '2024-05-27 21:00:21', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(384, 1, '2024-05-27 21:00:32', '2024-05-27 21:00:32', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(385, 1, '2024-05-27 21:00:54', '2024-05-27 21:00:54', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(386, 1, '2024-05-27 23:43:44', '2024-05-27 23:43:44', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(387, 1, '2024-05-27 23:44:51', '2024-05-27 23:44:51', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(388, 1, '2024-05-27 23:46:32', '2024-05-27 23:46:32', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(389, 1, '2024-05-27 23:47:30', '2024-05-27 23:47:30', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(390, 1, '2024-05-27 23:47:35', '2024-05-27 23:47:35', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(391, 1, '2024-05-27 23:48:41', '2024-05-27 23:48:41', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 10),
(392, 1, '2024-05-27 23:48:41', '2024-05-27 23:48:41', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 10),
(393, 1, '2024-05-27 23:48:54', '2024-05-27 23:48:54', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 10),
(394, 1, '2024-05-28 07:56:11', '2024-05-28 07:56:11', '2605:4c40:4:9d34:0:7467:6b9e:1', 6, 2, '41.8778', '-87.6312', 9),
(395, 1, '2024-05-28 07:56:26', '2024-05-28 07:56:26', '2605:4c40:4:9d34:0:7467:6b9e:1', 6, 2, '41.8778', '-87.6312', 9),
(396, 1, '2024-05-28 07:56:41', '2024-05-28 07:56:41', '2605:4c40:4:9d34:0:7467:6b9e:1', 6, 2, '41.8778', '-87.6312', 9),
(397, 1, '2024-05-28 07:59:11', '2024-05-28 07:59:11', '2605:4c40:4:9d34:0:7467:6b9e:1', 6, 2, '41.8778', '-87.6312', 9),
(398, 1, '2024-05-28 07:59:11', '2024-05-28 07:59:11', '2605:4c40:4:de4a:0:e5f3:aea9:1', 6, 2, '41.8778', '-87.6312', 9),
(399, 1, '2024-05-28 07:59:25', '2024-05-28 07:59:25', '2605:4c40:4:9d34:0:7467:6b9e:1', 6, 2, '41.8778', '-87.6312', 9),
(400, 1, '2024-05-28 07:59:25', '2024-05-28 07:59:25', '2605:4c40:4:de4a:0:e5f3:aea9:1', 6, 2, '41.8778', '-87.6312', 9),
(401, 1, '2024-05-28 08:01:10', '2024-05-28 08:01:10', '2605:4c40:4:9d34:0:7467:6b9e:1', 6, 2, '41.8778', '-87.6312', 9),
(402, 1, '2024-05-28 08:01:10', '2024-05-28 08:01:10', '2605:4c40:4:de4a:0:e5f3:aea9:1', 6, 2, '41.8778', '-87.6312', 9),
(403, 1, '2024-05-28 09:11:30', '2024-05-28 09:11:30', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(404, 1, '2024-05-28 09:12:58', '2024-05-28 09:12:58', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(405, 1, '2024-05-28 09:34:20', '2024-05-28 09:34:20', '190.24.59.100', 1, 1, '4.6115', '-74.0833', 7),
(406, 1, '2024-05-28 16:02:50', '2024-05-28 16:02:50', '181.51.34.207', 7, 1, '4.1409', '-73.626', 10),
(407, 1, '2024-05-28 16:02:53', '2024-05-28 16:02:53', '181.51.34.207', 7, 1, '4.1409', '-73.626', 10),
(408, 1, '2024-05-28 20:25:23', '2024-05-28 20:25:23', '::1', 4, 25, '', '', 7),
(409, 1, '2024-05-28 20:26:30', '2024-05-28 20:26:30', '::1', 4, 25, '', '', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias_requerimientos`
--

CREATE TABLE `historias_requerimientos` (
  `id_h` int(11) NOT NULL,
  `prioridad` varchar(5) NOT NULL,
  `fecha_crea` datetime NOT NULL,
  `criterio_aceptacion` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `fk_proyecto` int(11) DEFAULT NULL,
  `status` varchar(5) NOT NULL,
  `fecha_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `historias_requerimientos`
--

INSERT INTO `historias_requerimientos` (`id_h`, `prioridad`, `fecha_crea`, `criterio_aceptacion`, `obs`, `fk_proyecto`, `status`, `fecha_update`) VALUES
(1, 'A', '2021-03-01 17:13:02', 'Requerimiento 1.0', 'Requerimiento 1', 1, 'A', '2021-12-21 20:37:51'),
(2, 'M', '2021-03-01 15:03:51', 'El sistema deberá mostrar informes de ventas y productos en inventario, según la jerarquía del rol en cuanto a el acceso a los mismos', 'Generar informes', 1, 'A', '2021-03-28 03:59:31'),
(3, 'B', '2021-03-28 03:05:36', 'El sistema deberá permitir registrar y visualizar los puntos y compras \r\nque haya hecho el cliente', 'Acumulación de puntos por compra', 1, 'A', '2021-03-28 03:56:13'),
(4, 'A', '2021-03-28 04:07:08', 'El actor deberá acceder a la interfaz de login para \r\nasimismo poder ingresar al sistema. según su rol', 'Autenticación de usuario', 1, 'A', '0000-00-00 00:00:00'),
(5, 'A', '2021-03-28 04:08:56', 'El sistema debe permitir crear, modificar, eliminar un\r\nusuario para el administrador “El vendedor solo puede crear \r\ny modificar clientes”.', 'Registro de usuario y definición de rol', 1, 'A', '0000-00-00 00:00:00'),
(21, 'A', '2021-03-28 04:39:08', 'El rol nutricionista podrá realizar login', 'Inicio de sesion', 2, 'A', '2021-03-28 04:58:22'),
(23, 'A', '2021-03-28 04:46:28', 'el rol nutricionista puede registrar un paciente/cliente con información básica\r\n- Nombre \r\n- Eddad\r\n- Altura\r\n- Medidas de cintura\r\n- Medidas de cadera\r\n- Medidas de muslo\r\n- Biceps\r\n- IMC\r\n- Kilo de', 'Registro de pacientes', 2, 'A', '2021-03-28 04:58:43'),
(24, 'A', '2021-03-28 04:49:37', 'El sistema debe mostrar informe de las medidas por fecha, y estadística grafica por cada paciente', 'Historia de avances en los pacientes', 2, 'A', '2021-03-28 04:59:22'),
(26, 'A', '2021-03-28 04:55:37', 'El rol nutricionista puede realiza asignación de plan a cada paciente', 'Asignación de plan', 2, 'A', '2021-03-28 08:20:04'),
(27, 'A', '2021-03-28 04:57:04', 'El rol de cliente también deberá poder ver su peso por medio de una grafica que le permitirá ver estadísticas en un lapso de tiempo', 'Ver estadísticas', 2, 'A', '2021-03-28 05:00:12'),
(28, 'A', '2021-03-29 01:09:45', 'El sistema debe permitir mostrar un catálogo al  Rol cliente.', 'Catalogo', 4, 'A', '2021-03-29 01:50:48'),
(29, 'A', '2021-03-29 01:18:50', 'Se permite el registro de un nuevo cliente solo si no está inscrito.', 'Registro', 4, 'A', '2021-03-29 01:18:50'),
(30, 'A', '2021-03-29 01:20:23', 'Determinado cliente o empleado inicia sesión correctamente, permisos distintos según su rol.', 'Login', 4, 'A', '2021-03-29 01:28:24'),
(31, 'A', '2021-03-29 01:20:43', 'El sistema no permite la compra de productos si el empleado o el cliente no están logados.', 'Compra segura', 4, 'A', '2021-03-29 01:20:43'),
(32, 'A', '2021-03-29 01:21:07', 'Pasividad de pago con cuotas dependiendo el\r\nplazo pedido y el respectivo interés.', 'Pago por Cuotas', 4, 'A', '2021-03-29 01:52:37'),
(33, 'A', '2021-03-29 01:25:11', 'Determinado cliente realiza la compra de 2 productos o más productos esta compra se debe validar con el \r\nstock o historial de compras DEBEN ESTAR RELACIONADOS LOS PRODUCTOS EN UNA SOLA COMPRA\r\nLa factura debe quedar al nombre del cliente', 'Facturación', 4, 'A', '2021-03-29 01:28:38'),
(34, 'A', '2021-03-29 01:25:29', 'Determinado cliente realiza la compra de un (1) producto (esta compra se debe validar con el stock o historial de compras)', 'Actualización de stock', 4, 'A', '2021-03-29 01:25:29'),
(35, 'A', '2021-03-29 01:26:45', 'Stock de productos en inventario\r\nSi el empleado acepta la petición del cliente (rembolso) el valor del reembolso se descuenta de la caja de AMOBLANDO y el producto regresa al Stock (Este proceso se debe evidenciar en el Stock y la caja de AMOBLANDO)', 'Inventario', 4, 'A', '2021-03-29 01:26:45'),
(36, 'A', '2021-03-29 01:27:15', 'El sistema debe permitir al rol de empleado crear productos y los mismos deben de visualizarse en el catalogo\r\nEl empleado registra un nuevo producto al stock de AMOBLANDO (Para la creación de un nuevo producto se debe requerir: Imagen, Nombre del Producto, Categoría, Precio, Cantidad, Descripción).', 'Crear productos', 4, 'A', '2021-03-29 01:27:15'),
(37, 'A', '2021-03-29 01:27:37', 'Determinado cliente puede pedir un reembolso en los 15 días posteriores de la compra, donde debe especificar las razones por cual solicita el reembolso. (Este proceso se debe validar en una interfaz de reembolso del Cliente).\r\nDeterminado Empleado cuenta con una interfaz en la cual se pueden evidenciar las peticiones de reembolso de los clientes. (El empleado puede aceptar o rechaza el reembolso) .', 'Solicitud de reembolso', 4, 'A', '2021-03-29 01:27:37'),
(38, 'A', '2021-03-29 01:27:57', 'El rolo empleado deberá poder visualizar las  ventas y valor facturado en un periodo de  tiempo\r\n(el reporte debe contener, NOMBRE DEL PRODUCTO, CANTIDAD, PRECIO, FECHA DE LA COMPRA)', 'Informe de ventas', 4, 'A', '2021-03-29 01:27:57'),
(39, 'A', '2021-03-29 01:28:14', 'Determinado empleado revisa el stock de AMOBLANDO (el reporte debe contener, CATEGORIA, NOMBRE DEL PRODUCTO, CANTIDAD) si el producto está agotado se debe evidenciar ese estado en CANTIDAD\r\nAdemás del catálogo el sistemas depara poder realizar facturación vía web y también contar con facturación interna.', 'Informe de productos', 4, 'A', '2021-03-29 01:28:14'),
(40, 'A', '2021-03-29 01:32:01', 'El sistema me debe permitir registrar una nueva ficha', 'Registro de ficha', 3, 'A', '2021-03-29 01:32:01'),
(41, 'A', '2021-03-29 01:32:34', 'El sistema me debe permitir actualizar de una ficha cualquier información ejemplo.\r\n(jornada, nombre, programa de formación etc)', 'Actualización ficha', 3, 'A', '2021-03-29 01:32:45'),
(42, 'A', '2021-03-29 01:33:07', 'El sistema me debe permitir DESACTIVAR cualquier ficha.', 'Desactivar ficha', 3, 'A', '2021-03-29 01:33:07'),
(43, 'A', '2021-03-29 01:33:42', 'El sistema me debe permitir realizar búsquedas de las fichas con los siguientes filtros\r\n• Filtro por jornada\r\n• Filtro por carácter\r\n• Filtro de fichas activas e inactivas.', 'Filtro ficha', 3, 'A', '2021-03-29 01:33:42'),
(44, 'A', '2021-03-29 01:34:21', 'El sistema me debe permitir registrar un nuevo programa de formación.\r\nLos campos usados en la entidad serán\r\n• Código\r\n• Nombre del programa de formación\r\n• Sigla', 'Registro de programa de formación', 3, 'A', '2021-03-29 01:35:44'),
(45, 'A', '2021-03-29 01:34:51', 'El sistema debe permitir actualizar cualquier dato de programa de formación', 'Actualizar programa de formación', 3, 'A', '2021-03-29 01:54:55'),
(46, 'A', '2021-03-29 01:36:48', 'El sistema debe validar que la información a guardar en el campo sigla siempre este en\r\nmayúscula.', 'Mayúsculas', 3, 'A', '2021-03-29 01:36:48'),
(47, 'M', '2021-03-29 01:37:19', 'Listado de los programas de formación con un con “pagínate(‘5’)”', 'Paginado', 3, 'A', '2021-03-29 01:37:19'),
(48, 'M', '2021-03-29 01:37:46', 'El sistema no debe permitir eliminar algún eliminar ni desactivar los programas de\r\nformación', 'Programa de formación', 3, 'P', '2021-03-29 01:37:46'),
(49, 'A', '2021-03-29 01:38:19', 'El sistema de información me debe permitir crear un nuevo aprendiz y asociarlo a una\r\nficha.\r\nLos datos del aprendiz serán\r\n• Documento\r\n• Nombres\r\n• Apellidos\r\n• Correo electrónico\r\n• Fecha de nacimiento\r\n• Genero\r\n• Tipo de documento', 'Crear aprendiz', 3, 'A', '2021-03-29 01:38:32'),
(50, 'M', '2021-03-29 01:39:21', 'Importante, no se permite la creación de entidades para guardar los tipos de documento\r\nni genero el desarrollador debe buscar otra alternativa para manejar esa información\r\nhaciendo uso de larval.', 'Objetos más no DB', 3, 'A', '2021-03-29 01:39:21'),
(51, 'A', '2021-03-29 01:39:44', 'El sistema me debe permitir eliminar un aprendiz de ser necesario', 'Eliminar aprendiz', 3, 'A', '2021-03-29 01:39:44'),
(52, 'A', '2021-03-29 01:40:12', 'El sistema me debe permitir registrar un nuevo instructor.\r\n. Los datos del instructor serán\r\n• Nombres\r\n• Apellidos\r\n• Documento\r\n• Foto de perfil\r\nAl momento de crear un instructor inmediatamente se le debe asociar a una ficha, de\r\nno ser así el instructor no deberá ser creado.', 'Registrar instructor', 3, 'A', '2021-03-29 01:40:54'),
(53, 'A', '2021-03-29 01:41:16', 'Se debe permitir actualizar el instructor.', 'Actualizar rol instructor', 3, 'A', '2021-03-29 01:41:16'),
(54, 'A', '2021-03-29 01:41:38', 'No se debe permitir eliminar un instructor solo desactivarlo', 'No eliminar instructores', 3, 'A', '2021-03-29 01:41:38'),
(55, 'A', '2021-03-29 02:14:16', 'El sistema permite al rol de SM, PO, Crear nuevos proyectos \r\n- (Pendiente formulario)', 'Registrar proyectos', 7, 'P', '2021-04-01 11:33:19'),
(56, 'A', '2021-03-29 02:15:52', 'El sistema permite registrar por individual cada requerimiento y asociarlo a un proyecto', 'Registrar requerimientos', 7, 'A', '2021-03-29 02:15:52'),
(57, 'A', '2021-03-29 02:17:29', 'El sistema permite Actualizar el estado de pendiente y aprobado según el avance que se baya teniendo en cada proyecto, registra update en DB y evidencia fecha de Update', 'Actualizar el estado de requerimiento', 7, 'A', '2021-03-28 23:05:19'),
(58, 'M', '2021-03-29 02:18:06', '- Filtro por búsqueda fecha de desarrollo por proyectos.\r\n- Filtro por estado desarrollo \r\n- Deseable grafica', 'Informe de desarrollos', 7, 'P', '2021-04-01 10:40:24'),
(59, 'A', '2021-03-29 02:23:31', 'Filtro por Empresas', 'Informe de empresas', 7, 'P', '2021-03-29 02:23:31'),
(60, 'A', '2021-03-29 02:25:42', 'El sistema permite realizar inició de sesión siempre y cuando el usuario ya este registrado', 'Login de usuario', 7, 'A', '2021-03-29 02:25:42'),
(61, 'A', '2021-03-29 02:29:10', 'El sistema permite el registro de nuevos usuarios (rol Cliente y Instructor), en caso de formar parte del equipo de desarrollo, se realizara el registro con uno de estos roles y el rol SM realizara la actualización del rol correspondiente.', 'Registro de usuario', 7, 'A', '2021-03-29 02:30:53'),
(62, 'A', '2021-03-29 02:29:58', 'El sistema permite asignar rol a SM \r\n(pendiente formulario)', 'Asignación de rol', 7, 'P', '2021-03-28 23:02:06'),
(63, 'A', '2021-03-29 02:33:00', '', 'Mostrar los roles por DB', 7, 'P', '2021-03-29 02:33:00'),
(66, 'B', '2021-03-28 22:57:34', '', 'Reloj js en nav', 7, 'P', '2021-03-28 22:57:34'),
(67, 'A', '2021-03-28 23:00:49', '- Filtro por fecha y hora Creación de requerimiento\r\n- Filtro por fecha y hora Actualización de requerimiento\r\n- Filtro por estado \r\nTodos los filtros al tiempo o solo uno o sin filtros, debe consultar sin novedad', 'Filtro en requerimientos', 7, 'A', '2021-03-28 23:06:07'),
(68, 'A', '2021-03-29 20:37:32', 'Debe contener 7 frutas indicando el nombre de la fruta, su imagen y una pequeña descripción.', 'Pagina principal de contenido informativo', 5, 'A', '2021-03-29 21:11:50'),
(69, 'M', '2021-03-29 20:38:42', 'Debe agregar una misión y visión de  internet de alguna tienda de frutas, además de datos de los dueños o administradores.', 'Información de la visón del establecimiento', 5, 'A', '2021-03-29 21:12:13'),
(70, 'M', '2021-03-29 20:39:42', 'Agregaremos información inventada sobre los domicilios, el coste, y el horario.', 'Información acerca de los domicilios', 5, 'A', '2021-03-29 21:12:29'),
(71, 'B', '2021-03-29 20:40:23', 'Información sobre la ubicación de la frutería (Google Maps), direcciones y teléfonos de contacto.', 'Contacto', 5, 'A', '2021-03-29 20:40:23'),
(72, 'A', '2021-03-29 20:43:24', 'El actor deberá acceder a la interfaz de login para \r\nasimismo poder ingresar al sistema.', 'Autenticación de usuario', 6, 'A', '2021-03-31 20:56:31'),
(73, 'A', '2021-03-29 20:45:55', 'La empresa requiere consultar información de los propietarios, conductores según al vehículo al que estén asignados', 'Consultar información', 6, 'A', '2021-03-29 20:45:55'),
(74, 'A', '2021-03-29 20:47:50', 'La empresa solicita buscar a sus conductores y propietarios a través de su numero de documento', 'Consulta a través de cedula', 6, 'A', '2021-03-29 20:47:50'),
(75, 'A', '2021-03-29 20:48:56', 'La empresa solicita buscar sus vehículos no solo a través de sus atributos si no principalmente de sus placas', 'Consulta a través de placa', 6, 'A', '2021-03-29 20:48:56'),
(76, 'M', '2021-03-29 20:50:17', 'La empresa solicita generar un informe donde se encuentre la información del propietario, conductor y vehículo junto con el modelo', 'Informe general', 6, 'A', '2021-03-29 20:50:17'),
(77, 'M', '2021-03-29 20:51:58', 'La empresa solicita que la base de datos se relacional y flexible para futuras mejoras', 'Base de datos', 6, 'A', '2021-03-29 20:51:58'),
(78, 'A', '2021-03-29 20:53:50', 'La empresa solicita que haya formularios de inscripción para cada conductor, propietario y vehículo con la respectiva información de cada uno', 'Formularios', 6, 'P', '2021-03-29 20:53:50'),
(79, 'M', '2021-03-29 20:54:12', 'La empresa solicita que cada información ingresada a la plataforma pueda ser actualizable, borrable y visible', 'Proceso CRUD', 6, 'A', '2021-03-29 20:56:17'),
(80, 'A', '2021-03-31 15:17:08', 'El sistema permite llevar a cabo el proceso de selección de productos y a si mismo acumulándolos mediante el carrito de compras', 'Carrito de compra', 1, 'A', '2021-03-31 15:17:08'),
(81, 'M', '2021-03-31 15:19:14', 'El sistema permite que cuando un nuevo usuario se une al sistema, le llega una notificación al administrador y este decide si darle o no permisos al usuario nuevo', 'Permisos por rol', 1, 'A', '2021-03-31 15:19:14'),
(82, 'M', '2021-03-31 15:21:44', 'El sistema permite que haya notificaciones en los que debe informar sobre: compras, errores, usuarios nuevos, inventario y ingreso de productos  nuevos', 'Notificaciones', 1, 'A', '2021-03-31 15:21:44'),
(83, 'B', '2021-03-31 15:24:26', 'El sistema contara con la ayuda de un chat bot, el cual es de utilidad para los usuarios nuevos con el sistema, incluso llegando a ser útil para notificar al administrador quien esta haciendo uso del mismo', 'Chat bot', 1, 'A', '2021-03-31 15:24:26'),
(84, 'M', '2021-03-31 15:27:47', 'El sistema cuenta con la filtración de muchos tipos de productos, visualizando así el inventario, los productos vendidos, los nuevos productos y los productos que faltan o están en rojo.', 'Visualización de productos', 1, 'A', '2021-03-31 15:27:47'),
(85, 'M', '2021-03-31 15:30:14', 'El sistema cuenta con un filtrado de información acerca de los usuarios, mostrando así todos los usuarios, los usuarios deshabilitados y habilitados, usuarios por rol o inclusive mostrándolos por la fecha en la que ingresaron al sistema', 'Visualización de usuarios', 1, 'A', '2021-03-31 15:30:14'),
(86, 'M', '2021-03-31 15:33:32', 'El sistema cuenta con un informe a través de graficas en donde muestra cual es el mes en que se a vendido mas o cual a sido el mes en donde se a sufrido un decremento en las ventas, mostrando no solo las ventas si no también el estado de los productos y el estado de la caja', 'Informe a través de graficas', 1, 'A', '2021-03-31 15:33:32'),
(87, 'M', '2021-03-31 15:34:28', 'El sistema cuenta con un filtrado de información acerca de los usuarios, mostrando así todos los usuarios, los usuarios deshabilitados y habilitados, usuarios por rol o inclusive mostrándolos por la fecha en la que ingresaron al sistema', 'Visualización de usuarios', 1, 'A', '2021-03-31 15:34:28'),
(88, 'M', '2021-03-31 15:34:42', 'El sistema cuenta con un informe a través de graficas en donde muestra cual es el mes en que se a vendido mas o cual a sido el mes en donde se a sufrido un decremento en las ventas, mostrando no solo las ventas si no también el estado de los productos y el estado de la caja', 'Informe a través de graficas', 1, 'A', '2021-03-31 15:34:42'),
(89, 'M', '2021-03-31 15:36:10', 'El sistema cuenta con una asignación de citas, en donde el paciente llena un formulario y el nutricionista decide si asignarle o no una cita', 'Asignación de citas', 2, 'A', '2021-03-31 15:36:10'),
(90, 'M', '2021-04-24 14:44:15', 'Crear insert de foto que suba al hosting y recorrer imágenes en vista según el perfil.', 'Foto User', 7, 'P', '2021-04-24 14:44:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_avances`
--

CREATE TABLE `log_avances` (
  `id_avance` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `fk_tarea` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `log_avances`
--

INSERT INTO `log_avances` (`id_avance`, `fecha`, `tipo`, `fk_tarea`) VALUES
(1, '2021-04-04 10:24:23', 'I', 1),
(2, '2021-04-04 10:38:34', 'T', 1),
(3, '2021-04-04 10:41:15', 'I', 2),
(5, '2021-04-04 10:43:26', 'T', 2),
(8, '2021-04-04 13:58:15', 'I', 3),
(11, '2021-04-04 15:04:31', 'I', 5),
(14, '2021-04-04 15:26:55', 'T', 2),
(15, '2021-04-04 15:27:05', 'T', 3),
(16, '2021-04-04 15:28:19', 'T', 8),
(17, '2021-04-04 15:32:48', 'T', 5),
(18, '2021-04-11 15:14:46', 'I', 1),
(19, '2021-04-11 15:16:12', 'I', 4),
(20, '2021-04-11 15:16:37', 'T', 4),
(21, '2021-04-11 15:25:52', 'I', 15),
(22, '2021-04-11 20:24:14', 'T', 15),
(23, '2021-04-24 15:03:18', 'I', 1),
(24, '2021-12-21 17:33:22', 'T', 15),
(25, '2021-12-21 17:33:51', 'I', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_medicines`
--

CREATE TABLE `log_medicines` (
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `log_medicines`
--

INSERT INTO `log_medicines` (`created_at`, `updated_at`, `medicine_id`) VALUES
('2023-02-04 20:33:39', '2023-02-04 20:33:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_peticion`
--

CREATE TABLE `log_peticion` (
  `id` int(11) NOT NULL,
  `body` json DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `log_peticion`
--

INSERT INTO `log_peticion` (`id`, `body`, `created_at`) VALUES
(12, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:19:54'),
(13, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:19:57'),
(14, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:22:19'),
(15, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:22:38'),
(16, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:22:48'),
(17, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:35:18'),
(18, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:35:20'),
(19, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-27 17:40:34'),
(20, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-27 18:09:14'),
(21, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-27 23:48:41'),
(22, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-27 23:48:41'),
(23, '{\"ip\": \"190.24.59.100\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-27 23:48:54'),
(24, '{\"ip\": \"2605:4c40:4:9d34:0:7467:6b9e:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 07:56:11'),
(25, '{\"ip\": \"2605:4c40:4:9d34:0:7467:6b9e:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 07:56:26'),
(26, '{\"ip\": \"2605:4c40:4:9d34:0:7467:6b9e:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 07:56:41'),
(27, '{\"ip\": \"2605:4c40:4:9d34:0:7467:6b9e:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 07:59:11'),
(28, '{\"ip\": \"2605:4c40:4:de4a:0:e5f3:aea9:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 07:59:11'),
(29, '{\"ip\": \"2605:4c40:4:9d34:0:7467:6b9e:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 07:59:25'),
(30, '{\"ip\": \"2605:4c40:4:de4a:0:e5f3:aea9:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 07:59:26'),
(31, '{\"ip\": \"2605:4c40:4:9d34:0:7467:6b9e:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 08:01:11'),
(32, '{\"ip\": \"2605:4c40:4:de4a:0:e5f3:aea9:1\", \"api_case\": \"log_ingreso\", \"proyect_id\": 9}', '2024-05-28 08:01:11'),
(33, '{\"ip\": \"181.51.34.207\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 16:02:50'),
(34, '{\"ip\": \"181.51.34.207\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 16:02:53'),
(35, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 17:22:36'),
(36, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 17:23:02'),
(37, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 17:31:48'),
(38, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 17:56:56'),
(39, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 18:33:04'),
(40, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 18:33:26'),
(41, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 18:33:39'),
(42, '{\"ip\": \"UNKNOWN\", \"api_case\": \"log_ingreso\", \"proyect_id\": 10}', '2024-05-28 18:55:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `descript` varchar(250) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `interval_days` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `status`, `descript`, `quantity`, `interval_days`, `created_at`, `update_at`) VALUES
(1, 'dutasterida', 1, 'Tomar dia por medion', 50, 1, '2023-02-04 20:31:40', '2023-02-04 20:31:40'),
(2, 'Vitaminas dtr pulido', 1, 'Tomar dia por medion', 50, 1, '2023-02-04 20:31:40', '2023-02-04 20:31:40'),
(3, 'vitamina d', 1, NULL, NULL, 5, '2023-02-04 20:31:40', '2023-02-04 20:31:40'),
(4, 'vitamina c', 1, NULL, 80, 0, '2023-02-04 20:31:40', '2023-02-04 20:31:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_crea` datetime NOT NULL,
  `coste` int(10) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_termina` datetime DEFAULT NULL,
  `fk_empresa` int(11) DEFAULT NULL,
  `fk_equipo` int(11) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `has_requirements` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `status`, `fecha_crea`, `coste`, `descripcion`, `fecha_termina`, `fk_empresa`, `fk_equipo`, `nom`, `has_requirements`) VALUES
(1, 1, '2021-03-18 13:25:11', 55000000, '../sicloud/', '2021-03-09 14:37:59', 1, 1, 'Sicloud', 1),
(2, 1, '2021-03-18 13:25:11', NULL, '../sporthealth', '2021-03-09 14:37:59', 2, 1, 'Sporthealth', 1),
(3, 0, '2021-03-18 13:25:11', NULL, 'http://larave-developer.herokuapp.com/login', '2021-03-09 14:37:59', 4, 1, 'Ficha - laravel', 0),
(4, 1, '2021-03-18 13:25:11', NULL, '../amoblando/', '2021-03-09 14:37:59', 3, 1, 'Amoblando', 1),
(5, 0, '2021-03-16 16:14:50', NULL, 'javascipt:;', NULL, 6, 1, 'Fruteria', 0),
(6, 0, '2021-03-18 13:25:11', 0, 'javascipt:;', '2021-03-09 14:37:59', 5, 1, 'Transportes', 0),
(7, 1, '2021-03-18 13:25:11', NULL, 'javascipt:;', NULL, 7, 1, 'sicloud-dev(Este sistema)', 1),
(8, 1, '2023-11-20 01:10:16', NULL, 'https://solucionesintegralesmallorca.com/', NULL, NULL, NULL, 'Soluciones integrales', 0),
(9, 1, '2023-11-20 01:10:16', NULL, 'https://prueba-alegra-javierrn.fly.dev/', '2021-03-09 14:37:59', 9, 1, 'Larave-vue', 0),
(10, 1, '2023-11-20 01:10:16', NULL, 'https://javier-reyes-neira-laravel-angular.fly.dev/', '2021-03-09 14:37:59', 10, 1, 'Laravel-angular', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reuniones`
--

CREATE TABLE `reuniones` (
  `id_reunion` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `color` varchar(40) NOT NULL,
  `text_color` varchar(40) NOT NULL,
  `fecha_crea` datetime DEFAULT NULL,
  `fecha_reunion` datetime DEFAULT NULL,
  `status` varchar(5) NOT NULL,
  `fk_equipo` int(11) DEFAULT NULL,
  `fk_tipo` int(11) DEFAULT NULL,
  `fk_us` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reuniones`
--

INSERT INTO `reuniones` (`id_reunion`, `title`, `descripcion`, `color`, `text_color`, `fecha_crea`, `fecha_reunion`, `status`, `fk_equipo`, `fk_tipo`, `fk_us`) VALUES
(1, 'Celebración', 'celebración de pepito', '#FF01F0', '#FFFFFF', '2021-04-01 00:00:00', '2021-04-01 09:35:00', 'A', 1, 2, 0),
(2, 'Titulo', 'Descripcion', '#934d4d', '#FFFFFF', '2021-04-01 22:49:41', '2021-04-07 22:52:00', 'P', 1, 1, 1),
(3, 'Cumeplaños', 'Cumpleaños de jasinto', '#7a4343', '#FFFFFF', '2021-04-01 23:31:18', '2021-04-02 14:30:00', 'P', 2, 1, 1),
(4, 'Cumeplaños', 'Sandra', '#10ace0', '#FFFFFF', '2021-04-01 23:33:48', '2021-04-02 23:36:00', 'P', 2, 1, 1),
(15, 'Cumpleaños', 'De pepito 2', '#1aba17', '#FFFFFF', '2021-04-02 00:14:03', '2021-04-10 23:54:00', 'P', 2, 1, 1),
(16, 'Prueba de calendario', '', '#927611', '#FFFFFF', '2021-04-02 00:16:04', '2021-04-07 00:18:00', 'P', 1, 2, 1),
(17, 'Prueba de calendario', '', '#927611', '#FFFFFF', '2021-04-02 00:17:21', '2021-04-07 00:18:00', 'P', 1, 2, 1),
(18, 'Dearrollo', 'Prueba', '#3b96b5', '#FFFFFF', '2021-04-02 00:30:33', '2021-04-02 00:33:00', 'P', 1, 2, 11),
(19, 'Prueba', 'Prueba de desarrollo calendario', '#ff0000', '#FFFFFF', '2021-04-02 10:21:54', '2021-04-22 10:24:00', 'P', 1, 1, 11),
(20, 'Validación de requerimientos', 'Se debe recolectar la informacion para el posterior desarrollo', '#268256', '#FFFFFF', '2021-04-02 10:24:47', '2021-04-23 11:23:00', 'P', 2, 1, 1),
(21, 'Prueba', 'Se prueba el desarrollo de calendario', '#3a65cb', '#FFFFFF', '2021-04-02 10:25:52', '2021-04-30 00:25:00', 'P', 1, 1, 11),
(22, 'Reunión', 'Se valida cambios generales de sicloud', '#26b5ab', '#FFFFFF', '2021-04-11 15:18:17', '2021-04-04 16:17:00', 'P', 1, 6, 9),
(23, 'Dearrollo', 'Dgf', '#42cdbc', '#FFFFFF', '2021-04-11 15:20:07', '2021-04-22 18:19:00', 'P', 1, 5, 14),
(24, 'Dearrollo Reuniones', 'Reunion de presentacion', '#235786', '#FFFFFF', '2021-04-24 15:05:53', '2021-04-14 15:08:00', 'P', 1, 2, 11),
(25, '', '', '#ff0000', '#FFFFFF', '2021-08-16 13:42:11', '2021-07-28 00:00:00', 'P', 1, 2, 9),
(26, 'Reunion 1', '', '#ff0000', '#FFFFFF', '2021-08-16 13:45:47', '2021-07-28 13:48:00', 'P', 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_acro` varchar(5) NOT NULL,
  `nom_rol` varchar(35) NOT NULL,
  `descript` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_acro`, `nom_rol`, `descript`) VALUES
('C', 'Cliente', NULL),
('I', 'Instructor', NULL),
('PO', 'Product Owner', ' Representante de lso accionistas y clientes que usan el software. Se focaliza en la parte de negocio y el es responsable del ROI del proyecto (entregar un valor superior al dinero invertido). Traslad'),
('SM', 'Scrum master', 'Persona que lidera al equipo guiándolo para que cumpla las reglas y procesos de la metodología. Gestiona la reducción de impedimentos del proyecto y trabaja con el Product Owner para maximizar el ROI.'),
('TM', 'Team Development', 'Grupo de profesionales con los conocimientos técnicos necesarios y que desarrollan el proyecto de manera conjunta llevando a cabo las historias a las que se comprometen al inicio de cada sprint.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shopify_products_on_sale`
--

CREATE TABLE `shopify_products_on_sale` (
  `id` int(11) NOT NULL,
  `product_shopify_id` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `shopify_products_on_sale`
--

INSERT INTO `shopify_products_on_sale` (`id`, `product_shopify_id`, `sku`, `created_at`) VALUES
(1, 'test', 'test', '2024-02-28 15:11:46'),
(2, 'test', 'test', '2024-02-28 15:11:47'),
(3, 'test', 'test', '2024-02-28 15:11:48'),
(4, 'test', 'test', '2024-02-28 15:16:37'),
(5, 'test', 'test', '2024-02-28 15:16:58'),
(6, 'test', 'test', '2024-02-28 15:16:59'),
(7, 'test', 'test', '2024-02-28 15:17:00'),
(8, 'test', 'test', '2024-02-28 15:17:12'),
(9, 'test', 'test', '2024-02-28 15:17:13'),
(10, 'test', 'test', '2024-02-28 15:17:14'),
(11, 'test', 'test', '2024-02-28 15:17:28'),
(12, 'test', 'test', '2024-02-28 15:17:29'),
(13, 'test', 'test', '2024-02-28 15:17:29'),
(14, 'test', 'test', '2024-02-28 15:18:16'),
(15, 'test', 'test', '2024-02-28 15:18:17'),
(16, 'test', 'test', '2024-02-28 15:18:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `skills`
--

CREATE TABLE `skills` (
  `id_skill` int(11) NOT NULL,
  `nom` varchar(35) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `fecha_asig` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  `fk_us` int(11) NOT NULL,
  `descript` varchar(200) DEFAULT NULL,
  `tiempo_plan_h` varchar(30) DEFAULT NULL,
  `esfuerzo_estimado` int(11) DEFAULT NULL,
  `fk_proyecto` int(11) NOT NULL,
  `fecha_update` datetime DEFAULT NULL,
  `user_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `nom`, `fecha_asig`, `status`, `fk_us`, `descript`, `tiempo_plan_h`, `esfuerzo_estimado`, `fk_proyecto`, `fecha_update`, `user_update`) VALUES
(1, 'Migración', '2020-12-01 00:00:00', 'I', 1, 'Se debe migrar todo el BK del Proyecto a framework', '10', 2190, 1, '2021-04-24 15:03:18', 1),
(2, 'From index', '2020-11-01 00:00:00', 'T', 11, 'constricción de index del proyecto en frond-end', '9', 8, 1, '2021-04-04 15:26:55', 1),
(3, 'Crud user', '2021-04-03 15:42:32', 'T', 1, 'Desarrollo del bk-end', '2', 10, 1, '2021-04-04 15:27:05', 1),
(4, 'Carrito de compraspras', '2021-04-13 00:00:00', 'T', 1, 'Desarrollo del controller carrito de compras.', '9', 20, 1, '2021-04-11 15:16:37', 1),
(5, 'Facturacion interna', '2021-04-13 00:00:00', 'T', 1, 'Generación de facturas', '24', 10, 1, '2021-04-04 15:32:48', 1),
(6, 'Update de inventario', '2021-04-03 18:12:21', 'P', 1, 'Una vez  se facture un producto, el mismo debe descontarse de inventario', '10', 8, 1, '2021-04-04 10:25:36', 1),
(7, 'Foto user', '2021-04-03 18:12:21', 'P', 1, 'Una vez el user se registre la foto que selección', '5', 8, 3, '2021-04-04 15:00:03', 1),
(8, 'Nav', '2021-04-03 18:17:12', 'T', 1, 'El nav debe construirse con array de permisos de DB segun el rol del user', '9', 10, 1, '2021-04-04 15:28:19', 1),
(9, 'Dearrollo de framework', '2021-04-03 18:17:12', 'P', 1, 'Desarrollar framework, totalmente seguro en php puro', '24', 10, 1, '2021-04-04 10:26:34', 1),
(11, 'Crud de user', '2021-04-03 18:19:59', 'P', 1, 'Crud de usarios', '10', 8, 1, '2021-04-04 10:26:18', 1),
(12, 'JS', '2021-04-03 23:40:32', 'P', 1, 'js que cambie el div en index', '8', 4, 2, '2021-04-04 00:51:54', 1),
(13, 'Crud', '2021-04-03 23:40:32', 'P', 1, 'bk-end de proyecto', '8', 7, 4, '2021-04-04 00:52:29', 1),
(14, 'DB', '2021-04-04 00:52:50', 'P', 1, 'Crear db', '7', 10, 4, '2021-04-04 00:52:50', 1),
(15, 'Prue F', '2021-04-11 15:25:37', 'I', 14, 'Validación de la correcta ejecución de sicloud', '8', 8, 1, '2021-12-21 17:33:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tikets`
--

CREATE TABLE `tikets` (
  `id_tiket` int(11) NOT NULL,
  `fecha_crea` datetime NOT NULL,
  `fecha_ini` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `status` varchar(5) NOT NULL,
  `fk_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_reunion`
--

CREATE TABLE `tipo_reunion` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `descript` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_reunion`
--

INSERT INTO `tipo_reunion` (`id`, `nom`, `descript`) VALUES
(1, 'Externa', 'Esta Reunión es externa al sistema'),
(2, 'Interna', 'Sin categorizar, solo se requiere de carácter extraordinario'),
(3, 'Sprint Planning', 'Al comienzo del Sprint, sirve para inspeccionar el Backlog del Producto (Product Backlog ) y que el equipo de desarrollo seleccione los Product Backlog Items en los que va a trabajar durante el siguiente Sprint. Estos Product Backlog Items son los que compondrán el Sprint Backlog.\r\n\r\nDurante esta reunión, el product owner presenta el Product Backlog actualizado que el equipo de desarrollo se encarga de estimar, además de intentar clarificar aquellos ítems que crea necesarios.'),
(4, 'Daily Scrums', 'A diario, El Daily Scrum, conocido comúnmente sólo como “La Daily”, es una reunión diaria de 15 minutos en la que participa exclusivamente el Development Team.\r\n\r\nEn esta reunión todas y cada una de las personas del Development Team responden a las siguientes preguntas:\r\n\r\n¿Qué hice ayer para contribuir al Sprint Goal?\r\n¿Qué voy a hacer hoy para contribuir al Sprint Goal?\r\n¿Tengo algún impedimento que me impida entregar?\r\nMucha gente confunde el Daily Scrum con el Standup Meeting, sin embargo, este último es una práctica de eXtreme Programming (XP) orientada a controlar y gestionar el trabajo motivada por un manager, mientras que el primer término, Daily Scrum, hace referencia a la práctica que permite la inspección y adaptación a través de la auto-organización del equipo.'),
(5, 'Sprint Review', 'Al final del Sprint para inspeccionar el incremento realizado.\r\nEl Sprint Review es la reunión que ocurre al final del Sprint, generalmente el último viernes del Sprint, donde el product owner y el Develpment Team presentan a los stakeholders el incremento terminado para su inspección y adaptación correspondientes. En esta reunión organizada por el product owner se estudia cuál es la situación y se actualiza el Product Backlog con las nuevas condiciones que puedan afectar al negocio.\r\n\r\nEl equipo ha pasado hasta cuatro semanas desarrollando un incremento terminado de software que ahora mostrará a los stakeholders. No se trata de una demostración, sino de una reunión de trabajo. El software ya ha sido mostrado y validado junto con el product owner previamente a esta reunión.'),
(6, 'Retrospectiva', 'Al finalmente, una Retrospectiva para inspeccionar el equipo y levantar mejoras que se apliquen en el siguiente Sprint.'),
(7, 'Sprint Grooming', 'El refinamiento del Product Backlog es una práctica recomendada para asegurar que éste siempre esté preparado. Esta ceremonia sigue un patrón similar al resto y tiene una agenda fija específica en cada Sprint. Se estima su duración en 2 horas máximo por semana del Sprint. Es responsabilidad del product owner agendar, gestionar y dirigir esta reunión.\r\n\r\nLos participantes de esta reunión son todo el equipo Scrum, así como cualquier recurso adicional que considere necesario el PO y que pueda contribuir a aclarar el requerimiento. Es necesario, por tanto, que antes de la reunión todos conozcan los requerimientos o historias de usuario que van a ser tratados en la misma y sólo asistan aquellos cuya presencia sea estrictamente relevante.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_us` int(11) NOT NULL,
  `documento` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nom1` varchar(20) NOT NULL,
  `nom2` varchar(20) DEFAULT NULL,
  `ape1` varchar(20) NOT NULL,
  `ape2` varchar(20) NOT NULL,
  `fecha_n` date NOT NULL,
  `fecha_crea` datetime DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `foto` varchar(30) DEFAULT NULL,
  `correo` varchar(30) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `status` varchar(11) NOT NULL,
  `fk_rol` varchar(5) NOT NULL,
  `fk_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_us`, `documento`, `nom1`, `nom2`, `ape1`, `ape2`, `fecha_n`, `fecha_crea`, `telefono`, `direccion`, `foto`, `correo`, `password`, `status`, `fk_rol`, `fk_equipo`) VALUES
(1, '543', 'Javier', 'H', 'Reyes', 'Neira', '2021-03-15', '2021-03-18 13:25:11', '310 478 69 58', 'Calle 2 sur no 22 44', 'fds', 'jav-rn@hotmail.com', '1', 'A', 'SM', 1),
(6, '', 'Diego', 'Martin', 'Rodríguez ', 'Gómez', '2021-03-15', '2021-03-28 21:48:48', 'cel', 'dir', '', 'corr@fff.com', 'pass', 'A', 'I', 3),
(7, '', 'Juan', 'Oliver', 'López', 'González', '2021-03-15', '2021-03-28 22:03:00', 'cel', 'dir', '', 'corr@fff.com', 'pass', 'A', 'I', 3),
(8, '', 'Guillermo', 'Jesús', 'Díaz', 'Hernández ', '2021-03-15', '2021-03-28 22:03:30', 'cel', 'dir', '', 'corr@fff.com', 'pass', 'A', 'I', 3),
(9, '', 'Miguel', 'Mario', 'García', 'Sánchez', '2021-03-10', '2021-03-28 22:06:01', '123', 'phpmyadmin', '', 'corr@fff.com', '2', 'A', 'C', 2),
(10, '', 'Erik', 'Alberto', 'Martínez', 'Ramírez ', '2021-03-12', '2021-03-28 22:08:52', '123', 'phpmyadmin', '', 'corr@fff.com', 'fddd', 'A', 'I', 3),
(11, '', 'Fabian', 'Lopez', 'Pérez', 'Torres', '2021-03-11', '2021-03-29 12:34:08', '1111111', 'cll xx- xxx- xxx', '', 'admin@hotmail.com', 'admin', 'A', 'TM', 3),
(12, '', 'Felix', 'lopez', 'Torres', 'Moreno', '2021-04-14', '2021-04-03 19:49:41', '123123412', 'cll 10 -- xxx x', '', 'prueba@gmail.com', '1', 'A', 'TM', 1),
(13, '', 'David', 'Angel', 'Rincon', 'Lopez', '2021-04-11', '2021-04-11 09:28:07', '', '', '', 'cuentafalsa@hotmail.com', '123', 'A', 'TM', 1),
(14, '', 'Daniel', 'Armndo', 'Correa', 'Cuervo', '2021-04-13', '2021-04-11 09:35:56', '1234567', 'cll 17b #35b-96', '', '903danielruiz@gmail.com', 'Uno2345678', 'A', 'TM', 1),
(15, '', 'Angel', 'Alejandro', 'Duran', 'Pulido', '2021-04-12', '2021-04-11 09:36:02', '3108097578', 'Call 23 66 kajaj', '', 'angel@gmail.com', '1', 'A', 'TM', 1),
(16, '', 'Hugo', 'Luiz', 'Rojas', 'Moreno ', '2021-05-20', '2021-04-18 19:34:28', 'asdad', 'dasdad', '', 'prueba@gmail.com', '1', 'A', 'C', 2),
(17, '', 'Joaquín', 'Damián', 'prueba', 'prueba', '2021-05-20', '2021-04-18 19:35:46', 'prueba', 'prueba', '', 'prueba5@gmail.com', 'prueba', 'A', 'C', 2),
(18, '', '', '', '', '', '1969-12-31', '2021-12-21 18:05:20', '', '', '', '', '', 'A', 'C', 2),
(19, '', 'Pedro', 'N', 'Perez', 'Daza', '2021-12-07', '2021-12-21 18:23:14', '7324869', 'calle 26 No 8 - 08', '', 'jhreyes483@misena.edu.co', '$0ndest17*', 'A', 'C', 2),
(20, '', 'Miguel', 'N', 'Perez', 'Daza', '2021-12-07', '2021-12-21 18:25:08', '7324869', 'calle 26 No 8 - 08', '', 'jhreyes483@misena.edu.co', '$0ndest17*', 'A', 'C', 2),
(21, '', '', '', '', '', '1969-12-31', '2023-02-02 21:57:52', '', '', '', '', '', 'A', 'C', 2),
(22, '', '', '', '', '', '1969-12-31', '2023-02-02 21:57:53', '', '', '', '', '', 'A', 'C', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_skills`
--

CREATE TABLE `users_skills` (
  `fk_us` int(11) NOT NULL,
  `fk_skill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type_event_x` (`type_event_id`);

--
-- Indices de la tabla `historias_requerimientos`
--
ALTER TABLE `historias_requerimientos`
  ADD PRIMARY KEY (`id_h`),
  ADD KEY `fk_proyecto_r` (`fk_proyecto`);

--
-- Indices de la tabla `log_avances`
--
ALTER TABLE `log_avances`
  ADD PRIMARY KEY (`id_avance`),
  ADD KEY `fk_tareas` (`fk_tarea`);

--
-- Indices de la tabla `log_medicines`
--
ALTER TABLE `log_medicines`
  ADD KEY `log_medicines_fk_medicines` (`medicine_id`);

--
-- Indices de la tabla `log_peticion`
--
ALTER TABLE `log_peticion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `fk_empresa` (`fk_empresa`),
  ADD KEY `fk_equipo_proyecto` (`fk_equipo`);

--
-- Indices de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD PRIMARY KEY (`id_reunion`),
  ADD KEY `fk_reuniones` (`fk_equipo`),
  ADD KEY `fk_tipo_reunion` (`fk_tipo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_acro`);

--
-- Indices de la tabla `shopify_products_on_sale`
--
ALTER TABLE `shopify_products_on_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id_skill`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `fk_id_us` (`fk_us`),
  ADD KEY `fk_tareas_proyectos` (`fk_proyecto`);

--
-- Indices de la tabla `tikets`
--
ALTER TABLE `tikets`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `fk_equipo` (`fk_equipo`);

--
-- Indices de la tabla `tipo_reunion`
--
ALTER TABLE `tipo_reunion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_us`),
  ADD KEY `fk_rol_users` (`fk_rol`),
  ADD KEY `fk_equipos_users` (`fk_equipo`);

--
-- Indices de la tabla `users_skills`
--
ALTER TABLE `users_skills`
  ADD PRIMARY KEY (`fk_us`,`fk_skill`),
  ADD KEY `users_skills_skill` (`fk_skill`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;

--
-- AUTO_INCREMENT de la tabla `historias_requerimientos`
--
ALTER TABLE `historias_requerimientos`
  MODIFY `id_h` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `log_avances`
--
ALTER TABLE `log_avances`
  MODIFY `id_avance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `log_peticion`
--
ALTER TABLE `log_peticion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  MODIFY `id_reunion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `shopify_products_on_sale`
--
ALTER TABLE `shopify_products_on_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `skills`
--
ALTER TABLE `skills`
  MODIFY `id_skill` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tikets`
--
ALTER TABLE `tikets`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `proyect_log` FOREIGN KEY (`type_event_id`) REFERENCES `proyectos` (`id_proyecto`);

--
-- Filtros para la tabla `historias_requerimientos`
--
ALTER TABLE `historias_requerimientos`
  ADD CONSTRAINT `fk_proyecto_r` FOREIGN KEY (`fk_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `log_avances`
--
ALTER TABLE `log_avances`
  ADD CONSTRAINT `fk_tareas` FOREIGN KEY (`fk_tarea`) REFERENCES `tareas` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `log_medicines`
--
ALTER TABLE `log_medicines`
  ADD CONSTRAINT `log_medicines_fk_medicines` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`fk_empresa`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipo_proyecto` FOREIGN KEY (`fk_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD CONSTRAINT `fk_reuniones` FOREIGN KEY (`fk_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_reunion` FOREIGN KEY (`fk_tipo`) REFERENCES `tipo_reunion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_id_us` FOREIGN KEY (`fk_us`) REFERENCES `users` (`id_us`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tareas_proyectos` FOREIGN KEY (`fk_proyecto`) REFERENCES `proyectos` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tikets`
--
ALTER TABLE `tikets`
  ADD CONSTRAINT `fk_equipo` FOREIGN KEY (`fk_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_equipos_users` FOREIGN KEY (`fk_equipo`) REFERENCES `equipos` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rol_users` FOREIGN KEY (`fk_rol`) REFERENCES `roles` (`id_acro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_skills`
--
ALTER TABLE `users_skills`
  ADD CONSTRAINT `users_skills` FOREIGN KEY (`fk_us`) REFERENCES `users` (`id_us`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_skills_skill` FOREIGN KEY (`fk_skill`) REFERENCES `skills` (`id_skill`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
