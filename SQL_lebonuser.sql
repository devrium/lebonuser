-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 08 jan. 2019 à 21:09
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lebonuser`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `addr_id` int(11) NOT NULL AUTO_INCREMENT,
  `addr_rue` varchar(255) DEFAULT NULL,
  `addr_ville` varchar(255) DEFAULT NULL,
  `addr_cp` varchar(14) DEFAULT NULL,
  `addr_pays` varchar(14) DEFAULT NULL,
  `addr_created` datetime DEFAULT NULL,
  `addr_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `addr_lead` int(11) NOT NULL,
  `addr_statut` int(1) NOT NULL DEFAULT '1' COMMENT 'Activé / Désactivé',
  `addr_user` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`addr_id`),
  UNIQUE KEY `addr_id_2` (`addr_id`),
  KEY `addr_id` (`addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`addr_id`, `addr_rue`, `addr_ville`, `addr_cp`, `addr_pays`, `addr_created`, `addr_updated`, `addr_lead`, `addr_statut`, `addr_user`) VALUES
(1, '3 rue des petits prés', 'cergy', '95000', 'France', '2019-01-08 00:00:00', '2019-01-08 00:00:00', 1, 1, 1),
(2, '25 rue perronet', 'Suresnes', '92150', 'France', '2019-01-08 00:00:00', '2019-01-08 13:34:44', 1, 1, 1),
(3, '12 rue jean baptiste charcot', 'Massy', '91300', 'France', NULL, '2019-01-08 18:12:57', 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `leads`
--

DROP TABLE IF EXISTS `leads`;
CREATE TABLE IF NOT EXISTS `leads` (
  `lead_id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_nom` varchar(255) DEFAULT NULL,
  `lead_prenom` varchar(255) DEFAULT NULL,
  `lead_email` varchar(255) DEFAULT NULL,
  `lead_created` datetime NOT NULL,
  `lead_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lead_user` int(11) NOT NULL,
  `lead_statut` int(1) NOT NULL DEFAULT '1' COMMENT 'Activé / Désactivé',
  PRIMARY KEY (`lead_id`),
  UNIQUE KEY `lead_id_2` (`lead_id`),
  KEY `lead_id` (`lead_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `leads`
--

INSERT INTO `leads` (`lead_id`, `lead_nom`, `lead_prenom`, `lead_email`, `lead_created`, `lead_updated`, `lead_user`, `lead_statut`) VALUES
(1, 'Dupont', 'Jeanne', 'jdupont@gmail.com', '2019-01-08 00:00:00', '2019-01-08 00:00:00', 1, 1),
(2, 'Jobs', 'Steeve', 'sjobs@gmail.com', '2019-01-08 00:00:00', '2019-01-08 00:00:00', 1, 1),
(3, 'Faure', 'Rémi', 'rfaure@gmail.com', '2019-01-08 17:32:40', '2019-01-08 18:34:25', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_login` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `user_prenom` varchar(50) NOT NULL,
  `user_picture` varchar(255) NOT NULL DEFAULT 'profil_default.jpg',
  `user_email` varchar(100) NOT NULL,
  `user_statut` int(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `user_id_2` (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_date`, `user_login`, `user_password`, `user_nom`, `user_prenom`, `user_picture`, `user_email`, `user_statut`) VALUES
(1, '2019-01-08 03:30:31', 'test', 'test', 'Mozar', 'Emmanuel', 'default.jpg', 'emozar@ubinov.fr', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
