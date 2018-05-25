-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 25, 2018 alle 11:42
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
-- Struttura della tabella `gioca`
--

CREATE TABLE `gioca` (
  `FKSquadra` int(11) NOT NULL,
  `IDTorneoSquadra` int(11) NOT NULL,
  `FKPartita` int(11) NOT NULL,
  `IDTorneoPartita` int(11) NOT NULL,
  `Punteggio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `gioca`
--

INSERT INTO `gioca` (`FKSquadra`, `IDTorneoSquadra`, `FKPartita`, `IDTorneoPartita`, `Punteggio`) VALUES
(1, 31, 28, 31, NULL),
(2, 31, 28, 31, NULL),
(3, 31, 29, 31, NULL),
(4, 31, 29, 31, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `partita`
--

CREATE TABLE `partita` (
  `IDPartita` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `IDVincitrice` int(11) DEFAULT NULL,
  `IDTorneoVincitrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `partita`
--

INSERT INTO `partita` (`IDPartita`, `IDTorneo`, `IDVincitrice`, `IDTorneoVincitrice`) VALUES
(28, 31, NULL, NULL),
(29, 31, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `IDSquadra` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `squadra`
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
-- Struttura della tabella `tipo`
--

CREATE TABLE `tipo` (
  `IDTipo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tipo`
--

INSERT INTO `tipo` (`IDTipo`, `Nome`) VALUES
(1, 'Eliminazione diretta');

-- --------------------------------------------------------

--
-- Struttura della tabella `torneo`
--

CREATE TABLE `torneo` (
  `IDTorneo` int(11) NOT NULL,
  `FKTipo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `DataCreazione` date DEFAULT NULL,
  `NomeGioco` varchar(50) DEFAULT NULL,
  `IDAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `torneo`
--

INSERT INTO `torneo` (`IDTorneo`, `FKTipo`, `Nome`, `DataCreazione`, `NomeGioco`, `IDAdmin`) VALUES
(31, 1, 'Calcetto 5INB', '2018-05-25', 'Calcio', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `IDUtente` int(11) NOT NULL,
  `NomeUtente` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`IDUtente`, `NomeUtente`, `Password`) VALUES
(2, 'user', 'user');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `gioca`
--
ALTER TABLE `gioca`
  ADD PRIMARY KEY (`FKSquadra`,`IDTorneoSquadra`,`FKPartita`,`IDTorneoPartita`),
  ADD KEY `NumeroPartita` (`FKPartita`,`IDTorneoPartita`);

--
-- Indici per le tabelle `partita`
--
ALTER TABLE `partita`
  ADD PRIMARY KEY (`IDPartita`,`IDTorneo`),
  ADD KEY `IDTorneo` (`IDTorneo`),
  ADD KEY `NumeroVincitrice` (`IDVincitrice`,`IDTorneoVincitrice`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`IDSquadra`,`IDTorneo`),
  ADD KEY `IDTorneo` (`IDTorneo`);

--
-- Indici per le tabelle `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`IDTipo`);

--
-- Indici per le tabelle `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`IDTorneo`),
  ADD KEY `IDTipo` (`FKTipo`),
  ADD KEY `IDAdmin` (`IDAdmin`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IDUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `partita`
--
ALTER TABLE `partita`
  MODIFY `IDPartita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT per la tabella `squadra`
--
ALTER TABLE `squadra`
  MODIFY `IDSquadra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `tipo`
--
ALTER TABLE `tipo`
  MODIFY `IDTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `torneo`
--
ALTER TABLE `torneo`
  MODIFY `IDTorneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `IDUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `gioca`
--
ALTER TABLE `gioca`
  ADD CONSTRAINT `gioca_ibfk_2` FOREIGN KEY (`FKSquadra`,`IDTorneoSquadra`) REFERENCES `squadra` (`IDSquadra`, `IDTorneo`),
  ADD CONSTRAINT `gioca_ibfk_3` FOREIGN KEY (`FKPartita`,`IDTorneoPartita`) REFERENCES `partita` (`IDPartita`, `IDTorneo`);

--
-- Limiti per la tabella `partita`
--
ALTER TABLE `partita`
  ADD CONSTRAINT `partita_ibfk_1` FOREIGN KEY (`IDVincitrice`,`IDTorneoVincitrice`) REFERENCES `squadra` (`IDSquadra`, `IDTorneo`),
  ADD CONSTRAINT `partita_ibfk_2` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`IDTorneo`);

--
-- Limiti per la tabella `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `torneo_ibfk_1` FOREIGN KEY (`FKTipo`) REFERENCES `tipo` (`IDTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `torneo_ibfk_2` FOREIGN KEY (`IDAdmin`) REFERENCES `utente` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
