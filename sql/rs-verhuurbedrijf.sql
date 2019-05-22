-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2019 at 04:21 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rs-verhuurbedrijf`
--

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `klantenid` int(225) NOT NULL,
  `naam` varchar(225) NOT NULL,
  `voornaam` varchar(225) DEFAULT NULL,
  `adres` varchar(225) NOT NULL,
  `telefoonnummer` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`klantenid`, `naam`, `voornaam`, `adres`, `telefoonnummer`) VALUES
(1, 'Latchmansing', 'Kenson Jean-Michel', 'Kailanweg 14', 8674832),
(2, 'Samadhan', 'Shaniel', 'Vierkinderenweg 156', 8958112),
(3, 'Telesur', '', 'Heiligeweg 32', 474242),
(4, 'Escobar', 'Pablo', 'st. Patrick Boiun str. 387', 911),
(5, 'Compa', '', 'Oost-West verbinding 764 Commewijne', 354340),
(6, 'N.V Self-Reliance', '', 'Heeren Straat 48-50', 472582),
(7, 'Carib Computers', '', 'Heeren Straat', 424748);

-- --------------------------------------------------------

--
-- Table structure for table `tarief`
--

CREATE TABLE `tarief` (
  `categorie` varchar(50) NOT NULL,
  `tarief` int(50) NOT NULL,
  `borgsom` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarief`
--

INSERT INTO `tarief` (`categorie`, `tarief`, `borgsom`) VALUES
('P1', 1, 150),
('P2', 2, 270),
('P3', 4, 520),
('P4', 5, 750);

-- --------------------------------------------------------

--
-- Table structure for table `verhuurd`
--

CREATE TABLE `verhuurd` (
  `verhuur_id` int(225) NOT NULL,
  `klant_naam` text NOT NULL,
  `voertuig` varchar(150) NOT NULL,
  `oudkm` int(225) NOT NULL,
  `nieuwkm` int(225) NOT NULL,
  `bedrag` int(225) NOT NULL,
  `uitgeef_datum` date NOT NULL,
  `inlever_datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verhuurd`
--

INSERT INTO `verhuurd` (`verhuur_id`, `klant_naam`, `voertuig`, `oudkm`, `nieuwkm`, `bedrag`, `uitgeef_datum`, `inlever_datum`) VALUES
(1, 'Latchmansing Kenson Jean-Michel', 'BMW X6', 8630, 8700, 420, '2019-05-05', '2019-05-05'),
(3, 'Carib Computers ', 'Toyata Noah', 2395, 2549, 370, '2019-05-05', '2019-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `voertuigen`
--

CREATE TABLE `voertuigen` (
  `voertuigid` int(225) NOT NULL,
  `merk` varchar(225) NOT NULL,
  `model` varchar(225) NOT NULL,
  `plaatnummer` varchar(225) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `kmstand` int(225) NOT NULL,
  `chassisnummer` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voertuigen`
--

INSERT INTO `voertuigen` (`voertuigid`, `merk`, `model`, `plaatnummer`, `categorie`, `status`, `kmstand`, `chassisnummer`) VALUES
(5, 'BMW', 'X6', 'PK 64-24', 'P3', 'binnen', 8700, 'DTP864KJEI630HFO'),
(6, 'Toyata', 'Corola', '36-62 SP', 'P2', 'binnen', 476397, 'HS48JHYLSY8TWO62'),
(7, 'Honda', 'Civic', 'PA 87-07', 'P2', 'binnen', 6538, 'JHFLJGUTHVIURLKJV'),
(9, 'Toyata', 'Mark-X', 'PD 14-87', 'P3', 'verhuurd', 2652, 'KJEGKL5JG3K46KVJKJFL26'),
(10, 'Toyata', 'Noah', 'PB 64-14', 'P4', 'verhuurd', 2549, 'JGDS3KJG5LKG2LKG6LIG1'),
(11, 'Kia', 'Sorento', 'PF 85-06', 'P3', 'binnen', 3873, 'K3L2KJ3FLJ6F2J37KF'),
(12, 'Tesla', 'Model X', 'PK 14-26', 'P3', 'binnen', 0, 'J3FKJ3GL7KFK3JFE7KFJK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantenid`);

--
-- Indexes for table `tarief`
--
ALTER TABLE `tarief`
  ADD PRIMARY KEY (`categorie`);

--
-- Indexes for table `verhuurd`
--
ALTER TABLE `verhuurd`
  ADD PRIMARY KEY (`verhuur_id`);

--
-- Indexes for table `voertuigen`
--
ALTER TABLE `voertuigen`
  ADD PRIMARY KEY (`voertuigid`),
  ADD KEY `categorie` (`categorie`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantenid` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `verhuurd`
--
ALTER TABLE `verhuurd`
  MODIFY `verhuur_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voertuigen`
--
ALTER TABLE `voertuigen`
  MODIFY `voertuigid` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voertuigen`
--
ALTER TABLE `voertuigen`
  ADD CONSTRAINT `voertuigen_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `tarief` (`categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
