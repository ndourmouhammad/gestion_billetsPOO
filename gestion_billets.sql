-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 04 avr. 2024 à 18:16
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
-- Base de données : `gestion_billets`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE `billets` (
  `id` int(11) NOT NULL,
  `date_heure_reservation` datetime NOT NULL,
  `statut` enum('confirmée','en attente','annulée') NOT NULL,
  `id_client` int(11) NOT NULL,
  `id__trajet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `billets`
--

INSERT INTO `billets` (`id`, `date_heure_reservation`, `statut`, `id_client`, `id__trajet`) VALUES
(1, '2024-04-04 01:38:21', 'en attente', 1, 3),
(2, '2024-04-04 01:38:21', 'confirmée', 2, 4),
(4, '2024-04-04 13:01:29', 'confirmée', 4, 3),
(5, '2024-04-04 13:09:16', 'en attente', 6, 6),
(6, '2024-04-04 13:15:37', 'annulée', 5, 3),
(7, '2024-04-04 00:00:00', 'en attente', 3, 3),
(8, '2024-04-04 00:00:00', 'en attente', 3, 3),
(9, '2024-04-04 16:04:00', 'en attente', 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `telephone` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `email`, `adresse`, `telephone`) VALUES
(1, 'BA', 'Aissé', 'a.ba@exemple.com', 'Yoff', 770000000),
(2, 'Dieng', 'Sokhna Astou', 'mbene@exemple.com', 'Parcelles assainies', 760000000),
(3, 'Ndour', 'Mouhammad ', 'ndourmouhammad15@gmail.com', 'Dakar Plateau', 750000000),
(4, 'Diallo', 'Dora', 'diallo@exemple.com', 'Yoff', 771111111),
(5, 'Diop', 'Abdou Aziz', 'diop@exemple.com', 'Bambey', 772222222),
(6, 'Diagne', 'Babacar', 'diagne@gmail.co', 'SAINT-LOUIS', 773333333);

-- --------------------------------------------------------

--
-- Structure de la table `trajets`
--

CREATE TABLE `trajets` (
  `id` int(11) NOT NULL,
  `trajet` varchar(50) NOT NULL,
  `heure_depart` time NOT NULL,
  `heure_arrivee` time NOT NULL,
  `compagnie` varchar(50) NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajets`
--

INSERT INTO `trajets` (`id`, `trajet`, `heure_depart`, `heure_arrivee`, `compagnie`, `prix`) VALUES
(3, 'Dakar - Diourbel', '07:00:00', '10:00:00', 'Senegal Dem Dikk', 3500),
(4, 'Dakar - Kaolack', '15:00:00', '19:00:00', 'Senegal Dem Dikk', 4000),
(5, 'Dakar - Sedhiou', '08:00:00', '13:00:00', 'Senegal Dem Dikk', 9000),
(6, 'SAINT-LOUIS - DAKAR', '07:00:00', '13:00:00', 'Ya Salam Voyage', 5000);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id__trajet` (`id__trajet`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`telephone`);

--
-- Index pour la table `trajets`
--
ALTER TABLE `trajets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `trajets`
--
ALTER TABLE `trajets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billets`
--
ALTER TABLE `billets`
  ADD CONSTRAINT `billets_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `billets_ibfk_2` FOREIGN KEY (`id__trajet`) REFERENCES `trajets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
