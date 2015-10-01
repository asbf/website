-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: asbf.fr
-- Généré le: Jeu 01 Octobre 2015 à 18:59
-- Version du serveur: 5.5.44

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `asbf`
--

-- --------------------------------------------------------

--
-- Structure de la table `collecte`
--
-- Création: Dim 07 Juin 2015 à 13:48
-- Dernière modification: Dim 14 Juin 2015 à 17:22
--

CREATE TABLE IF NOT EXISTS `collecte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(32) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `adresse` varchar(256) COLLATE utf8_bin NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `resultat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--
-- Création: Ven 22 Mai 2015 à 21:33
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `slug` varchar(50) NOT NULL,
  `article` text NOT NULL,
  `edited` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
