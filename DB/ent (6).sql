-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 jan. 2025 à 15:12
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
  `abs_desc` text NOT NULL,
  `abs_date_debut` datetime NOT NULL,
  `abs_date_fin` datetime NOT NULL,
  `abs_justif` tinyint(1) NOT NULL,
  `fk_matiere_id` int NOT NULL,
  `abs_justif_file` text NOT NULL,
  `abs_justif_valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`abs_id`),
  KEY `fk_matiere_id` (`fk_matiere_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`abs_id`, `fk_user_id`, `abs_desc`, `abs_date_debut`, `abs_date_fin`, `abs_justif`, `fk_matiere_id`, `abs_justif_file`, `abs_justif_valid`) VALUES
(1, 1, 'Retard bouchon', '2024-12-03 12:30:00', '2024-12-03 12:45:00', 0, 1, 'Casquette luigi.png', 0),
(3, 1, 'Retard bouffe', '2024-12-17 15:43:23', '2024-12-17 18:43:23', 1, 3, '20210718_182207.jpg', 1),
(7, 1, 'Maladie', '2025-01-10 11:39:41', '2025-01-10 18:39:41', 1, 1, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int NOT NULL AUTO_INCREMENT,
  `fk_user_id1` int NOT NULL,
  `fk_user_id2` int NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `fk_user_id1` (`fk_user_id1`),
  KEY `fk_user_id2` (`fk_user_id2`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`chat_id`, `fk_user_id1`, `fk_user_id2`) VALUES
(1, 1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `competence_id` int NOT NULL AUTO_INCREMENT,
  `competence_nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`competence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`competence_id`, `competence_nom`) VALUES
(1, 'Développer'),
(2, 'Comprendre'),
(3, 'Concevoir'),
(4, 'Exprimer'),
(5, 'Entreprendre');

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
  `fk_matiere_id` int NOT NULL,
  `fk_user_id` int NOT NULL,
  `devoir_rendu` tinyint(1) NOT NULL,
  `devoir_fichier` text NOT NULL,
  PRIMARY KEY (`devoir_id`),
  KEY `devoir_matiere` (`fk_matiere_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `devoir`
--

INSERT INTO `devoir` (`devoir_id`, `devoir_nom`, `devoir_desc`, `devoir_date_fin`, `fk_matiere_id`, `fk_user_id`, `devoir_rendu`, `devoir_fichier`) VALUES
(1, 'ENT ', 'Rendre le projet de l\'ENT', '2025-01-10 23:59:59', 2, 1, 0, ''),
(2, 'DATAVIZ', 'Rendre dataviz', '2024-12-16 08:08:17', 1, 1, 1, '677d4b4b99a37-spotifymaquette.png'),
(5, 'Portfolio', 'Finir le Portfolio', '2025-01-31 13:52:26', 4, 1, 0, '');

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
  `fk_folder_id` int NOT NULL,
  `file_url` text NOT NULL,
  `fk_user_id` int NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `fk_folder_id` (`fk_folder_id`),
  KEY `fk_user_id_2` (`fk_user_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `file`
--

INSERT INTO `file` (`file_id`, `file_name`, `fk_folder_id`, `file_url`, `fk_user_id`) VALUES
(1, 'Fichier1', 1, '', 1),
(6, 'Casquette luigi.png', 1, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `folder`
--

DROP TABLE IF EXISTS `folder`;
CREATE TABLE IF NOT EXISTS `folder` (
  `folder_id` int NOT NULL AUTO_INCREMENT,
  `fk_user_id` int NOT NULL,
  `folder_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`folder_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `folder`
--

INSERT INTO `folder` (`folder_id`, `fk_user_id`, `folder_name`) VALUES
(1, 1, 'PHP'),
(2, 1, 'Javascript'),
(8, 1, 'Test'),
(10, 1, 'Test2');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `matiere_id` int NOT NULL AUTO_INCREMENT,
  `matiere_nom` varchar(60) NOT NULL,
  `fk_competence_id` int NOT NULL,
  PRIMARY KEY (`matiere_id`),
  KEY `fk_competence_id` (`fk_competence_id`),
  KEY `fk_competence_id_2` (`fk_competence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`matiere_id`, `matiere_nom`, `fk_competence_id`) VALUES
(1, 'JavaScript', 1),
(2, 'PHP', 1),
(3, 'Gestion de projet', 5),
(4, 'Intégration', 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `fk_chat_id` int NOT NULL,
  `message_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_user_id` int NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `fk_chat_id` (`fk_chat_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`message_id`, `fk_chat_id`, `message_text`, `fk_user_id`) VALUES
(1, 1, 'Salut Louis', 9),
(2, 1, 'Salut Théo', 1),
(3, 1, 'Comment vas tu ?', 1),
(4, 1, 'Bien et toi ?', 9),
(5, 1, 'tranquille je bosse sur l\'ent', 1);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `note_id` int NOT NULL AUTO_INCREMENT,
  `note_coef` float NOT NULL,
  `note_number` float NOT NULL,
  `fk_matiere_id` int NOT NULL,
  `fk_user_id` int NOT NULL,
  `note_name` text NOT NULL,
  PRIMARY KEY (`note_id`),
  KEY `fk_matiere_id_2` (`fk_matiere_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`note_id`, `note_coef`, `note_number`, `fk_matiere_id`, `fk_user_id`, `note_name`) VALUES
(1, 1, 15, 1, 1, 'QCM'),
(2, 1, 2, 3, 1, 'Contrôle fin de chapitre'),
(3, 1, 10, 2, 1, 'Blog PHP'),
(8, 1, 20, 2, 1, 'ENT'),
(9, 1, 5, 1, 1, 'QCM '),
(10, 1, 10, 2, 1, 'Référencement');

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
  `user_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_nom`, `user_prenom`, `user_mdp`, `user_email`, `user_admin`) VALUES
(1, 'DUHEZ', 'Louis', 'test', 'test', 0),
(9, 'De Oliveira', 'Théo', 'theo', 'theo', 0),
(10, 'admin', 'admin', 'admin', 'admin', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`fk_matiere_id`) REFERENCES `matiere` (`matiere_id`),
  ADD CONSTRAINT `absence_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`fk_user_id1`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`fk_user_id2`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `devoir`
--
ALTER TABLE `devoir`
  ADD CONSTRAINT `devoir_ibfk_1` FOREIGN KEY (`fk_matiere_id`) REFERENCES `matiere` (`matiere_id`),
  ADD CONSTRAINT `devoir_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`fk_folder_id`) REFERENCES `folder` (`folder_id`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `folder`
--
ALTER TABLE `folder`
  ADD CONSTRAINT `folder_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`fk_competence_id`) REFERENCES `competence` (`competence_id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`fk_chat_id`) REFERENCES `chat` (`chat_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`fk_matiere_id`) REFERENCES `matiere` (`matiere_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
