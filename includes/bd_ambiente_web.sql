-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 02:52 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_ambiente_web`
--
CREATE DATABASE IF NOT EXISTS `bd_ambiente_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_ambiente_web`;

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
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
-- Table structure for table `detalleorden`
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
-- Dumping data for table `detalleorden`
--

-- --------------------------------------------------------

--
-- Table structure for table `orden`
--

DROP TABLE IF EXISTS `orden`;
CREATE TABLE `orden` (
  `ID_ORDEN` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `DIRECCION` varchar(255) DEFAULT NULL,
  `TOTAL` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orden`
--

-- --------------------------------------------------------

--
-- Table structure for table `producto`
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
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `descripccion`, `precio`, `imageName`, `cantVenta`) VALUES
(1, 'camiseta space', 'Color negro, talla S, Hombre', '5000', 0x31332e6a7067, 43),
(2, 'camisa de vestir cuadros', 'Color rojo, talla M, Hombre', '10000', 0x31322e6a7067, 35),
(3, 'camisa de vestir cuadros', 'Color celeste, talla S, Hombre', '1000', 0x31312e6a7067, 55),
(4, 'sweater', 'Color blanco, talla M, Hombre', '15000', 0x31302e6a7067, 30),
(5, 'sweater', 'Color turquesa, talla S, Mujer', '15000', 0x322e6a7067, 44),
(6, 'sweater', 'Color blanco/negro, talla M, Mujer', '15000', 0x312e6a7067, 50),
(7, 'pantalon', 'Color turquesa, talla 32, Mujer', '11500', 0x382e6a7067, 24),
(8, 'camisa manga corta', 'Color azul, talla S, Hombre', '7500', 0x392e6a7067, 35);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
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
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `nickname_usuario`, `pass_usuario`, `tipoUsuario`) VALUES
(1, 'Admin', 'admin', '$2y$04$43CLWElmDI9jd.VRM1dtHuo3pel8K1wU1QtGjnnaiKuWOvmBqHBn6', 'a'),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ID_CARRITO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_PROD` (`ID_PROD`);

--
-- Indexes for table `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_ORDEN` (`ID_ORDEN`),
  ADD KEY `ID_PROD` (`ID_PROD`);

--
-- Indexes for table `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`ID_ORDEN`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nickname_usuario` (`nickname_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `ID_CARRITO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detalleorden`
--
ALTER TABLE `detalleorden`
  MODIFY `ID_DETALLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`ID_PROD`) REFERENCES `producto` (`idProducto`);

--
-- Constraints for table `detalleorden`
--
ALTER TABLE `detalleorden`
  ADD CONSTRAINT `detalleorden_ibfk_1` FOREIGN KEY (`ID_ORDEN`) REFERENCES `orden` (`ID_ORDEN`),
  ADD CONSTRAINT `detalleorden_ibfk_2` FOREIGN KEY (`ID_PROD`) REFERENCES `producto` (`idProducto`);

--
-- Constraints for table `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
