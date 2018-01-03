-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-01-2018 a las 20:11:38
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `genus_elector`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `admin_cedula` bigint(20) NOT NULL,
  `admin_clave` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudadano`
--

CREATE TABLE IF NOT EXISTS `ciudadano` (
  `ciudadano_cedula` bigint(20) NOT NULL,
  `ciudadano_nombre1` varchar(200) NOT NULL,
  `ciudadano_nombre2` varchar(200) NOT NULL,
  `ciudadano_apellido1` varchar(200) NOT NULL,
  `ciudadano_apellido2` varchar(200) NOT NULL,
  `ciudadano_genero` varchar(1) NOT NULL,
  `ciudadano_edad` int(11) NOT NULL,
  `ciudadano_tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`ciudadano_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudadano`
--

INSERT INTO `ciudadano` (`ciudadano_cedula`, `ciudadano_nombre1`, `ciudadano_nombre2`, `ciudadano_apellido1`, `ciudadano_apellido2`, `ciudadano_genero`, `ciudadano_edad`, `ciudadano_tipo`) VALUES
(123456, 'PEDRO', 'PABLO', 'PEREZ', 'PEREIRA', 'M', 37, 'Profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE IF NOT EXISTS `comuna` (
  `comuna_numero` int(11) NOT NULL,
  `comuna_nombre` varchar(200) NOT NULL,
  `comuna_estado` int(11) NOT NULL,
  PRIMARY KEY (`comuna_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`comuna_numero`, `comuna_nombre`, `comuna_estado`) VALUES
(1, 'Comuna 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jurado`
--

CREATE TABLE IF NOT EXISTS `jurado` (
  `jurado_cedula` bigint(20) NOT NULL,
  `jurado_nombre1` varchar(200) NOT NULL,
  `jurado_nombre2` varchar(200) NOT NULL,
  `jurado_apellido1` varchar(200) NOT NULL,
  `jurado_apellido2` varchar(200) NOT NULL,
  `jurado_clave` varchar(50) NOT NULL,
  `jurado_nivel` int(11) NOT NULL,
  `jurado_estado` int(11) NOT NULL,
  `puesto_numero` int(11) NOT NULL,
  PRIMARY KEY (`jurado_cedula`),
  KEY `puesto_numero` (`puesto_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jurado`
--

INSERT INTO `jurado` (`jurado_cedula`, `jurado_nombre1`, `jurado_nombre2`, `jurado_apellido1`, `jurado_apellido2`, `jurado_clave`, `jurado_nivel`, `jurado_estado`, `puesto_numero`) VALUES
(123456, 'Pedro', 'Pablo', 'Perez', 'Pereira', '123456', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pin`
--

CREATE TABLE IF NOT EXISTS `pin` (
  `pin_numero` bigint(20) NOT NULL AUTO_INCREMENT,
  `ciudadano_cedula` bigint(20) NOT NULL,
  `puesto_numero` int(11) NOT NULL,
  `jurado_cedula` bigint(20) NOT NULL,
  `pin_fecha_creado` datetime NOT NULL,
  `pin_fecha_utilizado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `pin_estado` int(11) NOT NULL,
  PRIMARY KEY (`pin_numero`),
  KEY `ciudadano_cedula` (`ciudadano_cedula`),
  KEY `puesto_numero` (`puesto_numero`),
  KEY `jurado_cedula` (`jurado_cedula`),
  KEY `jurado_cedula_2` (`jurado_cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `pin`
--

INSERT INTO `pin` (`pin_numero`, `ciudadano_cedula`, `puesto_numero`, `jurado_cedula`, `pin_fecha_creado`, `pin_fecha_utilizado`, `pin_estado`) VALUES
(1, 123456, 1, 123456, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE IF NOT EXISTS `puesto` (
  `comuna_numero` int(11) NOT NULL,
  `puesto_numero` int(11) NOT NULL DEFAULT '0',
  `puesto_direccion` varchar(200) NOT NULL,
  PRIMARY KEY (`puesto_numero`),
  KEY `comuna_numero` (`comuna_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`comuna_numero`, `puesto_numero`, `puesto_direccion`) VALUES
(1, 1, 'Junta de Accion Comunal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeton1`
--

CREATE TABLE IF NOT EXISTS `tarjeton1` (
  `tarjeton1_codigo` int(11) NOT NULL,
  `tarjeton1_descripcion` longtext NOT NULL,
  `comuna_numero` int(11) NOT NULL,
  `tarjeton1_item` int(11) NOT NULL,
  PRIMARY KEY (`tarjeton1_codigo`),
  KEY `comuna_numero` (`comuna_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarjeton1`
--

INSERT INTO `tarjeton1` (`tarjeton1_codigo`, `tarjeton1_descripcion`, `comuna_numero`, `tarjeton1_item`) VALUES
(1, 'Cancha Sintetica', 1, 1),
(2, 'Insumos banda marcial', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeton2`
--

CREATE TABLE IF NOT EXISTS `tarjeton2` (
  `tarjeton2_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tarjeton2_descripcion` longtext NOT NULL,
  `comuna_numero` int(11) NOT NULL,
  `tarjeton2_item` int(11) NOT NULL,
  PRIMARY KEY (`tarjeton2_codigo`),
  KEY `comuna_numero` (`comuna_numero`),
  KEY `comuna_numero_2` (`comuna_numero`),
  KEY `delegado_codigo` (`tarjeton2_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votacion`
--

CREATE TABLE IF NOT EXISTS `votacion` (
  `voto_codigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `tarjeton1_codigo` int(11) NOT NULL,
  `pin_numero` bigint(20) NOT NULL,
  `tarjeton2_codigo` int(11) NOT NULL,
  `puesto_numero` int(11) NOT NULL,
  PRIMARY KEY (`voto_codigo`),
  KEY `proyecto_codigo` (`tarjeton1_codigo`),
  KEY `pin_numero` (`pin_numero`),
  KEY `delegado_codigo` (`tarjeton2_codigo`),
  KEY `delegado_codigo_2` (`tarjeton2_codigo`),
  KEY `puesto_numero` (`puesto_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jurado`
--
ALTER TABLE `jurado`
  ADD CONSTRAINT `jurado_ibfk_1` FOREIGN KEY (`puesto_numero`) REFERENCES `puesto` (`puesto_numero`);

--
-- Filtros para la tabla `pin`
--
ALTER TABLE `pin`
  ADD CONSTRAINT `pin_ibfk_1` FOREIGN KEY (`ciudadano_cedula`) REFERENCES `ciudadano` (`ciudadano_cedula`),
  ADD CONSTRAINT `pin_ibfk_2` FOREIGN KEY (`puesto_numero`) REFERENCES `puesto` (`puesto_numero`),
  ADD CONSTRAINT `pin_ibfk_3` FOREIGN KEY (`jurado_cedula`) REFERENCES `jurado` (`jurado_cedula`);

--
-- Filtros para la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD CONSTRAINT `puesto_ibfk_1` FOREIGN KEY (`comuna_numero`) REFERENCES `comuna` (`comuna_numero`);

--
-- Filtros para la tabla `tarjeton1`
--
ALTER TABLE `tarjeton1`
  ADD CONSTRAINT `tarjeton1_ibfk_1` FOREIGN KEY (`comuna_numero`) REFERENCES `comuna` (`comuna_numero`);

--
-- Filtros para la tabla `tarjeton2`
--
ALTER TABLE `tarjeton2`
  ADD CONSTRAINT `tarjeton2_ibfk_1` FOREIGN KEY (`comuna_numero`) REFERENCES `comuna` (`comuna_numero`);

--
-- Filtros para la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD CONSTRAINT `votacion_ibfk_2` FOREIGN KEY (`pin_numero`) REFERENCES `pin` (`pin_numero`),
  ADD CONSTRAINT `votacion_ibfk_4` FOREIGN KEY (`puesto_numero`) REFERENCES `puesto` (`puesto_numero`),
  ADD CONSTRAINT `votacion_ibfk_5` FOREIGN KEY (`tarjeton1_codigo`) REFERENCES `tarjeton1` (`tarjeton1_codigo`),
  ADD CONSTRAINT `votacion_ibfk_6` FOREIGN KEY (`tarjeton2_codigo`) REFERENCES `tarjeton2` (`tarjeton2_codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
