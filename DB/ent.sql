-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 03 déc. 2024 à 12:45
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ent`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `abs_id` int NOT NULL AUTO_INCREMENT,
  `fk_user_id` int NOT NULL,
  `abs_nom` text NOT NULL,
  `abs_desc` text NOT NULL,
  `abs_matiere` varchar(60) NOT NULL,
  `abs_date_debut` datetime NOT NULL,
  `abs_date_fin` datetime NOT NULL,
  `abs_justif` tinyint(1) NOT NULL,
  PRIMARY KEY (`abs_id`),
  UNIQUE KEY `fk_user_id` (`fk_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devoir`
--

DROP TABLE IF EXISTS `devoir`;
CREATE TABLE IF NOT EXISTS `devoir` (
  `devoir_id` int NOT NULL AUTO_INCREMENT,
  `devoir_nom` text NOT NULL,
  `devoir_desc` text NOT NULL,
  `devoir_date_fin` datetime NOT NULL,
  `devoir_matiere` varchar(60) NOT NULL,
  PRIMARY KEY (`devoir_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `email_id` int NOT NULL AUTO_INCREMENT,
  `email_destinataire` text NOT NULL,
  `email_envoyeur` text NOT NULL,
  `email_obj` text NOT NULL,
  `email_texte` text NOT NULL,
  `fk_user_messagerie` int NOT NULL,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `fk_user_messagerie` (`fk_user_messagerie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int NOT NULL AUTO_INCREMENT,
  `file_name` text NOT NULL,
  `fk_user_id` int NOT NULL,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `fk_user_id` (`fk_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `matiere_id` int NOT NULL AUTO_INCREMENT,
  `matiere_nom` varchar(60) NOT NULL,
  PRIMARY KEY (`matiere_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int NOT NULL AUTO_INCREMENT,
  `note_matiere` varchar(60) NOT NULL,
  `note_coef` float NOT NULL,
  `note_number` float NOT NULL,
  `fk_matiere_id` int NOT NULL,
  `fk_user_id` int NOT NULL,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `fk_matiere_id` (`fk_matiere_id`,`fk_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int NOT NULL AUTO_INCREMENT,
  `schedule_niveau` varchar(60) NOT NULL,
  `schedule_class` varchar(60) NOT NULL,
  `fk_user_id` int NOT NULL,
  PRIMARY KEY (`schedule_id`),
  UNIQUE KEY `fk_user_id` (`fk_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_nom` varchar(60) NOT NULL,
  `user_prenom` varchar(60) NOT NULL,
  `user_mdp` text NOT NULL,
  `user_email` text NOT NULL,
  `user_messagerie` int NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_messagerie` (`user_messagerie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
