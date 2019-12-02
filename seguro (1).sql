-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2019 a las 15:02:34
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seguro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `folio` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `noSeguro` int(11) DEFAULT NULL,
  `noExpediente` int(11) DEFAULT NULL,
  `presion` decimal(6,2) DEFAULT NULL,
  `peso` decimal(6,2) DEFAULT NULL,
  `estaruta` decimal(6,2) DEFAULT NULL,
  `diagnostico` varchar(400) DEFAULT NULL,
  `prescripcion` varchar(400) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`folio`, `cedula`, `noSeguro`, `noExpediente`, `presion`, `peso`, `estaruta`, `diagnostico`, `prescripcion`, `fecha`) VALUES
('102', '104', 1, 1, '120.00', '80.00', '1.70', 'sobrepeso', 'ejercicio', '2019-11-19'),
('104', '104', 3, 3, '150.00', '90.00', '1.90', 'hipertenso', 'metifenidato', '2019-11-24'),
('3201911231901', '104', 3, 3, '3.00', '3.00', '3.00', 'goo', 'goo', '2019-11-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `cedula` varchar(10) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`cedula`, `correo`, `pass`) VALUES
('101', 'adan@adan', 'password'),
('102', 'carlos@agc', 'password'),
('103', 'hhhh', 'DF048A31F4985F731F6DB803AE2C1A6F'),
('104', 'ttt', 'DF048A31F4985F731F6DB803AE2C1A6F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `noSeguro` int(11) NOT NULL,
  `noExpediente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `domicilio` varchar(100) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`noSeguro`, `noExpediente`, `nombre`, `domicilio`, `fechaNac`) VALUES
(1, 1, 'adan gomez', 'neutla', '1996-08-05'),
(2, 2, 'pablo', 'neutla', '1996-04-10'),
(3, 3, 'carlos', 'ssdd', '2000-12-12'),
(4, 4, 'juan', NULL, NULL),
(5, 5, 'sandra', 'Empalme escobedo', '1995-06-26'),
(6, 6, 'roberto', 'empalme escobedo', '1996-12-12'),
(7, 7, 'mario', 'valle de santiago', '1996-10-15'),
(101, 100, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`folio`),
  ADD UNIQUE KEY `folio` (`folio`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `noSeguro` (`noSeguro`,`noExpediente`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`noSeguro`,`noExpediente`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `medicos` (`cedula`),
  ADD CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`noSeguro`,`noExpediente`) REFERENCES `pacientes` (`noSeguro`, `noExpediente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
