SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `storingapp`
--
DROP DATABASE IF EXISTS `storingapp`;
CREATE DATABASE IF NOT EXISTS `storingapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `storingapp`;

--
-- Tabel: `meldingen`
--

DROP TABLE IF EXISTS `meldingen`;
CREATE TABLE IF NOT EXISTS `meldingen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attractie` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `capaciteit` int(11) DEFAULT NULL,
  `prioriteit` tinyint(1) NOT NULL DEFAULT 0,
  `melder` varchar(255) NOT NULL,
  `gemeld_op` datetime NOT NULL DEFAULT current_timestamp(),
  `overige_info` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;


INSERT INTO `meldingen` (`attractie`, `type`, `capaciteit`, `prioriteit`, `melder`, `gemeld_op`, `overige_info`) VALUES
('Terminator3000', 'achtbaan', 200, 1, 'M. Onteur', '2020-01-01 00:00:00', 'Dit is een testmelding.');