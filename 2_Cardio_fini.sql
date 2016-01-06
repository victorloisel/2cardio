-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 06 Janvier 2016 à 10:40
-- Version du serveur: 5.5.46-0ubuntu0.14.04.2
-- Version de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `2.Cardio`
--

-- --------------------------------------------------------

--
-- Structure de la table `Reponse`
--

CREATE TABLE IF NOT EXISTS `Reponse` (
  `Reponse_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Topic_id` int(11) NOT NULL,
  `id_User` int(11) NOT NULL,
  `Reponse_texte` mediumtext COLLATE utf8_bin NOT NULL,
  `Reponse_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Reponse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Contenu de la table `Reponse`
--

INSERT INTO `Reponse` (`Reponse_id`, `Topic_id`, `id_User`, `Reponse_texte`, `Reponse_date`) VALUES
(1, 1, 2, 'une question sur le topic 1 ?', '2015-12-11 09:30:09'),
(2, 2, 2, 'question sur le topic 2 ?', '2015-12-11 09:30:20'),
(4, 1, 2, 'test test', '2015-12-11 09:31:31'),
(11, 11, 2, 'testtest', '2015-12-11 13:14:59'),
(12, 12, 1, 'test ?', '2015-12-11 17:23:33'),
(13, 12, 1, 'test', '2015-12-11 17:23:40');

-- --------------------------------------------------------

--
-- Structure de la table `Topic`
--

CREATE TABLE IF NOT EXISTS `Topic` (
  `Topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Topic_titre` text COLLATE utf8_bin NOT NULL,
  `id_User` int(11) NOT NULL,
  PRIMARY KEY (`Topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Contenu de la table `Topic`
--

INSERT INTO `Topic` (`Topic_id`, `Topic_titre`, `id_User`) VALUES
(1, 'Affichage d''un select en PHP', 1),
(2, 'Affichage d''un update en PHP', 1),
(11, 'testtest', 2),
(12, 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_city`
--

CREATE TABLE IF NOT EXISTS `t_city` (
  `City_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `City_Name` text NOT NULL,
  `City_Zip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`City_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `t_city`
--

INSERT INTO `t_city` (`City_ID`, `City_Name`, `City_Zip`) VALUES
(5, 'Dreux', 28100),
(6, 'Rouen', 76000),
(7, 'Paris', 75000),
(8, 'Toulouse', 31000),
(9, 'Dijon', 21000);

-- --------------------------------------------------------

--
-- Structure de la table `t_country`
--

CREATE TABLE IF NOT EXISTS `t_country` (
  `Country_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Country_Name` text NOT NULL,
  PRIMARY KEY (`Country_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `t_country`
--

INSERT INTO `t_country` (`Country_ID`, `Country_Name`) VALUES
(1, 'France');

-- --------------------------------------------------------

--
-- Structure de la table `t_difficulty`
--

CREATE TABLE IF NOT EXISTS `t_difficulty` (
  `Difficulty_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Difficulty_Name` tinytext NOT NULL,
  `Difficulty_Factor` float unsigned NOT NULL,
  PRIMARY KEY (`Difficulty_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_difficulty`
--

INSERT INTO `t_difficulty` (`Difficulty_ID`, `Difficulty_Name`, `Difficulty_Factor`) VALUES
(1, 'Easy', 1),
(2, 'Medium', 1.5),
(3, 'Hardcore', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_exercice`
--

CREATE TABLE IF NOT EXISTS `t_exercice` (
  `Exercice_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Exercice_Name` text NOT NULL,
  `Exercice_Repetition` int(10) unsigned NOT NULL,
  `Exercice_Description` longtext,
  `Exercice_Link` mediumtext,
  PRIMARY KEY (`Exercice_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `t_exercice`
--

INSERT INTO `t_exercice` (`Exercice_ID`, `Exercice_Name`, `Exercice_Repetition`, `Exercice_Description`, `Exercice_Link`) VALUES
(1, 'Pompes x3', 12, 'Une certaine sorte de pompes test test test', 'http://www.salto-arriere.fr/wp-content/uploads/2012/09/mouvementpompes.jpg'),
(2, 'Abdos x3', 12, NULL, 'http://cdn2-doctissimo.ladmedia.fr/var/doctissimo/storage/images/fr/www/forme/fitness/ventre-plat/abdos-exercices/62449-1-fre-FR/abdos-exercices1.jpg'),
(3, 'Corde à sauter', 5, NULL, 'http://www.conseilmuscu.com/wp-content/uploads/cordeasauter1-224x300.jpg'),
(4, 'Course', 10, NULL, 'http://www.mobilesport.ch/wp-content/uploads/2013/07/L_D1_9.SJ_ABC_T3.png'),
(5, 'Flexions x3', 12, NULL, 'http://amelioretasante.com/wp-content/uploads/2014/05/Flexion-sur-jambes.png'),
(6, 'Crunch Abdo x4', 12, NULL, 'http://www.comment-avoirdesabdos.com/wp-content/uploads/2012/02/crunches.jpg'),
(12, 'La planche', 1, NULL, 'http://www.mangervivant.fr/wp-content/uploads/2015/03/gainage-facial.jpg'),
(13, 'Fentes avant Gauche/Droite x3', 6, NULL, 'http://p2.storage.canalblog.com/28/16/721145/75934655_p.png'),
(14, 'Dips x3', 5, NULL, 'http://www.conseilmuscu.com/wp-content/uploads/dipspecs.jpg'),
(15, 'Fentes latérale Gauche/Droite x3', 6, NULL, 'http://www.personal-sport-trainer.com/blog/wp-content/uploads/2014/04/side-lunge.jpg'),
(16, 'Burpees x3', 5, NULL, 'http://www.body-op.com/blog/wp-content/uploads/2015/06/burpees.jpg'),
(17, 'jumping jack x3', 8, NULL, 'http://www.personal-sport-trainer.com/blog/wp-content/uploads/2015/04/jumping-jack-300x300.jpg'),
(18, 'Mountain climbing x2', 5, NULL, 'http://strong.top.me/wp-content/uploads/2014/02/Mountain-Climbing-Exercise.jpg'),
(19, 'Pompes Inclinée x2', 2, NULL, 'http://www.mensfitness-magazine.fr/wp-content/uploads/2013/10/Capture-d%E2%80%99%C3%A9cran-2013-10-28-%C3%A0-11.22.31.png'),
(20, 'Double Crunch x3', 3, NULL, 'http://www.mensfitness-magazine.fr/wp-content/uploads/2012/04/ex1.jpeg'),
(21, 'Flutter kicks', 10, NULL, 'https://s-media-cache-ak0.pinimg.com/236x/b2/89/88/b289889ebcad29acf7fe2fa3426b62d6.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `t_exercice_difficulty`
--

CREATE TABLE IF NOT EXISTS `t_exercice_difficulty` (
  `ID_Difficulty` tinyint(3) unsigned NOT NULL,
  `ID_Exercice` tinyint(3) unsigned NOT NULL,
  KEY `ID_Difficulty` (`ID_Difficulty`,`ID_Exercice`),
  KEY `ID_Exercice` (`ID_Exercice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_exercice_difficulty`
--

INSERT INTO `t_exercice_difficulty` (`ID_Difficulty`, `ID_Exercice`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21);

-- --------------------------------------------------------

--
-- Structure de la table `t_exercice_objective`
--

CREATE TABLE IF NOT EXISTS `t_exercice_objective` (
  `ID_Exercice` tinyint(3) unsigned NOT NULL,
  `ID_Objective` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ID_Exercice`,`ID_Objective`),
  KEY `ID_Exercice` (`ID_Exercice`,`ID_Objective`),
  KEY `ID_Objective` (`ID_Objective`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_exercice_objective`
--

INSERT INTO `t_exercice_objective` (`ID_Exercice`, `ID_Objective`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_history`
--

CREATE TABLE IF NOT EXISTS `t_history` (
  `History_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `History_Programme` tinyint(3) unsigned NOT NULL,
  `ID_User` tinyint(3) unsigned NOT NULL,
  `ID_Exercice` tinyint(3) unsigned NOT NULL,
  `ID_Difficulty` tinyint(3) unsigned NOT NULL,
  `ID_Objective` tinyint(3) unsigned NOT NULL,
  `ID_Status` tinyint(3) unsigned NOT NULL,
  `History_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `History_Repetition` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`History_ID`),
  KEY `ID_Status` (`ID_Status`),
  KEY `ID_Status_2` (`ID_Status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;

--
-- Contenu de la table `t_history`
--

INSERT INTO `t_history` (`History_ID`, `History_Programme`, `ID_User`, `ID_Exercice`, `ID_Difficulty`, `ID_Objective`, `ID_Status`, `History_Date`, `History_Repetition`) VALUES
(7, 0, 1, 1, 1, 1, 2, '2016-01-05 14:40:07', NULL),
(8, 0, 1, 6, 1, 1, 2, '2016-01-05 14:40:07', NULL),
(9, 0, 1, 3, 1, 1, 2, '2016-01-05 14:40:07', NULL),
(48, 1, 3, 4, 1, 1, 2, '2016-01-05 19:32:20', 40),
(49, 1, 3, 5, 1, 1, 2, '2016-01-05 19:32:20', 40),
(147, 1, 1, 13, 1, 1, 1, '2016-01-06 09:37:23', NULL),
(148, 1, 1, 6, 1, 1, 1, '2016-01-06 09:37:23', NULL),
(149, 1, 1, 14, 1, 1, 1, '2016-01-06 09:37:23', NULL),
(150, 1, 1, 3, 1, 1, 1, '2016-01-06 09:37:23', NULL),
(151, 1, 1, 18, 1, 1, 1, '2016-01-06 09:37:23', NULL),
(152, 1, 1, 12, 1, 1, 1, '2016-01-06 09:37:23', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_objective`
--

CREATE TABLE IF NOT EXISTS `t_objective` (
  `Objective_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Objective_Name` text NOT NULL,
  `Objective_Factor` float unsigned NOT NULL,
  PRIMARY KEY (`Objective_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_objective`
--

INSERT INTO `t_objective` (`Objective_ID`, `Objective_Name`, `Objective_Factor`) VALUES
(1, 'Maigrir', 1),
(2, 'Remise en forme', 1.5),
(3, 'Performance', 1.5);

-- --------------------------------------------------------

--
-- Structure de la table `t_permission`
--

CREATE TABLE IF NOT EXISTS `t_permission` (
  `Permission_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Permission_Name` text NOT NULL,
  PRIMARY KEY (`Permission_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_permission`
--

INSERT INTO `t_permission` (`Permission_ID`, `Permission_Name`) VALUES
(1, 'Read_User'),
(2, 'Update_User'),
(3, 'Delete_User'),
(4, 'Add_User');

-- --------------------------------------------------------

--
-- Structure de la table `t_role`
--

CREATE TABLE IF NOT EXISTS `t_role` (
  `Role_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Role_Name` text NOT NULL,
  PRIMARY KEY (`Role_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_role`
--

INSERT INTO `t_role` (`Role_ID`, `Role_Name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `t_role_permission`
--

CREATE TABLE IF NOT EXISTS `t_role_permission` (
  `ID_Permission` tinyint(3) unsigned NOT NULL,
  `ID_Role` tinyint(3) unsigned NOT NULL,
  KEY `ID_Permission` (`ID_Permission`,`ID_Role`),
  KEY `ID_Role` (`ID_Role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_role_permission`
--

INSERT INTO `t_role_permission` (`ID_Permission`, `ID_Role`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_status`
--

CREATE TABLE IF NOT EXISTS `t_status` (
  `Status_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Status_Name` text NOT NULL,
  PRIMARY KEY (`Status_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_status`
--

INSERT INTO `t_status` (`Status_ID`, `Status_Name`) VALUES
(1, 'En cours'),
(2, 'Terminé'),
(3, 'Annulé');

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `User_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `User_FirstName` text NOT NULL,
  `User_LastName` text NOT NULL,
  `User_Mail` text NOT NULL,
  `ID_City` tinyint(3) unsigned DEFAULT NULL,
  `ID_Country` tinyint(3) unsigned DEFAULT NULL,
  `User_Street` text,
  `User_Phone` tinytext,
  `User_Password` text NOT NULL,
  `User_Age` tinyint(4) DEFAULT NULL,
  `User_Height` int(11) DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  KEY `ID_City` (`ID_City`),
  KEY `ID_Country` (`ID_Country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_user`
--

INSERT INTO `t_user` (`User_ID`, `User_FirstName`, `User_LastName`, `User_Mail`, `ID_City`, `ID_Country`, `User_Street`, `User_Phone`, `User_Password`, `User_Age`, `User_Height`) VALUES
(1, 'Murail', 'Jeremy', 'jeremy.murail@gmail.com', 5, 1, '7 allée henri barbier', '0635347534', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 22, 185),
(2, 'Loisel', 'Victor', 'victor.loisel@gmail.com', 7, 1, '3 rue du bois', '0635141215', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 29, 183),
(3, 'Mylène', 'THEOT ', 'mymy_sun@hotmail.fr', 6, 1, '1 rue chantereine ', '0636360494', '46305fc3e2af4b2d94b593d05ad1628a3f36bd47', 21, 168);

-- --------------------------------------------------------

--
-- Structure de la table `t_user_role`
--

CREATE TABLE IF NOT EXISTS `t_user_role` (
  `ID_Role` tinyint(3) unsigned NOT NULL,
  `ID_User` tinyint(3) unsigned NOT NULL,
  KEY `ID_Role` (`ID_Role`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_user_role`
--

INSERT INTO `t_user_role` (`ID_Role`, `ID_User`) VALUES
(1, 1),
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_weight`
--

CREATE TABLE IF NOT EXISTS `t_weight` (
  `ID_User` tinyint(3) unsigned NOT NULL,
  `Weight_Value` int(11) NOT NULL,
  `Weight_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `t_weight`
--

INSERT INTO `t_weight` (`ID_User`, `Weight_Value`, `Weight_Date`) VALUES
(1, 84, '2016-01-04 15:08:28'),
(2, 110, '2016-01-04 15:08:28'),
(3, 60, '2015-12-31 23:00:00'),
(3, 58, '2016-01-03 23:00:00'),
(3, 52, '2016-01-07 23:00:00');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_exercice_difficulty`
--
ALTER TABLE `t_exercice_difficulty`
  ADD CONSTRAINT `FK_Difficulty` FOREIGN KEY (`ID_Difficulty`) REFERENCES `t_difficulty` (`Difficulty_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Exercice-Difficulty` FOREIGN KEY (`ID_Exercice`) REFERENCES `t_exercice` (`Exercice_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_exercice_objective`
--
ALTER TABLE `t_exercice_objective`
  ADD CONSTRAINT `FK_Exercice-Objective` FOREIGN KEY (`ID_Exercice`) REFERENCES `t_exercice` (`Exercice_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Objective` FOREIGN KEY (`ID_Objective`) REFERENCES `t_objective` (`Objective_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_role_permission`
--
ALTER TABLE `t_role_permission`
  ADD CONSTRAINT `FK_Permission` FOREIGN KEY (`ID_Permission`) REFERENCES `t_permission` (`Permission_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Role-Permission` FOREIGN KEY (`ID_Role`) REFERENCES `t_role` (`Role_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `FK_City` FOREIGN KEY (`ID_City`) REFERENCES `t_city` (`City_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Country` FOREIGN KEY (`ID_Country`) REFERENCES `t_country` (`Country_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_user_role`
--
ALTER TABLE `t_user_role`
  ADD CONSTRAINT `FK_Role-User` FOREIGN KEY (`ID_Role`) REFERENCES `t_role` (`Role_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User` FOREIGN KEY (`ID_User`) REFERENCES `t_user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_weight`
--
ALTER TABLE `t_weight`
  ADD CONSTRAINT `FK_User_Weight` FOREIGN KEY (`ID_User`) REFERENCES `t_user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
