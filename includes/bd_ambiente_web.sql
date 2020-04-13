-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2020 a las 00:08:54
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_ambiente_web`
--
CREATE DATABASE IF NOT EXISTS `bd_ambiente_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_ambiente_web`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE `carrito` (
  `ID_CARRITO` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_PROD` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `TOTAL` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleorden`
--

DROP TABLE IF EXISTS `detalleorden`;
CREATE TABLE `detalleorden` (
  `ID_DETALLE` int(11) NOT NULL,
  `ID_ORDEN` int(11) NOT NULL,
  `ID_PROD` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `COSTO` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleorden`
--

INSERT INTO `detalleorden` (`ID_DETALLE`, `ID_ORDEN`, `ID_PROD`, `CANTIDAD`, `COSTO`) VALUES
(8, 1, 1, 1, '5000.0'),
(9, 1, 4, 1, '15000.0'),
(10, 2, 8, 1, '7500.0'),
(12, 3, 5, 2, '30000.0'),
(13, 3, 7, 1, '11500.0'),
(14, 4, 8, 2, '15000.0'),
(15, 4, 2, 1, '10000.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

DROP TABLE IF EXISTS `orden`;
CREATE TABLE `orden` (
  `ID_ORDEN` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `DIRECCION` varchar(255) DEFAULT NULL,
  `TOTAL` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`ID_ORDEN`, `ID_USUARIO`, `DIRECCION`, `TOTAL`) VALUES
(1, 4, '300mts bomberos central, casa verde mano derecha.', '20000.0'),
(2, 4, '50mts este de la farmacia la central, casa color blanco.', '7500.0'),
(3, 5, '200mts norte y 100 oeste del templo catolico Tejar, casa color crema con tapia blanca y porton cafe grande a mano derecha.', '41500.0'),
(4, 6, '75 mts oeste del parque central de San Carlos, casa color azul mano derecha', '25000.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripccion` varchar(255) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `imageName` blob NOT NULL,
  `cantVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `descripccion`, `precio`, `imageName`, `cantVenta`) VALUES
(1, 'camiseta space', 'Color negro, talla S, Hombre', '5000', 0x31332e6a7067, 42),
(2, 'camisa de vestir cuadros', 'Color rojo, talla M, Hombre', '10000', 0x31322e6a7067, 32),
(3, 'camisa de vestir cuadros', 'Color celeste, talla S, Hombre', '1000', 0x31312e6a7067, 55),
(4, 'sweater', 'Color blanco, talla M, Hombre', '15000', 0x31302e6a7067, 28),
(5, 'sweater', 'Color turquesa, talla S, Mujer', '15000', 0x322e6a7067, 42),
(6, 'sweater', 'Color blanco/negro, talla M, Mujer', '15000', 0x312e6a7067, 47),
(7, 'pantalon', 'Color turquesa, talla 32, Mujer', '11500', 0x382e6a7067, 23),
(8, 'camisa manga corta', 'Color azul, talla S, Hombre', '7500', 0x392e6a7067, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(100) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `nickname_usuario` varchar(15) NOT NULL,
  `pass_usuario` varchar(60) NOT NULL,
  `tipoUsuario` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `nickname_usuario`, `pass_usuario`, `tipoUsuario`) VALUES
(1, 'Admin', 'admin', '$2y$04$43CLWElmDI9jd.VRM1dtHuo3pel8K1wU1QtGjnnaiKuWOvmBqHBn6', 'a'),
(4, 'Cliente Uno', 'cliente1', '$2y$04$fJ.fAbeBjeemcSVcVCMowONMubzj8LjHD4zhS7.ywrxceBPlYClt6', 'c'),
(5, 'Cliente Dos', 'cliente2', '$2y$04$tKnOJbm.cdYaLR0/50kY9.0Ug3ZUBBwxo2k0vocCs.Ys0kebsnIPW', 'c'),
(6, 'Cliente Tres', 'cliente3', '$2y$04$J/FiGXQoS8YoZ6QH9BT4seZ9uNs6TpKjXIJsuqlAk9yoBSOMWhB8y', 'c');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ID_CARRITO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_PROD` (`ID_PROD`);

--
-- Indices de la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_ORDEN` (`ID_ORDEN`),
  ADD KEY `ID_PROD` (`ID_PROD`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`ID_ORDEN`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nickname_usuario` (`nickname_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `ID_CARRITO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  MODIFY `ID_DETALLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`ID_PROD`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD CONSTRAINT `detalleorden_ibfk_1` FOREIGN KEY (`ID_ORDEN`) REFERENCES `orden` (`ID_ORDEN`),
  ADD CONSTRAINT `detalleorden_ibfk_2` FOREIGN KEY (`ID_PROD`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
