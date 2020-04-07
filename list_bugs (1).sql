-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 avr. 2020 à 17:20
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bug`
--

-- --------------------------------------------------------

--
-- Structure de la table `list_bugs`
--

CREATE TABLE `list_bugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `createAt` datetime NOT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT 0,
  `url` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `list_bugs`
--

INSERT INTO `list_bugs` (`id`, `titre`, `description`, `createAt`, `status`, `url`, `ip`) VALUES
(1, 'alim ordinateur', 'ne fonctionne pas', '2019-10-21 09:36:50', 1, '', ''),
(2, 'test', '<script text=\"text/javascript\">alert(\'Hacked\')</script>', '2019-10-21 09:51:49', 0, '', ''),
(3, 'test hacked', '&lt;script text=&quot;text/javascript&quot;&gt;alert(\'Hacked\')&lt;/script&gt;', '2019-10-21 09:55:53', 0, '', ''),
(4, 'test template', 'ajout template', '2019-10-22 18:34:16', 0, '', ''),
(5, 'Google pas d\'accès', 'oh mon dieu!', '2020-03-25 12:54:24', 1, 'https://www.google.fr', '172.217.17.35'),
(6, 'azerazerazer12121', 'qsdfqsdfqsdfqsdfqsdf12121', '2020-04-07 15:20:56', 0, 'https://google.fr', '216.58.211.163'),
(7, 'test postman', 'post mans fonc ou onctinera passqdsqdqsdqsqsdqsfqsqq', '2020-04-07 17:01:15', 0, 'https://google.fr', '216.58.211.163'),
(8, 'azerazerazer12121', 'qsdfqsdfqsdfqsdfqsdf12121', '2020-04-07 17:04:31', 0, 'https://google.fr', '216.58.211.163');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `list_bugs`
--
ALTER TABLE `list_bugs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `list_bugs`
--
ALTER TABLE `list_bugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
