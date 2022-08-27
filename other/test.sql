-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-08-2022 a las 20:08:00
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
  `id_estado` int(11) NOT NULL,
  `patente` text NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `anio` text NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autos`
--

INSERT INTO `autos` (`id`, `id_estado`, `patente`, `id_modelo`, `anio`, `id_cliente`) VALUES
(1, 0, 'HDC940', 1, '2009', 1),
(4, 1, 'ASD123', 32, '2020', 1),
(5, 2, 'QWE', 3, '123', 8),
(6, 5, 'QAZ', 2, '456', 8),
(7, 3, 'HDP666', 33, '2001', 10),
(8, 3, 'QWE123', 31, '2003', 10);

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
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `marca`) VALUES
(1, 'HONDA'),
(2, 'FORD'),
(3, 'FIAT'),
(4, 'AUDI'),
(5, 'BMW'),
(6, 'TOYOTA'),
(7, 'HYUNDAI'),
(8, 'PEUGEOT'),
(9, 'LAMBORGHINI'),
(10, 'FERRARI'),
(29, 'CHEVROLET'),
(36, 'VOLKSWAGEN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `modelo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `id_marca`, `modelo`) VALUES
(1, 1, 'FIT'),
(2, 6, 'ETIOS'),
(3, 2, 'KA'),
(4, 3, '147'),
(10, 8, '207'),
(11, 8, '206'),
(18, 8, '408'),
(19, 8, '308'),
(20, 8, '2008'),
(23, 3, 'UNO'),
(25, 3, 'CRONOS'),
(26, 3, '500X'),
(28, 1, 'CR-V'),
(29, 6, 'COROLLA'),
(30, 8, 'PARTNER'),
(31, 2, 'FOCUS'),
(32, 29, 'ONIX'),
(33, 36, 'VENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `fecha_recibido` date NOT NULL DEFAULT current_timestamp(),
  `problema` text NOT NULL,
  `notas` text DEFAULT NULL,
  `adjuntos` int(11) DEFAULT NULL,
  `id_recibo` int(11) NOT NULL,
  `id_presupuesto` int(11) NOT NULL,
  `solucion` text DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `id_auto`, `fecha_recibido`, `problema`, `notas`, `adjuntos`, `id_recibo`, `id_presupuesto`, `solucion`, `fecha_devolucion`, `estado`) VALUES
(3, 1, '2022-08-27', 'QWE', 'ASD', NULL, 0, 0, NULL, NULL, 1),
(4, 1, '2022-08-27', 'PROBLEMAS CON LA CORREA', 'REVISAR X COSA', NULL, 0, 0, NULL, NULL, 1),
(5, 4, '2022-08-27', 'QUILOMBO CON EL ONIX', 'TEST', NULL, 0, 0, NULL, NULL, 1),
(6, 8, '2022-08-27', 'AUTO GIANE', '', NULL, 0, 0, NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
