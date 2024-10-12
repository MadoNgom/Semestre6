-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 06 août 2024 à 21:06
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
-- Base de données : `fineshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `id_boutiquier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`, `id_boutiquier`) VALUES
(1, 'Tous Les Produits', 'Listes de tous les produits disponible sur la plateforme', 2),
(2, 'Beauté et bien être ', 'Accessoires beauté et bien être ', 2),
(3, 'Accessoires Femmes', 'Listes de produits pour femme', 2),
(4, 'Chaussure Hommes', 'Listes des chaussures', 2);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `montantTOT` float DEFAULT NULL,
  `etat` enum('EN COURS','VALIDER','REJETER') DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date`, `montantTOT`, `etat`, `id_client`) VALUES
(1, '2024-08-06', 15000, 'VALIDER', 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `montantTOT` float DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `montantTOT`, `id_client`) VALUES
(1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prixU` float DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `id_boutiquier` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `description`, `prixU`, `image`, `id_boutiquier`, `id_categorie`) VALUES
(1, 'Garnier', 'Produits Garnier', 25000, 'GARNIER.jpg', 2, 1),
(2, 'Mixa', 'Lait de corp', 10500, 'mixa copy.jpg', 2, 1),
(3, 'Sac Dior', 'Sac pour femme', 15500, 'sac1.png', 2, 1),
(4, 'Vaseline', 'produit de beauté', 19500, 'vaseline.jpg', 2, 1),
(5, 'Montre', 'Montre pour Homme', 12500, 'montre3.png', 2, 1),
(6, 'Poudre300', 'Poudre visage', 5000, 'poudre.webp', 2, 1),
(7, 'Shampoing', 'Shampoing pour chevaux', 1500, 'shampoing.webp', 2, 1),
(8, 'Talons', 'Talons pour fille', 12900, 'talon2.png', 2, 1),
(9, 'Pull', 'Pull pour homme', 6000, 'pull5.png', 2, 1),
(11, 'Pack Makeup', 'Makeup pour les filles', 10000, 'pack1.jpg', 2, 1),
(12, 'Byphase200', 'Lait de corp', 2500, 'byphase copy.jpg', 2, 2),
(13, 'Font', 'Font de teint', 4500, 'font1.jpg', 2, 2),
(14, 'Roue', 'Lait de corp', 5000, 'roue0.png', 2, 2),
(15, 'Mixa', 'Lait de corp', 2500, 'mixa.jpg', 2, 2),
(16, 'Gloss', 'soins de visage', 9000, 'gloss.jpg', 2, 2),
(17, 'Garnier200', 'Lait de corp', 3500, 'GARNIER.jpg', 2, 2),
(19, 'Vaseline', 'Lait de corp', 2700, 'vaseline.jpg', 2, 2),
(20, 'Shampoing', 'Lait de corp', 18500, 'shampoing.webp', 2, 2),
(21, 'Poudre', 'Faire belle', 3800, 'poudre.webp', 2, 2),
(22, 'Rouge', 'Rouge lèvre', 4500, 'rouge1.jpg', 2, 2),
(23, 'Montre', 'Montre pour femme', 24000, 'montre3.png', 2, 3),
(24, 'Rolex', 'Montre pour femme', 35000, 'montre2.png', 2, 3),
(25, 'Montre de luxe', 'Montre femme', 15000, 'montre1.png', 2, 3),
(26, 'Sac', 'Sac pour femme', 8500, 'sac2.png', 2, 3),
(27, 'Sac OG', 'Sac pour femme', 29000, 'sac0.png', 2, 3),
(28, 'Pull', 'Pull pour femme', 6000, 'pull0.png', 2, 3),
(29, 'Pull Noble', 'Pull pour femme', 6500, 'pull1.png', 2, 3),
(30, 'Pull Noir', 'Pull pour femme', 7500, 'pull2.png', 2, 3),
(31, 'Pull gri', 'Pull pour femme', 9000, 'pull4.png', 2, 3),
(32, 'Pull vert', 'Pull pour femme', 6000, 'pull5.png', 2, 3),
(33, 'Chaussure Nike', 'Chaussure pour homme', 37000, 'image.jpg', 2, 4),
(34, 'Air Max', 'Chaussure pour Homme', 10000, 'image1.png', 2, 4),
(35, 'NIKE Noir', 'Marque Américain ', 55000, 'image12.jpg', 2, 4),
(36, 'Vans', 'Marque des nobles', 19000, 'images2.jpg', 2, 4),
(37, 'Basket', 'Marque pour homme', 17500, 'image-png.png', 2, 4),
(38, 'Bisgaard', 'chaussure homme', 35000, 'img4.png', 2, 4),
(39, 'Bellamy', 'Chaussure homme', 25000, 'img8.png', 2, 4),
(40, 'Kickers', 'Chaussure pour homme', 18000, 'img1.png', 2, 4),
(41, 'Geox', 'Marque Noble', 65000, 'image-png.png', 2, 4),
(42, 'Igor ', 'Chaussure homme', 21000, 'img0.png', 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `produitcommande`
--

CREATE TABLE `produitcommande` (
  `id` int(11) NOT NULL,
  `id_commande` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `nbr` int(11) DEFAULT NULL,
  `montantTOT` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produitcommande`
--

INSERT INTO `produitcommande` (`id`, `id_commande`, `id_produit`, `nbr`, `montantTOT`) VALUES
(1, 1, 25, 1, 15000);

-- --------------------------------------------------------

--
-- Structure de la table `produitpanier`
--

CREATE TABLE `produitpanier` (
  `id` int(11) NOT NULL,
  `id_panier` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `nbr` int(11) DEFAULT NULL,
  `montantTOT` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nomComplet` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `profile` enum('ADMIN','BOUTIQUIER','CLIENT') DEFAULT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nomComplet`, `address`, `email`, `pwd`, `profile`, `dateCreation`) VALUES
(1, 'Mansour BA', 'Yarakh Bel-Air', 'mansourba0109@gmail.com', 'passer123', 'ADMIN', '2024-08-06 12:40:38'),
(2, 'Malado Ngom', 'Parcelle ', 'maladongom@gmail.com', 'passer123', 'BOUTIQUIER', '2024-08-06 12:43:28');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_boutiquier_id` (`id_boutiquier`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_client` (`id_client`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client` (`id_client`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorie` (`id_categorie`),
  ADD KEY `fk_boutiquier` (`id_boutiquier`);

--
-- Index pour la table `produitcommande`
--
ALTER TABLE `produitcommande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produitpanier`
--
ALTER TABLE `produitpanier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_panier` (`id_panier`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `produitcommande`
--
ALTER TABLE `produitcommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `produitpanier`
--
ALTER TABLE `produitpanier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `fk_boutiquier_id` FOREIGN KEY (`id_boutiquier`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_client` FOREIGN KEY (`id_client`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`id_client`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_boutiquier` FOREIGN KEY (`id_boutiquier`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `produitcommande`
--
ALTER TABLE `produitcommande`
  ADD CONSTRAINT `produitcommande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `produitcommande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produitpanier`
--
ALTER TABLE `produitpanier`
  ADD CONSTRAINT `produitpanier_ibfk_1` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id`),
  ADD CONSTRAINT `produitpanier_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
