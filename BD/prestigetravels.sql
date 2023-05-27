-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2023 a las 02:36:24
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
-- Base de datos: `prestigetravels`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `nombre` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedajes`
--

CREATE TABLE `hospedajes` (
  `id_hospedaje` int(11) NOT NULL,
  `id_hotel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precionoche` int(11) NOT NULL,
  `ciudad` varchar(150) NOT NULL,
  `img` varchar(360) DEFAULT NULL,
  `estrellas` int(11) NOT NULL,
  `hab_totales` int(11) NOT NULL,
  `hab_disp` int(11) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `piscina` tinyint(1) NOT NULL,
  `lavanderia` tinyint(1) NOT NULL,
  `mascotas` tinyint(1) NOT NULL,
  `desayuno` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `nombre`, `precionoche`, `ciudad`, `img`, `estrellas`, `hab_totales`, `hab_disp`, `parking`, `piscina`, `lavanderia`, `mascotas`, `desayuno`) VALUES
(1, 'Hotel 1', 37944, 'Iquique', 'image1.jpg', 0, 53, 49, 1, 1, 1, 0, 0),
(2, 'Hotel 2', 26991, 'Puerto Montt', 'image2.jpg', 0, 106, 106, 1, 1, 1, 1, 1),
(3, 'Hotel 3', 64118, 'Arica', 'image3.jpg', 0, 102, 56, 1, 0, 0, 1, 1),
(4, 'Hotel 4', 46381, 'Valdivia', 'image4.jpg', 0, 150, 81, 0, 0, 0, 1, 1),
(5, 'Hotel 5', 61975, 'Viña del Mar', 'image5.jpg', 0, 154, 104, 1, 0, 1, 0, 0),
(6, 'Hotel 6', 52217, 'Concepción', 'image6.jpg', 0, 92, 14, 1, 0, 0, 1, 1),
(7, 'Hotel 7', 36571, 'Valparaíso', 'image7.jpg', 0, 82, 2, 1, 0, 0, 1, 0),
(8, 'Hotel 8', 91168, 'Concepción', 'image8.jpg', 0, 118, 2, 1, 1, 1, 0, 1),
(9, 'Hotel 9', 48146, 'Arica', 'image9.jpg', 0, 154, 19, 1, 1, 1, 0, 0),
(10, 'Hotel 10', 54064, 'Arica', 'image10.jpg', 0, 111, 57, 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `img` varchar(360) DEFAULT NULL,
  `aero_ida` varchar(150) NOT NULL,
  `aero_vuelta` varchar(159) NOT NULL,
  `id_hospedaje` int(11) DEFAULT NULL,
  `id_ciudad` int(11) DEFAULT NULL,
  `f_salida` date NOT NULL,
  `f_llegada` date NOT NULL,
  `noches_totales` int(11) NOT NULL,
  `precio_persona` int(11) NOT NULL,
  `paq_disp` int(11) NOT NULL,
  `paq_totales` int(11) NOT NULL,
  `max_personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `birthday`) VALUES
(4, 'benjamin', '$2y$10$/4p7Mvn.I9mTTCH/IAEdlOK9Qa8NkoaaK5bWQOAlNrs9Thx/w/Ela', 'benjamin.aguilera64@gmail.com', '2001-08-27'),
(5, 'PIPE', '$2y$10$E3Cl.UOwTt7uyb7pc7SVgeLfGTKm5drm7pIl0.3BkI8Uu5iAQ37Pq', 'felipe14789632@gmail.com', '2003-01-14'),
(6, 'pabloski', '$2y$10$33BMRFD1EjDcYzOuqqNWC.4T654boY1P0pPm7R4A.Ak0yeg.ZH4yu', 'eco@gmail.com', '2023-05-10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
