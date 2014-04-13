-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: philea
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Classe`
--

DROP TABLE IF EXISTS `Classe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomcourt` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nomlong` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `discipline` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Classe`
--

LOCK TABLES `Classe` WRITE;
/*!40000 ALTER TABLE `Classe` DISABLE KEYS */;
INSERT INTO `Classe` VALUES (1,'BTS CPI','Conception de Produits Industriels','Mécanique'),(2,'BTS SIO','Services Informatiques aux Organisations','Informatique'),(3,'Bac Pro TU','Technicien d’Usinage','Mécanique'),(4,'Licence ISCM','Ingénieries Simultanées en Construction Mécanique','Mécanique'),(6,'BTS IRIS','Informatique et Réseaux pour l’Industrie et les Services techniques','Informatique'),(7,'BTS SCBH','Systèmes Constructifs Bois et Habitat','Emballage'),(8,'BTS DP','Design de Produits','Décor'),(9,'BMA GD','Graphisme et Decor','Décor'),(10,'BAC STD2A','Sciences et Technologie du Design et des Arts Appliqués','Décor'),(11,'BTS CIM','Conception et Industrialisation en Microtechnique','Mécanique'),(12,'BAC STI2D','(ITEC)','Mécanique'),(13,'BAC STI2D','(SIN)','Informatique'),(14,'BTS ET','Electrotechnique','Génie électrique'),(15,'BTS SE','Systèmes Electroniques','Génie électrique'),(16,'BTS IPM','Industrialisation des Produits Mécaniques','Informatique'),(17,'BAC Pro CTRM','Conducteur Transport Routier de Marchandises','Transport, Logistique'),(18,'BTS DE','Design d’Espace','Décor');
/*!40000 ALTER TABLE `Classe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Domaine`
--

DROP TABLE IF EXISTS `Domaine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Domaine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `typeDomaine` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Domaine`
--

LOCK TABLES `Domaine` WRITE;
/*!40000 ALTER TABLE `Domaine` DISABLE KEYS */;
INSERT INTO `Domaine` VALUES (1,'Caisse','Structure centrale de la plateforme','no-picture.jpg','Plateforme'),(2,'Balcon','Accueille tous les instruments','no-picture.jpg','Plateforme'),(3,'Landing Gear','Train d’atterrissage composé de trois pieds','no-picture.jpg','Plateforme'),(4,'ADS','Système de propulsion qui permet de plaquer Philae au sol','no-picture.jpg','Plateforme'),(5,'Anchors','Système d’ancrage composé de 2 modules capables de projeter dans le sol des harpons','no-picture.jpg','Plateforme'),(6,'CDMS+TXRX','Liaison radio','no-picture.jpg','Plateforme'),(7,'APXS','Alpha Particle X-ray Spectrometer<p>Spectromètre qui permet de déterminer la composition de la surface de la comète</p>','no-picture.jpg','Instrument exploration'),(8,'CIVA','Comet Infrared and Visible Analyser<p>Réaliser les images de la surface tout autour du lander (panorama) en 2D et 3D à l’aide de caméras placées sur toutes les faces de Philae</p>','no-picture.jpg','Instrument exploration'),(9,'MUPUS','MUlti PUrpose Sensor package<p>Système qui par vibration va s’enfoncer dans le sol et déterminera la dureté de celui-ci</p>','no-picture.jpg','Instrument exploration'),(10,'ROLIS','ROsetta Lander Imaging System <p> Composé d’une caméra et d’une lampe placées sous l’atterrisseur. La caméra va permettre de faire des prises de vue de la zone d’atterrissage </p>','no-picture.jpg','Instrument exploration'),(11,'ROMAP','ROsetta MAgnetmeter and Plasma monitor<p>Permet de mesurer le champ magnétique, la composante électronique et ionique du gaz dégazé par le noyau cométaire</p>','no-picture.jpg','Instrument exploration'),(12,'SD2','Sampler, Drill & Distribution system<p>Système de mise à disposition des échantillons du sol cométaire : il se compose d’une foreuse et d’un carrousel tournant</p>','no-picture.jpg','Instrument exploration'),(13,'Fabrication','','no-picture.jpg','Support'),(14,'Energie','','no-picture.jpg','Support'),(15,'Treuil et Portique','','no-picture.jpg','Support'),(16,'Transport','','no-picture.jpg','Support'),(17,'Site Web','Site et Application Web du projet Philea','no-picture.jpg','Support'),(18,'Décor','','no-picture.jpg','Support');
/*!40000 ALTER TABLE `Domaine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Etablissement`
--

DROP TABLE IF EXISTS `Etablissement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Etablissement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `academie` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Etablissement`
--

LOCK TABLES `Etablissement` WRITE;
/*!40000 ALTER TABLE `Etablissement` DISABLE KEYS */;
INSERT INTO `Etablissement` VALUES (1,'Lycée Léonard de Vinci','Melun','77','Créteil'),(2,'Lycée Louis Armand','Nogent sur marne','94','Créteil'),(3,'Lycée François Mansart','La Varenne','94','Créteil'),(4,'Lycée du Gué à Tresmes','Congis','77','Créteil'),(5,'Lycée Eugénie Cotton','Montreuil','93','Créteil'),(6,'Lycée Diderot','Paris','75','Paris'),(7,'Lycée Louis Armand','Paris','75','Paris'),(8,'Lycée Dorian','Paris','75','Paris'),(9,'Lycée Alexandre Denis','Cerny','91','Versailles'),(10,'Lycée Cabanis','Brive-la-gaillarde','19','Limoges'),(11,'Lycée Chenneviere-Malézieux','Paris','75','Paris');
/*!40000 ALTER TABLE `Etablissement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Etape`
--

DROP TABLE IF EXISTS `Etape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Etape` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `contenu` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `dateEntre` datetime NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isValide` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Avancement` decimal(10,2) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idProjet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E99E5AD9FE6E88D7` (`idUser`),
  KEY `IDX_E99E5AD933043433` (`idProjet`),
  CONSTRAINT `FK_E99E5AD933043433` FOREIGN KEY (`idProjet`) REFERENCES `Projet` (`id`),
  CONSTRAINT `FK_E99E5AD9FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `User` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Etape`
--

LOCK TABLES `Etape` WRITE;
/*!40000 ALTER TABLE `Etape` DISABLE KEYS */;
INSERT INTO `Etape` VALUES (1,'Changement complet d\'interface','Réalisation','<p>Nous avons pris la d&eacute;cision de changer compl&egrave;tement l\'interface du site. Nous passons d\'une interface certes tr&egrave;s tape-&agrave;-l\'oeil mais assez bricol&eacute;e &agrave; quelques chose de sobre. Nous retrouvons aussi un menu plus fonctionel. Mais le gros plus r&eacute;side dans le fait que le site est maintenant responsive, c\'est &agrave; dire qu\'il s\'adapte &agrave; toutes les r&eacute;solutions et les tailles d\'&eacute;cran (PC/Mobile/Tablette).</p>\r\n<p>Voir l\'image de la nouvelle interface &agrave; gauche.</p>','2014-02-12 00:00:00','c5ead195a470331d93bd66854227cb551220ac70.png','1',10.00,12,29),(15,'Première version du site','Réalisation','<p>La premi&egrave;re version du site a &eacute;t&eacute; r&eacute;alis&eacute;e par un groupe de 12 &eacute;tudiants de la classe. Elle &eacute;tait assez esth&eacute;tique mais peu fonctionnelle. De plus, des erreurs d\'analyse ont &eacute;t&eacute; constat&eacute;es (absence de domaines par exemple, ce qui a remis en cause le choix initial de l\'interface utilisateur)</p>','2014-02-13 00:00:00','dfb25c55df968976768fb9d68dd17a50c305ec7d.png','1',10.00,11,29),(16,'Mise en forme de la liste des étapes','Libre','<p>Nous avons travaill&eacute; sur un belle pr&eacute;sentation de la liste des &eacute;tapes</p>','2014-02-13 00:00:00','97f84f2e4e8367ccc79562cd3e7bb4a105b552cf.png','1',20.00,12,29),(17,'Nouveauté sur la page d\'ajout d\'une étape','Réalisation','<p>Nous avons rajout&eacute; plusieurs &eacute;l&eacute;ments sur la page d\'ajout d\'une &eacute;tape.</p>\r\n<p>-Nous avons mis en place la gestion d\'upload d\'image (avec changement automatique de nom d\'images)</p>\r\n<p>-Mis en place de cat&eacute;gorie pour une &eacute;tape (Libre, Analyse/conception, r&eacute;alisation)</p>\r\n<p>Il nous faut rajouter une bonne mise en forme, enlever la date, et ajouter du texte pour aider les r&eacute;dacteurs.</p>','2014-02-13 00:00:00','f73333aa61475120a3e075dd2831987dd49d62ff.png','1',30.00,11,29);
/*!40000 ALTER TABLE `Etape` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Projet`
--

DROP TABLE IF EXISTS `Projet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Projet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idDomaine` int(11) DEFAULT NULL,
  `idEtablissement` int(11) DEFAULT NULL,
  `idClasse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_57B9999F6816613E` (`idDomaine`),
  KEY `IDX_57B9999FEA190502` (`idEtablissement`),
  KEY `IDX_57B9999FEC96170C` (`idClasse`),
  CONSTRAINT `FK_57B9999F6816613E` FOREIGN KEY (`idDomaine`) REFERENCES `Domaine` (`id`),
  CONSTRAINT `FK_57B9999FEA190502` FOREIGN KEY (`idEtablissement`) REFERENCES `Etablissement` (`id`),
  CONSTRAINT `FK_57B9999FEC96170C` FOREIGN KEY (`idClasse`) REFERENCES `Classe` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Projet`
--

LOCK TABLES `Projet` WRITE;
/*!40000 ALTER TABLE `Projet` DISABLE KEYS */;
INSERT INTO `Projet` VALUES (1,1,1,4),(2,1,1,3),(3,1,6,6),(4,2,7,1),(5,3,1,1),(6,3,1,3),(7,4,1,1),(8,4,6,6),(9,5,6,11),(10,5,6,6),(11,6,6,6),(12,7,6,12),(13,7,6,13),(14,8,8,6),(15,9,2,1),(16,9,2,6),(17,10,8,6),(18,11,2,1),(19,11,2,6),(20,12,10,1),(21,12,6,6),(22,13,8,16),(23,13,11,3),(24,14,2,15),(25,14,2,14),(26,15,2,14),(27,16,3,7),(28,16,9,17),(29,17,1,2),(30,18,5,10),(31,18,5,18),(32,18,4,10),(34,18,4,9);
/*!40000 ALTER TABLE `Projet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'sio','sio','sio@gmail.com','sio@gmail.com',1,'te1b57b6vrkc04gsc4gcwcsoco8cwww','qrKOJB3diDQbp68xP3fVwhz8r9eH13gtfFHfwHKyQ+++CQV4r/9eon3lZtkEv9T4SAQCTd05m9TRk/CfFx5xUQ==','2014-02-27 20:49:27',0,0,NULL,NULL,NULL,'a:2:{i:0;s:10:\"ROLE_ADMIN\";i:1;s:14:\"ROLE_REDACTEUR\";}',0,NULL,''),(8,'admin','admin','admin@admin.com','admin@admin.com',1,'dqmi8q8lsc8w4g4kow4oc8s88k0cksg','VWpjEUdg0MvttSnf5hgzAqhJ50X7GgUVlRBgt8FTbNdUk4QcJy9HsKr6/rtk6fZDsqu5cAwP1hl7DTx5hTe2dg==','2014-03-03 14:32:29',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL,NULL),(9,'kpu','kpu','kpu@gmail.com','kpu@gmail.com',1,'hn0rpxn1hpckg0c4kososgw0k80w8ow','B3h+aHJniSuRwGHNSDWkeu8u2UlduJSk52QYZyNasXRZrZM/H8fRVsMMfFhg3F40H344kwxYmFPMNLT4KkuA5A==','2014-03-04 10:31:10',0,0,NULL,NULL,NULL,'a:1:{i:0;s:17:\"ROLE_GESTIONNAIRE\";}',0,NULL,NULL),(11,'slisik','slisik','slisik','slisik',1,'teg10qxnm1wwg4cs0wksg088cw44w8s','toP24r3h6HOuheIaecwejKQfISca0EU55Mfs/sR9nEzaPjomOyifbrwLTGHvHJvOdLmXd1qLYHG2pl0L4BLpKg==','2014-03-04 08:50:40',0,0,NULL,NULL,NULL,'a:1:{i:0;s:14:\"ROLE_REDACTEUR\";}',0,NULL,NULL),(12,'fcho','fcho','fcho','fcho',1,'srwp4ac9sms8c0wgw400c00404ow0ck','ntIQGmT+5vtN2SyDPF6bVGy8qXT8tw4K0XnAXMEvV4ujRJZ5bpmoXf9jZE5M78TyDgE+qYFvUzvPZWJfvDpclw==','2014-02-13 14:08:54',0,0,NULL,NULL,NULL,'a:1:{i:0;s:14:\"ROLE_REDACTEUR\";}',0,NULL,NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_projet`
--

DROP TABLE IF EXISTS `user_projet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_projet` (
  `user_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`projet_id`),
  KEY `IDX_35478794A76ED395` (`user_id`),
  KEY `IDX_35478794C18272` (`projet_id`),
  CONSTRAINT `FK_35478794A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_35478794C18272` FOREIGN KEY (`projet_id`) REFERENCES `Projet` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_projet`
--

LOCK TABLES `user_projet` WRITE;
/*!40000 ALTER TABLE `user_projet` DISABLE KEYS */;
INSERT INTO `user_projet` VALUES (1,29),(9,10),(9,29),(11,29),(12,29);
/*!40000 ALTER TABLE `user_projet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-03-04 11:20:14
