-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 01:47 AM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `id_pack` int(11) DEFAULT NULL,
  `ishotel` tinyint(1) NOT NULL,
  `quant` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_hotel`, `id_pack`, `ishotel`, `quant`) VALUES
(21, 5, 2, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `ciudad_nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`id`, `ciudad_nombre`) VALUES
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
(5, 12, 13, 14),
(6, 15, 16, NULL),
(7, 17, NULL, NULL);

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
(5, 14, 15, 16),
(6, 17, 18, NULL),
(7, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `id_pack` int(11) DEFAULT NULL,
  `ishotel` tinyint(1) NOT NULL,
  `quant` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historial`
--

INSERT INTO `historial` (`id`, `id_user`, `id_hotel`, `id_pack`, `ishotel`, `quant`) VALUES
(23, 5, 2, NULL, 1, 1);

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
  `desayuno` tinyint(1) NOT NULL,
  `calif_promedio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `nombre`, `ciudad`, `precionoche`, `img`, `estrellas`, `hab_totales`, `hab_disp`, `parking`, `piscina`, `lavanderia`, `mascotas`, `desayuno`, `calif_promedio`) VALUES
(1, 'Richman Hotel', 1, 37944, '/BD-T2/IMG/image1.jpg', 3, 53, 7, 1, 1, 1, 0, 0, 0),
(2, 'Hotel Jefferson', 1, 26991, '/BD-T2/IMG/image2.jpg', 4, 106, 61, 1, 1, 1, 1, 1, 0),
(3, 'Templar Hotel', 1, 64118, '/BD-T2/IMG/image3.jpg', 4, 102, 9, 1, 0, 0, 1, 1, 0),
(4, 'Hotel Ocean View', 2, 46381, '/BD-T2/IMG/image4.jpg', 5, 150, 19, 1, 1, 1, 1, 1, 0),
(5, 'Hotel Moist Palms', 2, 61975, '/BD-T2/IMG/image5.jpg', 4, 154, 22, 1, 0, 1, 0, 0, 0),
(6, 'Majestic Hotel', 4, 52217, '/BD-T2/IMG/image6.jpg', 4, 92, 14, 1, 0, 0, 1, 1, 0),
(7, 'Indian Inn Hotel', 8, 36571, '/BD-T2/IMG/image7.jpg', 2, 82, 2, 0, 0, 0, 0, 0, 0),
(8, 'Nicoise Hotel', 4, 91168, '/BD-T2/IMG/image8.jpg', 5, 118, 2, 1, 1, 1, 0, 1, 0),
(9, 'Old Bullworth Vale Hotel', 7, 48146, '/BD-T2/IMG/image9.jpg', 2, 154, 19, 0, 0, 1, 0, 0, 0),
(10, 'Hotel The Visage', 0, 54064, '/BD-T2/IMG/image10.jpg', 4, 111, 52, 1, 1, 0, 0, 1, 0),
(11, 'Sofitel Bahrain Zallaq Thalassa sea & spa', 9, 90000, '/BD-T2/IMG/image11.jpg', 5, 1000, 31, 1, 1, 1, 1, 1, 0),
(12, 'Kenana Hotel', 10, 39739, '/BD-T2/IMG/image12.jpg', 3, 500, 36, 1, 0, 0, 0, 1, 0),
(13, 'Batman\'s Hill On Collins', 11, 64616, '/BD-T2/IMG/image13.jpg', 5, 200, 11, 1, 0, 1, 1, 1, 0),
(14, 'Grand Hyatt Shanghai', 12, 105000, '/BD-T2/IMG/image14.jpg', 5, 700, 35, 1, 0, 1, 1, 1, 0),
(15, 'Altus Hotel Baku', 13, 6588, '/BD-T2/IMG/image15.jpg', 4, 300, 14, 1, 0, 1, 1, 1, 0),
(16, 'Days Inn by Wyndham Miami Airport North', 14, 52816, '/BD-T2/IMG/image16.jpg', 3, 15, 5, 1, 0, 0, 0, 0, 0),
(17, 'Santiago Hotel', 15, 22500, '/BD-T2/IMG/image17.jpg', 3, 50, 5, 1, 0, 0, 0, 1, 0),
(18, 'Fairmont Monte Carlo', 16, 217000, '/BD-T2/IMG/image18.jpg', 4, 200, 20, 1, 1, 1, 1, 1, 0),
(19, 'Hotel Soho', 17, 83100, '/BD-T2/IMG/image19.jpg', 3, 150, 22, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_review`
--

CREATE TABLE `hotel_review` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `limpieza` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `deco` int(11) NOT NULL,
  `camas` int(11) NOT NULL,
  `reseña` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_review`
--

INSERT INTO `hotel_review` (`id`, `id_user`, `id_hotel`, `fecha`, `limpieza`, `servicio`, `deco`, `camas`, `reseña`) VALUES
(1, 5, 2, '2023-06-06 18:19:12', 2, 4, 3, 3, 'decente'),
(2, 5, 10, '2023-06-07 08:06:10', 4, 3, 4, 4, 'bastante bien la verda'),
(4, 5, 2, '2023-06-07 17:55:39', 0, 0, 0, 0, '');

--
-- Triggers `hotel_review`
--
DELIMITER $$
CREATE TRIGGER `purchase_check_hotel` BEFORE INSERT ON `hotel_review` FOR EACH ROW BEGIN
	DECLARE counter INT;
    SELECT COUNT(*) INTO counter FROM historial WHERE id_user = NEW.id_user AND id_hotel = NEW.id_hotel;
    
    IF counter = 0 THEN 
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El hotel no está en el historial del usuario';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `package_review`
--

CREATE TABLE `package_review` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pack` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cal_hoteles` int(11) NOT NULL,
  `cal_transport` int(11) NOT NULL,
  `cal_servicio` int(11) NOT NULL,
  `rel_calprecio` int(11) NOT NULL,
  `reseña` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_review`
--

INSERT INTO `package_review` (`id`, `id_user`, `id_pack`, `fecha`, `cal_hoteles`, `cal_transport`, `cal_servicio`, `rel_calprecio`, `reseña`) VALUES
(1, 5, 4, '2023-06-07 17:39:53', 4, 5, 4, 2, 'Bastante bien, pero algo caro, y Ferrari dio vergüenza como siempre'),
(2, 5, 1, '2023-06-06 17:39:53', 2, 3, 4, 4, 'me robaron');

--
-- Triggers `package_review`
--
DELIMITER $$
CREATE TRIGGER `purchase_check_pack` BEFORE INSERT ON `package_review` FOR EACH ROW BEGIN
	DECLARE counter INT;
    SELECT COUNT(*) INTO counter FROM historial WHERE id_user = NEW.id_user AND id_pack = NEW.id_pack;
    
    IF counter = 0 THEN 
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El paquete no está en el historial del usuario';
    END IF;
END
$$
DELIMITER ;

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
  `precio_persona` int(11) NOT NULL,
  `paq_disp` int(11) NOT NULL,
  `paq_totales` int(11) NOT NULL,
  `max_personas` int(11) NOT NULL,
  `calif_promedio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `nombre`, `img`, `aero_ida`, `aero_vuelta`, `id_hospedajes`, `id_ciudades`, `f_salida`, `f_llegada`, `precio_persona`, `paq_disp`, `paq_totales`, `max_personas`, `calif_promedio`) VALUES
(1, 'Tour San Andreas', '/BD-T2/IMG/imgpck1.jpg', 'LATAM', 'LATAM', 1, 1, '2023-05-30', '2023-06-06', 100000, 14, 30, 3, 0),
(2, 'Vice City', '/BD-T2/IMG/imgpck2.jpg', 'LATAM', 'FlyUS', 2, 3, '2023-06-21', '2023-06-30', 120000, 40, 100, 3, 0),
(3, 'F1 Races 1 - 3', '/BD-T2/IMG/imgpck3.jpg', 'LATAM', 'Emirates', 4, 4, '2023-06-01', '2023-06-18', 3000000, 48, 70, 2, 0),
(4, 'F1 Races 4 - 6', '/BD-T2/IMG/imgpck4.jpg', 'LATAM', 'Emirates', 5, 5, '2023-07-01', '2023-07-23', 2500000, 43, 60, 2, 0),
(5, 'F1 Races 7 - 8', '/BD-T2/IMG/imgpck5.jpg', 'LATAM', 'Emirates', 6, 6, '2023-08-03', '2023-08-13', 1500000, 7, 10, 2, 0),
(7, 'F1 Spanish Grand Prix ', '/BD-T2/IMG/imgpck6.jpg', 'LATAM', 'IBERIA', 7, 7, '2023-08-17', '2023-08-20', 600000, 11, 20, 2, 0);

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
(5, 'hasbulla', '$2y$10$5vYjqepQyXdnc.geXJ8zteZwo9bPFuTC7jWxUUh5WeRrKSnaMPhoO', 'hasbulla.delbulla@gmail.com', '2010-04-08'),
(11, 'banjos', '$2y$10$aBiQcHDaCqGZTvV9qc5iTeaPVm2CxlXZgq6s8J9HAm04JuF9EQEei', 'banjos@gmail.com', '2023-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_hotel` int(11) DEFAULT NULL,
  `id_pack` int(11) DEFAULT NULL,
  `ishotel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `id_user`, `id_hotel`, `id_pack`, `ishotel`) VALUES
(14, 5, 10, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_idhotel_cart` (`id_hotel`),
  ADD KEY `FK_idpack_cart` (`id_pack`),
  ADD KEY `FK_iduserc` (`id_user`);

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
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hist_user` (`id_user`),
  ADD KEY `FK_hist_hotel` (`id_hotel`),
  ADD KEY `FK_hist_pack` (`id_pack`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `FK_ciudadhotel` (`ciudad`);

--
-- Indexes for table `hotel_review`
--
ALTER TABLE `hotel_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_hreview_user` (`id_user`),
  ADD KEY `FK_hreview_hotel` (`id_hotel`);

--
-- Indexes for table `package_review`
--
ALTER TABLE `package_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_preview_user` (`id_user`),
  ADD KEY `FK_preview_pack` (`id_pack`);

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_wishuser` (`id_user`),
  ADD KEY `FK_idhotelw` (`id_hotel`),
  ADD KEY `FK_idpackw` (`id_pack`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `grupo_ciudades`
--
ALTER TABLE `grupo_ciudades`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grupo_hospedajes`
--
ALTER TABLE `grupo_hospedajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `hotel_review`
--
ALTER TABLE `hotel_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_review`
--
ALTER TABLE `package_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_idhotel_cart` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_idpack_cart` FOREIGN KEY (`id_pack`) REFERENCES `paquete` (`id_paquete`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_iduserc` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grupo_ciudades`
--
ALTER TABLE `grupo_ciudades`
  ADD CONSTRAINT `FK_ciudad1` FOREIGN KEY (`id_ciudad1`) REFERENCES `ciudad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ciudad2` FOREIGN KEY (`id_ciudad2`) REFERENCES `ciudad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ciudad3` FOREIGN KEY (`id_ciudad3`) REFERENCES `ciudad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grupo_hospedajes`
--
ALTER TABLE `grupo_hospedajes`
  ADD CONSTRAINT `FK_hotel1` FOREIGN KEY (`id_hotel1`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_hotel2` FOREIGN KEY (`id_hotel2`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_hotel3` FOREIGN KEY (`id_hotel3`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `FK_hist_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_hist_pack` FOREIGN KEY (`id_pack`) REFERENCES `paquete` (`id_paquete`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_hist_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_ciudadhotel` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id`);

--
-- Constraints for table `hotel_review`
--
ALTER TABLE `hotel_review`
  ADD CONSTRAINT `FK_hreview_hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_hreview_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `package_review`
--
ALTER TABLE `package_review`
  ADD CONSTRAINT `FK_preview_pack` FOREIGN KEY (`id_pack`) REFERENCES `paquete` (`id_paquete`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_preview_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paquete`
--
ALTER TABLE `paquete`
  ADD CONSTRAINT `FK_ciudades` FOREIGN KEY (`id_ciudades`) REFERENCES `grupo_ciudades` (`id_grupo`),
  ADD CONSTRAINT `FK_hospedajes` FOREIGN KEY (`id_hospedajes`) REFERENCES `grupo_hospedajes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `FK_idhotelw` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_idpackw` FOREIGN KEY (`id_pack`) REFERENCES `paquete` (`id_paquete`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_wishuser` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
