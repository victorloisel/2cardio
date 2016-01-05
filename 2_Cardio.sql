-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 05 Janvier 2016 à 08:39
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Contenu de la table `Reponse`
--

INSERT INTO `Reponse` (`Reponse_id`, `Topic_id`, `id_User`, `Reponse_texte`, `Reponse_date`) VALUES
(1, 1, 2, 'une question sur le topic 1 ?', '2015-12-11 09:30:09'),
(2, 2, 2, 'question sur le topic 2 ?', '2015-12-11 09:30:20'),
(4, 1, 2, 'test test', '2015-12-11 09:31:31'),
(9, 1, 1, 'test', '2015-12-11 13:12:43'),
(11, 11, 2, 'testtest', '2015-12-11 13:14:59'),
(12, 12, 1, 'test ?', '2015-12-11 17:23:33'),
(13, 12, 1, 'test', '2015-12-11 17:23:40'),
(14, 1, 1, 'test', '2016-01-04 10:45:10'),
(17, 15, 1, 'test', '2016-01-04 12:25:15');

-- --------------------------------------------------------

--
-- Structure de la table `Topic`
--

CREATE TABLE IF NOT EXISTS `Topic` (
  `Topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Topic_titre` text COLLATE utf8_bin NOT NULL,
  `id_User` int(11) NOT NULL,
  PRIMARY KEY (`Topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Contenu de la table `Topic`
--

INSERT INTO `Topic` (`Topic_id`, `Topic_titre`, `id_User`) VALUES
(1, 'Affichage d''un select en PHP', 1),
(2, 'Affichage d''un update en PHP', 1),
(11, 'testtest', 2),
(12, 'test', 1),
(15, 'test', 1);

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
  `Difficulty_Factor` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`Difficulty_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_difficulty`
--

INSERT INTO `t_difficulty` (`Difficulty_ID`, `Difficulty_Name`, `Difficulty_Factor`) VALUES
(1, 'Easy', 1),
(2, 'Medium', 2),
(3, 'Hardcore', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_exercice`
--

CREATE TABLE IF NOT EXISTS `t_exercice` (
  `Exercice_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Exercice_Name` text NOT NULL,
  `Exercice_Repetition` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Exercice_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `t_exercice`
--

INSERT INTO `t_exercice` (`Exercice_ID`, `Exercice_Name`, `Exercice_Repetition`) VALUES
(1, 'Pompes', 20),
(2, 'Abdos', 20),
(3, 'Corde à sauter', 50),
(4, 'Course', 25),
(5, 'Flexions', 40),
(6, 'Crunch Abdo', 10),
(7, 'pompes test', 0);

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
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6);

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
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3);

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
  `History_Repetition` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`History_ID`),
  KEY `ID_Status` (`ID_Status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `t_history`
--

INSERT INTO `t_history` (`History_ID`, `History_Programme`, `ID_User`, `ID_Exercice`, `ID_Difficulty`, `ID_Objective`, `ID_Status`, `History_Date`, `History_Repetition`) VALUES
(4, 1, 1, 1, 1, 1, 1, '2016-01-04 10:10:03', 10),
(5, 1, 1, 2, 1, 1, 1, '2016-01-04 10:10:03', 20),
(6, 1, 2, 1, 1, 1, 1, '2016-01-04 19:03:13', 15);

-- --------------------------------------------------------

--
-- Structure de la table `t_objective`
--

CREATE TABLE IF NOT EXISTS `t_objective` (
  `Objective_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Objective_Name` text NOT NULL,
  `Objective_Factor` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`Objective_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `t_objective`
--

INSERT INTO `t_objective` (`Objective_ID`, `Objective_Name`, `Objective_Factor`) VALUES
(1, 'Maigrir', 2),
(2, 'Remise en forme', 1),
(3, 'Performance', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_permission`
--

CREATE TABLE IF NOT EXISTS `t_permission` (
  `Permission_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Permission_Name` text NOT NULL,
  PRIMARY KEY (`Permission_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_status`
--

INSERT INTO `t_status` (`Status_ID`, `Status_Name`) VALUES
(1, 'En cours'),
(2, 'Terminé');

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
(2, 'Loisel', 'Victor', 'victor.loisel@gmail.com', 7, 1, '3 rue du bois', '0635141215', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 29, 183);

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
(1, 2);

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
(2, 110, '2016-01-04 15:08:28');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_exercice_difficulty`
--
ALTER TABLE `t_exercice_difficulty`
  ADD CONSTRAINT `FK_Exercice-Difficulty` FOREIGN KEY (`ID_Exercice`) REFERENCES `t_exercice` (`Exercice_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Difficulty` FOREIGN KEY (`ID_Difficulty`) REFERENCES `t_difficulty` (`Difficulty_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_exercice_objective`
--
ALTER TABLE `t_exercice_objective`
  ADD CONSTRAINT `FK_Objective` FOREIGN KEY (`ID_Objective`) REFERENCES `t_objective` (`Objective_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Exercice-Objective` FOREIGN KEY (`ID_Exercice`) REFERENCES `t_exercice` (`Exercice_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_history`
--
ALTER TABLE `t_history`
  ADD CONSTRAINT `FK_Status` FOREIGN KEY (`ID_Status`) REFERENCES `t_status` (`Status_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `t_role_permission`
--
ALTER TABLE `t_role_permission`
  ADD CONSTRAINT `FK_Role-Permission` FOREIGN KEY (`ID_Role`) REFERENCES `t_role` (`Role_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Permission` FOREIGN KEY (`ID_Permission`) REFERENCES `t_permission` (`Permission_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_User` FOREIGN KEY (`ID_User`) REFERENCES `t_user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Role-User` FOREIGN KEY (`ID_Role`) REFERENCES `t_role` (`Role_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_weight`
--
ALTER TABLE `t_weight`
  ADD CONSTRAINT `FK_User_Weight` FOREIGN KEY (`ID_User`) REFERENCES `t_user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
