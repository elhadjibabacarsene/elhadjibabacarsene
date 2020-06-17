-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 17 juin 2020 à 18:24
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `saquizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `prenom_user` varchar(150) NOT NULL,
  `nom_user` varchar(100) NOT NULL,
  `login_user` varchar(50) NOT NULL,
  `email_user` varchar(150) NOT NULL,
  `password_user` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `avatar_user` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `statut_user` enum('admin','joueur') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `prenom_user`, `nom_user`, `login_user`, `email_user`, `password_user`, `avatar_user`, `statut_user`) VALUES
(1, 'Babacar', 'Séne', 'admin', 'elhadjibabacarsene@gmail.com', '$2y$10$RZMgAFRq/pYM8sdmBr0yOOKA7zw1o7c.bwQ6XkKycdOvC1c/ZU88m', 'avatar-default.png', 'admin'),
(2, 'El Hadji', 'Séne', 'joueur', 'seneelhadjibabacar@outlook.com', '$2y$10$6fovS3LrXZVIDWZITSjx/umDFVoRNxE7mGaxN9yd.Ki2qUuJAWwUi', 'avatar-default.png', 'joueur'),
(14, 'Babacar', 'Diouf', 'joueur12', 'dawalmesenegal@gmail.com', '$2y$10$lst6zR7o1VJO8QIFUVtszukUjTsDxnOVgmOHzBnPEgXCQhp4TPsl.', 'avatar-default.png', 'joueur'),
(15, 'Fatou', 'Séne', 'fasha', 'fatousene@world-trade-consulting.com', '$2y$10$oBjo2xzjAzQEnk1SotsZ1.nrsdPZU3ZarES6NzBu1fSHITAaNdVk2', 'avatar-default.png', 'joueur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
