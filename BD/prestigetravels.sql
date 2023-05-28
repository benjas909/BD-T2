-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 07:46 AM
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
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`) VALUES
(0, 'Las Venturas'),
(1, 'Los Santos'),
(2, 'Vice City'),
(3, 'San Fierro'),
(4, 'Algonquin, Liberty City'),
(5, 'Broker, Liberty City'),
(6, 'Ludendorff'),
(7, 'Bullworth'),
(8, 'Dukes, Liberty City'),
(9, 'Sakhir'),
(10, 'Jeddah'),
(11, 'Melbourne'),
(12, 'Shanghai'),
(13, 'Baku'),
(14, 'Miami'),
(15, 'Emilia Romagna'),
(16, 'Monaco'),
(17, 'Barcelona'),
(18, 'Montreal');

-- --------------------------------------------------------

--
-- Table structure for table `grupo_ciudades`
--

CREATE TABLE `grupo_ciudades` (
  `id_grupo` int(11) NOT NULL,
  `id_ciudad1` int(11) DEFAULT NULL,
  `id_ciudad2` int(11) DEFAULT NULL,
  `id_ciudad3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grupo_ciudades`
--

INSERT INTO `grupo_ciudades` (`id_grupo`, `id_ciudad1`, `id_ciudad2`, `id_ciudad3`) VALUES
(1, 1, 3, 0),
(2, 4, 5, NULL),
(3, 2, NULL, NULL),
(4, 9, 10, 11),
(5, 12, 13, 14);

-- --------------------------------------------------------

--
-- Table structure for table `grupo_hospedajes`
--

CREATE TABLE `grupo_hospedajes` (
  `id` int(11) NOT NULL,
  `id_hotel1` int(11) NOT NULL,
  `id_hotel2` int(11) DEFAULT NULL,
  `id_hotel3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grupo_hospedajes`
--

INSERT INTO `grupo_hospedajes` (`id`, `id_hotel1`, `id_hotel2`, `id_hotel3`) VALUES
(1, 1, 10, 3),
(2, 5, 4, NULL),
(3, 8, 6, 7),
(4, 11, 12, 13),
(5, 14, 15, 16);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `ciudad` int(11) NOT NULL,
  `precionoche` int(11) NOT NULL,
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
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `nombre`, `ciudad`, `precionoche`, `img`, `estrellas`, `hab_totales`, `hab_disp`, `parking`, `piscina`, `lavanderia`, `mascotas`, `desayuno`) VALUES
(1, 'Richman Hotel', 1, 37944, '/BD-T2/IMG/image1.jpg', 2, 53, 49, 1, 1, 1, 0, 0),
(2, 'Hotel Jefferson', 1, 26991, '/BD-T2/IMG/image2.jpg', 4, 106, 106, 1, 1, 1, 1, 1),
(3, 'Templar Hotel', 1, 64118, '/BD-T2/IMG/image3.jpg', 3, 102, 56, 1, 0, 0, 1, 1),
(4, 'Hotel Ocean View', 2, 46381, '/BD-T2/IMG/image4.jpg', 5, 150, 81, 1, 1, 1, 1, 1),
(5, 'Hotel Moist Palms', 2, 61975, '/BD-T2/IMG/image5.jpg', 0, 154, 104, 1, 0, 1, 0, 0),
(6, 'Majestic Hotel', 4, 52217, '/BD-T2/IMG/image6.jpg', 4, 92, 14, 1, 0, 0, 1, 1),
(7, 'Indian Inn Hotel', 8, 36571, '/BD-T2/IMG/image7.jpg', 2, 82, 2, 0, 0, 0, 0, 0),
(8, 'Nicoise Hotel', 4, 91168, '/BD-T2/IMG/image8.jpg', 5, 118, 2, 1, 1, 1, 0, 1),
(9, 'Old Bullworth Vale Hotel', 7, 48146, '/BD-T2/IMG/image9.jpg', 2, 154, 19, 0, 0, 1, 0, 0),
(10, 'Hotel The Visage', 0, 54064, '/BD-T2/IMG/image10.jpg', 3, 111, 57, 1, 1, 0, 0, 1),
(11, 'Sofitel Bahrain Zallaq Thalassa sea & spa', 9, 90000, '/BD-T2/IMG/image11.jpg', 5, 1000, 340, 1, 1, 1, 1, 1),
(12, 'Kenana Hotel', 10, 39739, '/BD-T2/IMG/image12.jpg', 3, 500, 40, 1, 0, 0, 0, 1),
(13, 'Batman\'s Hill On Collins', 11, 64616, '/BD-T2/IMG/image13.jpg', 4, 200, 15, 1, 0, 1, 1, 1),
(14, 'Grand Hyatt Shanghai', 12, 105000, '/BD-T2/IMG/image14.jpg', 4, 700, 56, 1, 0, 1, 1, 1),
(15, 'Altus Hotel Baku', 13, 6588, '/BD-T2/IMG/image15.jpg', 3, 300, 16, 1, 0, 1, 1, 1),
(16, 'Days Inn by Wyndham Miami Airport North', 14, 52816, '/BD-T2/IMG/image16.jpg', 2, 15, 7, 1, 0, 0, 0, 0);

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
  `id_hospedajes` int(11) NOT NULL,
  `id_ciudades` int(11) NOT NULL,
  `f_salida` date NOT NULL,
  `f_llegada` date NOT NULL,
  `noches_totales` int(11) NOT NULL,
  `precio_persona` int(11) NOT NULL,
  `paq_disp` int(11) NOT NULL,
  `paq_totales` int(11) NOT NULL,
  `max_personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `nombre`, `img`, `aero_ida`, `aero_vuelta`, `id_hospedajes`, `id_ciudades`, `f_salida`, `f_llegada`, `noches_totales`, `precio_persona`, `paq_disp`, `paq_totales`, `max_personas`) VALUES
(1, 'Tour San Andreas', '/BD-T2/IMG/imgpck1.jpg', 'LATAM', 'LATAM', 1, 1, '2023-05-30', '2023-06-06', 6, 100000, 15, 30, 3),
(2, 'Vice City', '/BD-T2/IMG/imgpck2.jpg', 'LATAM', 'FlyUS', 2, 3, '2023-06-21', '2023-06-30', 8, 120000, 3, 5, 3),
(3, 'F1 Races 1 - 3', '/BD-T2/IMG/imgpck3.jpg', 'LATAM', 'Emirates', 4, 4, '2023-06-01', '2023-06-18', 19, 3000000, 3, 4, 2),
(4, 'F1 Races 4 - 6', '/BD-T2/IMG/imgpck4.jpg', 'LATAM', 'Emirates', 5, 5, '2023-07-01', '2023-07-23', 20, 2500000, 4, 6, 2);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupo_ciudades`
--
ALTER TABLE `grupo_ciudades`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `FK_ciudad3` (`id_ciudad3`) USING BTREE,
  ADD KEY `FK_ciudad2` (`id_ciudad2`) USING BTREE,
  ADD KEY `FK_ciudad1` (`id_ciudad1`) USING BTREE;

--
-- Indexes for table `grupo_hospedajes`
--
ALTER TABLE `grupo_hospedajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hotel1` (`id_hotel1`) USING BTREE,
  ADD KEY `FK_hotel2` (`id_hotel2`) USING BTREE,
  ADD KEY `FK_hotel3` (`id_hotel3`) USING BTREE;

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `FK_ciudadhotel` (`ciudad`);

--
-- Indexes for table `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `FK_hospedajes` (`id_hospedajes`),
  ADD KEY `FK_ciudades` (`id_ciudades`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grupo_ciudades`
--
ALTER TABLE `grupo_ciudades`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `grupo_hospedajes`
--
ALTER TABLE `grupo_hospedajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grupo_ciudades`
--
ALTER TABLE `grupo_ciudades`
  ADD CONSTRAINT `FK_ciudad1` FOREIGN KEY (`id_ciudad1`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `FK_ciudad2` FOREIGN KEY (`id_ciudad2`) REFERENCES `ciudad` (`id`),
  ADD CONSTRAINT `FK_ciudad3` FOREIGN KEY (`id_ciudad3`) REFERENCES `ciudad` (`id`);

--
-- Constraints for table `grupo_hospedajes`
--
ALTER TABLE `grupo_hospedajes`
  ADD CONSTRAINT `FK_hotel1` FOREIGN KEY (`id_hotel1`) REFERENCES `hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_hotel2` FOREIGN KEY (`id_hotel2`) REFERENCES `hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_hotel3` FOREIGN KEY (`id_hotel3`) REFERENCES `hotel` (`id_hotel`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_ciudadhotel` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id`);

--
-- Constraints for table `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `FK_ciudades` FOREIGN KEY (`id_ciudades`) REFERENCES `grupo_ciudades` (`id_grupo`),
  ADD CONSTRAINT `FK_hospedajes` FOREIGN KEY (`id_hospedajes`) REFERENCES `grupo_hospedajes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
