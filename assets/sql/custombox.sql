-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 mars 2022 à 16:49
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

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

--
-- Structure de la table `boite`
--

CREATE TABLE `boite`
(
    `id_boite`  int(11)      NOT NULL,
    `taille`    text         NOT NULL,
    `poidsmax`  float        NOT NULL,
    `message`   varchar(120) NOT NULL,
    `couleur`   varchar(40)  NOT NULL,
    `id_user`   int(10)      NOT NULL,
    `id_modele` int(10)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `boite`
--

INSERT INTO `boite` (`id_boite`, `taille`, `poidsmax`, `message`, `couleur`, `id_user`, `id_modele`)
VALUES (0, '', 0, '', '', 0, 0),
       (1, 'petite', 0.7, '', '', 0, 0),
       (2, 'moyenne', 1.5, '', '', 0, 0),
       (3, 'grande', 3.2, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie`
(
    `id_categorie` int(11) NOT NULL,
    `nom`          text    NOT NULL
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

CREATE TABLE `produit`
(
    `id`          int(11) NOT NULL,
    `titre`       text    NOT NULL,
    `description` text    NOT NULL,
    `categorie`   int(11) NOT NULL,
    `poids`       float   NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `categorie`, `poids`)
VALUES (1, 'Crème', 'Une crème hydratante et parfumée qui rend la peau douce', 1, 0.3),
       (2, 'Savon', 'Un savon qui respecte la peau', 1, 0.2),
       (3, 'Shampoing', 'Shampoing doux et démêlant', 1, 0.4),
       (4, 'Bracelet', 'Un bracelet en tissu aux couleurs plaisantes', 2, 0.15),
       (5, 'Tableau', 'Aquarelle ou peinture à l\'huile', 3, 0.6),
       (6, 'Essuie-main', 'Utile au quotidien', 4, 0.45),
       (7, 'Gel', 'Gel hydroalcoolique et Antibactérien', 4, 0.25),
       (8, 'Masque', 'masque chirurgical jetable categorie 1', 4, 0.35),
       (9, 'Gilet', 'Gilet décoré par nos couturières', 5, 0.55),
       (10, 'Marque page', 'Joli marque page pour accompagner vos lectures favorites', 5, 0.1),
       (11, 'Sac', 'Sac éco-responsable avec décorations variées', 5, 0.26),
       (12, 'Surprise', 'Pochette surprise pour faire plaisir aux petits et grands', 5, 0.7),
       (13, 'T-shirt', 'T-shirt peint à la main et avec pochoir', 5, 0.32);

-- --------------------------------------------------------

--
-- Structure de la table `typebox`
--

CREATE TABLE `typebox`
(
    `id_modele`     int(2)                              NOT NULL,
    `designation`   varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `poidsmax`      float                               NOT NULL,
    `poidsobjetmax` float                               NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user`
(
    `id_user`  int(11)      NOT NULL,
    `nom`      varchar(255) NOT NULL,
    `prenom`   varchar(255) NOT NULL,
    `email`    varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `admin`    int(1)       NOT NULL DEFAULT '0'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `produits_boite`
(
    `id_boite`   int(10) NOT NULL,
    `id_produit` int(10) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `password`, `admin`)
VALUES (0, 'Admin', 'CustomBox', 'contact@custombox.fr',
        '$2y$10$exMdTkaAZ2P2mYU3ciRF4eQ9wGbi2wEGpxUNZUr9tPn/EJDLQHjIq', 1);

--
-- Index pour les tables déchargées
--


--
-- Index pour la table `boite`
--
ALTER TABLE `boite`
    ADD PRIMARY KEY (`id_boite`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
    ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
    ADD PRIMARY KEY (`id`),
    ADD KEY `categorie` (`categorie`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id_user`);

ALTER TABLE `user`
    AUTO_INCREMENT = 1;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
    MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

ALTER TABLE `boite`
    MODIFY `id_boite` int(11) AUTO_INCREMENT NOT NULL;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
    ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
