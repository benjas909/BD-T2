-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 08:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prestigetravels`
--

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `nombre` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospedajes`
--

CREATE TABLE `hospedajes` (
  `id_hospedaje` int(11) NOT NULL,
  `id_hotel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `paquete`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `birthday`) VALUES
(4, 'benjamin', '$2y$10$/4p7Mvn.I9mTTCH/IAEdlOK9Qa8NkoaaK5bWQOAlNrs9Thx/w/Ela', 'benjamin.aguilera64@gmail.com', '2001-08-27'),
(5, 'hasbulla', '$2y$10$5vYjqepQyXdnc.geXJ8zteZwo9bPFuTC7jWxUUh5WeRrKSnaMPhoO', 'hasbulla.delbulla@gmail.com', '2010-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `id_paquete` int(11) DEFAULT NULL,
  `id_hotel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indexes for table `hospedajes`
--
ALTER TABLE `hospedajes`
  ADD PRIMARY KEY (`id_hospedaje`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_hospedaje` (`id_hospedaje`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id` (`id`),
  ADD KEY `id_paquete` (`id_paquete`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hospedajes`
--
ALTER TABLE `hospedajes`
  ADD CONSTRAINT `hospedajes_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`);

--
-- Constraints for table `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `paquete_ibfk_1` FOREIGN KEY (`id_hospedaje`) REFERENCES `hospedajes` (`id_hospedaje`),
  ADD CONSTRAINT `paquete_ibfk_2` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_paquete`) REFERENCES `paquete` (`id_paquete`),
  ADD CONSTRAINT `wishlist_ibfk_3` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
