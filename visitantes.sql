-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb1034.awardspace.net
-- Tiempo de generación: 05-09-2025 a las 15:46:46
-- Versión del servidor: 8.0.32
-- Versión de PHP: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4667265_editorial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

CREATE TABLE `visitantes` (
  `id_visitante` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `persona_a_visitar` varchar(100) DEFAULT NULL,
  `empresa` varchar(120) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`id_visitante`, `nombre`, `motivo`, `persona_a_visitar`, `empresa`, `telefono`, `creado_en`) VALUES
(2, 'Zahira Garcia', 'Entrevista', '', 'uacj', '65656565', '2025-09-05 15:44:19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`id_visitante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `id_visitante` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
