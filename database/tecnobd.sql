-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2023 a las 22:08:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnobd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `CategoriaID` int(11) NOT NULL,
  `DesCategoria` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`CategoriaID`, `DesCategoria`) VALUES
(1, 'Discos Duros'),
(2, 'Procesadores'),
(3, 'Monitores'),
(4, 'RAM'),
(5, 'Tarjetas Gráficas'),
(6, 'Teclados'),
(7, 'Mouse');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesventa`
--

CREATE TABLE `detallesventa` (
  `DetalleVentaID` int(11) NOT NULL,
  `VentaID` int(11) DEFAULT NULL,
  `ProductoID` int(11) DEFAULT NULL,
  `CantidadVendida` int(11) DEFAULT NULL,
  `PrecioVenta` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `PreguntaID` int(11) NOT NULL,
  `Pregunta` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`PreguntaID`, `Pregunta`) VALUES
(1, '¿Cuál es el nombre de tu primera mascota?'),
(2, '¿Cuál es tu equipo de fútbol favorito?'),
(3, '¿Cuál es el nombre de tu mejor amigo/a?'),
(4, '¿Cuál es tu color favorito?'),
(5, '¿Cuál es tu banda o artista favorito?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ProductoID` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripción` varchar(250) NOT NULL,
  `Modelo` varchar(50) DEFAULT NULL,
  `NúmeroSerie` varchar(30) DEFAULT NULL,
  `ProveedorID` int(11) DEFAULT NULL,
  `PrecioCompra` decimal(10,2) DEFAULT NULL,
  `PrecioVenta` decimal(10,2) DEFAULT NULL,
  `CantidadStock` int(11) DEFAULT NULL,
  `Imagen` varchar(30) DEFAULT NULL,
  `CategoriaID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ProductoID`, `Nombre`, `Descripción`, `Modelo`, `NúmeroSerie`, `ProveedorID`, `PrecioCompra`, `PrecioVenta`, `CantidadStock`, `Imagen`, `CategoriaID`) VALUES
(4, 'Pollo', 'hola', 'Cuantum', '4556585', 1, 4.00, 5.00, 6, '', 1),
(5, 'humus', 'jojojo', 'acelga', '78945', 2, 45.00, 10.00, 89, '', 5),
(6, 'raton ms', 'raton mini slim para manos pequeñas', 'ms lux', '653320', 1, 250.00, 60.00, 5, '', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ProveedorID` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Dirección` varchar(150) DEFAULT NULL,
  `NúmeroContacto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ProveedorID`, `Nombre`, `Dirección`, `NúmeroContacto`) VALUES
(1, 'Jose Luis Ornelas Valadez', 'Santander 127 Col. España', '+52 1 449 279 5404'),
(2, 'Adrian Alonso Arambula', 'Santander 127 Col. España', '+52 1 449 543 6109');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ClienteID` int(11) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Dirección` varchar(150) DEFAULT NULL,
  `NúmeroContacto` varchar(20) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Contraseña` varchar(40) DEFAULT NULL,
  `Cuenta` varchar(30) DEFAULT NULL,
  `PreguntaID` int(11) DEFAULT NULL,
  `RespuestaP` varchar(50) DEFAULT NULL,
  `Estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ClienteID`, `IsAdmin`, `Nombre`, `Dirección`, `NúmeroContacto`, `Correo`, `Contraseña`, `Cuenta`, `PreguntaID`, `RespuestaP`, `Estado`) VALUES
(1, 0, 'Adrian Alonso Arambula', 'Santander 127 Col. España', '(449) 543-6109', 'adrianalonso.a4@gmail.com', 'e9d1d42e658461e23c02ca01d57bf7b31d9d4f51', 'YuunoDev', 4, 'azul', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `VentaID` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `ClienteID` int(11) DEFAULT NULL,
  `PrecioVentaTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CategoriaID`);

--
-- Indices de la tabla `detallesventa`
--
ALTER TABLE `detallesventa`
  ADD PRIMARY KEY (`DetalleVentaID`),
  ADD KEY `VentaID` (`VentaID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`PreguntaID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ProductoID`),
  ADD KEY `ProveedorID` (`ProveedorID`),
  ADD KEY `fk_Producto_Categoria` (`CategoriaID`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ProveedorID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ClienteID`),
  ADD KEY `fk_Pregunta_Usuario` (`PreguntaID`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`VentaID`),
  ADD KEY `ClienteID` (`ClienteID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detallesventa`
--
ALTER TABLE `detallesventa`
  MODIFY `DetalleVentaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `PreguntaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ProductoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ProveedorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ClienteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `VentaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallesventa`
--
ALTER TABLE `detallesventa`
  ADD CONSTRAINT `DetallesVenta_ibfk_1` FOREIGN KEY (`VentaID`) REFERENCES `ventas` (`VentaID`),
  ADD CONSTRAINT `DetallesVenta_ibfk_2` FOREIGN KEY (`ProductoID`) REFERENCES `producto` (`ProductoID`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `Producto_ibfk_1` FOREIGN KEY (`ProveedorID`) REFERENCES `proveedores` (`ProveedorID`),
  ADD CONSTRAINT `fk_Producto_Categoria` FOREIGN KEY (`CategoriaID`) REFERENCES `categoria` (`CategoriaID`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_Pregunta_Usuario` FOREIGN KEY (`PreguntaID`) REFERENCES `preguntas` (`PreguntaID`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `Ventas_ibfk_1` FOREIGN KEY (`ClienteID`) REFERENCES `usuarios` (`ClienteID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
