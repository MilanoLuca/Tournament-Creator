-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 16, 2018 alle 12:57
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

-- --------------------------------------------------------

--
-- Struttura della tabella `partita`
--

CREATE TABLE `partita` (
  `IDPartita` int(11) NOT NULL,
  `IDSquadra1` int(11) NOT NULL,
  `IDSquadra2` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `IDVincitrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `IDSquadra` int(11) NOT NULL,
  `IDTorneo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `IDTipo` int(11) NOT NULL,
  `Nome` varchar(50) DEFAULT NULL,
  `DataCreazione` date DEFAULT NULL,
  `NomeGioco` varchar(50) DEFAULT NULL,
  `IDAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `torneo`
--

INSERT INTO `torneo` (`IDTorneo`, `IDTipo`, `Nome`, `DataCreazione`, `NomeGioco`, `IDAdmin`) VALUES
(5, 1, 'prova', '2018-04-16', 'sajhkd', 1);

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
  ADD PRIMARY KEY (`IDPartita`),
  ADD KEY `IDTorneo` (`IDTorneo`),
  ADD KEY `NumeroVincitrice` (`IDVincitrice`),
  ADD KEY `IDSquadra1` (`IDSquadra1`),
  ADD KEY `IDSquadra2` (`IDSquadra2`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`IDSquadra`),
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
  ADD KEY `IDTipo` (`IDTipo`),
  ADD KEY `IDAdmin` (`IDAdmin`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`IDUtente`);

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
-- AUTO_INCREMENT per la tabella `squadra`
--
ALTER TABLE `squadra`
  MODIFY `IDSquadra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `tipo`
--
ALTER TABLE `tipo`
  MODIFY `IDTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `torneo`
--
ALTER TABLE `torneo`
  MODIFY `IDTorneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `IDUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `partita`
--
ALTER TABLE `partita`
  ADD CONSTRAINT `partita_ibfk_1` FOREIGN KEY (`IDSquadra1`) REFERENCES `squadra` (`IDSquadra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partita_ibfk_2` FOREIGN KEY (`IDSquadra2`) REFERENCES `squadra` (`IDSquadra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partita_ibfk_3` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`IDTorneo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partita_ibfk_4` FOREIGN KEY (`IDVincitrice`) REFERENCES `squadra` (`IDSquadra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `squadra`
--
ALTER TABLE `squadra`
  ADD CONSTRAINT `squadra_ibfk_1` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`IDTorneo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `torneo_ibfk_1` FOREIGN KEY (`IDTipo`) REFERENCES `tipo` (`IDTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `torneo_ibfk_2` FOREIGN KEY (`IDAdmin`) REFERENCES `utente` (`IDUtente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `visualizza`
--
ALTER TABLE `visualizza`
  ADD CONSTRAINT `visualizza_ibfk_1` FOREIGN KEY (`IDUtente`) REFERENCES `utente` (`IDUtente`),
  ADD CONSTRAINT `visualizza_ibfk_2` FOREIGN KEY (`IDTorneo`) REFERENCES `torneo` (`IDTorneo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
