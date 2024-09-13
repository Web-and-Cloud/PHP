-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 08.08.2024 klo 08:30
-- Palvelimen versio: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vuokraamo`
--
CREATE DATABASE IF NOT EXISTS `vuokraamo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vuokraamo`;

-- --------------------------------------------------------

--
-- Rakenne taululle `asiakas`
--

CREATE TABLE `asiakas` (
  `asiakasID` int NOT NULL,
  `etunimi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sukunimi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sahkoposti` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lahiosoite` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `postinumero` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `postitoimipaikka` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `puhelin` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `henkilotunnus` varchar(11) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `asiakas`
--

INSERT INTO `asiakas` (`asiakasID`, `etunimi`, `sukunimi`, `sahkoposti`, `lahiosoite`, `postinumero`, `postitoimipaikka`, `puhelin`, `henkilotunnus`) VALUES
(1, 'Matti', 'Meikäläinen', 'matti.meikalainen@salo.fi', 'Salonkatu 1', '24100', 'Salo', '0441234567', '010150-123H');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asiakas`
--
ALTER TABLE `asiakas`
  ADD PRIMARY KEY (`asiakasID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asiakas`
--
ALTER TABLE `asiakas`
  MODIFY `asiakasID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Create a user and give the necessary privileges
-- 
CREATE USER 'vuokraamo'@'localhost' IDENTIFIED BY 'ip4AQdDr9Lk)siQX';
GRANT SELECT, INSERT, UPDATE, DELETE ON `vuokraamo`.* TO `vuokraamo`@`localhost`;