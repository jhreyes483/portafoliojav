-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: b5iuezjksb3w4hp92nei-mysql.services.clever-cloud.com:3306
-- Tiempo de generación: 02-06-2024 a las 00:47:46
-- Versión del servidor: 8.0.22-13
-- Versión de PHP: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `b5iuezjksb3w4hp92nei`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_cate` int NOT NULL,
  `name_c` varchar(50) NOT NULL,
  `fk_cate_prin` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_cate`, `name_c`, `fk_cate_prin`) VALUES
(6, 'SOFÁ CAMA', 1),
(7, 'SOFÁ', 1),
(8, 'SOFA L', 1),
(9, 'CAMAS', 3),
(10, 'JUEGO DE COMEDORES', 2),
(11, 'MESAS', 2),
(12, 'SILLAS', 2),
(13, 'BIFFES', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories_prin`
--

CREATE TABLE `categories_prin` (
  `id_cate_prin` int NOT NULL,
  `name_cate_prin` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categories_prin`
--

INSERT INTO `categories_prin` (`id_cate_prin`, `name_cate_prin`) VALUES
(1, 'SALAS'),
(2, 'COMEDORES'),
(3, 'ALCOBAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits`
--

CREATE TABLE `credits` (
  `id_credits` int NOT NULL,
  `term` int NOT NULL,
  `state` int NOT NULL,
  `name_credits` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `credits`
--

INSERT INTO `credits` (`id_credits`, `term`, `state`, `name_credits`) VALUES
(1, 1, 1, 'Contado'),
(2, 2, 2, 'Dos cuotas'),
(3, 3, 2, 'Tres cuotas'),
(4, 4, 2, 'Cuatro cuotas'),
(5, 5, 2, 'Cinco cuotas'),
(6, 6, 2, 'Seis cuotas'),
(7, 12, 2, 'Doce cuotas'),
(8, 24, 2, 'Veinticuatro cuotas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_types`
--

CREATE TABLE `document_types` (
  `acron` varchar(5) NOT NULL,
  `name_doc` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `document_types`
--

INSERT INTO `document_types` (`acron`, `name_doc`) VALUES
('CC', 'Cedula de ciudadania'),
('CE', 'Cedula extranjería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dues`
--

CREATE TABLE `dues` (
  `id_dues` int NOT NULL,
  `name` int DEFAULT NULL,
  `fk_credits` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `id_factura` int NOT NULL,
  `total` int NOT NULL,
  `date_inv` date NOT NULL,
  `iva` int DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `fk_payment` int NOT NULL,
  `fk_credits` int DEFAULT NULL,
  `fk_user` int NOT NULL,
  `fk_doc` varchar(5) DEFAULT NULL,
  `estatus` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `invoices`
--

INSERT INTO `invoices` (`id_factura`, `total`, `date_inv`, `iva`, `obs`, `fk_payment`, `fk_credits`, `fk_user`, `fk_doc`, `estatus`) VALUES
(5, 3296000, '2020-01-01', 626240, '', 1, 1, 2, 'CC', '4'),
(6, 1896000, '2021-02-14', 360240, '', 1, 1, 2, 'CC', '1'),
(7, 596269, '2021-02-17', 113291, NULL, 1, 1, 2, 'CE', '1'),
(8, 2301000, '2021-02-17', 437190, NULL, 1, 1, 2, 'CE', '1'),
(9, 1878423, '2021-02-17', 356900, '', 1, 1, 2, 'CC', '1'),
(10, 1698398, '2021-02-17', 322695, NULL, 1, 1, 2, 'CC', '3'),
(11, 2198000, '2021-02-27', 417620, NULL, 1, 1, 3, 'CE', '4'),
(12, 399000, '2021-02-28', 75810, NULL, 1, 1, 2, 'CC', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices_products`
--

CREATE TABLE `invoices_products` (
  `sub_total` int DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `fk_invoices` int NOT NULL,
  `fk_prod` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `invoices_products`
--

INSERT INTO `invoices_products` (`sub_total`, `amount`, `fk_invoices`, `fk_prod`) VALUES
(599000, 1, 5, 10),
(499000, 1, 5, 14),
(2198000, 2, 5, 16),
(798000, 2, 6, 9),
(599000, 1, 6, 10),
(499000, 1, 6, 14),
(499000, 1, 7, 14),
(399000, 1, 8, 9),
(1198000, 2, 8, 10),
(704000, 1, 8, 20),
(499000, 1, 9, 14),
(1347000, 3, 9, 18),
(599000, 1, 10, 12),
(1099000, 1, 10, 16),
(398, 1, 10, 19),
(399000, 1, 11, 9),
(1799000, 1, 11, 15),
(399000, 1, 12, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE `payment` (
  `id_payment` int NOT NULL,
  `name_payment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`id_payment`, `name_payment`) VALUES
(1, 'Efectivo'),
(2, 'Tarjera crédito'),
(3, 'Tarjeta debito '),
(4, 'Venta en linea ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_prod` int NOT NULL,
  `name_prod` varchar(50) NOT NULL,
  `prices` int NOT NULL,
  `stok` int NOT NULL,
  `est_com` varchar(15) NOT NULL,
  `est_sis` varchar(5) NOT NULL,
  `descript` varchar(200) DEFAULT NULL,
  `create_date` date NOT NULL,
  `fk_cate` int NOT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_prod`, `name_prod`, `prices`, `stok`, `est_com`, `est_sis`, `descript`, `create_date`, `fk_cate`, `img`) VALUES
(9, 'SOFACAMA MAURO CUERO SINTETICO', 399000, 3, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 6, '9.jpg'),
(10, 'SILLACAMA ANGELA CUERO SINTETICO', 599000, 1, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 6, '10.jpg'),
(11, 'SOFA VIVIR CUERO SINTETICO', 499000, 10, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 7, '11.jpg'),
(12, 'SOFÁ JOEL CUERO SINTÉTICO', 599000, 11, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 7, '12.jpg'),
(13, 'SALA MODULAR SOFÍA CUERO SINTÉTICO', 599000, 8, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-13', 8, '13.jpg'),
(14, 'CAMA ROMA MICRO FIBRA', 499000, 9, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 9, '14.jpg'),
(15, 'SALA CAMA STERIMBERG MICROFIBRA', 1799000, 1, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 9, '15.jpg'),
(16, 'JUEGO DE COMEDOR DINA 4 PUESTOS', 1099000, 18, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 10, '16.jpg'),
(17, 'JUEGO DE COMEDOR DINA 6 PUESTOS', 1399000, 17, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-13', 10, '17.jpg'),
(18, 'MESA DE COMEDOR ITALIA 4 PUESTOS', 449000, 9, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 11, '18.jpg'),
(19, 'PACK 2 SILLAS DINA', 398000, 33, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-13', 12, '19.jpg'),
(20, 'BIFFE LOFT', 704000, 7, '1', '1', 'Producto AAA, material confortable de gran calidad', '2021-02-14', 13, '20.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int NOT NULL,
  `name_rol` varchar(30) DEFAULT NULL,
  `assignment_date` date NOT NULL,
  `state` varchar(3) NOT NULL,
  `permits` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `name_rol`, `assignment_date`, `state`, `permits`) VALUES
(1, 'Administrador', '2021-02-13', '1', 'AZAERD'),
(2, 'Cliente', '2021-02-26', '1', 'AF345F'),
(3, 'Empleado', '2021-02-13', '1', 'SFDF34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_doc` int NOT NULL,
  `name1` varchar(30) NOT NULL,
  `name2` varchar(30) NOT NULL,
  `last_name1` varchar(30) NOT NULL,
  `last_name2` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `create_date` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `fk_rol` int NOT NULL,
  `fk_doc_acron` varchar(5) NOT NULL,
  `estatus` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_doc`, `name1`, `name2`, `last_name1`, `last_name2`, `email`, `create_date`, `gender`, `img`, `password`, `fk_rol`, `fk_doc_acron`, `estatus`) VALUES
(2, 'Sandra', 'Maria', 'Torres', 'Perez', 'cliente@desarrollador.com', '2021-02-13', 'm', 'kendall.jpg', 'cliente*', 2, 'CC', '1'),
(3, 'Pedro', 'Fabian', 'Daza', 'Torres', 'vendedor@desarrollador.com', '2021-02-23', '2021-02-13', 'f', 'vendedor*', 3, 'CC', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cate`),
  ADD KEY `fk_cate_prin` (`fk_cate_prin`);

--
-- Indices de la tabla `categories_prin`
--
ALTER TABLE `categories_prin`
  ADD PRIMARY KEY (`id_cate_prin`);

--
-- Indices de la tabla `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id_credits`);

--
-- Indices de la tabla `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`acron`);

--
-- Indices de la tabla `dues`
--
ALTER TABLE `dues`
  ADD PRIMARY KEY (`id_dues`),
  ADD KEY `dues_fk` (`fk_credits`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `fk_credits` (`fk_credits`),
  ADD KEY `fk_payment` (`fk_payment`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Indices de la tabla `invoices_products`
--
ALTER TABLE `invoices_products`
  ADD PRIMARY KEY (`fk_invoices`,`fk_prod`),
  ADD KEY `fk_prod` (`fk_prod`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `fk_cate` (`fk_cate`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_doc`,`fk_doc_acron`),
  ADD KEY `fk_doc_acron` (`fk_doc_acron`),
  ADD KEY `fk_rol` (`fk_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cate` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `categories_prin`
--
ALTER TABLE `categories_prin`
  MODIFY `id_cate_prin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `credits`
--
ALTER TABLE `credits`
  MODIFY `id_credits` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `dues`
--
ALTER TABLE `dues`
  MODIFY `id_dues` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id_factura` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_prod` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_cate_prin` FOREIGN KEY (`fk_cate_prin`) REFERENCES `categories_prin` (`id_cate_prin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dues`
--
ALTER TABLE `dues`
  ADD CONSTRAINT `dues_fk` FOREIGN KEY (`fk_credits`) REFERENCES `credits` (`id_credits`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_credits` FOREIGN KEY (`fk_credits`) REFERENCES `credits` (`id_credits`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_payment` FOREIGN KEY (`fk_payment`) REFERENCES `payment` (`id_payment`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`fk_user`) REFERENCES `users` (`id_doc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `invoices_products`
--
ALTER TABLE `invoices_products`
  ADD CONSTRAINT `fk_invoices` FOREIGN KEY (`fk_invoices`) REFERENCES `invoices` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prod` FOREIGN KEY (`fk_prod`) REFERENCES `products` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_cate` FOREIGN KEY (`fk_cate`) REFERENCES `categories` (`id_cate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_doc_acron` FOREIGN KEY (`fk_doc_acron`) REFERENCES `document_types` (`acron`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`fk_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
