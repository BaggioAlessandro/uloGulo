-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Ott 29, 2014 alle 12:48
-- Versione del server: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agencavi_sito`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ac_admin`
--

CREATE TABLE IF NOT EXISTS `ac_admin` (
  `user_name` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ac_admin`
--

INSERT INTO `ac_admin` (`user_name`, `password`, `email`) VALUES
('gulo', 'ulo', 'alebaggio91@hotmail.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `user_name` varchar(15) NOT NULL,
  `prodotto` varchar(20) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_name`,`time_stamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `log`
--

INSERT INTO `log` (`user_name`, `prodotto`, `time_stamp`) VALUES
('1', 'u', '2014-10-25 09:19:49'),
('1', 'u', '2014-10-25 09:24:00'),
('1', 'u', '2014-10-25 09:24:05'),
('1', 'u', '2014-10-27 08:50:26'),
('1', 'poi', '2014-10-27 08:50:33'),
('1', 'u', '2014-10-27 17:41:38'),
('1', 'poi', '2014-10-27 17:41:46'),
('1', 'poi', '2014-10-27 17:41:58'),
('1', 'POI', '2014-10-27 17:42:50'),
('1', 'POI', '2014-10-27 17:43:14'),
('1', 'poi', '2014-10-27 17:45:00'),
('1', 'u', '2014-10-28 11:39:27'),
('1', 'u', '2014-10-28 11:39:48'),
('1', 'poi', '2014-10-28 11:40:07'),
('1', 'poi', '2014-10-28 11:40:36'),
('1', 'u', '2014-10-28 11:43:30'),
('1', 'u', '2014-10-28 11:45:06'),
('uloGulo', 'u', '2014-10-29 09:14:19'),
('uloGulo', 'u', '2014-10-29 09:30:08'),
('uloGulo', 'u', '2014-10-29 09:30:53'),
('1', 'u', '2014-10-29 10:34:34'),
('.it', 'u', '2014-10-29 10:35:14'),
('1', 'u', '2014-10-29 10:36:51');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE IF NOT EXISTS `utenti` (
  `nome` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `azienda` varchar(20) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `stato` enum('P','C','D','') NOT NULL DEFAULT 'P',
  `user_name` varchar(40) NOT NULL,
  PRIMARY KEY (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`nome`, `password`, `mail`, `azienda`, `telefono`, `stato`, `user_name`) VALUES
('1', '2', 'ciccia', 'culo', NULL, '', '1'),
('Alesssandro', 'culo', 'alebaggio91@hotmail.it', 'casamia', NULL, 'P', 'alebaggio91@hotmail.it'),
('ulo', 'gulo', 'sfdjlsjhfs', 'fsddf', NULL, 'C', 'uloGulo'),
('ds', '2', 'd', 'd', NULL, 'P', 'a@b'),
('ds', '2', 'd', 'd', NULL, 'P', 'a'),
('1', '22', 'e', 'e', NULL, 'P', 'a@'),
('a', 'a', 'a', 'a', NULL, 'P', '.it');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
