-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 mars 2022 à 18:24
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `charlyday`
--

-- --------------------------------------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`
(
    `id_user`  int(11)      NOT NULL,
    `nom`      varchar(255) NOT NULL,
    `prenom`   varchar(255) NOT NULL,
    `email`    varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    primary key (`id_user`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Structure de la table `boite`
--
DROP TABLE IF EXISTS `boite`;
CREATE TABLE `boite`
(
    `id_boite` int(11) NOT NULL,
    `taille` text NOT NULL,
    `poidsmax` float NOT NULL,
    `message` varchar(120) NOT NULL,
    `couleur` varchar(40) NOT NULL,
    `id_user` int(10) NOT NULL,
    `id_modele` int(10) NOT NULL,
    primary key (`id_boite`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `boite`
--

INSERT INTO `boite` (`id_boite`, `taille`, `poidsmax`)
VALUES (1, 'petite', 0.7),
       (2, 'moyenne', 1.5),
       (3, 'grande', 3.2);

-- --------------------------------------------------------


CREATE TABLE `typebox` (
  `id_modele` int(2) NOT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `poidsmax` float NOT NULL,
  `poidsobjetmax` float NOT NULL
)  ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Structure de la table `categorie`
--
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie`
(
    `id_categorie` int(11) NOT NULL,
    `nom`          text    NOT NULL,
    primary key (`id_categorie`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`)
VALUES (1, 'Beauté'),
       (2, 'Bijoux'),
       (3, 'Décoration'),
       (4, 'Produit ménager'),
       (5, 'Upcycling');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--
DROP TABLE IF EXISTS `produit`;
CREATE TABLE `produit`
(
    `id_produit`  int(11) NOT NULL,
    `titre`       text    NOT NULL,
    `description` text    NOT NULL,
    `categorie`   int(11) NOT NULL,
    `poids`       float   NOT NULL,
    `image`        text   NOT NULL,
    primary key (`id_produit`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `produits_boite`;
CREATE TABLE `produits_boite`
(
    `id_produit` int(11) NOT NULL,
    `id_boite`   int(11) NOT NULL,
    `quantite`   int(11) NOT NULL,
    primary key (`id_produit`, `id_boite`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `titre`, `description`, `categorie`, `poids`, `image`)
VALUES (1, 'Crème', 'Une crème hydratante et parfumée qui rend la peau douce', 1, 0.3, '1.jpg'),
       (2, 'Savon', 'Un savon qui respecte la peau', 1, 0.2, '2.jpg'),
       (3, 'Shampoing', 'Shampoing doux et démêlant', 1, 0.4, '3.jpg'),
       (4, 'Bracelet', 'Un bracelet en tissu aux couleurs plaisantes', 2, 0.15, '4.jpg'),
       (5, 'Tableau', 'Aquarelle ou peinture à l\'huile', 3, 0.6, '5.jpg'),
       (6, 'Essuie-main', 'Utile au quotidien', 4, 0.45, '6.jpg'),
       (7, 'Gel', 'Gel hydroalcoolique et Antibactérien', 4, 0.25, '7.jpg'),
       (8, 'Masque', 'masque chirurgical jetable categorie 1', 4, 0.35, '8.jpg'),
       (9, 'Gilet', 'Gilet décoré par nos couturières', 5, 0.55, '9.jpg'),
       (10, 'Marque page', 'Joli marque page pour accompagner vos lectures favorites', 5, 0.1, '10.jpg'),
       (11, 'Sac', 'Sac éco-responsable avec décorations variées', 5, 0.26, '11.jpg'),
       (12, 'Surprise', 'Pochette surprise pour faire plaisir aux petits et grands', 5, 0.7, '12.jpg'),
       (13, 'T-shirt', 'T-shirt peint à la main et avec pochoir', 5, 0.32, '13.jpg');

--
-- Index pour les tables déchargées
--


--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
    ADD KEY `categorie` (`categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boite`
--
ALTER TABLE `boite`
    MODIFY `id_boite` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
    MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
    MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

ALTER TABLE `user`
    MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 1;

ALTER TABLE `produits_boite`
    ADD FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

ALTER TABLE `boite`
    ADD FOREIGN KEY (`id_boite`) REFERENCES `boite` (`id_boite`);

ALTER TABLE `boite`
    ADD FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

ALTER TABLE `boite`
    ADD FOREIGN KEY (`id_modele`) REFERENCES `typebox` (`id_modele`);

ALTER TABLE `produit`
    ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
