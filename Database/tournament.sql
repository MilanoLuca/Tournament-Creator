-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 10, 2018 alle 08:42
-- Versione del server: 10.1.25-MariaDB
-- Versione PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struttura della tabella `partita`
--

CREATE TABLE `partita` (
  `ID` int(11) NOT NULL,
  `IDSquadra1` int(11) NOT NULL,
  `IDSquadra2` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `IDVincitrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `ID` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo`
--

CREATE TABLE `tipo` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tipo`
--

INSERT INTO `tipo` (`ID`, `Nome`) VALUES
(1, 'Eliminazione diretta');

-- --------------------------------------------------------

--
-- Struttura della tabella `torneo`
--

CREATE TABLE `torneo` (
  `ID` int(11) NOT NULL,
  `IDTipo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `DataCreazione` date DEFAULT NULL,
  `NomeGioco` varchar(50) DEFAULT NULL,
  `IDAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `ID` int(11) NOT NULL,
  `NomeUtente` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`ID`, `NomeUtente`, `Password`) VALUES
(1, 'termosimone', 'ciaosonotommy');

-- --------------------------------------------------------

--
-- Struttura della tabella `visualizza`
--

CREATE TABLE `visualizza` (
  `IDUtente` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `partita`
--
ALTER TABLE `partita`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDTorneo` (`IDTorneo`),
  ADD KEY `NumeroVincitrice` (`IDVincitrice`),
  ADD KEY `IDSquadra1` (`IDSquadra1`),
  ADD KEY `IDSquadra2` (`IDSquadra2`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDTorneo` (`IDTorneo`);

--
-- Indici per le tabelle `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDTipo` (`IDTipo`),
  ADD KEY `IDAdmin` (`IDAdmin`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `visualizza`
--
ALTER TABLE `visualizza`
  ADD PRIMARY KEY (`IDUtente`,`IDTorneo`),
  ADD KEY `IDTorneo` (`IDTorneo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tipo`
--
ALTER TABLE `tipo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `torneo`
--
ALTER TABLE `torneo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `partita`
--
ALTER TABLE `partita`
  ADD CONSTRAINT `partita_ibfk_1` FOREIGN KEY (`IDVincitrice`) REFERENCES `squadra` (`ID`),
  ADD CONSTRAINT `partita_ibfk_2` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`ID`),
  ADD CONSTRAINT `partita_ibfk_3` FOREIGN KEY (`IDSquadra1`) REFERENCES `squadra` (`ID`),
  ADD CONSTRAINT `partita_ibfk_4` FOREIGN KEY (`IDSquadra2`) REFERENCES `squadra` (`ID`);

--
-- Limiti per la tabella `squadra`
--
ALTER TABLE `squadra`
  ADD CONSTRAINT `squadra_ibfk_1` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`ID`);

--
-- Limiti per la tabella `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `torneo_ibfk_1` FOREIGN KEY (`IDTipo`) REFERENCES `tipo` (`ID`),
  ADD CONSTRAINT `torneo_ibfk_2` FOREIGN KEY (`IDAdmin`) REFERENCES `utente` (`ID`);

--
-- Limiti per la tabella `visualizza`
--
ALTER TABLE `visualizza`
  ADD CONSTRAINT `visualizza_ibfk_1` FOREIGN KEY (`IDUtente`) REFERENCES `utente` (`ID`),
  ADD CONSTRAINT `visualizza_ibfk_2` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
