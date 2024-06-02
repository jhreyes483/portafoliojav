-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: bzsvpsfy9oknkorinigg-mysql.services.clever-cloud.com:3306
-- Tiempo de generación: 02-06-2024 a las 00:37:06
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
-- Base de datos: `bzsvpsfy9oknkorinigg`
--
CREATE DATABASE IF NOT EXISTS `bzsvpsfy9oknkorinigg` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bzsvpsfy9oknkorinigg`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `ID_a` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descript` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `FK_tipoA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`ID_a`, `nombre`, `descript`, `fecha`, `FK_tipoA`) VALUES
(1, 'Herramientas Manuales', '\r\nAlicates Universales, Alicates de Corte, Alicates de Puntas, Atornilladores, Picotas Chuzos, Escaleras y Carretillas, Espátulas, Espátulas, Formones, Juegos de Llaves, Llaves Ajustables, Llaves Francesas, Llaves Punta Corona, Martillos, Mazos', '2021-01-16', 1),
(2, 'Herramientas Electricas.', 'Taladros sin cable, Taladros con cable, Sierras, Herramientas elétricas . Destornilladores eléctricos Martillos perforadores Amoladoras eléctrica, Lijadoras eléctricas, Sierras circulares Cepillos eléctricos, Fresadoras eléctricas, Pistolas para pintar.', '2022-01-16', 1),
(3, 'Materiales construccion', 'productos manufacturados que son necesarios en las labores de construcción de edificaciones o en las obras de ingeniería civil.', '2021-01-16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio` (
  `ID_barrio` int(11) NOT NULL,
  `nom_barrio` varchar(25) NOT NULL,
  `FK_localidad` int(11) NOT NULL,
  `FK_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `barrio`
--

INSERT INTO `barrio` (`ID_barrio`, `nom_barrio`, `FK_localidad`, `FK_ciudad`) VALUES
(1, 'Bella suiza', 1, 1),
(2, 'Bellavista', 1, 1),
(3, 'Bosque Medina', 1, 1),
(4, 'Santa Barbara', 1, 1),
(5, 'San gabriel', 1, 1),
(6, 'El pedregal', 1, 1),
(7, 'Francisco Miranda', 1, 1),
(8, 'La Esperanza', 1, 1),
(9, 'Unicerros', 1, 1),
(10, 'El pañuelito', 1, 1),
(11, 'Bellavista', 2, 1),
(12, 'La cabrera', 2, 1),
(13, 'San isidro', 2, 1),
(14, 'Los Rosales', 2, 1),
(15, 'Chapinero alto', 2, 1),
(16, 'El castillo', 2, 1),
(17, 'Los Olivos', 2, 1),
(18, 'Villa Anita', 2, 1),
(19, 'Nueva Granada', 2, 1),
(20, 'Chapinero central', 2, 1),
(21, 'La Merced', 3, 1),
(22, 'San Martin', 3, 1),
(23, 'La Alameda', 3, 1),
(24, 'Veracruz', 3, 1),
(25, 'Santa ines', 3, 1),
(26, 'Las Cruces', 3, 1),
(27, 'Egipto', 3, 1),
(28, 'Girardot', 3, 1),
(29, 'Cartagena', 3, 1),
(30, 'San bernardo', 3, 1),
(31, 'San Blas', 4, 1),
(32, 'Horacio Orjuela', 4, 1),
(33, 'Los laureles', 4, 1),
(34, 'Molinos del Oriente', 4, 1),
(35, 'Buenos aires', 4, 1),
(36, 'La Gran Colombia', 4, 1),
(37, 'El Rodeo', 4, 1),
(38, 'Panorama', 4, 1),
(39, 'Antioquia', 4, 1),
(40, 'Los Libertadores San isid', 4, 1),
(41, 'La igualdad', 5, 1),
(42, 'Las Americas', 5, 1),
(43, 'Ciudad Kennedy', 5, 1),
(44, 'Nueva Marsella', 5, 1),
(45, 'Centro Americas', 5, 1),
(46, 'Castilla', 5, 1),
(47, 'Osorio', 5, 1),
(48, 'El Jordan', 5, 1),
(49, 'Las Luces', 5, 1),
(50, 'Maria Paz', 5, 1),
(51, 'Santa Lucia', 6, 1),
(52, 'Nuevo Muzu', 6, 1),
(53, 'Rincon de Venecia', 6, 1),
(54, 'Ciudad tunal', 6, 1),
(55, 'San Benito', 6, 1),
(56, 'Venecia Occidental', 6, 1),
(57, 'San Carlos', 6, 1),
(58, 'Villa Ximena', 6, 1),
(59, 'Santa Lucia', 6, 1),
(60, 'Abraham Lincoln', 6, 1),
(61, 'Villa Karen', 7, 1),
(62, 'El Recreo', 7, 1),
(63, 'Barrio El jardin', 7, 1),
(64, 'Las Mercedes', 7, 1),
(65, 'Villa Natalia', 7, 1),
(66, 'Bosa Central', 7, 1),
(67, 'Barrio Bosa', 7, 1),
(68, 'La Esperanza', 7, 1),
(69, 'La Riviera', 7, 1),
(70, 'Arabia', 8, 1),
(71, 'Fontibon Centro', 8, 1),
(72, 'Tintal Central', 8, 1),
(73, 'Flandes', 8, 1),
(74, 'La cabaña', 8, 1),
(75, 'Versalles', 8, 1),
(76, 'Ciudad Salitre Occidente', 8, 1),
(77, 'Ciudad Hayuelos', 8, 1),
(78, 'Montevideo', 8, 1),
(79, 'La Rosito', 8, 1),
(80, 'Bachue', 9, 1),
(81, 'Bochica', 9, 1),
(82, 'Barrio Luz', 9, 1),
(83, 'Boyaca', 9, 1),
(84, 'Ciudadela Colsubsidio', 9, 1),
(85, 'El cortijo', 9, 1),
(86, 'Minuto de dios', 9, 1),
(87, 'Normandia', 9, 1),
(88, 'Normandia', 9, 1),
(89, 'Quirigua', 9, 1),
(90, 'Britalia', 10, 1),
(91, 'Alcala', 10, 1),
(92, 'Bernal', 10, 1),
(93, 'Sultana', 10, 1),
(94, 'El recreo', 10, 1),
(95, 'Miraflores', 10, 1),
(96, 'Escuela de Carabineros', 10, 1),
(97, 'Ciudad jardin Norte', 10, 1),
(98, 'Acacias', 10, 1),
(99, 'La campiña', 10, 1),
(100, 'Acevedo Tejado', 11, 1),
(101, 'Alfonso Lopez', 11, 1),
(102, 'Armenia', 11, 1),
(103, 'Banco Central', 11, 1),
(104, 'Banco Central', 11, 1),
(105, 'Centro Nariño', 11, 1),
(106, 'Chapinero Occidental', 11, 1),
(107, 'El Recuerdo', 11, 1),
(108, 'Chicala', 7, 1),
(108, 'Gran America', 11, 1),
(109, 'La Esmeralda', 11, 1),
(110, 'La soledad', 12, 1),
(111, 'El campin', 12, 1),
(112, 'La ciudad Universitaria', 12, 1),
(113, 'La Esmeralda', 12, 1),
(114, 'Tejada', 12, 1),
(115, 'Gran America', 12, 1),
(116, 'Ciudad Salitre', 12, 1),
(117, 'Simon Bolivar', 12, 1),
(118, 'Palermo', 12, 1),
(119, 'Ciudad Salitre', 12, 1),
(120, 'Veraguas', 13, 1),
(121, 'Santa Isabel', 13, 1),
(122, 'El progreso', 13, 1),
(123, 'San Victorino', 13, 1),
(124, 'Panamericano-La Florida', 13, 1),
(125, 'Samper Mendoza', 13, 1),
(126, 'Ricaurte', 13, 1),
(127, 'Paloquemao', 13, 1),
(128, 'La favorita', 13, 1),
(129, 'Estacion de la Sabana', 13, 1),
(130, 'Caracas', 14, 1),
(131, 'Ciudad Berna', 14, 1),
(132, 'Ciudad Jardin', 14, 1),
(133, 'Restrepo', 14, 1),
(134, 'Villa Mayor', 14, 1),
(135, 'San Antonio', 14, 1),
(136, 'La Fragua', 14, 1),
(137, 'La Fraguita', 14, 1),
(138, 'Santander', 14, 1),
(139, 'Sevilla', 14, 1),
(140, 'Alcala', 15, 1),
(141, 'Alqueria', 15, 1),
(142, 'San Rafael', 15, 1),
(143, 'Galan', 15, 1),
(144, 'Barcelona', 15, 1),
(145, 'El Jazmin', 15, 1),
(146, 'La Camelia', 15, 1),
(147, 'Pradera', 15, 1),
(148, 'Salazar Gomez', 15, 1),
(149, 'Los ejidos y Pensilvania', 15, 1),
(150, 'La Catedral', 16, 1),
(151, 'Centro Administrativo', 16, 1),
(152, 'Egipto', 16, 1),
(153, 'Belen', 16, 1),
(154, 'San Francisco', 16, 1),
(155, 'La Concordia', 16, 1),
(156, 'Santa Barbara', 16, 1),
(157, 'San Francisco', 16, 1),
(158, 'La Concordio', 16, 1),
(159, 'Nueva Santa Fe', 16, 1),
(160, 'Murillo Toro', 17, 1),
(161, 'Granjas de Santa Sofia', 17, 1),
(162, 'Marco Fidel Suarez', 17, 1),
(163, 'Rio de Janeiro', 17, 1),
(164, 'San Jorge', 17, 1),
(165, 'Bravo Paez', 17, 1),
(166, 'Santiago Perez', 17, 1),
(167, 'Jorge Cavalier', 17, 1),
(168, 'Guiparma', 17, 1),
(169, 'El Triangulo', 17, 1),
(170, 'El Pedregal', 18, 1),
(171, 'Villa Jacky', 18, 1),
(172, 'Las Manas', 18, 1),
(176, 'La Playa', 18, 1),
(177, 'Santa Rosa Sur', 18, 1),
(178, 'Las Acaricias', 18, 1),
(179, 'Milan', 18, 1),
(180, 'San Antonio', 18, 1),
(181, 'Bonanza sur', 18, 1),
(182, 'La Carbonera', 18, 1),
(183, 'Alaska', 19, 1),
(184, 'La Morena', 19, 1),
(185, 'La Fiscalia', 19, 1),
(186, 'San Martin', 19, 1),
(187, 'Doña Liliana', 19, 1),
(188, 'Santa Librada', 19, 1),
(189, 'San Juan Bautista', 19, 1),
(200, 'Sierra Morena', 19, 1),
(201, 'Arrayanas', 19, 1),
(202, 'El Bosque Central', 19, 1),
(203, 'Rio Sumapaz', 20, 1),
(204, 'El Gaque', 20, 1),
(205, 'Granada', 20, 1),
(206, 'El salitre', 20, 1),
(207, 'Santa rosa', 20, 1),
(208, 'Barrio Sumapaz', 20, 1),
(209, 'Tunal Alto', 20, 1),
(210, 'Tunal Bajo', 20, 1),
(212, 'La Union', 20, 1),
(221, 'San Antonio', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_categoria` int(11) NOT NULL,
  `nom_categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_categoria`, `nom_categoria`) VALUES
(1, 'Electricos'),
(2, 'Manuales'),
(3, 'Materiales metalicos'),
(4, 'Materiales no metalicos'),
(5, 'Pinturas'),
(6, 'Cerrajeria'),
(9, 'Construcción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `ID_ciudad` int(11) NOT NULL,
  `nom_ciudad` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`ID_ciudad`, `nom_ciudad`) VALUES
(1, 'Bogotá'),
(2, 'Medellín'),
(3, 'Cali'),
(4, 'Barranquilla'),
(5, 'Soledad'),
(6, 'Cúcuta'),
(7, 'Soacha'),
(8, 'Ibagué'),
(9, 'Bucaramanga'),
(10, 'Villavicencio'),
(11, 'Santa Marta'),
(12, 'Bello'),
(13, 'Valledupar'),
(14, 'Pereira'),
(15, 'Buenaventura'),
(16, 'Pasto'),
(17, 'Manizales'),
(18, 'Montería'),
(19, 'Neiva'),
(20, 'Monte Alegre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_factura`
--

CREATE TABLE `det_factura` (
  `FK_det_factura` int(11) NOT NULL,
  `FK_det_prod` varchar(40) NOT NULL,
  `precio_unt` int(30) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `CF_us` varchar(25) NOT NULL,
  `CF_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `det_factura`
--

INSERT INTO `det_factura` (`FK_det_factura`, `FK_det_prod`, `precio_unt`, `estado`, `cantidad`, `CF_us`, `CF_tipo_doc`) VALUES
(111, '176974732X', 716000, 'NULL', 1, '10304662733', 'CC'),
(111, '5574468565', 99950, 'NULL', 1, '10304662733', 'CC'),
(111, '6691851129', 13900, 'NULL', 1, '10304662733', 'CC'),
(111, '98022222111', 29900, 'NULL', 1, '10304662733', 'CC'),
(112, '2041172460', 79950, 'NULL', 1, '10304662733', 'CC'),
(112, '509004757X', 114900, 'NULL', 1, '10304662733', 'CC'),
(112, '543543', 25000, 'NULL', 1, '10304662733', 'CC'),
(112, '7880000739', 559900, 'NULL', 1, '10304662733', 'CC'),
(112, '9774391012', 124950, 'NULL', 1, '10304662733', 'CC'),
(112, '9808922111', 29900, 'NULL', 1, '10304662733', 'CC'),
(117, '1557972591', 22900, 'NULL', 1, '1', 'CC'),
(117, '6638029436', 9950, 'NULL', 1, '1', 'CC'),
(125, '0529063441', 35950, 'NULL', 1, '10345967', 'CC'),
(125, '543543', 25000, 'NULL', 1, '10345967', 'CC'),
(125, '6691851129', 13900, 'NULL', 2, '10345967', 'CC'),
(126, '2041172460', 79950, 'NULL', 1, '102475643', 'CC'),
(126, '6638029436', 9950, 'NULL', 3, '102475643', 'CC'),
(126, '8585851732', 59950, 'NULL', 1, '102475643', 'CC'),
(126, '9774391012', 124950, 'NULL', 1, '102475643', 'CC'),
(126, '9808922111', 29900, 'NULL', 1, '102475643', 'CC'),
(127, '0529063441', 35950, 'NULL', 1, '102475643', 'CC'),
(127, '2041172460', 79950, 'NULL', 1, '102475643', 'CC'),
(127, '4884032810', 49950, 'NULL', 4, '102475643', 'CC'),
(127, '543543', 25000, 'NULL', 1, '102475643', 'CC'),
(127, '6691851129', 13900, 'NULL', 1, '102475643', 'CC'),
(128, '4884032810', 49950, 'NULL', 1, '1608051762299', 'CC'),
(128, '6638029436', 9950, 'NULL', 1, '1608051762299', 'CC'),
(128, '7880000739', 559900, 'NULL', 1, '1608051762299', 'CC'),
(129, '23dsf', 25000, 'NULL', 1, '4', 'CC'),
(129, '8585851732', 59950, 'NULL', 1, '4', 'CC'),
(130, '176974732X', 716000, 'NULL', 1, '1', 'CC'),
(130, '7880000739', 559900, 'NULL', 1, '1', 'CC'),
(131, '0529063441', 35950, 'NULL', 1, '10345967', 'CC'),
(131, '176974732X', 716000, 'NULL', 1, '10345967', 'CC'),
(132, '1557972591', 22900, 'NULL', 1, '102475643', 'CC'),
(132, '6638029436', 9950, 'NULL', 1, '102475643', 'CC'),
(132, '6691851129', 13900, 'NULL', 1, '102475643', 'CC'),
(133, '2041172460', 79950, 'NULL', 1, '1', 'CC'),
(133, '23dsf', 25000, 'NULL', 1, '1', 'CC'),
(133, '98022222111', 29900, 'NULL', 1, '1', 'CC'),
(134, '1557972591', 22900, 'NULL', 1, '1', 'CC'),
(134, '9774391012', 124950, 'NULL', 1, '1', 'CC'),
(135, '4884032810', 49950, 'NULL', 1, '2', 'CC'),
(135, '509004757X', 114900, 'NULL', 1, '2', 'CC'),
(135, '543543', 25000, 'NULL', 1, '2', 'CC'),
(156, '9774391012', 124950, 'NULL', 5, '2', 'CC'),
(157, '0529063441', 35950, 'NULL', 4, '2', 'CC'),
(157, '7880000739', 559900, 'NULL', 4, '2', 'CC'),
(157, '8585851732', 59950, 'NULL', 1, '2', 'CC'),
(157, '9774391012', 124950, 'NULL', 5, '2', 'CC'),
(158, '9808922111', 29900, 'NULL', 11, '4', 'CC'),
(159, '23dsf', 25000, 'NULL', 2, '6', 'CC'),
(159, '509004757X', 114900, 'NULL', 6, '6', 'CC'),
(159, '9774391012', 124950, 'NULL', 5, '6', 'CC'),
(160, '0529063441', 35950, 'NULL', 1, '1', 'CC'),
(160, '2041172460', 79950, 'NULL', 1, '1', 'CC'),
(160, '6638029436', 9950, 'NULL', 1, '1', 'CC'),
(160, '98022222111', 29900, 'NULL', 1, '1', 'CC'),
(161, '1557972591', 22900, 'NULL', 8, '3', 'CC'),
(161, '543543', 25000, 'NULL', 1, '3', 'CC'),
(161, '98022222111', 29900, 'NULL', 8, '3', 'CC'),
(162, '430911542X', 659000, 'NULL', 1, '1', 'CC'),
(162, '98022222111', 29900, 'NULL', 1, '1', 'CC'),
(162, '9808953743', 29900, 'NULL', 1, '1', 'CC'),
(163, '23dsf', 25000, 'NULL', 2, '4', 'CC'),
(163, '45235', 1000, 'NULL', 30, '4', 'CC'),
(163, '6691851129', 13900, 'NULL', 1, '4', 'CC'),
(163, '7880000739', 559900, 'NULL', 4, '4', 'CC'),
(164, '23dsf', 25000, 'NULL', 2, '3', 'CC'),
(164, '5574468565', 99950, 'NULL', 3, '3', 'CC'),
(165, '176974732X', 716000, 'NULL', 7, '1', 'CC'),
(165, '2041172460', 479700, 'NULL', 14, '1', 'CC'),
(165, '45235', 1000, 'NULL', 30, '1', 'CC'),
(166, '45235', 1000, 'NULL', 1, '1', 'CC'),
(166, '8585851732', 59950, 'NULL', 1, '1', 'CC'),
(170, '6638029436', 9950, 'NULL', 1, '1', 'CC'),
(170, '9808953743', 29900, 'NULL', 1, '1', 'CC'),
(172, '123123', 15000, 'NULL', 2, '1', 'CC'),
(172, '5574468565', 99950, 'NULL', 1, '1', 'CC'),
(173, '1557972591', 22900, 'NULL', 1, '1', 'CC'),
(173, '4884032810', 49950, 'NULL', 1, '1', 'CC'),
(173, '6691851129', 27800, 'NULL', 2, '1', 'CC'),
(174, '123123', 15000, 'NULL', 2, '1', 'CC'),
(174, '353740283X', 89900, 'NULL', 1, '1', 'CC'),
(176, '7880000739', 559900, 'NULL', 1, '1', 'CC'),
(177, '543543', 25000, 'NULL', 1, '1', 'CC'),
(177, '9808922111', 59800, 'NULL', 2, '1', 'CC'),
(177, '9808953743', 29900, 'NULL', 1, '1', 'CC'),
(178, '123123', 7500, 'NULL', 1, '1', 'CC'),
(178, '23dsf', 25000, 'NULL', 1, '1', 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_orden`
--

CREATE TABLE `det_orden` (
  `FK_ord` int(11) NOT NULL,
  `FK_prod` varchar(40) NOT NULL,
  `cantidad_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `det_orden`
--

INSERT INTO `det_orden` (`FK_ord`, `FK_prod`, `cantidad_prod`) VALUES
(2, '176974732X', 1),
(6, '0529063441', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_producto`
--

CREATE TABLE `det_producto` (
  `FK_prod` varchar(40) NOT NULL,
  `FK_rut` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `num_fac_ing` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `det_producto`
--

INSERT INTO `det_producto` (`FK_prod`, `FK_rut`, `fecha`, `num_fac_ing`) VALUES
('0529063441', '353721273', '2019-06-14', '0523793441'),
('1557972591', '411070291', '2019-09-14', '1557412591'),
('176974732X', '719875909', '2019-10-14', '176515932X'),
('2041172460', '478267154', '2019-10-14', '2011172460'),
('353740283X', '17468875', '2019-12-14', '353744583X'),
('430911542X', '759451251', '2019-08-14', '430947842X'),
('4884032810', '17468875', '2019-12-14', '4884999810'),
('5574468565', '178890276', '2019-02-14', '5574168565'),
('6638029436', '481796032', '2019-06-14', '6123429436');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `ID_dir` int(11) NOT NULL,
  `dir` varchar(25) NOT NULL,
  `CF_us` varchar(25) DEFAULT NULL,
  `CF_tipo_doc` varchar(5) DEFAULT NULL,
  `CF_rut` varchar(20) DEFAULT NULL,
  `FK_barrio` int(11) NOT NULL,
  `FK_Localidad` int(11) NOT NULL,
  `FK_Ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`ID_dir`, `dir`, `CF_us`, `CF_tipo_doc`, `CF_rut`, `FK_barrio`, `FK_Localidad`, `FK_Ciudad`) VALUES
(2, 'Calle 30 sur No 21 45', '1', 'CC', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_provedor`
--

CREATE TABLE `empresa_provedor` (
  `ID_rut` varchar(40) NOT NULL,
  `nom_empresa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa_provedor`
--

INSERT INTO `empresa_provedor` (`ID_rut`, `nom_empresa`) VALUES
('130382612', 'Eyegate Pharmaceuticals, Inc'),
('17468875', 'Tuberias S.A.S'),
('178890276', 'Avista Corporation'),
('296342653', 'Kearny Financial'),
('353721273', 'Celgene Corporation'),
('411070291', 'Graco Inc'),
('464978345', 'Virtus Global Multi-Sector Income Fund'),
('467487188', 'Vident International Equity Fund'),
('478267154', 'BlackRock Energy and Resources Trust'),
('481796032', 'Artesian Resources Corporation'),
('550507862', 'Antero Midstream Partners LP'),
('632873939', 'WisdomTree Interest'),
('647278225', 'Contreras Ltd'),
('684382518', 'Ekso Bionics Holdings, Inc'),
('719875909', 'Nomad Foods Limited'),
('759451251', 'Citigroup Inc'),
('763011374', 'Amplify Snack Brands, inc'),
('784044923', 'Banco Santander SAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID_factura` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `FK_c_tipo_pago` int(11) NOT NULL,
  `claveTransaccion` varchar(200) DEFAULT NULL,
  `PaypalDatos` varchar(200) DEFAULT NULL,
  `FK_tipoV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`ID_factura`, `total`, `fecha`, `status`, `iva`, `FK_c_tipo_pago`, `claveTransaccion`, `PaypalDatos`, `FK_tipoV`) VALUES
(111, 859750, '2020-12-12', 'N/A', 163353, 1, NULL, NULL, 4),
(112, 934600, '2020-12-12', 'En proceso', 177574, 5, NULL, NULL, 1),
(117, 32850, '2020-12-12', 'En proceso', 6242, 5, NULL, NULL, 1),
(125, 88750, '2020-12-13', 'En proceso', 16863, 5, NULL, NULL, 1),
(126, 324600, '2020-12-13', 'En proceso', 61674, 5, NULL, NULL, 1),
(127, 354600, '2020-12-13', 'En proceso', 67374, 5, NULL, NULL, 1),
(128, 639700, '2020-12-14', 'N/A', 121543, 1, NULL, NULL, 1),
(129, 144900, '2020-12-14', 'N/A', 27531, 1, NULL, NULL, 1),
(130, 1275900, '2020-12-14', 'N/A', 242421, 1, NULL, NULL, 1),
(131, 751950, '2020-12-14', 'N/A', 142871, 1, NULL, NULL, 1),
(132, 46750, '2020-12-14', 'N/A', 8883, 1, NULL, NULL, 3),
(133, 134850, '2020-12-19', 'En proceso', 25622, 5, NULL, NULL, 1),
(134, 147850, '2020-12-19', 'En proceso', 28092, 5, NULL, NULL, 1),
(135, 189850, '2020-12-24', 'N/A', 36072, 1, NULL, NULL, 1),
(136, 684850, '2020-12-28', 'N/A', 130122, 1, NULL, NULL, 1),
(137, 684850, '2020-12-28', 'N/A', 130122, 1, NULL, NULL, 1),
(138, 744800, '2020-12-28', 'N/A', 141512, 1, NULL, NULL, 1),
(139, 744800, '2020-12-28', 'N/A', 141512, 1, NULL, NULL, 1),
(140, 744800, '2020-12-28', 'N/A', 141512, 1, NULL, NULL, 1),
(141, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(142, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(143, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(144, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(145, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(146, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(147, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(148, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(149, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(150, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(151, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(152, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(153, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(154, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(155, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(156, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(157, 780750, '2020-12-28', 'N/A', 148343, 1, NULL, NULL, 1),
(158, 29900, '2020-12-28', 'N/A', 5681, 1, NULL, NULL, 1),
(159, 264850, '2020-12-28', 'N/A', 50322, 1, NULL, NULL, 1),
(160, 155750, '2020-12-28', 'En proceso', 29593, 5, NULL, NULL, 1),
(161, 77800, '2020-12-29', 'N/A', 14782, 1, NULL, NULL, 1),
(162, 718800, '2021-01-07', 'En proceso', 136572, 5, NULL, NULL, 1),
(163, 599800, '2021-02-08', 'N/A', 113962, 1, NULL, NULL, 1),
(164, 124950, '2021-02-08', 'N/A', 23741, 2, NULL, NULL, 3),
(165, 1196700, '2021-02-09', 'N/A', 227373, 1, NULL, NULL, 4),
(166, 60950, '2021-02-09', 'En proceso', 11581, 5, NULL, NULL, 1),
(167, 44900, '2021-02-10', 'N/A', 8531, 1, NULL, NULL, 4),
(168, 44900, '2021-02-10', 'N/A', 8531, 1, NULL, NULL, 1),
(169, 119850, '2021-02-10', 'N/A', 22772, 1, NULL, NULL, 1),
(170, 39850, '2021-02-10', 'En proceso', 7572, 5, NULL, NULL, 1),
(171, 127350, '2021-02-10', 'N/A', 24197, 1, NULL, NULL, 1),
(172, 114950, '2021-02-10', 'N/A', 21841, 1, NULL, NULL, 4),
(173, 100650, '2021-02-10', 'N/A', 19124, 1, NULL, NULL, 1),
(174, 104900, '2021-02-10', 'N/A', 19931, 1, NULL, NULL, 1),
(175, 559900, '2021-02-10', 'N/A', 106381, 1, NULL, NULL, 1),
(176, 559900, '2021-02-10', 'N/A', 106381, 1, NULL, NULL, 1),
(177, 114700, '2021-02-18', 'N/A', 21793, 1, NULL, NULL, 1),
(178, 32500, '2021-02-21', 'N/A', 6175, 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `ID_localidad` int(11) NOT NULL,
  `nom_localidad` varchar(25) NOT NULL,
  `FK_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`ID_localidad`, `nom_localidad`, `FK_ciudad`) VALUES
(1, 'Bosa', 1),
(2, 'Kennedy', 1),
(3, 'Chapinero', 1),
(4, 'Usaquen', 1),
(5, 'Suba', 1),
(6, 'Fontibon', 1),
(7, 'Engativa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_error`
--

CREATE TABLE `log_error` (
  `ID_error` int(11) NOT NULL,
  `descrip_error` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `log_error`
--

INSERT INTO `log_error` (`ID_error`, `descrip_error`, `fecha`, `hora`) VALUES
(1, 'Error correo electronico no valido', '2018-12-04', '14:14:00'),
(2, 'Error en la contraseña por favor digitela de nuevo', '2019-07-05', '13:24:54'),
(3, 'su solicitud requiere elevacion', '2019-02-03', '15:24:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `ID_not` int(11) NOT NULL,
  `estado` int(225) NOT NULL,
  `descript` varchar(225) NOT NULL,
  `nom_us` varchar(100) NOT NULL,
  `FK_ms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`ID_not`, `estado`, `descript`, `nom_us`, `FK_ms`) VALUES
(1, 0, 'Bienvenidos al chat', 'Javier H. Reyes', 1),
(2, 0, 'Prueba de chat en vivo cuenta id 2', 'Fabian Pepito Perezz', 1),
(3, 0, 'el javier', 'Fabian Pepito Perezz', 1),
(4, 0, 'pero no mas javier , no masss', 'Fabian Pepito Perezz', 1),
(5, 0, 'Entonces', 'Javier H. Reyes', 1),
(6, 0, 'jajaj', 'Javier H. Reyes', 1),
(7, 0, 'esta una brutalidad huevon jajajaja', 'Fabian Pepito Perezz', 1),
(8, 0, 'jaja y en vivo', 'Javier H. Reyes', 1),
(9, 0, 'como lo hizo jajaja', 'Fabian Pepito Perezz', 1),
(10, 0, 'que garra jaja', 'Javier H. Reyes', 1),
(11, 0, 'con ajax?', 'Fabian Pepito Perezz', 1),
(12, 0, 'si', 'Javier H. Reyes', 1),
(13, 0, 'si con ajax', 'Javier H. Reyes', 1),
(14, 0, 'brutal jajajaja', 'Fabian Pepito Perezz', 1),
(15, 0, 'tiene varias cosas jajja por ejemplo se econde parte del texto', 'Javier H. Reyes', 1),
(16, 0, 'jajaj pero funciono jaja', 'Javier H. Reyes', 1),
(17, 0, 'no que brutalidad', 'Fabian Pepito Perezz', 1),
(18, 0, 'ajajajja si parce ', 'Javier H. Reyes', 1),
(19, 0, 'bueno  parce nos hablamos, que tengo que volver a salir', 'Fabian Pepito Perezz', 1),
(20, 0, 'si al caso feliz año parce nos vemos jajajaja', 'Fabian Pepito Perezz', 1),
(21, 0, 'Listo parce nos hablamos', 'Javier H. Reyes', 1),
(22, 0, 'feliz año ', 'Javier H. Reyes', 1),
(23, 0, 'eso', 'Fabian Pepito Perezz', 1),
(24, 0, 'venga :)', 'Fabian Pepito Perezz', 1),
(25, 0, 'esto no recibe emoticones ?', 'Fabian Pepito Perezz', 1),
(26, 0, 'no jajaj', 'Javier H. Reyes', 1),
(27, 0, 'pero voy a ver', 'Javier H. Reyes', 1),
(28, 0, 'jajajaja brutal, bueno nos hablamos pa', 'Fabian Pepito Perezz', 1),
(29, 0, 'jajajaj listo parce', 'Javier H. Reyes', 1),
(34, 0, 'Hola', 'Fabian Pepito Perezz', 1),
(35, 0, '55', 'Javier H. Reyes', 1),
(36, 0, 'ah claro', 'Daniela Milena Echeverría', 1),
(37, 0, 'las pruebas', 'Daniela Milena Echeverría', 1),
(49, 0, 'Presentacion', 'Alejandro Daniel Perez', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modific`
--

CREATE TABLE `modific` (
  `ID_modifc` int(11) NOT NULL,
  `descrip` varchar(200) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `FK_us` varchar(25) NOT NULL,
  `FK_doc` varchar(5) NOT NULL,
  `FK_modific` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modific`
--

INSERT INTO `modific` (`ID_modifc`, `descrip`, `fecha`, `hora`, `FK_us`, `FK_doc`, `FK_modific`) VALUES
(31, 'Usario modificado ID 1662041247199', '2020-11-15', '04:25:24', '1', 'CC', 4),
(32, 'Usario modificado ID 1234', '2020-11-15', '06:01:40', '1', 'CC', 4),
(33, 'Usario modificado ID 111', '2020-11-15', '06:04:48', '1', 'CC', 4),
(34, 'Usario modificado ID 111', '2020-11-15', '06:09:00', '1', 'CC', 4),
(37, 'Usario modificado ID 2', '2020-11-16', '10:00:20', '2', 'CC', 4),
(38, 'Usario eliminado ID 1676090228999', '2020-11-16', '10:50:30', '1', 'CC', 2),
(39, 'Usario modificado ID 111', '2020-11-16', '11:06:27', '1', 'CC', 4),
(40, 'Usario modificado ID 111', '2020-12-11', '03:30:43', '1', 'CC', 4),
(41, 'Usario modificado ID 102475643', '2020-12-13', '09:34:11', '1', 'CC', 4),
(42, 'Usario eliminado ID 1608051762299', '2020-12-13', '10:23:46', '1', 'CC', 2),
(43, 'Usario eliminado ID 1628012272099', '2020-12-13', '10:23:59', '1', 'CC', 2),
(44, 'Usario eliminado ID 555', '2020-12-13', '11:22:31', '1', 'CC', 2),
(45, 'Usuario modificado ID 222', '2020-12-13', '12:09:24', '1', 'CC', 2),
(46, 'Usuario modificado ID 10345967', '2020-12-13', '12:19:29', '1', 'CC', 1),
(47, 'Usuario modificado ID 1234', '2020-12-13', '12:33:04', '1', 'CC', 6),
(48, 'Usuario modificado ID 1662041247199', '2020-12-13', '12:35:46', '1', 'CC', 5),
(49, 'Producto modificado ID 22', '2020-12-13', '12:43:11', '1', 'CC', 2),
(50, 'Producto modificado ID 2222', '2020-12-13', '12:48:59', '1', 'CC', 1),
(51, 'Producto modificado ID 2222', '2020-12-13', '12:49:00', '1', 'CC', 1),
(52, 'Producto modificado ID 2222', '2020-12-13', '12:51:09', '1', 'CC', 1),
(53, 'Producto modificado ID 2222', '2020-12-13', '12:51:42', '1', 'CC', 1),
(54, 'Producto modificado ID 2222', '2020-12-13', '12:54:45', '1', 'CC', 1),
(55, 'Producto modificado ID 2222', '2020-12-13', '12:55:34', '1', 'CC', 1),
(56, 'Categoria modificada ID 17', '2020-12-13', '01:05:47', '1', 'CC', 2),
(57, 'Categoria modificada ID 18', '2020-12-13', '01:10:12', '1', 'CC', 1),
(58, 'Categoria modificada ID 18', '2020-12-13', '01:10:50', '1', 'CC', 2),
(59, 'Empresa modificada ID 3423', '2020-12-13', '01:15:41', '1', 'CC', 1),
(60, 'Empresa modificada ID 1123', '2020-12-13', '01:24:32', '1', 'CC', 2),
(61, 'Unidad de medidad modificada ID 26', '2020-12-13', '01:28:44', '1', 'CC', 1),
(62, 'Unidad de medida modificada ID 26', '2020-12-13', '01:31:57', '1', 'CC', 2),
(63, 'Usuario modificado ID 4', '2020-12-13', '01:55:58', '1', 'CC', 6),
(64, 'Usuario modificado ID 5', '2020-12-13', '01:59:07', '1', 'CC', 6),
(65, 'Usuario modificado ID 1234', '2020-12-13', '05:16:59', '1', 'CC', 1),
(66, 'Producto modificado ID 2222', '2020-12-13', '05:42:52', '1', 'CC', 2),
(67, 'Usuario modificado ID 3', '2020-12-13', '07:07:14', '1', 'CC', 5),
(68, 'Producto modificado ID 543543', '2020-12-13', '09:11:03', '1', 'CC', 1),
(69, 'Usuario modificado ID 10304662733', '2020-12-14', '02:18:15', '1', 'CC', 1),
(70, 'Usuario modificado ID 6', '2020-12-14', '02:19:11', '1', 'CC', 1),
(71, 'Usuario modificado ID 4', '2020-12-14', '02:20:45', '1', 'CC', 5),
(72, 'Usuario modificado ID 1234', '2020-12-16', '07:38:57', '1', 'CC', 1),
(73, 'Usuario modificado ID 1', '2020-12-16', '07:39:11', '1', 'CC', 5),
(75, 'Usuario modificado ID 3', '2020-12-19', '12:20:58', '1', 'CC', 1),
(76, 'Usuario modificado ID 3', '2020-12-19', '12:24:07', '1', 'CC', 1),
(77, 'Usuario modificado ID 3', '2020-12-19', '12:25:47', '1', 'CC', 1),
(78, 'Usuario modificado ID 3', '2020-12-19', '12:27:08', '1', 'CC', 1),
(79, 'Usuario modificado ID 2', '2020-12-19', '12:49:04', '1', 'CC', 1),
(80, 'Usuario modificado ID 2', '2020-12-20', '02:54:38', '1', 'CC', 5),
(81, 'Usuario modificado ID 104759324', '2020-12-26', '11:53:27', '1', 'CC', 5),
(82, 'Usuario modificado ID formControl.php', '2020-12-26', '11:53:38', '1', 'CC', 5),
(83, 'Usuario modificado ID 4', '2020-12-26', '11:56:04', '1', 'CC', 5),
(84, 'Usuario modificado ID 4', '2020-12-26', '06:00:25', '1', 'CC', 5),
(85, 'Usuario modificado ID 104759324', '2020-12-26', '06:02:56', '1', 'CC', 6),
(86, 'Categoria modificada ID 28', '2020-12-26', '09:05:38', '1', 'CC', 2),
(87, 'Categoria modificada ID ', '2020-12-26', '10:43:04', '1', 'CC', 1),
(88, 'Categoria modificada ID 52', '2020-12-26', '10:43:47', '1', 'CC', 1),
(89, 'Categoria modificada ID 52', '2020-12-26', '10:46:11', '1', 'CC', 2),
(90, 'Categoria modificada ID 53', '2020-12-26', '11:20:12', '1', 'CC', 2),
(91, 'Unidad de medidad modificada ID 30', '2020-12-27', '01:05:16', '1', 'CC', 1),
(92, 'Empresa modificada ID 45325', '2020-12-27', '01:10:22', '1', 'CC', 1),
(93, 'Empresa modificada ID ', '2020-12-27', '01:10:32', '1', 'CC', 1),
(94, 'Empresa modificada ID 34324', '2020-12-27', '01:14:01', '1', 'CC', 1),
(95, 'Empresa modificada ID 34324', '2020-12-27', '01:14:06', '1', 'CC', 2),
(96, 'Unidad de medida modificada ID ', '2020-12-27', '01:32:25', '1', 'CC', 2),
(97, 'Unidad de medidad modificada ID 33', '2020-12-27', '01:33:23', '1', 'CC', 1),
(98, 'Usuario modificado ID 7', '2020-12-28', '01:01:53', '1', 'CC', 1),
(99, 'Usuario modificado ID 7', '2020-12-28', '01:03:10', '1', 'CC', 1),
(100, 'Usuario modificado ID 7', '2020-12-28', '01:05:18', '1', 'CC', 1),
(101, 'Categoria modificada ID 54', '2020-12-28', '12:27:27', '1', 'CC', 1),
(102, 'Categoria modificada ID 54', '2020-12-28', '12:27:33', '1', 'CC', 2),
(103, 'Empresa modificada ID 34234', '2020-12-28', '12:50:53', '1', 'CC', 1),
(104, 'Empresa modificada ID 34234', '2020-12-28', '12:51:00', '1', 'CC', 2),
(105, 'Unidad de medida modificada ID ', '2020-12-28', '01:20:30', '1', 'CC', 2),
(106, 'Unidad de medidad modificada ID 33', '2020-12-28', '01:20:39', '1', 'CC', 1),
(107, 'Unidad de medida modificada ID ', '2020-12-28', '01:20:46', '1', 'CC', 2),
(108, 'Producto modificado ID 45325', '2020-12-28', '02:00:43', '1', 'CC', 2),
(109, 'Producto modificado ID 45325', '2020-12-28', '02:00:54', '1', 'CC', 2),
(110, 'Producto modificado ID 3', '2020-12-28', '02:03:25', '1', 'CC', 2),
(111, 'Producto modificado ID 3', '2020-12-28', '02:03:38', '1', 'CC', 2),
(112, 'Producto modificado ID 43534', '2020-12-28', '02:07:15', '1', 'CC', 2),
(113, 'Producto modificado ID 4324', '2020-12-28', '02:40:39', '1', 'CC', 2),
(114, 'Producto modificado ID 543', '2020-12-28', '03:34:21', '1', 'CC', 1),
(115, 'Categoria modificada ID 55', '2020-12-30', '09:46:04', '1', 'CC', 2),
(116, 'Usuario modificado ID 5', '2021-01-11', '01:28:39', '1', 'CC', 6),
(117, 'Usuario modificado ID 4', '2021-01-11', '01:28:58', '1', 'CC', 6),
(118, 'Usuario modificado ID 324', '2021-01-11', '01:30:21', '1', 'CC', 6),
(119, 'Usuario modificado ID 7', '2021-01-11', '01:30:37', '1', 'CC', 6),
(120, 'Usuario modificado ID 1112', '2021-01-11', '01:33:49', '1', 'CC', 6),
(121, 'Usuario modificado ID 3', '2021-01-28', '09:11:59', '1', 'CC', 6),
(122, 'Usuario modificado ID 1030607384', '2021-02-09', '11:03:42', '1', 'CC', 6),
(123, 'Usuario modificado ID 1030607384', '2021-02-09', '11:05:20', '1', 'CC', 6),
(124, 'Usuario modificado ID ', '2021-02-09', '11:06:06', '1', 'CC', 6),
(125, 'Usuario modificado ID 1030607384', '2021-02-09', '11:07:04', '1', 'CC', 5),
(126, 'Usuario modificado ID 1030607384', '2021-02-09', '11:10:27', '1', 'CC', 5),
(127, 'Usuario modificado ID 1030607384', '2021-02-09', '11:12:23', '1', 'CC', 5),
(128, 'Usuario modificado ID 1030607384', '2021-02-09', '11:12:41', '1', 'CC', 5),
(129, 'Usuario modificado ID 1030607384', '2021-02-09', '11:12:56', '1', 'CC', 5),
(130, 'Usuario modificado ID 1030607384', '2021-02-09', '11:13:51', '1', 'CC', 6),
(131, 'Producto modificado ID 2041172460', '2021-02-13', '01:50:40', '1', 'CC', 1),
(132, 'Producto modificado ID 2041172460', '2021-02-13', '01:51:18', '1', 'CC', 1),
(133, 'Producto modificado ID 2041172460', '2021-02-13', '01:51:34', '1', 'CC', 1),
(134, 'Producto modificado ID 45235', '2021-02-13', '01:52:12', '1', 'CC', 1),
(135, 'Producto modificado ID 8585851732', '2021-02-13', '01:54:14', '1', 'CC', 1),
(136, 'Producto modificado ID 45235', '2021-02-13', '01:55:24', '1', 'CC', 1),
(137, 'Usuario modificado ID 2', '2021-02-13', '02:00:14', '1', 'CC', 1),
(138, 'Usuario modificado ID 2', '2021-02-13', '02:04:42', '1', 'CC', 1),
(139, 'Usuario modificado ID 2', '2021-02-13', '02:09:35', '1', 'CC', 1),
(140, 'Usuario modificado ID 2', '2021-02-13', '02:13:34', '1', 'CC', 1),
(141, 'Usuario modificado ID 2', '2021-02-13', '02:16:00', '1', 'CC', 1),
(142, 'Usuario modificado ID 2', '2021-02-13', '02:18:34', '1', 'CC', 1),
(143, 'Usuario modificado ID 2', '2021-02-13', '02:23:48', '1', 'CC', 1),
(144, 'Usuario modificado ID 1231', '2021-02-13', '02:30:55', '1', 'CC', 1),
(145, 'Usuario modificado ID 1231', '2021-02-13', '02:32:04', '1', 'CC', 1),
(146, 'Usuario modificado ID 2', '2021-02-13', '02:58:12', '1', 'CC', 1),
(147, 'Usuario modificado ID 2', '2021-02-13', '02:58:13', '1', 'CC', 1),
(148, 'Usuario modificado ID 2', '2021-02-13', '02:58:40', '1', 'CC', 6),
(149, 'Usuario modificado ID 2', '2021-02-13', '02:58:46', '1', 'CC', 6),
(150, 'Usuario modificado ID 2', '2021-02-13', '02:58:51', '1', 'CC', 6),
(151, 'Usuario modificado ID 2', '2021-02-13', '02:58:56', '1', 'CC', 6),
(152, 'Usuario modificado ID 2', '2021-02-13', '02:59:31', '1', 'CC', 6),
(153, 'Usuario modificado ID 2', '2021-02-13', '02:59:59', '1', 'CC', 6),
(154, 'Usuario modificado ID 3', '2021-02-13', '03:00:20', '1', 'CC', 5),
(155, 'Usuario modificado ID 3', '2021-02-13', '03:01:26', '1', 'CC', 6),
(156, 'Usuario modificado ID 3', '2021-02-13', '03:01:43', '1', 'CC', 6),
(157, 'Usuario modificado ID 1030607384', '2021-02-19', '07:52:25', '1', 'CC', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `ID_not` int(11) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `descript` varchar(200) DEFAULT NULL,
  `FK_rol` int(3) NOT NULL,
  `FK_not` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`ID_not`, `estado`, `descript`, `FK_rol`, `FK_not`) VALUES
(6, '0', 'Promoción', 6, 10),
(32, '1', '1636012383599', 1, 1),
(33, '0', '10304662733', 1, 1),
(35, '0', '102475643', 1, 1),
(36, '0', '104759324', 1, 1),
(37, '0', '4444', 1, 1),
(38, '1', '555', 1, 1),
(39, '0', '222', 1, 1),
(40, '0', '324', 1, 1),
(41, '0', '1112', 1, 1),
(42, '1', '7', 1, 1),
(43, '1', 'Javier Reyes@@@jav-rn@hotmail.com@@@3002321243@@@Prueba de insert desde index', 4, 12),
(44, '0', 'Javier Reyes@@@jav-rn@hotmail.com@@@3002321243@@@dddd', 4, 12),
(45, '0', 'Javier@@@jav@.com@@@30045576534@@@Verificación de registro de fecha y hora@@@2021-01-5102:06', 4, 12),
(46, '1', 'Javier Reyes@@@jav-rn@hotmail.com@@@3002321243@@@Prueba dos de registro fecha@@@2021-01-58@@@02:09', 4, 12),
(47, '0', 'Javier Reyes@@@jav-rn@hotmail.com@@@3002321243@@@Prueba de solicitud de servicios desde el index@@@2021-01-04@@@07:23', 4, 12),
(55, '0', '5@@@Pepito Richar@@@Ramirez Daza@@@3423@@@pepito@gmail.com@@@4543543@@@45235@@@1@@@asdfds@@@1000@@@Cable@@@cableC.jpg@@@Nanometro@@@2021-01-01@@@10:54', 5, 11),
(56, '0', '5@@@Pepito Richar@@@Ramirez Daza@@@45435324@@@pepito@gmail.com@@@2@@@45235@@@1@@@gsfdgfd@@@1000@@@Cable@@@cableC.jpg@@@Nanometro@@@2021-01-08@@@11:03', 5, 11),
(57, '0', 'Fabian@@@4534@@@45654@@@fdsafds\r\n\r\nsadfdsaffgdfddsfds\r\n\r\n\r\nprueba enidex@@@2021-01-17@@@11:44', 4, 12),
(58, '0', '2@@@Fabian Pepito@@@Perezz Del Carmenn@@@34543345@@@elfabiancho01@gmail.com@@@3@@@45235@@@1@@@FHjkdasaffdsadasf\r\n\r\n\r\nsadfadsfdsf@@@1000@@@Cable@@@cableC.jpg@@@Nanometro@@@2021-01-51@@@11:47', 5, 11),
(59, '0', '2@@@Fabian Pepito@@@Perezz Del Carmenn@@@30534534345@@@elfabiancho01@gmail.com@@@3@@@9774391012@@@6@@@@@@124950@@@Pinzas@@@pinzas.jpg@@@Unidad@@@2021-02-39@@@12:08', 5, 11),
(60, '0', '1030607384', 1, 1),
(61, '0', '1030607384', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_entrada`
--

CREATE TABLE `orden_entrada` (
  `ID_ord` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fact_prov` varchar(40) DEFAULT NULL,
  `CF_rol` int(3) NOT NULL,
  `CF_rol_us` varchar(25) NOT NULL,
  `CF_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orden_entrada`
--

INSERT INTO `orden_entrada` (`ID_ord`, `fecha_ingreso`, `fact_prov`, `CF_rol`, `CF_rol_us`, `CF_tipo_doc`) VALUES
(2, '2020-02-18', 'f116', 2, '1662041247199', 'CC'),
(4, '2020-05-30', 'f118', 4, '1668040515399', 'CC'),
(5, '2020-08-08', 'f119', 4, '1694050100899', 'CC'),
(6, '2020-01-28', 'f120', 4, '1628012272099', 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_prod` varchar(40) NOT NULL,
  `nom_prod` varchar(30) NOT NULL,
  `val_prod` int(11) NOT NULL,
  `stok_prod` int(11) NOT NULL,
  `estado_prod` varchar(20) NOT NULL,
  `descript` varchar(200) DEFAULT NULL,
  `img` varchar(40) DEFAULT NULL,
  `CF_categoria` int(11) NOT NULL,
  `CF_tipo_medida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_prod`, `nom_prod`, `val_prod`, `stok_prod`, `estado_prod`, `descript`, `img`, `CF_categoria`, `CF_tipo_medida`) VALUES
('0529063441', 'Martillo', 35950, 4, 'estandar', 'producto AAA', 'martillo.jpg', 2, 6),
('123123', 'Pintura plateada base', 7500, 100, 'Promoción', 'Pintura plateada base para pared', 'plateada.png', 5, 13),
('1557972591', 'Llave', 22900, 9, 'promocion', 'producto AAA', 'llave.jpg', 2, 6),
('176974732X', 'Trenzadora', 716000, 7, 'estandar', 'producto AAA', 'trenzadora.jpg', 1, 6),
('2041172460', 'Compresor', 79950, 14, 'estandar', 'producto AAA', 'compresor.jpg', 1, 6),
('23dsf', 'Segueta', 25000, 2, 'estandar', NULL, 'SEGUETA.jpg', 3, 6),
('353740283X', 'Destornillador', 89900, 4, 'estandar', 'producto AAA', 'destornillador.jpg', 2, 6),
('430911542X', 'Pulidora', 659000, 6, 'estandar', 'producto AAA', 'pulidora.jpg', 3, 6),
('45235', 'Cable', 1000, 30, 'estandar', 'conductores de cobre electrolítico de alta pureza, en forma de cable concéntrico clase A, B o C.', 'cableC.jpg', 6, 4),
('4884032810', 'Linterna', 49950, 9, 'promocion', 'producto AAA', 'linterna.jpg', 1, 6),
('509004757X', 'Remachadora', 114900, 6, 'promocion', 'producto AAA', 'remachadora.jpg', 2, 6),
('543', 'wwww', 342, 24, 'estandar', 'sdfads', 'descarga.jpg', 6, 1),
('543543', 'Ponchadora', 25000, 1, 'estandar', NULL, 'ponchadora.jpg', 2, 6),
('5574468565', 'Taladro', 99950, 3, 'estandar', 'producto AAA', 'taladro.jpg', 1, 6),
('6638029436', 'Pegadit', 9950, 7, 'estandar', 'producto AAA', 'pegadit.jpg', 5, 13),
('6691851129', 'Puntilla', 13900, 1, 'promocion', 'producto AAA', 'puntilla.jpg', 3, 10),
('7880000739', 'Sierra', 559900, 4, 'promocion', 'producto AAA', 'sierra.jpg', 1, 6),
('8585851732', 'Alicate', 59950, 34, 'estandar', 'producto AAA', 'alicates.jpg', 2, 6),
('9774391012', 'Pinzas', 124950, 5, 'promocion', 'producto AAA', 'pinzas.jpg', 2, 6),
('98022222111', 'Cemento', 29900, 8, 'promocion', 'producto AAA', 'cemento.jpg', 9, 12),
('9808922111', 'Ladrillos', 29900, 11, 'promocion', 'producto AAA', 'ladrillo.jpg', 4, 6),
('9808953743', 'Cerrojo', 29900, 11, 'promocion', 'producto AAA', 'cerrojo.jpg', 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `Id_puntos` int(11) NOT NULL,
  `puntos` int(5) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `FK_us` varchar(25) NOT NULL,
  `FK_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`Id_puntos`, `puntos`, `fecha`, `FK_us`, `FK_tipo_doc`) VALUES
(22, 2, '2020-10-17', '3', 'CC'),
(25, 2, '2020-10-17', '4', 'CC'),
(26, 2, '2020-10-17', '5', 'CC'),
(27, 2, '2020-10-17', '6', 'CC'),
(28, 2, '2020-11-15', '1231', 'CC'),
(29, 2, '2020-11-15', '111', 'CC'),
(30, 2, '2020-11-16', '5', 'CC'),
(31, 2, '2020-12-12', '1636012383599', 'CC'),
(32, 2, '2020-12-12', '10304662733', 'CC'),
(33, 2, '2020-12-12', '10345967', 'CC'),
(34, 2, '2020-12-13', '102475643', 'CC'),
(35, 2, '2020-12-13', '104759324', 'CC'),
(36, 2, '2020-12-13', '4444', 'CC'),
(37, 2, '2020-12-13', '555', 'CC'),
(38, 2, '2020-12-13', '222', 'CC'),
(39, 2, '2020-12-27', '324', 'CC'),
(40, 2, '2020-12-27', '1112', 'CC'),
(41, 2, '2020-12-27', '7', 'CC'),
(43, 2, '2021-02-19', '1030607384', 'CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ID_rol_n` int(11) NOT NULL,
  `nom_rol` varchar(25) NOT NULL,
  `acronimo` varchar(5) NOT NULL,
  `permisos` varchar(300) NOT NULL,
  `token` varchar(300) NOT NULL,
  `FK_not` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ID_rol_n`, `nom_rol`, `acronimo`, `permisos`, `token`, `FK_not`) VALUES
(1, 'Administrador', 'A', '01,0101,0102,0103,0104,0105,0106,0107,,0108,02,0201,0202,0203,0204,0205,0206,0207,0208,03,0301,0302,0303,04,0401,0402,0403,0404,0405,0406,05', '', NULL),
(2, 'Bodega', 'B', '01,0101,0102,02,03,0301,0302,0303,0304,04,0401,0402,0403,0404,05', '', NULL),
(3, 'Supervisor', 'S', '01,0101,0102,02,04,0401,0402,0403,0404,05,0501,0502,0503,06', '', NULL),
(4, 'Ventas', 'V', '01,0101,0102,02,03,0301,0302,0303,0305,04,0401,0402,0403,0404,0405,0406,05', '', NULL),
(5, 'Proveedor', 'P', '01,0101,0102,02,03,04,05', '', NULL),
(6, 'Cliente', 'C', '01,0101,0102,02,03,04,05', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `FK_rol` int(3) NOT NULL,
  `FK_us` varchar(25) NOT NULL,
  `FK_tipo_doc` varchar(5) NOT NULL,
  `fecha_asignacion` date NOT NULL,
  `estado` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`FK_rol`, `FK_us`, `FK_tipo_doc`, `fecha_asignacion`, `estado`) VALUES
(1, '1', 'CC', '2020-10-17', '1'),
(1, '1231', 'CC', '2020-11-15', '0'),
(2, '1624060419399', 'CC', '2019-03-02', '0'),
(2, '1654011145999', 'CC', '2019-04-05', '1'),
(2, '1662041247199', 'CC', '2018-12-28', '1'),
(2, '2', 'CC', '2020-10-17', '1'),
(3, '1662101568299', 'CC', '2018-11-19', '1'),
(3, '3', 'CC', '2020-10-17', '1'),
(4, '1608051762299', 'CC', '2019-05-16', '1'),
(4, '1628012272099', 'CC', '2019-03-25', '1'),
(4, '1668040515399', 'CC', '2019-02-13', '1'),
(4, '1676090228999', 'CC', '2019-05-20', '1'),
(4, '1687060309399', 'CC', '2019-09-25', '1'),
(4, '1694050100899', 'CC', '2019-05-13', '1'),
(4, '4', 'CC', '2020-10-17', '1'),
(5, '5', 'CC', '2020-10-17', '1'),
(6, '102475643', 'CC', '2020-12-13', '1'),
(6, '10304662733', 'CC', '2020-12-12', '1'),
(6, '1030607384', 'CC', '2021-02-19', '1'),
(6, '10345967', 'CC', '2020-12-12', '1'),
(6, '104759324', 'CC', '2020-12-13', '1'),
(6, '1112', 'CC', '2020-12-27', '1'),
(6, '324', 'CC', '2020-12-27', '1'),
(6, '6', 'CC', '2020-10-17', '1'),
(6, '7', 'CC', '2020-12-27', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servidor_correo`
--

CREATE TABLE `servidor_correo` (
  `ID_SC` int(11) NOT NULL,
  `tipo_correo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servidor_correo`
--

INSERT INTO `servidor_correo` (`ID_SC`, `tipo_correo`) VALUES
(1, 'Gmail'),
(2, 'yahoo'),
(3, 'Outlook'),
(4, 'hotmail');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `ID_tel` int(11) NOT NULL,
  `tel` varchar(25) NOT NULL,
  `CF_us` varchar(25) DEFAULT NULL,
  `CF_tipo_doc` varchar(5) DEFAULT NULL,
  `CF_rut` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `telefono`
--

INSERT INTO `telefono` (`ID_tel`, `tel`, `CF_us`, `CF_tipo_doc`, `CF_rut`) VALUES
(28, '312 577 25 67', '3', NULL, NULL),
(29, '312 674 37 44', '4', NULL, NULL),
(30, '322 577 45 89', '5', NULL, NULL),
(31, '355 986 39 23', '4', NULL, NULL),
(32, '311 376 45 78', '5', NULL, NULL),
(33, '311 577 94 00', '6', NULL, NULL),
(34, '320 588 74 6', '1234', NULL, NULL),
(35, '387 494 66 44', '111', NULL, NULL),
(36, '311 567 78 39', '5', NULL, NULL),
(37, '3205663211', '3', 'CC', NULL),
(38, '3205663211', '2', 'CC', NULL),
(39, '320566345', '1', 'CC', NULL),
(40, '311 467 25 33', '1636012383599', NULL, NULL),
(41, '300 245 27 32', '10304662733', NULL, NULL),
(42, '312 546 77 90', '10345967', NULL, NULL),
(43, '311 825 351', '102475643', NULL, NULL),
(44, '312 578 34 24', '104759324', NULL, NULL),
(48, 'asdf', '324', NULL, NULL),
(49, '311 722 23 11', '1112', NULL, NULL),
(50, '311 567 44 33', '7', NULL, NULL),
(51, '3057331744', '1030607384', NULL, NULL),
(52, '3057331744', '1030607384', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_anuncio`
--

CREATE TABLE `tipo_anuncio` (
  `ID_at` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_anuncio`
--

INSERT INTO `tipo_anuncio` (`ID_at`, `nombre`) VALUES
(1, 'Index');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_doc`
--

CREATE TABLE `tipo_doc` (
  `ID_acronimo` varchar(5) NOT NULL,
  `nom_doc` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_doc`
--

INSERT INTO `tipo_doc` (`ID_acronimo`, `nom_doc`) VALUES
('CC', 'Cedula'),
('CE', 'Documento de extranjeria'),
('TI', 'Tarjeta de identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_medida`
--

CREATE TABLE `tipo_medida` (
  `ID_medida` int(11) NOT NULL,
  `nom_medida` varchar(35) NOT NULL,
  `acron_medida` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_medida`
--

INSERT INTO `tipo_medida` (`ID_medida`, `nom_medida`, `acron_medida`) VALUES
(1, 'Nanometro', 'nn'),
(2, 'Milimetro', 'mm'),
(3, 'Centimetro', 'cm'),
(4, 'Metro', 'mts'),
(5, 'Pulgada', 'inch'),
(6, 'Unidad', 'U'),
(9, 'Docena', 'doc'),
(10, 'Millar', 'Mill'),
(11, 'Caja', 'caj'),
(12, 'Bulto', 'Bul'),
(13, 'Botella', 'Btl'),
(35, 'Mililitro', 'Ml'),
(36, 'Litro', 'L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_modific`
--

CREATE TABLE `tipo_modific` (
  `ID_t_modific` int(11) NOT NULL,
  `nom_modific` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_modific`
--

INSERT INTO `tipo_modific` (`ID_t_modific`, `nom_modific`) VALUES
(1, 'add_update'),
(2, 'add_delete'),
(3, 'add_insert'),
(4, 'add_update, cuenta de usuario'),
(5, 'Activo cuenta'),
(6, 'Desactivo cuenta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_not`
--

CREATE TABLE `tipo_not` (
  `ID_tipo_not` int(11) NOT NULL,
  `nom_tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_not`
--

INSERT INTO `tipo_not` (`ID_tipo_not`, `nom_tipo`) VALUES
(1, 'Activacion cuenta'),
(2, 'Solicitud producto'),
(3, 'Alerta producto agotado'),
(4, 'Informe mensual'),
(5, 'Reporte de ventas mensual'),
(6, 'Ventas muy bajas'),
(7, 'Error persistente en plataforma'),
(8, 'Se elimino producto'),
(9, 'Bloqueo de cuenta por contraseña'),
(10, 'Promociones'),
(11, 'Pedido'),
(12, 'Mensaje cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `ID_tipo_pago` int(11) NOT NULL,
  `nom_tipo_pago` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`ID_tipo_pago`, `nom_tipo_pago`) VALUES
(1, 'Efectivo-Contado'),
(2, 'Tarjeta credito'),
(3, 'Tarjeta debito'),
(4, 'Bono oferta'),
(5, 'PayPal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_venta`
--

CREATE TABLE `tipo_venta` (
  `Id_tipoV` int(11) NOT NULL,
  `Tipo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_venta`
--

INSERT INTO `tipo_venta` (`Id_tipoV`, `Tipo`) VALUES
(1, 'Venta en lineal'),
(2, 'Puerta a puerta'),
(3, 'Interna'),
(4, 'Sucursal principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_us` varchar(25) NOT NULL,
  `nom1` varchar(20) NOT NULL,
  `nom2` varchar(20) DEFAULT NULL,
  `ape1` varchar(20) NOT NULL,
  `ape2` varchar(20) DEFAULT NULL,
  `fecha` date NOT NULL,
  `pass` varchar(100) NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `FK_tipo_doc` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_us`, `nom1`, `nom2`, `ape1`, `ape2`, `fecha`, `pass`, `foto`, `correo`, `FK_tipo_doc`) VALUES
('1', 'Javier', 'H.', 'Reyes', 'Neira', '2020-10-09', '$2y$10$fJB3hFAaL81N8YUQRNAsN.Hr5OE5DqRatNJh2EpAGP/385Y2ueaIG', 'jav.png', 'jav@desarrollador.com', 'CC'),
('102475643', 'Martha', 'Milena', 'Fuente', 'Ribero', '1994-07-30', '$2y$10$qNsyHVgTwj7/CjaQ78Nrh.VhvzuJEdhLWWSdSpIPBxQyZlgbkTT3G', 'userVentas.jpg', 'Milena01@hotmail.com', 'CC'),
('10304662733', 'Irma ', 'Rosalyn', ' Mullen', 'Torrez', '2020-12-30', '$2y$10$MO54WvmF6EXVuOiuB90WZeJBeLd9.HDXcm2kg2T8p0XyMgYer4Ike', 'kendall.jpg', 'Cote@gmail.com', 'CC'),
('1030607384', 'Javier', 'H', 'Reyes', 'Neira', '2020-09-02', '$2y$10$InCMiZnn5X8hKwenUobMxeVA1pAW7aR2EHawWW/ua7wVNWQghh87q', 'jav.png', 'jav-rn@hotmail.com', 'CC'),
('10345967', 'Sandra', 'Pancha', 'Ramirez', 'Pardo', '1995-01-31', '$2y$10$4x195tuc608Yob.Pr8s/veGnR0O6olaptfGNrp63wTDU8pymsz40G', 'us03.jpg', 'Sandra01@gmail.com', 'CC'),
('104759324', 'Mauricio', 'Julian', 'Perez', 'Rincon', '1982-02-01', '$2y$10$ruFpaQ3tysXcK1nLqK7jx.ycKSutrTTEG/YA2hfK.1GHlxwbL//nq', 'srfet.jpg', 'mauricio@gmail.com', 'CC'),
('111', 'David', 'Gabriel', 'Collado', 'Perez', '2020-11-02', '$2y$10$/uhh/UKds2VnpSWBJNztzu.k7CuS4lDumxFFNBm/yrI3juZYsUyBi', 'user-icon1.jpg', 'elfabiancho01@gmail.com', 'CC'),
('1112', 'prueba', 'prueba', 'prueba', 'prueba', '2020-12-01', '$2y$10$m0ibHJUE78AvCNK6lmuFXuxumVPqWoClRe7NChNObUmsfg.bOG4qy', 'userPrueba.jpg', 'ddd@ddd', 'CC'),
('1231', 'Fabian', 'Pepito', 'Perez', 'Herrera', '2020-12-11', '$2y$10$1fnI32bugk722ZUanQwDDu4PhyQj1eKenbaFkwj5vBP8Ber8atbE6', NULL, 'desarrollador@gmail.com', 'CC'),
('1608051762299', 'Thor Alias', 'hijo de odin ', 'Mayer', 'ragnarok', '1989-04-18', '1234', 'us.png', 'eu.tellus@augue.com', 'CC'),
('1624060419399', 'Carlos', 'Dario', 'Flynn', 'Morris', '1982-07-19', 'PVJ34CMM2DX', 'us.png', 'Curabitur@velitAliquamnisl.edu', 'CC'),
('1628012272099', 'Dacey', 'Chanda', 'Gates', 'Foreman', '1995-09-02', 'MWX02YMX4GM', 'us.png', 'cursus.vestibulum@Vivamusnon.edu', 'CC'),
('1636012383599', 'Irma', ' Rosalyn', 'Mullen', 'Simena', '2020-12-31', '$2y$10$W70O.aopcNlNK4LV3zyZWeK7IJiTXO9Mv6RNRJZrBEKD3axO5qM6W', 'kendall.jpg', 'Rosal@gmial.com', 'CC'),
('1651011048199', 'Rajah', 'Gage', 'Barry', 'Daza', '1987-12-19', 'BSZ77PRI6GH', 'us.png', 'lobortis.Class@egestasurna.ca', 'CC'),
('1654011145999', 'Mollie', 'Jacqueline', 'Murphy', 'Henderson', '1997-12-14', 'KDF36PDZ2DU', 'us.png', 'nisi.magna@Nuncmauris.edu', 'CC'),
('1662041247199', 'Marcela', 'Daniela', 'Morris', 'Howell', '1988-09-19', 'JPC81QFH3JG', 'usm.png', 'Donec.est@temporeratneque.net', 'CC'),
('1662101568299', 'Quin', 'Paki', 'Ford', 'Hahn', '1992-07-28', 'GMU34EQF1NR', 'us.png', 'semper.tellus.id@Proinvelnisl.ca', 'CC'),
('1668040515399', 'Salvador', 'Samuel', 'Stevens', 'Perez', '1995-07-21', 'PWL76KXQ4FG', 'us.png', 'libero.lacus.varius@Quisque.co.uk', 'CC'),
('1676090228999', 'James', 'Oprah', 'Dickerson', 'Turner', '1988-11-25', 'TUB17VSF8MZ', 'us.png', 'ut.molestie@morbitristiquesenectus.co.uk', 'CC'),
('1687060309399', 'Kylynn', 'Aubrey', 'Daniel', NULL, '1990-01-11', 'YDS91KRH4PL', 'us.png', 'mattis@eu.com', 'CC'),
('1694050100899', 'Jeremy', 'Miryam', 'Hahn', 'Trujillo', '1990-04-11', 'SGU29VRZ0IS', 'usm.png', 'nec@adipiscinglobortisrisus.net', 'CC'),
('2', 'Fabianddd', 'Pepito', 'Perez', 'Del Carmen', '2020-10-23', '$2y$10$tceRlw0LoTN2T.cp/aKv5.ufo.wjhXJi5aaExd4N9QYf6KaBxp.U2', NULL, 'elfabiancho01@gmail.com', 'CC'),
('2342', 'sadf', 'sdf', 'sadf', 'sfd', '2020-12-11', '$2y$10$br09ogp1Vpz2eoLVevPGnOUk6VFICqF0WrAtAj.OKle6EHYdZzKcq', '', 'sdf@dsf', 'CC'),
('3', 'Alejandro', 'Daniel', 'Perez', 'Perez', '2020-10-30', '$2y$10$pxCbE3ot3TRMhaydl5LHxO3v4It4932HWIFbCk1Aywy2D8sodwVCq', 'al.png', 'Alejandro@gmail.com', 'CC'),
('324', 'sdf', 'asdf', 'sadf', 'sadf', '2020-12-10', '$2y$10$PwIFjgZBrzYiFMP50CEESesglOv7W9aMDMW2fS9QpynBWumVGGYMW', '', 'sdf@dfss', 'CC'),
('4', 'Francisco', 'Roberto', 'Aguirre', 'Ayala', '2020-10-31', '$2y$10$62YVUv7w3/zPTYWe4SocpePBZ2u6VNk7Yya4qey8XWKmlNFvd44.2', 'usf.png', 'francisco@gmail.com', 'CC'),
('5', 'Pepito', 'Richar', 'Ramirez', 'Daza', '2020-11-06', '$2y$10$sFSjJ2EczPgz16BzzDwPLOoW56p2QjrrLW6bmvFVKmTENotzb7ZVe', 'user-icon1.jpg', 'pepito@gmail.com', 'CC'),
('6', 'Daniela', 'Milena', 'Echeverría', 'Fraga', '2020-10-30', '$2y$10$uJ59CIp7vZSAis30sGG2DOWmM4Huz5716IoQGE34g3ujEtKDTrdPe', 'Us001.jpg', 'mile@gmail.com', 'CC'),
('7', 'Sandra', 'Daniela', 'Quintero', 'Perez', '2020-12-30', '$2y$10$AN3A5I18iwYIFFxT1Ert9uDTf0SICmIRFMncskYMx./7uMnlbWtb6', 'duser.jpg', 'sandra@gmail.com', 'CC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`ID_a`),
  ADD KEY `FK_anuncio_tipo` (`FK_tipoA`);

--
-- Indices de la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD PRIMARY KEY (`ID_barrio`,`FK_localidad`,`FK_ciudad`),
  ADD KEY `FK_Localidad_FK_ciudad` (`FK_localidad`,`FK_ciudad`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_categoria`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`ID_ciudad`);

--
-- Indices de la tabla `det_factura`
--
ALTER TABLE `det_factura`
  ADD PRIMARY KEY (`FK_det_factura`,`FK_det_prod`),
  ADD KEY `FK_det_factura_1` (`FK_det_prod`),
  ADD KEY `CF_us_CF_tipo_doc` (`CF_us`,`CF_tipo_doc`);

--
-- Indices de la tabla `det_orden`
--
ALTER TABLE `det_orden`
  ADD PRIMARY KEY (`FK_ord`,`FK_prod`),
  ADD KEY `FK_prod` (`FK_prod`);

--
-- Indices de la tabla `det_producto`
--
ALTER TABLE `det_producto`
  ADD PRIMARY KEY (`FK_prod`,`FK_rut`),
  ADD KEY `FK_rut` (`FK_rut`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`ID_dir`,`FK_barrio`,`FK_Localidad`,`FK_Ciudad`),
  ADD KEY `CF_us_CF_tipo_doc_2` (`CF_us`,`CF_tipo_doc`),
  ADD KEY `CF_rut_1` (`CF_rut`),
  ADD KEY `FK_barrio_FK_Localidad_FK_Ciudad` (`FK_barrio`,`FK_Localidad`,`FK_Ciudad`);

--
-- Indices de la tabla `empresa_provedor`
--
ALTER TABLE `empresa_provedor`
  ADD PRIMARY KEY (`ID_rut`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID_factura`),
  ADD KEY `tipo_pago` (`FK_c_tipo_pago`),
  ADD KEY `tipo_venta` (`FK_tipoV`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`ID_localidad`,`FK_ciudad`),
  ADD KEY `FK_ciudad` (`FK_ciudad`);

--
-- Indices de la tabla `log_error`
--
ALTER TABLE `log_error`
  ADD PRIMARY KEY (`ID_error`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`ID_not`);

--
-- Indices de la tabla `modific`
--
ALTER TABLE `modific`
  ADD PRIMARY KEY (`ID_modifc`),
  ADD KEY `FK_tipo_doc_modific` (`FK_us`,`FK_doc`),
  ADD KEY `FK_modific` (`FK_modific`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`ID_not`),
  ADD KEY `FK_rol_notificacion` (`FK_rol`),
  ADD KEY `FK_tipo_notificacion` (`FK_not`);

--
-- Indices de la tabla `orden_entrada`
--
ALTER TABLE `orden_entrada`
  ADD PRIMARY KEY (`ID_ord`),
  ADD KEY `CF_rol_CF_rol_us_CF_tipo_doc` (`CF_rol`,`CF_rol_us`,`CF_tipo_doc`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_prod`),
  ADD KEY `CF_categoria` (`CF_categoria`),
  ADD KEY `CF_tipo_medida` (`CF_tipo_medida`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`Id_puntos`,`FK_us`,`FK_tipo_doc`),
  ADD KEY `FK_tipo_doc_puntos` (`FK_us`,`FK_tipo_doc`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_rol_n`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`FK_rol`,`FK_us`,`FK_tipo_doc`),
  ADD KEY `FK_us_FK_tipo_doc` (`FK_us`,`FK_tipo_doc`);

--
-- Indices de la tabla `servidor_correo`
--
ALTER TABLE `servidor_correo`
  ADD PRIMARY KEY (`ID_SC`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`ID_tel`),
  ADD KEY `CF_us_CF_tipo_doc_1` (`CF_us`,`CF_tipo_doc`),
  ADD KEY `CF_rut` (`CF_rut`);

--
-- Indices de la tabla `tipo_anuncio`
--
ALTER TABLE `tipo_anuncio`
  ADD PRIMARY KEY (`ID_at`);

--
-- Indices de la tabla `tipo_doc`
--
ALTER TABLE `tipo_doc`
  ADD PRIMARY KEY (`ID_acronimo`);

--
-- Indices de la tabla `tipo_medida`
--
ALTER TABLE `tipo_medida`
  ADD PRIMARY KEY (`ID_medida`);

--
-- Indices de la tabla `tipo_modific`
--
ALTER TABLE `tipo_modific`
  ADD PRIMARY KEY (`ID_t_modific`);

--
-- Indices de la tabla `tipo_not`
--
ALTER TABLE `tipo_not`
  ADD PRIMARY KEY (`ID_tipo_not`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`ID_tipo_pago`);

--
-- Indices de la tabla `tipo_venta`
--
ALTER TABLE `tipo_venta`
  ADD PRIMARY KEY (`Id_tipoV`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_us`,`FK_tipo_doc`),
  ADD KEY `FK_tipo_doc` (`FK_tipo_doc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `ID_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `barrio`
--
ALTER TABLE `barrio`
  MODIFY `ID_barrio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `ID_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `ID_dir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `ID_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `log_error`
--
ALTER TABLE `log_error`
  MODIFY `ID_error` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `ID_not` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `modific`
--
ALTER TABLE `modific`
  MODIFY `ID_modifc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `ID_not` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `orden_entrada`
--
ALTER TABLE `orden_entrada`
  MODIFY `ID_ord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `Id_puntos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_rol_n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servidor_correo`
--
ALTER TABLE `servidor_correo`
  MODIFY `ID_SC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `ID_tel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `tipo_anuncio`
--
ALTER TABLE `tipo_anuncio`
  MODIFY `ID_at` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_medida`
--
ALTER TABLE `tipo_medida`
  MODIFY `ID_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tipo_modific`
--
ALTER TABLE `tipo_modific`
  MODIFY `ID_t_modific` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_not`
--
ALTER TABLE `tipo_not`
  MODIFY `ID_tipo_not` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `ID_tipo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_venta`
--
ALTER TABLE `tipo_venta`
  MODIFY `Id_tipoV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `FK_anuncio_tipo` FOREIGN KEY (`FK_tipoA`) REFERENCES `tipo_anuncio` (`ID_at`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD CONSTRAINT `FK_Localidad_FK_ciudad` FOREIGN KEY (`FK_localidad`,`FK_ciudad`) REFERENCES `localidad` (`ID_localidad`, `FK_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_factura`
--
ALTER TABLE `det_factura`
  ADD CONSTRAINT `CF_us_CF_tipo_doc` FOREIGN KEY (`CF_us`,`CF_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_det_factura` FOREIGN KEY (`FK_det_factura`) REFERENCES `factura` (`ID_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_det_factura_1` FOREIGN KEY (`FK_det_prod`) REFERENCES `producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_orden`
--
ALTER TABLE `det_orden`
  ADD CONSTRAINT `FK_ord` FOREIGN KEY (`FK_ord`) REFERENCES `orden_entrada` (`ID_ord`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_prod` FOREIGN KEY (`FK_prod`) REFERENCES `producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `det_producto`
--
ALTER TABLE `det_producto`
  ADD CONSTRAINT `FK_prod_1` FOREIGN KEY (`FK_prod`) REFERENCES `producto` (`ID_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rut` FOREIGN KEY (`FK_rut`) REFERENCES `empresa_provedor` (`ID_rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `CF_rut_1` FOREIGN KEY (`CF_rut`) REFERENCES `empresa_provedor` (`ID_rut`) ON UPDATE CASCADE,
  ADD CONSTRAINT `CF_us_CF_tipo_doc_2` FOREIGN KEY (`CF_us`,`CF_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_barrio_FK_Localidad_FK_Ciudad` FOREIGN KEY (`FK_barrio`,`FK_Localidad`,`FK_Ciudad`) REFERENCES `barrio` (`ID_barrio`, `FK_localidad`, `FK_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `tipo_pago` FOREIGN KEY (`FK_c_tipo_pago`) REFERENCES `tipo_pago` (`ID_tipo_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_venta` FOREIGN KEY (`FK_tipoV`) REFERENCES `tipo_venta` (`Id_tipoV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD CONSTRAINT `FK_ciudad` FOREIGN KEY (`FK_ciudad`) REFERENCES `ciudad` (`ID_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modific`
--
ALTER TABLE `modific`
  ADD CONSTRAINT `FK_modific` FOREIGN KEY (`FK_modific`) REFERENCES `tipo_modific` (`ID_t_modific`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tipo_doc_modific` FOREIGN KEY (`FK_us`,`FK_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `FK_rol_notificacion` FOREIGN KEY (`FK_rol`) REFERENCES `rol` (`ID_rol_n`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tipo_notificacion` FOREIGN KEY (`FK_not`) REFERENCES `tipo_not` (`ID_tipo_not`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_entrada`
--
ALTER TABLE `orden_entrada`
  ADD CONSTRAINT `CF_rol_CF_rol_us_CF_tipo_doc` FOREIGN KEY (`CF_rol`,`CF_rol_us`,`CF_tipo_doc`) REFERENCES `rol_usuario` (`FK_rol`, `FK_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `CF_categoria` FOREIGN KEY (`CF_categoria`) REFERENCES `categoria` (`ID_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CF_tipo_medida` FOREIGN KEY (`CF_tipo_medida`) REFERENCES `tipo_medida` (`ID_medida`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD CONSTRAINT `FK_tipo_doc_puntos` FOREIGN KEY (`FK_us`,`FK_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `FK_rol` FOREIGN KEY (`FK_rol`) REFERENCES `rol` (`ID_rol_n`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_us_FK_tipo_doc` FOREIGN KEY (`FK_us`,`FK_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `CF_rut` FOREIGN KEY (`CF_rut`) REFERENCES `empresa_provedor` (`ID_rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CF_us_CF_tipo_doc_1` FOREIGN KEY (`CF_us`,`CF_tipo_doc`) REFERENCES `usuario` (`ID_us`, `FK_tipo_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_tipo_doc` FOREIGN KEY (`FK_tipo_doc`) REFERENCES `tipo_doc` (`ID_acronimo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
