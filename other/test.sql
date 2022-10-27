-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2022 a las 02:20:32
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE `autos` (
  `id` int(11) NOT NULL,
  `patente` text NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `anio` text NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `patente`, `id_modelo`, `anio`, `id_cliente`) VALUES
(1, 'HDC940', 1, '2009', 1),
(4, 'ASD123', 32, '2020', 1),
(5, 'QWE', 3, '123', 8),
(6, 'QAZ', 2, '456', 8),
(7, 'HDP666', 33, '2001', 10),
(8, 'QWE123', 31, '2003', 10),
(9, 'AAA666', 30, '2022', 8),
(10, 'ZXC123', 10, '123', 1),
(11, '123', 28, '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambios`
--

CREATE TABLE `cambios` (
  `id` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `fecha_cambio` datetime NOT NULL DEFAULT current_timestamp(),
  `aceite` text NOT NULL,
  `km_actual` int(11) NOT NULL,
  `prox_cambio` int(11) NOT NULL,
  `filtro_aceite` datetime NOT NULL DEFAULT current_timestamp(),
  `filtro_aire` datetime NOT NULL DEFAULT current_timestamp(),
  `filtro_combustible` datetime NOT NULL DEFAULT current_timestamp(),
  `filtro_habitaculo` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cambios`
--

INSERT INTO `cambios` (`id`, `id_auto`, `fecha_cambio`, `aceite`, `km_actual`, `prox_cambio`, `filtro_aceite`, `filtro_aire`, `filtro_combustible`, `filtro_habitaculo`) VALUES
(1, 1, '2022-09-19 09:56:46', 'ACEITIN', 1750, 3000, '0000-00-00 00:00:00', '2022-09-19 09:56:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '2022-09-19 09:57:37', 'PEPITO', 3500, 4500, '2022-09-19 09:57:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-09-19 09:57:37'),
(3, 1, '0000-00-00 00:00:00', '', 0, 0, '0000-00-00 00:00:00', '2022-09-19 09:58:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 7, '0000-00-00 00:00:00', '', 0, 0, '2022-09-19 09:59:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `mail` text DEFAULT NULL,
  `domicilio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `telefono`, `mail`, `domicilio`) VALUES
(1, 'TOMAS BERROJALVIZ', '1165006784', 'CAI.BERROJALVIZ.TOMAS@GMAIL.COM', 'SANTIAGO DEL ESTERO 1767, LANUS'),
(8, 'FABIAN CANETE', '1121803501', 'FABIANCANETE21@GMAIL.COM', 'OTTO KRAUSSE 1522, ISIDRO CASANOVA'),
(10, 'GIANE', '123', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_presupuestos`
--

CREATE TABLE `insumos_presupuestos` (
  `id` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `precio_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos_presupuestos`
--

INSERT INTO `insumos_presupuestos` (`id`, `id_comprobante`, `descripcion`, `cantidad`, `precio`, `precio_total`) VALUES
(1, 1, 'MANO DE OBRA', 1, 10000, 10000),
(2, 1, 'FRENOS', 1, 7000, 7000),
(3, 1, 'PINTURA', 2, 3000, 6000),
(4, 2, 'MANO DE OBRA', 1, 5000, 5000),
(5, 2, 'ACEITE', 1, 2700, 2700),
(6, 2, 'FILTROS', 3, 850, 2550),
(7, 2, 'LLANTAS', 4, 5000, 20000),
(8, 1, 'FRENOS', 1, 500, 500),
(9, 3, 'MANO DE OBRA', 1, 10000, 10000),
(10, 3, 'FRENOS', 2, 1500, 3000),
(11, 4, 'MANO DE OBRA', 1, 10000, 10000),
(12, 4, 'BUJIA', 1, 10000, 10000),
(13, 4, 'FRENOS', 2, 7500, 15000),
(14, 5, 'MANO DE OBRA', 1, 10000, 10000),
(15, 6, 'MANO DE OBRA', 1, 10000, 10000),
(16, 7, 'MANO DE OBRA', 1, 10000, 10000),
(17, 2, 'FRENOS', 2, 3000, 6000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_recibos`
--

CREATE TABLE `insumos_recibos` (
  `id` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `precio_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos_recibos`
--

INSERT INTO `insumos_recibos` (`id`, `id_comprobante`, `descripcion`, `cantidad`, `precio`, `precio_total`) VALUES
(1, 1, 'MANO DE OBRA', 1, 5000, 5000),
(2, 2, 'MANO DE OBRA', 1, 10000, 10000),
(5, 1, 'LLANTAS', 4, 5000, 20000),
(13, 1, 'FILTRO DE AIRE', 1, 3000, 3000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `marca`) VALUES
(1, 'ALFA ROMEO'),
(2, 'AUDI'),
(3, 'BENTLEY'),
(4, 'BMW'),
(5, 'BUGATTI'),
(6, 'CADILLAC'),
(7, 'CHERRY'),
(8, 'CHEVROLET'),
(9, 'CITROEN'),
(10, 'CORVETTE'),
(11, 'DODGE'),
(12, 'FERRARI'),
(13, 'FIAT'),
(14, 'FORD'),
(15, 'HONDA'),
(16, 'HUMMER'),
(17, 'HYUNDAI'),
(18, 'JAGUAR'),
(19, 'JEEP'),
(20, 'KIA'),
(21, 'LAMBORGHINI'),
(22, 'MASERATI'),
(23, 'MAZDA'),
(24, 'MERCEDES BENZ'),
(25, 'MINI'),
(26, 'MITSUBISHI'),
(27, 'NISSAN'),
(28, 'PEUGEOT'),
(29, 'PORSCHE'),
(30, 'RENAULT'),
(31, 'ROLLS ROYCE'),
(32, 'SUBARU'),
(33, 'SUZUKI'),
(34, 'TOYOTA'),
(35, 'VOLKSWAGEN'),
(36, 'VOLVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `modelo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `id_marca`, `modelo`) VALUES
(1, 15, 'FIT'),
(2, 34, 'ETIOS'),
(3, 14, 'KA'),
(4, 13, '147'),
(10, 28, '207'),
(11, 28, '206'),
(18, 28, '408'),
(19, 28, '308'),
(20, 28, '2008'),
(23, 13, 'UNO'),
(25, 13, 'CRONOS'),
(26, 13, '500X'),
(28, 15, 'CR-V'),
(29, 34, 'COROLLA'),
(30, 28, 'PARTNER'),
(31, 14, 'FOCUS'),
(32, 8, 'ONIX'),
(33, 35, 'VENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `nota` text NOT NULL,
  `adjuntos` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `fecha`, `nota`, `adjuntos`, `id_orden`) VALUES
(1, '2022-10-04 11:39:08', 'QWE', 2, 6),
(2, '2022-10-04 19:26:17', 'HOLA', 6, 6),
(3, '2022-10-04 21:38:45', 'ASDFASDF', 0, 6),
(4, '2022-10-06 11:30:18', 'AUTO TO CHOCAO XDXD', 1, 6),
(5, '2022-10-06 19:51:33', 'ASDFASDF', 1, 6),
(6, '2022-10-06 21:27:21', 'SE CAMBIAN LOS FRENOS', 1, 6),
(7, '2022-10-06 21:28:55', 'TEST FOTO', 1, 6),
(8, '2022-10-18 14:10:04', 'WHAT IS LOREM IPSUM?\r\nLOREM IPSUM IS SIMPLY DUMMY TEXT OF THE PRINTING AND TYPESETTING INDUSTRY. LOREM IPSUM HAS BEEN THE INDUSTRY\'S STANDARD DUMMY TEXT EVER SINCE THE 1500S, WHEN AN UNKNOWN PRINTER TOOK A GALLEY OF TYPE AND SCRAMBLED IT TO MAKE A TYPE SPECIMEN BOOK. IT HAS SURVIVED NOT ONLY FIVE CENTURIES, BUT ALSO THE LEAP INTO ELECTRONIC TYPESETTING, REMAINING ESSENTIALLY UNCHANGED. IT WAS POPULARISED IN THE 1960S WITH THE RELEASE OF LETRASET SHEETS CONTAINING LOREM IPSUM PASSAGES, AND MORE RECENTLY WITH DESKTOP PUBLISHING SOFTWARE LIKE ALDUS PAGEMAKER INCLUDING VERSIONS OF LOREM IPSUM.\r\n\r\nWHY DO WE USE IT?\r\nIT IS A LONG ESTABLISHED FACT THAT A READER WILL BE DISTRACTED BY THE READABLE CONTENT OF A PAGE WHEN LOOKING AT ITS LAYOUT. THE POINT OF USING LOREM IPSUM IS THAT IT HAS A MORE-OR-LESS NORMAL DISTRIBUTION OF LETTERS, AS OPPOSED TO USING \'CONTENT HERE, CONTENT HERE\', MAKING IT LOOK LIKE READABLE ENGLISH. MANY DESKTOP PUBLISHING PACKAGES AND WEB PAGE EDITORS NOW USE LOREM IPSUM AS THEIR DEFAULT MODEL TEXT, AND A SEARCH FOR \'LOREM IPSUM\' WILL UNCOVER MANY WEB SITES STILL IN THEIR INFANCY. VARIOUS VERSIONS HAVE EVOLVED OVER THE YEARS, SOMETIMES BY ACCIDENT, SOMETIMES ON PURPOSE (INJECTED HUMOUR AND THE LIKE).\r\n', 0, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `fecha_recibido` datetime NOT NULL DEFAULT current_timestamp(),
  `problema` text NOT NULL,
  `solucion` text DEFAULT NULL,
  `fecha_devolucion` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `cobro` int(11) NOT NULL DEFAULT 0,
  `pago` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `id_auto`, `fecha_recibido`, `problema`, `solucion`, `fecha_devolucion`, `estado`, `cobro`, `pago`) VALUES
(4, 7, '2022-08-30 00:00:00', 'ASDFASFDASFASASDFASFDASFASASDFASFDASFASASD FASFDASFASASDFASFDASFASASDFASFDASFASASDFASFDASFASASDFASFDASFASASDFASFDASFASASDFASFDASFASASDFASFDASFAS', NULL, NULL, 1, 0, 0),
(5, 5, '2022-09-02 00:00:00', 'BUJIAS', NULL, NULL, 2, 0, 0),
(6, 7, '2022-09-08 14:16:18', 'FRENOS', NULL, '2022-10-19 11:16:40', 5, 10000, 28000),
(7, 1, '2022-09-12 19:43:06', 'QWEQWEQWE\nASHDAHJSD', NULL, NULL, 1, 0, 0),
(8, 1, '2022-09-14 23:21:08', 'EL TOPY SE QUIZO HACER EL RETO TOKYO Y CHOCO TODO EL AUTO', NULL, NULL, 1, 0, 0),
(9, 1, '2022-09-17 19:51:51', 'BUJIA ROTA', NULL, '2022-09-19 16:08:28', 4, 0, 0),
(10, 4, '2022-09-19 11:50:11', 'TEST', NULL, NULL, 3, 0, 0),
(11, 1, '2022-10-19 11:21:14', 'ASDASD', NULL, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`id`, `id_orden`, `id_cliente`, `fecha`) VALUES
(1, 8, 1, '2022-09-15 20:47:00'),
(2, 6, 10, '2022-09-16 15:17:07'),
(3, 5, 8, '2022-09-16 16:13:42'),
(4, 9, 1, '2022-09-17 19:54:00'),
(5, 10, 1, '2022-09-19 11:54:43'),
(6, 4, 10, '2022-09-19 15:22:46'),
(7, 7, 1, '2022-09-22 23:30:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE `recibos` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id`, `id_orden`, `id_cliente`, `fecha`) VALUES
(1, 6, 10, '2022-10-26 14:08:42'),
(2, 10, 1, '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modelo` (`id_modelo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `cambios`
--
ALTER TABLE `cambios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auto` (`id_auto`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos_presupuestos`
--
ALTER TABLE `insumos_presupuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_presupuesto` (`id_comprobante`);

--
-- Indices de la tabla `insumos_recibos`
--
ALTER TABLE `insumos_recibos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_recibo` (`id_comprobante`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orden` (`id_orden`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auto` (`id_auto`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cambios`
--
ALTER TABLE `cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `insumos_presupuestos`
--
ALTER TABLE `insumos_presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `insumos_recibos`
--
ALTER TABLE `insumos_recibos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autos`
--
ALTER TABLE `autos`
  ADD CONSTRAINT `autos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `autos_ibfk_3` FOREIGN KEY (`id_modelo`) REFERENCES `modelos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cambios`
--
ALTER TABLE `cambios`
  ADD CONSTRAINT `cambios_ibfk_1` FOREIGN KEY (`id_auto`) REFERENCES `autos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `insumos_presupuestos`
--
ALTER TABLE `insumos_presupuestos`
  ADD CONSTRAINT `insumos_presupuestos_ibfk_1` FOREIGN KEY (`id_comprobante`) REFERENCES `presupuestos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `insumos_recibos`
--
ALTER TABLE `insumos_recibos`
  ADD CONSTRAINT `insumos_recibos_ibfk_1` FOREIGN KEY (`id_comprobante`) REFERENCES `recibos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `ordenes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`id_auto`) REFERENCES `autos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `presupuestos_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `ordenes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `presupuestos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD CONSTRAINT `recibos_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `ordenes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `recibos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla autos
--

--
-- Metadatos para la tabla cambios
--

--
-- Metadatos para la tabla clientes
--

--
-- Metadatos para la tabla insumos_presupuestos
--

--
-- Metadatos para la tabla insumos_recibos
--

--
-- Metadatos para la tabla marcas
--

--
-- Metadatos para la tabla modelos
--

--
-- Metadatos para la tabla notas
--

--
-- Metadatos para la tabla ordenes
--

--
-- Metadatos para la tabla presupuestos
--

--
-- Metadatos para la tabla recibos
--

--
-- Metadatos para la base de datos test
--

--
-- Volcado de datos para la tabla `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_descr`) VALUES
('test', 'SisGestion');

SET @LAST_PAGE = LAST_INSERT_ID();

--
-- Volcado de datos para la tabla `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES
('test', 'autos', @LAST_PAGE, 644, 617),
('test', 'cambios', @LAST_PAGE, 66, 527),
('test', 'clientes', @LAST_PAGE, 828, 345),
('test', 'insumos_presupuestos', @LAST_PAGE, 1259, 20),
('test', 'insumos_recibos', @LAST_PAGE, 1286, 258),
('test', 'marcas', @LAST_PAGE, 305, 699),
('test', 'modelos', @LAST_PAGE, 455, 676),
('test', 'notas', @LAST_PAGE, 383, 83),
('test', 'ordenes', @LAST_PAGE, 588, 190),
('test', 'presupuestos', @LAST_PAGE, 1037, 47),
('test', 'recibos', @LAST_PAGE, 1060, 267);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
