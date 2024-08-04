DROP DATABASE IF EXISTS `FineShop`;
CREATE DATABASE IF NOT EXISTS `FineShop`;
USE `FineShop`;
/*base de donnée*/
CREATE TABLE `User` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nomComplet` VARCHAR(100),
  `address` VARCHAR(100),
  `email` VARCHAR(100) UNIQUE,
  `pwd` VARCHAR(100),
  `profile` ENUM("ADMIN", "BOUTIQUIER", "CLIENT"),
  `dateCreation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE `Categorie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` VARCHAR(100),
  `description` TEXT,
  `id_boutiquier` int,
  CONSTRAINT `fk_boutiquier_id` FOREIGN KEY (`id_boutiquier`) REFERENCES `User` (`id`)
);

CREATE TABLE `Produit` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `nom` VARCHAR(100),
  `description` TEXT,
  `prixU` float,
  `image` VARCHAR(100),
  `id_boutiquier` int,
  `id_categorie` int,
  CONSTRAINT `fk_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `Categorie` (`id`),
  CONSTRAINT `fk_boutiquier` FOREIGN KEY (`id_boutiquier`) REFERENCES `User` (`id`)
);

CREATE TABLE `Panier` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `montantTOT` float,
  `id_client` int,
  CONSTRAINT `fk_client` FOREIGN KEY (`id_client`) REFERENCES `User` (`id`)
);

CREATE TABLE `Commande` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `date` date,
  `montantTOT` float,
  `etat` ENUM('EN COURS', 'VALIDER', 'REJETER'),
  `id_client` int,
  CONSTRAINT `fk_commande_client` FOREIGN KEY (`id_client`) REFERENCES `User` (`id`)
);

CREATE TABLE `ProduitCommande` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_commande` int,
  `id_produit` int,
  `nbr` int,
  `montantTOT` float,
  CONSTRAINT FOREIGN KEY (`id_commande`) REFERENCES `Commande` (`id`),
  CONSTRAINT FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id`)
);

CREATE TABLE `ProduitPanier` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `id_panier` int,
  `id_produit` int,
  `nbr` int,
  `montantTOT` float,
  CONSTRAINT FOREIGN KEY (`id_panier`) REFERENCES `Panier` (`id`),
  CONSTRAINT FOREIGN KEY (`id_produit`) REFERENCES `Produit` (`id`)
);
