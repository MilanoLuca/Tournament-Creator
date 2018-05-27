-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2018 at 01:31 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tournament`
--
CREATE DATABASE IF NOT EXISTS `tournament` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tournament`;

-- --------------------------------------------------------

--
-- Table structure for table `gioca`
--

CREATE TABLE `gioca` (
  `FKSquadra` int(11) NOT NULL,
  `IDTorneoSquadra` int(11) NOT NULL,
  `FKPartita` int(11) NOT NULL,
  `IDTorneoPartita` int(11) NOT NULL,
  `Punteggio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gioca`
--

INSERT INTO `gioca` (`FKSquadra`, `IDTorneoSquadra`, `FKPartita`, `IDTorneoPartita`, `Punteggio`) VALUES
(1, 31, 28, 31, 1),
(2, 31, 28, 31, 7),
(2, 31, 30, 31, 2),
(3, 31, 29, 31, 12),
(3, 31, 30, 31, 3),
(4, 31, 29, 31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `partita`
--

CREATE TABLE `partita` (
  `IDPartita` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `IDVincitrice` int(11) DEFAULT NULL,
  `IDTorneoVincitrice` int(11) DEFAULT NULL,
  `Fase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partita`
--

INSERT INTO `partita` (`IDPartita`, `IDTorneo`, `IDVincitrice`, `IDTorneoVincitrice`, `Fase`) VALUES
(28, 31, 2, 31, 1),
(29, 31, 3, 31, 1),
(30, 31, 3, 31, 2);

-- --------------------------------------------------------

--
-- Table structure for table `squadra`
--

CREATE TABLE `squadra` (
  `IDSquadra` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `squadra`
--

INSERT INTO `squadra` (`IDSquadra`, `IDTorneo`, `Nome`) VALUES
(1, 26, '1'),
(1, 27, '1'),
(1, 28, '1'),
(1, 29, '12'),
(1, 30, '1'),
(1, 31, '1'),
(2, 26, '2'),
(2, 27, '2'),
(2, 28, '23'),
(2, 29, '34'),
(2, 30, '2'),
(2, 31, '2'),
(3, 26, '3'),
(3, 27, '34'),
(3, 28, '4'),
(3, 29, '56'),
(3, 30, '3'),
(3, 31, '3'),
(4, 26, '4'),
(4, 27, '4'),
(4, 28, '5'),
(4, 29, '78'),
(4, 30, '4'),
(4, 31, '4');

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `IDTipo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`IDTipo`, `Nome`) VALUES
(1, 'Eliminazione diretta');

-- --------------------------------------------------------

--
-- Table structure for table `torneo`
--

CREATE TABLE `torneo` (
  `IDTorneo` int(11) NOT NULL,
  `FKTipo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `DataCreazione` date DEFAULT NULL,
  `NomeGioco` varchar(50) DEFAULT NULL,
  `IDAdmin` int(11) DEFAULT NULL,
  `FaseCorrente` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `torneo`
--

INSERT INTO `torneo` (`IDTorneo`, `FKTipo`, `Nome`, `DataCreazione`, `NomeGioco`, `IDAdmin`, `FaseCorrente`) VALUES
(31, 1, 'Calcetto 5INB', '2018-05-25', 'Calcio', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `IDUtente` int(11) NOT NULL,
  `NomeUtente` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`IDUtente`, `NomeUtente`, `Password`) VALUES
(2, 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gioca`
--
ALTER TABLE `gioca`
  ADD PRIMARY KEY (`FKSquadra`,`IDTorneoSquadra`,`FKPartita`,`IDTorneoPartita`),
  ADD KEY `NumeroPartita` (`FKPartita`,`IDTorneoPartita`);

--
-- Indexes for table `partita`
--
ALTER TABLE `partita`
  ADD PRIMARY KEY (`IDPartita`,`IDTorneo`),
  ADD KEY `IDTorneo` (`IDTorneo`),
  ADD KEY `NumeroVincitrice` (`IDVincitrice`,`IDTorneoVincitrice`);

--
-- Indexes for table `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`IDSquadra`,`IDTorneo`),
  ADD KEY `IDTorneo` (`IDTorneo`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`IDTipo`);

--
-- Indexes for table `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`IDTorneo`),
  ADD KEY `IDTipo` (`FKTipo`),
  ADD KEY `IDAdmin` (`IDAdmin`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IDUtente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `partita`
--
ALTER TABLE `partita`
  MODIFY `IDPartita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `squadra`
--
ALTER TABLE `squadra`
  MODIFY `IDSquadra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `IDTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `torneo`
--
ALTER TABLE `torneo`
  MODIFY `IDTorneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `IDUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `gioca`
--
ALTER TABLE `gioca`
  ADD CONSTRAINT `gioca_ibfk_2` FOREIGN KEY (`FKSquadra`,`IDTorneoSquadra`) REFERENCES `squadra` (`IDSquadra`, `IDTorneo`),
  ADD CONSTRAINT `gioca_ibfk_3` FOREIGN KEY (`FKPartita`,`IDTorneoPartita`) REFERENCES `partita` (`IDPartita`, `IDTorneo`);

--
-- Constraints for table `partita`
--
ALTER TABLE `partita`
  ADD CONSTRAINT `partita_ibfk_1` FOREIGN KEY (`IDVincitrice`,`IDTorneoVincitrice`) REFERENCES `squadra` (`IDSquadra`, `IDTorneo`),
  ADD CONSTRAINT `partita_ibfk_2` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`IDTorneo`);

--
-- Constraints for table `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `torneo_ibfk_1` FOREIGN KEY (`FKTipo`) REFERENCES `tipo` (`IDTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `torneo_ibfk_2` FOREIGN KEY (`IDAdmin`) REFERENCES `utente` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
