-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 mars 2024 à 15:36
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cc4`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `pass`) VALUES
(2, 'root', '$2y$10$k633TJLfjHXsFvBYvJtk.u2mM4b34PPUK5J32lXpqMnzRIQkZaa16');

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `name` varchar(100) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `grade` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tel` int(11) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `matricule` varchar(45) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `pass` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`name`, `prenom`, `grade`, `email`, `tel`, `adresse`, `matricule`, `login`, `pass`) VALUES
('oussama', 'alaoui', 'technicien', 'oussama@gmail.com', 606704656, 'imm 48 appt 01', 'CB12345', 'oussama', '$2y$10$6jE2TXJoEQD1IerCQjWm3.PTZurPBG7SULe4xvOETrIZCk.9ixL.G'),
('maryam', 'lahya', 'technicien', 'test@gmail.com', 605040203, 'ap 48 appt 50', 'e85852', 'maryam', '$2y$10$rWDUaZGUt09Gpn6AX2lgpu90I67x2gBQ2zR1reXg2v7xV4wItBT4W'),
('guennach', 'adnane', 'TECHNICIEN', 'adnaneguennach@gmail.com', 606704656, 'imm 48 appt 01', 'X123456', 'test', '$2y$10$z0hc7/bSZH5XGBis58D6Yufi3BEGOYHRUCPqtmHosn5NAtrzWfsyK');

-- --------------------------------------------------------

--
-- Structure de la table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id_request` int(11) NOT NULL,
  `employee_matricule` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `leave_requests`
--

INSERT INTO `leave_requests` (`id_request`, `employee_matricule`, `start_date`, `end_date`, `status`) VALUES
(12, 'X123456', '2024-03-22', '2024-03-30', 0),
(13, 'X123456', '2024-03-22', '2024-03-31', 1),
(14, 'CB12345', '2024-03-28', '2024-03-31', 1),
(15, 'CB12345', '2024-03-29', '2024-04-19', 0),
(16, 'e85852', '2024-03-17', '2024-03-18', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`matricule`);

--
-- Index pour la table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `leave_requests_ibf2` (`employee_matricule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibf2` FOREIGN KEY (`employee_matricule`) REFERENCES `employees` (`matricule`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
