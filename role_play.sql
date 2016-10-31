-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 28 Octobre 2016 à 10:46
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `role_play`
--

-- --------------------------------------------------------

--
-- Structure de la table `bestiaire`
--

DROP TABLE IF EXISTS `bestiaire`;
CREATE TABLE IF NOT EXISTS `bestiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT '1',
  `vie` int(11) NOT NULL DEFAULT '1',
  `attaque` int(11) NOT NULL DEFAULT '1',
  `bonusDegat` text NOT NULL,
  `reductionDegat` int(11) NOT NULL DEFAULT '1',
  `sort` text NOT NULL,
  `parade` int(11) NOT NULL DEFAULT '1',
  `esquive` int(11) NOT NULL DEFAULT '1',
  `blocage` int(11) NOT NULL DEFAULT '1',
  `contreAttaque` int(11) NOT NULL DEFAULT '1',
  `force` text NOT NULL,
  `faiblesse` text NOT NULL,
  `isCacher` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

DROP TABLE IF EXISTS `carte`;
CREATE TABLE IF NOT EXISTS `carte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `afficher` enum('oui','non') NOT NULL DEFAULT 'non',
  `typeAffichage` enum('mapper','cacher','visible') NOT NULL DEFAULT 'mapper',
  `axeVertical` int(11) NOT NULL DEFAULT '12',
  `axeHorizontal` int(11) NOT NULL DEFAULT '12',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `historisationsonjouer`
--

DROP TABLE IF EXISTS `historisationsonjouer`;
CREATE TABLE IF NOT EXISTS `historisationsonjouer` (
  `idSon` int(12) NOT NULL,
  `idSession` varchar(255) NOT NULL,
  PRIMARY KEY (`idSon`,`idSession`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mappagecarte`
--

DROP TABLE IF EXISTS `mappagecarte`;
CREATE TABLE IF NOT EXISTS `mappagecarte` (
  `idCarte` int(11) NOT NULL,
  `axeVertical` int(11) NOT NULL,
  `axeHorizontal` int(11) NOT NULL,
  PRIMARY KEY (`idCarte`,`axeVertical`,`axeHorizontal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idPerso` int(11) NOT NULL,
  `message` text NOT NULL,
  `lue` enum('oui','non') NOT NULL DEFAULT 'non',
  `dateCreaction` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `navire`
--

DROP TABLE IF EXISTS `navire`;
CREATE TABLE IF NOT EXISTS `navire` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `forPlayer` enum('oui','non') NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Schooner',
  `equipage` int(12) NOT NULL DEFAULT '10',
  `coque` int(12) NOT NULL DEFAULT '10',
  `voile` int(12) NOT NULL DEFAULT '5',
  `canon` int(12) NOT NULL DEFAULT '10',
  `bouletCanon` int(12) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

DROP TABLE IF EXISTS `personnage`;
CREATE TABLE IF NOT EXISTS `personnage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT '1',
  `classe` varchar(255) NOT NULL DEFAULT '',
  `metier` varchar(255) NOT NULL,
  `vie` int(11) NOT NULL DEFAULT '1',
  `mana` int(11) NOT NULL DEFAULT '1',
  `force` int(11) NOT NULL DEFAULT '1',
  `dexterite` int(11) NOT NULL DEFAULT '1',
  `perception` int(11) NOT NULL DEFAULT '1',
  `education` int(11) NOT NULL DEFAULT '1',
  `constitution` int(11) NOT NULL DEFAULT '1',
  `chance` int(11) NOT NULL DEFAULT '1',
  `charisme` int(11) NOT NULL DEFAULT '1',
  `competence` text NOT NULL,
  `sort` text NOT NULL,
  `equipement` text NOT NULL,
  `inventaire` text NOT NULL,
  `po` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sonajouer`
--

DROP TABLE IF EXISTS `sonajouer`;
CREATE TABLE IF NOT EXISTS `sonajouer` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `dateTime` datetime NOT NULL,
  `cheminSon` varchar(255) NOT NULL,
  `idPerso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
