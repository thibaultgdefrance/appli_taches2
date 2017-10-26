-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2017 at 11:46 AM
-- Server version: 5.5.55-0+deb8u1
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `appli_taches2`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
`id` int(2) unsigned NOT NULL,
  `level_name` text CHARACTER SET latin1 COLLATE latin1_bin,
  `poids` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level_name`, `poids`) VALUES
(1, 'urgent', 99),
(2, 'rien ne presse', 0),
(3, 'important', 70),
(4, 'pour bientot', 30),
(5, 'pas_vraiment_important', 20),
(6, 'trÃ¨s important', 95),
(7, 'assez_important', 65);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`id2` int(3) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` tinytext,
  `deadline` date DEFAULT '2089-10-26',
  `level_id` int(2) unsigned NOT NULL DEFAULT '2',
  `accomplished` varchar(3) NOT NULL DEFAULT 'non'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `task`:
--   `level_id`
--       `level` -> `id`
--

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id2`, `name`, `description`, `deadline`, `level_id`, `accomplished`) VALUES
(1, 'faire une appli taches cool', 'coder une application de taches ï¿½ faire', '2017-10-26', 1, 'non'),
(5, 'faire du sport', 'aller courir', '2017-10-25', 3, 'non'),
(13, 'faire un truc', 'faire un trcu', '2017-10-25', 5, 'non'),
(14, 'faire une chose', 'faire une chose', '2017-10-25', 4, 'non'),
(15, 'apprendre le php', 'travailler sur internet pour améliorer son niveau en php', '2017-10-25', 1, 'oui'),
(20, 'faire le mÃ©nage', 'passer un coup d''aspirateur', '2017-10-27', 2, 'non'),
(22, 'apprendre Ã  faire les sushis', 'se reiseigner pour apprendre Ã  faire les sushis', '2017-10-29', 4, 'non'),
(23, 'apprendre Ã  faire des omelett', 'ne plus les faire bruler', '2017-10-29', 2, 'non'),
(24, 'fair un rÃ©gime', 'manger moin gras', '2017-10-29', 3, 'non'),
(25, 'dire bonjour', 'salut', '2017-10-26', 2, 'oui');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`id2`), ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
MODIFY `id` int(2) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
MODIFY `id2` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
