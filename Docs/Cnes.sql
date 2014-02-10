-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 10 Février 2014 à 15:26
-- Version du serveur: 5.5.32
-- Version de PHP: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `Cnes`
--

-- --------------------------------------------------------

--
-- Structure de la table `Classe`
--

CREATE TABLE IF NOT EXISTS `Classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomcourt` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nomlong` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `discipline` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `Classe`
--

INSERT INTO `Classe` (`id`, `nomcourt`, `nomlong`, `discipline`) VALUES
(1, 'BTS CPI', 'Conception de Produits Industriels', 'Mécanique'),
(2, 'BTS SIO', 'Services Informatiques aux Organisations', 'Informatique'),
(3, 'Bac Pro TU', 'Technicien d’Usinage', 'Mécanique'),
(4, 'Licence ISCM', 'Ingénieries Simultanées en Construction Mécanique', 'Mécanique'),
(6, 'BTS IRIS', 'Informatique et Réseaux pour l’Industrie et les Services techniques', 'Informatique'),
(7, 'BTS SCBH', 'Systèmes Constructifs Bois et Habitat', 'Emballage'),
(8, 'BTS DP', 'Design de Produits', 'Décor'),
(9, 'BMA GD', 'Graphisme et Decor', 'Décor'),
(10, 'BAC STD2A', 'Sciences et Technologie du Design et des Arts Appliqués', 'Décor'),
(11, 'BTS CIM', 'Conception et Industrialisation en Microtechnique', 'Mécanique'),
(12, 'BAC STI2D', '(ITEC)', 'Mécanique'),
(13, 'BAC STI2D', '(SIN)', 'Informatique'),
(14, 'BTS ET', 'Electrotechnique', 'Génie électrique'),
(15, 'BTS SE', 'Systèmes Electroniques', 'Génie électrique'),
(16, 'BTS IPM', 'Industrialisation des Produits Mécaniques', 'Informatique'),
(17, 'BAC Pro CTRM', 'Conducteur Transport Routier de Marchandises', 'Transport, Logistique'),
(18, 'BTS DE', 'Design d’Espace', 'Décor');

-- --------------------------------------------------------

--
-- Structure de la table `Domaine`
--

CREATE TABLE IF NOT EXISTS `Domaine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `typeDomaine` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `Domaine`
--

INSERT INTO `Domaine` (`id`, `nom`, `description`, `path`, `typeDomaine`) VALUES
(1, 'Caisse', 'Structure centrale de la plateforme', 'no-picture.jpg', 'Plateforme'),
(2, 'Balcon', 'Accueille tous les instruments', 'no-picture.jpg', 'Plateforme'),
(3, 'Landing Gear', 'Train d’atterrissage composé de trois pieds', 'no-picture.jpg', 'Plateforme'),
(4, 'ADS', 'Système de propulsion qui permet de plaquer Philae au sol', 'no-picture.jpg', 'Plateforme'),
(5, 'Anchors', 'Système d’ancrage composé de 2 modules capables de projeter dans le sol des harpons', 'no-picture.jpg', 'Plateforme'),
(6, 'CDMS+TXRX', 'Liaison radio', 'no-picture.jpg', 'Plateforme'),
(7, 'APXS', 'Alpha Particle X-ray Spectrometer<p>Spectromètre qui permet de déterminer la composition de la surface de la comète</p>', 'no-picture.jpg', 'Instrument exploration'),
(8, 'CIVA', 'Comet Infrared and Visible Analyser<p>Réaliser les images de la surface tout autour du lander (panorama) en 2D et 3D à l’aide de caméras placées sur toutes les faces de Philae</p>', 'no-picture.jpg', 'Instrument exploration'),
(9, 'MUPUS', 'MUlti PUrpose Sensor package<p>Système qui par vibration va s’enfoncer dans le sol et déterminera la dureté de celui-ci</p>', 'no-picture.jpg', 'Instrument exploration'),
(10, 'ROLIS', 'ROsetta Lander Imaging System<p>Composé d’une caméra et d’une lampe placées sous l’atterrisseur. La caméra va permettre de faire des prises de vue de la zone d’atterrissage</p>', 'no-picture.jpg', 'Instrument exploration'),
(11, 'ROMAP', 'ROsetta MAgnetmeter and Plasma monitor<p>Permet de mesurer le champ magnétique, la composante électronique et ionique du gaz dégazé par le noyau cométaire</p>', 'no-picture.jpg', 'Instrument exploration'),
(12, 'SD2', 'Sampler, Drill & Distribution system<p>Système de mise à disposition des échantillons du sol cométaire : il se compose d’une foreuse et d’un carrousel tournant</p>', 'no-picture.jpg', 'Instrument exploration'),
(13, 'Fabrication', '', 'no-picture.jpg', 'Support'),
(14, 'Energie', '', 'no-picture.jpg', 'Support'),
(15, 'Treuil et Portique', '', 'no-picture.jpg', 'Support'),
(16, 'Transport', '', 'no-picture.jpg', 'Support'),
(17, 'Site Web', 'Site Web du projet Philea, réalisé par 2 étudiants de BTS SIO lycée Léonard de Vinci à Melun', 'no-picture.jpg', 'Support'),
(18, 'Décor', '', 'no-picture.jpg', 'Support');

-- --------------------------------------------------------

--
-- Structure de la table `Etablissement`
--

CREATE TABLE IF NOT EXISTS `Etablissement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `academie` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `Etablissement`
--

INSERT INTO `Etablissement` (`id`, `nom`, `ville`, `region`, `academie`) VALUES
(1, 'Lycée Léonard de Vinci', 'Melun', '77', 'Créteil'),
(2, 'Lycée Louis Armand', 'Nogent sur marne', '94', 'Créteil'),
(3, 'Lycée François Mansart', 'La Varenne', '94', 'Créteil'),
(4, 'Lycée du Gué à Tresmes', 'Congis', '77', 'Créteil'),
(5, 'Lycée Eugénie Cotton', 'Montreuil', '93', 'Créteil'),
(6, 'Lycée Diderot', 'Paris', '75', 'Paris'),
(7, 'Lycée Louis Armand', 'Paris', '75', 'Paris'),
(8, 'Lycée Dorian', 'Paris', '75', 'Paris'),
(9, 'Lycée Alexandre Denis', 'Cerny', '91', 'Versailles'),
(10, 'Lycée Cabanis', 'Brive-la-gaillarde', '19', 'Limoges'),
(11, 'Lycée Chenneviere-Malézieux', 'Paris', '75', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `Etape`
--

CREATE TABLE IF NOT EXISTS `Etape` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Contenu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Date` datetime NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isValide` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Avancement` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idProjet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E99E5AD9FE6E88D7` (`idUser`),
  KEY `IDX_E99E5AD933043433` (`idProjet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

--
-- Contenu de la table `Etape`
--

INSERT INTO `Etape` (`id`, `Titre`, `Contenu`, `Date`, `path`, `isValide`, `Avancement`, `idUser`, `idProjet`) VALUES
(19, 'kpu', 'kpu', '2014-01-30 00:00:00', 'kpu', '1', 48, 11, 29),
(48, 'kyu', '<p>kyuliuliu</p>', '2014-02-10 00:00:00', NULL, '1', 42, 9, 29),
(49, 'gf"''', '<p>g''g''</p>', '2014-02-10 00:00:00', NULL, '-1', 45, 9, 29),
(51, ',ty,yt', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia volu', '2014-02-10 00:00:00', '8fc56b0f7a5f7e43a65a7bdfc101d935161e7882.jpeg', '1', 4, 12, 29),
(52, 'fez', '<p>fezfez</p>', '2014-02-10 00:00:00', NULL, '1', 9, 12, 33),
(53, 'testkpu', '<p>testkpu</p>', '2014-02-10 00:00:00', NULL, '0', 8, 9, 29);

-- --------------------------------------------------------

--
-- Structure de la table `Projet`
--

CREATE TABLE IF NOT EXISTS `Projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idDomaine` int(11) DEFAULT NULL,
  `idEtablissement` int(11) DEFAULT NULL,
  `idClasse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_57B9999F6816613E` (`idDomaine`),
  KEY `IDX_57B9999FEA190502` (`idEtablissement`),
  KEY `IDX_57B9999FEC96170C` (`idClasse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Contenu de la table `Projet`
--

INSERT INTO `Projet` (`id`, `idDomaine`, `idEtablissement`, `idClasse`) VALUES
(1, 1, 1, 4),
(2, 1, 1, 3),
(3, 1, 6, 6),
(4, 2, 7, 1),
(5, 3, 1, 1),
(6, 3, 1, 3),
(7, 4, 1, 1),
(8, 4, 6, 6),
(9, 5, 6, 11),
(10, 5, 6, 6),
(11, 6, 6, 6),
(12, 7, 6, 12),
(13, 7, 6, 13),
(14, 8, 8, 6),
(15, 9, 2, 1),
(16, 9, 2, 6),
(17, 10, 8, 6),
(18, 11, 2, 1),
(19, 11, 2, 6),
(20, 12, 10, 1),
(21, 12, 6, 6),
(22, 13, 8, 16),
(23, 13, 11, 3),
(24, 14, 2, 15),
(25, 14, 2, 14),
(26, 15, 2, 14),
(27, 16, 3, 7),
(28, 16, 9, 17),
(29, 17, 1, 2),
(30, 18, 5, 10),
(31, 18, 5, 18),
(32, 18, 4, 10),
(33, 18, 4, 18),
(34, 18, 4, 9);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `Nom` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA1797792FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_2DA17977A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `Nom`) VALUES
(1, 'sio', 'sio', 'sio@gmail.com', 'sio@gmail.com', 1, 'te1b57b6vrkc04gsc4gcwcsoco8cwww', 'qrKOJB3diDQbp68xP3fVwhz8r9eH13gtfFHfwHKyQ+++CQV4r/9eon3lZtkEv9T4SAQCTd05m9TRk/CfFx5xUQ==', '2014-01-31 10:33:49', 0, 0, NULL, NULL, NULL, 'a:2:{i:0;s:10:"ROLE_ADMIN";i:1;s:14:"ROLE_REDACTEUR";}', 0, NULL, ''),
(8, 'admin', 'admin', 'admin@admin.com', 'admin@admin.com', 1, 'dqmi8q8lsc8w4g4kow4oc8s88k0cksg', 'VWpjEUdg0MvttSnf5hgzAqhJ50X7GgUVlRBgt8FTbNdUk4QcJy9HsKr6/rtk6fZDsqu5cAwP1hl7DTx5hTe2dg==', '2014-02-10 15:22:53', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, NULL),
(9, 'kpu', 'kpu', 'kpu@gmail.com', 'kpu@gmail.com', 1, 'hn0rpxn1hpckg0c4kososgw0k80w8ow', 'B3h+aHJniSuRwGHNSDWkeu8u2UlduJSk52QYZyNasXRZrZM/H8fRVsMMfFhg3F40H344kwxYmFPMNLT4KkuA5A==', '2014-02-10 15:15:08', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:17:"ROLE_GESTIONNAIRE";}', 0, NULL, NULL),
(11, 'slisik', 'slisik', 'slisik', 'slisik', 1, 'teg10qxnm1wwg4cs0wksg088cw44w8s', 'toP24r3h6HOuheIaecwejKQfISca0EU55Mfs/sR9nEzaPjomOyifbrwLTGHvHJvOdLmXd1qLYHG2pl0L4BLpKg==', '2014-02-07 11:17:14', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_REDACTEUR";}', 0, NULL, NULL),
(12, 'fcho', 'fcho', 'fcho', 'fcho', 1, 'srwp4ac9sms8c0wgw400c00404ow0ck', 'ntIQGmT+5vtN2SyDPF6bVGy8qXT8tw4K0XnAXMEvV4ujRJZ5bpmoXf9jZE5M78TyDgE+qYFvUzvPZWJfvDpclw==', '2014-02-10 14:13:50', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_REDACTEUR";}', 0, NULL, NULL),
(13, 'test', 'test', 'tes@gmail.fr', 'tes@gmail.fr', 1, 'k9fgdieeiq8csws800kss0c0owwwo88', 'K1C6xtV06uQMU7DUXRvgClhe0dHS1mOCrIQ6v8CTNrXMW8Bb+tVwRrvKttjV1QsDNWgGs5LITFrT117EUBxfLQ==', '2014-02-05 10:09:53', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_REDACTEUR";}', 0, NULL, NULL),
(14, 'ok', 'ok', 'ok@ok.ok', 'ok@ok.ok', 1, '6p33kpuq1dc8884cgskc40o4g4s4ggk', 'v15iGAC9v7kEsDtjAS6wIyp0+FKWZEiCzQN1azmG3I0Ec3JhZ1h4kfj2U7or2NTkWSa9VYMEf+jvcwXl8Ud34g==', '2014-02-05 09:20:37', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_REDACTEUR";}', 0, NULL, NULL),
(15, 'aka', 'aka', 'ak@gfzer.fr', 'ak@gfzer.fr', 1, 's4lyhy16b8gko48ko0g0wwoc0so8ks0', 'imqIumLV9ZmD3KnBP5YC9qOZBLbYOZMdDH2A4oh1iqq8dN2/CbsZGBc2ebRHNQ1hOqRwNlDgm4536PDmXVzAlg==', '2014-02-10 15:16:40', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_REDACTEUR";}', 0, NULL, NULL),
(16, 'gtr', 'gtr', 'gtr@gre.com', 'gtr@gre.com', 1, 'ey5xv8vi448c88w000ccc884440cs8g', 'acNUJe8Ih7FBnJQO1myW7EvEcti0nNV+f+cUYjQwoNSzFff5/GWi0c5NC/l/hn6bP/5ePwsKVVbhHFBJsglkyQ==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:14:"ROLE_REDACTEUR";}', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_projet`
--

CREATE TABLE IF NOT EXISTS `user_projet` (
  `user_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`projet_id`),
  KEY `IDX_35478794A76ED395` (`user_id`),
  KEY `IDX_35478794C18272` (`projet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_projet`
--

INSERT INTO `user_projet` (`user_id`, `projet_id`) VALUES
(9, 29),
(9, 33),
(11, 29),
(12, 29),
(12, 33);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Etape`
--
ALTER TABLE `Etape`
  ADD CONSTRAINT `FK_E99E5AD933043433` FOREIGN KEY (`idProjet`) REFERENCES `Projet` (`id`),
  ADD CONSTRAINT `FK_E99E5AD9FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

--
-- Contraintes pour la table `Projet`
--
ALTER TABLE `Projet`
  ADD CONSTRAINT `FK_57B9999F6816613E` FOREIGN KEY (`idDomaine`) REFERENCES `Domaine` (`id`),
  ADD CONSTRAINT `FK_57B9999FEA190502` FOREIGN KEY (`idEtablissement`) REFERENCES `Etablissement` (`id`),
  ADD CONSTRAINT `FK_57B9999FEC96170C` FOREIGN KEY (`idClasse`) REFERENCES `Classe` (`id`);

--
-- Contraintes pour la table `user_projet`
--
ALTER TABLE `user_projet`
  ADD CONSTRAINT `FK_35478794A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_35478794C18272` FOREIGN KEY (`projet_id`) REFERENCES `Projet` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
