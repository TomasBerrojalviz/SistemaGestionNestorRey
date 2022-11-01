-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2022 a las 00:22:48
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
-- Base de datos: `sgnr`
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

REPLACE INTO `autos` (`id`, `patente`, `id_modelo`, `anio`, `id_cliente`) VALUES
(1, 'HDC940', 1, '2009', 1);

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

REPLACE INTO `clientes` (`id`, `nombre`, `telefono`, `mail`, `domicilio`) VALUES
(1, 'TOMAS BERROJALVIZ', '1165006784', 'CAI.BERROJALVIZ.TOMAS@GMAIL.COM', 'SANTIAGO DEL ESTERO 1767, LANUS'),
(8, 'FABIAN CANETE', '1121803501', 'FABIANCANETE21@GMAIL.COM', 'OTTO KRAUSSE 1522, ISIDRO CASANOVA');

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

REPLACE INTO `insumos_presupuestos` (`id`, `id_comprobante`, `descripcion`, `cantidad`, `precio`, `precio_total`) VALUES
(1, 1, 'MANO DE OBRA', 1, 5000, 5000),
(2, 1, 'CORREA', 1, 12000, 12000);

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

REPLACE INTO `insumos_recibos` (`id`, `id_comprobante`, `descripcion`, `cantidad`, `precio`, `precio_total`) VALUES
(1, 1, 'MANO DE OBRA', 1, 5000, 5000),
(2, 1, 'CORREA', 1, 12000, 12000);

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

REPLACE INTO `marcas` (`id`, `marca`) VALUES
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

REPLACE INTO `modelos` (`id`, `id_marca`, `modelo`) VALUES
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

REPLACE INTO `notas` (`id`, `fecha`, `nota`, `adjuntos`, `id_orden`) VALUES
(1, '2022-11-01 15:33:29', 'SE TRAE AUTO PARA REVISAR Y ES LA CORREA, SE COMPRARA UNA NUEVA Y CAMBIARA', 0, 1),
(2, '2022-11-01 15:34:22', 'SE CAMBIO CORREA Y YA NO HACE EL RUIDO', 1, 1),
(3, '2022-11-01 16:26:59', 'TESTEO DE COMO SE VEN DIFERENTES ADJUNTOS, ADEMAS DE UN TEXTO MAS LARGO PARA VER COMO AFECTA A LAS CELDAS DEL HISTORIAL. RECORDANDO QUE HAY UN MAXIMO DE 600 CARACTERES POR NOTA POR AHORA.', 5, 1);

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

REPLACE INTO `ordenes` (`id`, `id_auto`, `fecha_recibido`, `problema`, `solucion`, `fecha_devolucion`, `estado`, `cobro`, `pago`) VALUES
(1, 1, '2022-11-01 15:31:52', 'RUIDOS EN EL MOTOR POR CORREA', NULL, '2022-11-01 15:34:44', 4, 0, 17000);

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

REPLACE INTO `presupuestos` (`id`, `id_orden`, `id_cliente`, `fecha`) VALUES
(1, 1, 1, '2022-11-01 15:32:10');

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

REPLACE INTO `recibos` (`id`, `id_orden`, `id_cliente`, `fecha`) VALUES
(1, 1, 1, '2022-11-01 15:32:57');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cambios`
--
ALTER TABLE `cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `insumos_presupuestos`
--
ALTER TABLE `insumos_presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `insumos_recibos`
--
ALTER TABLE `insumos_recibos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Metadatos para la base de datos sgnr
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
