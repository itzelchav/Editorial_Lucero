-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb1034.awardspace.net
-- Tiempo de generación: 05-09-2025 a las 15:46:18
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
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id_acceso` int NOT NULL,
  `tipo` enum('empleado','visitante') NOT NULL,
  `id_persona` int NOT NULL,
  `fecha_hora_entrada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_hora_salida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`id_acceso`, `tipo`, `id_persona`, `fecha_hora_entrada`, `fecha_hora_salida`) VALUES
(6, 'visitante', 3, '2025-09-05 15:45:23', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id_acceso`),
  ADD KEY `idx_busqueda` (`tipo`,`id_persona`),
  ADD KEY `idx_abiertos` (`fecha_hora_salida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id_acceso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
