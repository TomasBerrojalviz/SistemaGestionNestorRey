-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-12-2022 a las 19:40:28
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
-- Creación: 31-10-2022 a las 23:59:25
--

CREATE TABLE `autos` (
  `id` int(11) NOT NULL,
  `patente` text NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `anio` text NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `autos`:
--   `id_cliente`
--       `clientes` -> `id`
--   `id_modelo`
--       `modelos` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambios`
--
-- Creación: 31-10-2022 a las 23:56:25
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
-- RELACIONES PARA LA TABLA `cambios`:
--   `id_auto`
--       `autos` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--
-- Creación: 10-11-2022 a las 17:36:40
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `domicilio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `clientes`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_presupuestos`
--
-- Creación: 24-11-2022 a las 17:53:28
-- Última actualización: 31-12-2022 a las 17:01:50
--

CREATE TABLE `insumos_presupuestos` (
  `id` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(9,2) NOT NULL,
  `precio_total` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `insumos_presupuestos`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_recibos`
--
-- Creación: 24-11-2022 a las 18:11:00
-- Última actualización: 31-12-2022 a las 17:14:34
--

CREATE TABLE `insumos_recibos` (
  `id` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL DEFAULT -1,
  `descripcion` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(9,2) NOT NULL,
  `precio_total` float(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `insumos_recibos`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--
-- Creación: 31-10-2022 a las 23:56:25
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `marcas`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--
-- Creación: 31-10-2022 a las 23:56:25
--

CREATE TABLE `modelos` (
  `id` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `modelo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `modelos`:
--   `id_marca`
--       `marcas` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--
-- Creación: 31-10-2022 a las 23:56:25
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `nota` text NOT NULL,
  `adjuntos` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `notas`:
--   `id_orden`
--       `ordenes` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--
-- Creación: 22-12-2022 a las 21:54:25
-- Última actualización: 31-12-2022 a las 17:14:38
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `fecha_recibido` datetime NOT NULL DEFAULT current_timestamp(),
  `problema` text NOT NULL,
  `fecha_devolucion` datetime DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `cobro` float(9,2) NOT NULL DEFAULT 0.00,
  `pago` float(9,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `ordenes`:
--   `id_auto`
--       `autos` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--
-- Creación: 09-11-2022 a las 19:34:00
-- Última actualización: 31-12-2022 a las 17:01:41
--

CREATE TABLE `presupuestos` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `presupuestos`:
--   `id_orden`
--       `ordenes` -> `id`
--   `id_cliente`
--       `clientes` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--
-- Creación: 31-12-2022 a las 17:14:58
-- Última actualización: 31-12-2022 a las 17:14:50
--

CREATE TABLE `recibos` (
  `id` int(11) NOT NULL,
  `id_orden` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `recibos`:
--   `id_orden`
--       `ordenes` -> `id`
--   `id_cliente`
--       `clientes` -> `id`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Creación: 22-12-2022 a las 22:17:55
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('user','admin') NOT NULL DEFAULT 'user',
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `usuarios`:
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patente` (`patente`) USING HASH,
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `marca` (`marca`) USING HASH;

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modelo` (`modelo`) USING HASH,
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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cambios`
--
ALTER TABLE `cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos_presupuestos`
--
ALTER TABLE `insumos_presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos_recibos`
--
ALTER TABLE `insumos_recibos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'sgnr', 'modelos', '{\"sorted_col\":\"`modelos`.`id_marca` ASC\"}', '2022-11-15 15:27:26');

--
-- Metadatos para la tabla notas
--

--
-- Metadatos para la tabla ordenes
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'sgnr', 'ordenes', '{\"sorted_col\":\"`ordenes`.`id` ASC\"}', '2022-12-26 22:49:51');

--
-- Metadatos para la tabla presupuestos
--

--
-- Metadatos para la tabla recibos
--

--
-- Metadatos para la tabla usuarios
--

--
-- Metadatos para la base de datos sgnr
--

--
-- Volcado de datos para la tabla `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_descr`) VALUES
('sgnr', 'sgnr');

SET @LAST_PAGE = LAST_INSERT_ID();

--
-- Volcado de datos para la tabla `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES
('sgnr', 'autos', @LAST_PAGE, 410, 331),
('sgnr', 'cambios', @LAST_PAGE, 118, 33),
('sgnr', 'clientes', @LAST_PAGE, 769, 611),
('sgnr', 'insumos_presupuestos', @LAST_PAGE, 1412, 78),
('sgnr', 'insumos_recibos', @LAST_PAGE, 1421, 584),
('sgnr', 'marcas', @LAST_PAGE, 54, 459),
('sgnr', 'modelos', @LAST_PAGE, 222, 403),
('sgnr', 'notas', @LAST_PAGE, 1066, 36),
('sgnr', 'ordenes', @LAST_PAGE, 730, 242),
('sgnr', 'presupuestos', @LAST_PAGE, 1177, 267),
('sgnr', 'recibos', @LAST_PAGE, 1175, 563);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
