-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-12-2015 a las 01:18:54
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `googletransit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agency`
--

CREATE TABLE `agency` (
  `id_agencia` bigint(20) UNSIGNED NOT NULL,
  `agency_id` varchar(10) NOT NULL,
  `agency_name` varchar(300) NOT NULL,
  `agency_url` varchar(300) NOT NULL,
  `agency_timezone` varchar(30) NOT NULL,
  `agency_lang` varchar(300) NOT NULL,
  `agency_phone` varchar(30) NOT NULL,
  `agency_fare_url` varchar(300) NOT NULL COMMENT 'agency_fare_url especifica la URL de una página web que permite a un pasajero comprar boletos u otros tipos de pasajes en esa empresa en línea. El valor debe ser una URL completa que incluya http:// o https://'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `agency`
--

INSERT INTO `agency` (`id_agencia`, `agency_id`, `agency_name`, `agency_url`, `agency_timezone`, `agency_lang`, `agency_phone`, `agency_fare_url`) VALUES
(1, '79864', 'rápidos de merida', 'http://www.rapidosdemerida.com', 'mx', 'español', '9995767041', 'http://www.rapidosdemerida.com/comprarticket'),
(2, '77279', 'rápidos de merida', 'http://www.rapidosdemerida.com', 'mx', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar`
--

CREATE TABLE `calendar` (
  `service_id` varchar(10) NOT NULL,
  `monday` char(1) NOT NULL,
  `tuesday` char(1) NOT NULL,
  `wednesday` char(1) NOT NULL,
  `thursady` char(1) NOT NULL,
  `friday` char(1) NOT NULL,
  `saturday` char(1) NOT NULL,
  `sunday` char(1) NOT NULL,
  `start_date` char(8) NOT NULL COMMENT 'Formato: AAAAMMDD',
  `end_date` char(8) NOT NULL COMMENT 'Formato: AAAAMMDD'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendar_dates`
--

CREATE TABLE `calendar_dates` (
  `service_id` varchar(10) NOT NULL,
  `date` char(8) NOT NULL,
  `exception_type` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fare_attibutes`
--

CREATE TABLE `fare_attibutes` (
  `fare_id` varchar(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `currency_type` varchar(30) NOT NULL,
  `payment_method` char(1) NOT NULL,
  `transfer` char(1) NOT NULL,
  `transfer_duration` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fare_rules`
--

CREATE TABLE `fare_rules` (
  `fare_id` varchar(10) NOT NULL,
  `route_id` varchar(10) NOT NULL,
  `origin_id` varchar(10) NOT NULL,
  `destination_id` varchar(10) NOT NULL,
  `contains_id` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feed_info`
--

CREATE TABLE `feed_info` (
  `feed_publisher_name` varchar(300) NOT NULL,
  `feed_publisher_url` varchar(300) NOT NULL,
  `feed_lang` varchar(30) NOT NULL,
  `feed_start_date` char(8) NOT NULL,
  `feed_end_date` char(8) NOT NULL,
  `feed_version` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frequences`
--

CREATE TABLE `frequences` (
  `trip_id` varchar(10) NOT NULL,
  `start_time` char(8) NOT NULL,
  `end_time` char(8) NOT NULL,
  `headways_secs` char(10) NOT NULL,
  `exact_times` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routes`
--

CREATE TABLE `routes` (
  `route_id` varchar(10) NOT NULL,
  `agency_id` varchar(10) NOT NULL,
  `route_short_name` varchar(100) NOT NULL,
  `route_long_name` varchar(300) NOT NULL,
  `route_desc` varchar(300) NOT NULL,
  `route_type` varchar(1) NOT NULL,
  `route_url` varchar(300) NOT NULL,
  `route_color` varchar(6) NOT NULL COMMENT 'Valor en hexadecimal',
  `route_text_color` varchar(30) NOT NULL COMMENT 'nombre del color'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shapes`
--

CREATE TABLE `shapes` (
  `shape_id` varchar(10) NOT NULL,
  `shape_pt_lat` varchar(10) NOT NULL,
  `shape_pt_lon` varchar(10) NOT NULL,
  `shape_pt_sequence` varchar(10) NOT NULL,
  `shape_dist_traveled` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stops`
--

CREATE TABLE `stops` (
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
  `wheelchair_boarding` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stops_times`
--

CREATE TABLE `stops_times` (
  `trip_id` varchar(10) NOT NULL,
  `arrival_time` char(8) NOT NULL,
  `departure_time` char(8) NOT NULL,
  `stop_id` varchar(10) NOT NULL,
  `stop_sequence` varchar(300) NOT NULL,
  `stop_headsign` varchar(300) NOT NULL,
  `pickup_type` char(1) NOT NULL,
  `drop_off_type` char(1) NOT NULL,
  `shape_dist_traveler` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers`
--

CREATE TABLE `transfers` (
  `from_stop_id` varchar(10) NOT NULL,
  `to_stop_id` varchar(10) NOT NULL,
  `transfer_id` char(1) NOT NULL,
  `min_transfer_time` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trips`
--

CREATE TABLE `trips` (
  `route_id` varchar(10) NOT NULL,
  `service_id` varchar(10) NOT NULL,
  `trip_id` varchar(10) NOT NULL,
  `trip_headsign` varchar(10) NOT NULL,
  `trip_short_name` varchar(100) NOT NULL,
  `direction_id` char(1) NOT NULL,
  `block_id` varchar(10) NOT NULL,
  `shape_id` varchar(10) NOT NULL,
  `wheelchair_accessible` char(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_facebook` bigint(20) UNSIGNED NOT NULL,
  `id_tipousuario` tinyint(3) UNSIGNED NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`id_agencia`);

--
-- Indices de la tabla `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`service_id`);

--
-- Indices de la tabla `calendar_dates`
--
ALTER TABLE `calendar_dates`
  ADD PRIMARY KEY (`service_id`);

--
-- Indices de la tabla `fare_attibutes`
--
ALTER TABLE `fare_attibutes`
  ADD PRIMARY KEY (`fare_id`);

--
-- Indices de la tabla `fare_rules`
--
ALTER TABLE `fare_rules`
  ADD PRIMARY KEY (`fare_id`);

--
-- Indices de la tabla `frequences`
--
ALTER TABLE `frequences`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indices de la tabla `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indices de la tabla `shapes`
--
ALTER TABLE `shapes`
  ADD PRIMARY KEY (`shape_id`);

--
-- Indices de la tabla `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`stop_id`);

--
-- Indices de la tabla `stops_times`
--
ALTER TABLE `stops_times`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indices de la tabla `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`from_stop_id`);

--
-- Indices de la tabla `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`route_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agency`
--
ALTER TABLE `agency`
  MODIFY `id_agencia` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
