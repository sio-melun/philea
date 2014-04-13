-- phpMyAdmin SQL Dump
-- version 4.1.12deb2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 13 Avril 2014 à 20:30
-- Version du serveur :  5.5.35-2
-- Version de PHP :  5.5.10-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `Cnes`
--

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE IF NOT EXISTS `Article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL,
  `isValide` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CD8737FAFE6E88D7` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Article`
--

INSERT INTO `Article` (`id`, `titre`, `contenu`, `date`, `isValide`, `idUser`) VALUES
(1, '\r\nPhilae, passager de la sonde Rosetta prépare son réveil', 'Un peu plus de deux mois après le réveil de la sonde européenne Rosetta, c''est au tour de son passager, le robot Philae, de sortir de l''hibernation pour préparer son atterrissage sur la comète 67P/Tchourioumov-Guérassimenko, une boule de glace d''environ 4 kilomètres de diamètre.\r\n\r\nLancée par l''Agence spatiale européenne (ESA) en 2004, Rosetta a rendez-vous en août avec la comète 67P/Tchourioumov-Guérassimenko, sur laquelle elle tentera de faire atterrir un petit module, le robot Philae, 100 kilogrammes bardé de 10 instruments scientifiques, qui doit se poser sur la comète, une première dans l''histoire de l''exploration spatiale. Philae est éteint depuis plus de trois ans, pour réduire au minimum sa consommation. Philae est éteint depuis plus de trois ans, pour réduire au minimum sa consommation. Seule sa température était contrôlée, « exactement comme un animal qui hiberne », explique Philippe Gaudon, chef du projet du Centre nationales des études spatiales (CNES — l''agence spatiale française) de la mission Rosetta.\r\n\r\nLire : La sonde spatiale Rosetta s''est bien réveillée\r\n\r\nVendredi, le CNES va « réveiller » le logiciel de vol central du robot. C''est le Centre de contrôle de Cologne (LCC) qui aura la charge de cette phase, tandis que le SONC (Science Operation and Navigation Center), à Toulouse, calculera les trajectoires permettant à Philae de se poser en toute sécurité et suivra les opérations scientifiques. A partir du 10 avril, les dix instruments de Philae vont être réveillés à leur tour les uns après les autres. Les scientifiques auront trois semaines pour vérifier leur bon fonctionnement.', '2014-04-13 00:00:00', 1, 1),
(2, 'Video explicative de la mission Philae', '<p><iframe src="//www.youtube.com/embed/siu2sxQ4YWI" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>', '2014-04-13 20:09:36', 1, 9);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `FK_CD8737FAFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
