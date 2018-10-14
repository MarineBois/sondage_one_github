-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 12 oct. 2018 à 12:39
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sondageone`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commentaire` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `sondage_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BCBAF4AE56` (`sondage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `pseudo`, `commentaire`, `date`, `sondage_id`) VALUES
(1, 'pseudo2', 'un super commentaire', '2018-10-02 08:05:33', 1),
(2, 'machin', 'test', '2018-10-02 08:13:54', 1);

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

DROP TABLE IF EXISTS `proposition`;
CREATE TABLE IF NOT EXISTS `proposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sondage_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C7CDC353BAF4AE56` (`sondage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `proposition`
--

INSERT INTO `proposition` (`id`, `titre`, `sondage_id`) VALUES
(2, 'proposition 1', 1),
(11, 'proposition 2', 1),
(12, 'proposition 3', 1),
(18, 'clqsh', 5),
(19, 'clqsh nxw', 5),
(20, 'hlvcqd', 5);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reponse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personne` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proposition_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5FB6DEC7DB96F9E` (`proposition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `reponse`, `personne`, `proposition_id`) VALUES
(22, 'oui', 'fhlzie', 18),
(23, 'oui', 'fhlzie', 19),
(24, 'oui', 'jvmzodvjpoz', 19),
(25, 'oui', 'jvmzodvjpoz', 20),
(26, 'oui', 'patate', 2),
(27, 'oui', 'fromage', 2),
(28, 'oui', 'fromage', 11);

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

DROP TABLE IF EXISTS `sondage`;
CREATE TABLE IF NOT EXISTS `sondage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `libelle` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7579C89FA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sondage`
--

INSERT INTO `sondage` (`id`, `titre`, `libelle`, `date`, `user_id`) VALUES
(1, 'titre', 'description sondage 1 marine', '2018-10-01 15:01:02', 4),
(5, 'sondage a garder', 'sondage a garder', '2018-10-08 13:12:45', 5),
(6, 'test', 'test', '2018-10-08 13:24:57', 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `roles`, `username_canonical`, `email`, `email_canonical`, `enabled`, `last_login`, `confirmation_token`, `password_requested_at`) VALUES
(4, 'marine', 'lnf4dkloEfguYamQ0WxSfxQxkdJ8TBYqWWYMLFR1/soi5IvPXY98YdJ8ZBZ9bElQisYo2Wpl2J6vA27iwojzGg==', '9k9nW8s1tNKX6AM06Pqg.PGQR1h4A6v3pAlGXPNzV7k', 'a:0:{}', 'marine', 'admin@admin.fr', 'admin@admin.fr', 1, '2018-10-12 08:38:23', NULL, NULL),
(5, 'test', 'egGncdP2Il0bf+4gprCSLu0H6A3nxqwtOrSEKFv5rmpxzxGHv7VIbqDI7GRWT+9cvcfz4bCsw4b8VvpEGbSo6w==', 'rfJBwTNw0le2EUFOx13427hiN3YJq6Ouocg92eJHbaA', 'a:0:{}', 'test', 'test@test.fr', 'test@test.fr', 1, '2018-10-08 13:10:55', NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BCBAF4AE56` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`id`);

--
-- Contraintes pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD CONSTRAINT `FK_C7CDC353BAF4AE56` FOREIGN KEY (`sondage_id`) REFERENCES `sondage` (`id`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_5FB6DEC7DB96F9E` FOREIGN KEY (`proposition_id`) REFERENCES `proposition` (`id`);

--
-- Contraintes pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD CONSTRAINT `FK_7579C89FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
