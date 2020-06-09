-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 09 juin 2020 à 09:47
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cgt`
--
CREATE DATABASE IF NOT EXISTS `cgt` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cgt`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(10) NOT NULL,
  `id_sections` int(10) NOT NULL,
  `titre` varchar(1000) NOT NULL,
  `sous_titre` varchar(1000) DEFAULT NULL,
  `date` date NOT NULL,
  `contenu` text NOT NULL,
  `statut` int(11) NOT NULL,
  `img` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `id_utilisateurs`, `id_sections`, `titre`, `sous_titre`, `date`, `contenu`, `statut`, `img`) VALUES
(1, 2, 1, 'la greve', 'cgt renault flins en greve', '2020-05-31', 'outpoetojreooorejtoiperjtopcerjpotjoperotjpoerjtpjerptpapojpjerojorjjtr', 0, 'img/CGT-Renault.jpeg'),
(2, 2, 1, 'la greve2', 'cgt renault flins en greve ertyu', '2020-05-30', 'outpoetojreooorejtoiperjtopcerjpotjoperotjpoerjtpjerptpapojpjeroertyjorjjtr', 0, 'img/img.jpg'),
(3, 2, 1, 'la greve3', 'cgt renault flins en greve ertyu ertrytuyrter', '2020-06-03', 'outpoetojreooorejtoiperjtopcerjpotjoperotjpoerjtpjerptpapojpjeroertyjorjjtr', 0, 'img/ob_0b8733_ob-20d250-renault.jpg'),
(35, 2, 1, 'azerty', 'zertyui', '2020-06-09', 'mpoiuytresqw', 0, 'img/logofb.png'),
(36, 2, 1, 'zertyuk', 'zertyui', '2020-06-09', 'qsderftyuiop^$*\r\n', 0, 'img/logofb.png');

-- --------------------------------------------------------

--
-- Structure de la table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sections`
--

INSERT INTO `sections` (`id`, `nom`) VALUES
(1, 'Ecoles'),
(2, 'Crèches');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `droits` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `mail`, `password`, `droits`) VALUES
(1, 'admin', 'amelie.chardon@laplateforme.io', '$2y$12$TVe1fUoQjTg/qq4xv5Lc0ezkqU.o2sQqTRZRXnGsa5FjK/AhbFXL6', 'Administrateur'),
(2, 'ikki88', 'jdcolas888@gmail.com', '$2y$12$F3fNXP3iJpW8gL.LJR8UO.lzGJL8jMZlYpULIjOfY1DIo4bsJXX2e', 'Redacteur'),
(5, 'le d ', 'jdcolas8887@gmail.com', '$2y$12$CqT/6KaG6yYDzqUVpDOCue0dcGgraBF4p.fOwXiAEGoUUVqIEjIUS', 'Relecteur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
