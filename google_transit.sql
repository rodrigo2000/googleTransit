-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-12-2015 a las 01:40:09
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `google_transit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agency`
--

DROP TABLE IF EXISTS `agency`;
CREATE TABLE IF NOT EXISTS `agency` (
  `agency_id` varchar(10) NOT NULL,
  `agency_name` varchar(300) NOT NULL,
  `agency_url` varchar(300) NOT NULL,
  `agency_timezone` varchar(30) NOT NULL,
  `agency_lang` varchar(300) NOT NULL,
  `agency_phone` varchar(30) NOT NULL,
  `agency_fare_url` varchar(300) NOT NULL COMMENT 'agency_fare_url especifica la URL de una página web que permite a un pasajero comprar boletos u otros tipos de pasajes en esa empresa en línea. El valor debe ser una URL completa que incluya http:// o https://',
  PRIMARY KEY (`agency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `agency`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar`
--

DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `service_id` varchar(10) NOT NULL,
  `monday` char(1) NOT NULL,
  `tuesday` char(1) NOT NULL,
  `wednesday` char(1) NOT NULL,
  `thursady` char(1) NOT NULL,
  `friday` char(1) NOT NULL,
  `saturday` char(1) NOT NULL,
  `sunday` char(1) NOT NULL,
  `start_date` char(8) NOT NULL COMMENT 'Formato: AAAAMMDD',
  `end_date` char(8) NOT NULL COMMENT 'Formato: AAAAMMDD',
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `calendar`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar_dates`
--

DROP TABLE IF EXISTS `calendar_dates`;
CREATE TABLE IF NOT EXISTS `calendar_dates` (
  `service_id` varchar(10) NOT NULL,
  `date` char(8) NOT NULL,
  `exception_type` char(1) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `calendar_dates`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fare_attibutes`
--

DROP TABLE IF EXISTS `fare_attibutes`;
CREATE TABLE IF NOT EXISTS `fare_attibutes` (
  `fare_id` varchar(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `currency_type` varchar(30) NOT NULL,
  `payment_method` char(1) NOT NULL,
  `transfer` char(1) NOT NULL,
  `transfer_duration` varchar(20) NOT NULL,
  PRIMARY KEY (`fare_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `fare_attibutes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fare_rules`
--

DROP TABLE IF EXISTS `fare_rules`;
CREATE TABLE IF NOT EXISTS `fare_rules` (
  `fare_id` varchar(10) NOT NULL,
  `route_id` varchar(10) NOT NULL,
  `origin_id` varchar(10) NOT NULL,
  `destination_id` varchar(10) NOT NULL,
  `contains_id` varchar(10) NOT NULL,
  PRIMARY KEY (`fare_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `fare_rules`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feed_info`
--

DROP TABLE IF EXISTS `feed_info`;
CREATE TABLE IF NOT EXISTS `feed_info` (
  `feed_publisher_name` varchar(300) NOT NULL,
  `feed_publisher_url` varchar(300) NOT NULL,
  `feed_lang` varchar(30) NOT NULL,
  `feed_start_date` char(8) NOT NULL,
  `feed_end_date` char(8) NOT NULL,
  `feed_version` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `feed_info`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frequences`
--

DROP TABLE IF EXISTS `frequences`;
CREATE TABLE IF NOT EXISTS `frequences` (
  `trip_id` varchar(10) NOT NULL,
  `start_time` char(8) NOT NULL,
  `end_time` char(8) NOT NULL,
  `headways_secs` char(10) NOT NULL,
  `exact_times` char(1) NOT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `frequences`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` varchar(10) NOT NULL,
  `agency_id` varchar(10) NOT NULL,
  `route_short_name` varchar(100) NOT NULL,
  `route_long_name` varchar(300) NOT NULL,
  `route_desc` varchar(300) NOT NULL,
  `route_type` varchar(1) NOT NULL,
  `route_url` varchar(300) NOT NULL,
  `route_color` varchar(6) NOT NULL COMMENT 'Valor en hexadecimal',
  `route_text_color` varchar(30) NOT NULL COMMENT 'nombre del color',
  PRIMARY KEY (`route_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcar la base de datos para la tabla `routes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shapes`
--

DROP TABLE IF EXISTS `shapes`;
CREATE TABLE IF NOT EXISTS `shapes` (
  `shape_id` varchar(10) NOT NULL,
  `shape_pt_lat` varchar(10) NOT NULL,
  `shape_pt_lon` varchar(10) NOT NULL,
  `shape_pt_sequence` varchar(10) NOT NULL,
  `shape_dist_traveled` varchar(10) NOT NULL,
  PRIMARY KEY (`shape_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `shapes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stops`
--

DROP TABLE IF EXISTS `stops`;
CREATE TABLE IF NOT EXISTS `stops` (
  `stop_id` varchar(10) NOT NULL,
  `stop_code` varchar(10) NOT NULL,
  `stop_name` varchar(300) NOT NULL,
  `stop_desc` varchar(500) NOT NULL,
  `stop_lat` varchar(30) NOT NULL,
  `stop_lon` varchar(30) NOT NULL,
  `zone_id` varchar(10) NOT NULL,
  `location_time` varchar(10) NOT NULL,
  `parent_station` varchar(30) NOT NULL,
  `stop_timezone` varchar(30) NOT NULL,
  `wheelchair_boarding` varchar(1) NOT NULL,
  PRIMARY KEY (`stop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `stops`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stops_times`
--

DROP TABLE IF EXISTS `stops_times`;
CREATE TABLE IF NOT EXISTS `stops_times` (
  `trip_id` varchar(10) NOT NULL,
  `arrival_time` char(8) NOT NULL,
  `departure_time` char(8) NOT NULL,
  `stop_id` varchar(10) NOT NULL,
  `stop_sequence` varchar(300) NOT NULL,
  `stop_headsign` varchar(300) NOT NULL,
  `pickup_type` char(1) NOT NULL,
  `drop_off_type` char(1) NOT NULL,
  `shape_dist_traveler` varchar(300) NOT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `stops_times`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers`
--

DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `from_stop_id` varchar(10) NOT NULL,
  `to_stop_id` varchar(10) NOT NULL,
  `transfer_id` char(1) NOT NULL,
  `min_transfer_time` varchar(10) NOT NULL,
  PRIMARY KEY (`from_stop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `transfers`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE IF NOT EXISTS `trips` (
  `route_id` varchar(10) NOT NULL,
  `service_id` varchar(10) NOT NULL,
  `trip_id` varchar(10) NOT NULL,
  `trip_headsign` varchar(10) NOT NULL,
  `trip_short_name` varchar(100) NOT NULL,
  `direction_id` char(1) NOT NULL,
  `block_id` varchar(10) NOT NULL,
  `shape_id` varchar(10) NOT NULL,
  `wheelchair_accessible` char(1) NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `trips`
--

