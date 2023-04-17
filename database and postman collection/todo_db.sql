-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 17 avr. 2023 à 12:02
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todo_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `status` varchar(255) NOT NULL,
  `due_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `todo`
--

INSERT INTO `todo` (`id`, `code`, `title`, `description`, `status`, `due_date`) VALUES
(1, '', 'reading php laravel documentation', 'reading php laravel documentation', 'ACTIVE', '19/04/2023'),
(2, '', 'system deployment', 'system deployment', 'ACTIVE', '17/04/2023');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
