-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 25 nov. 2019 à 13:11
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livreor`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(79, 'Bravo bravo !!!', 26, '2019-11-25 00:00:00'),
(78, 'Bcp de bonheur !! Je vous embrasse', 26, '2019-11-25 00:00:00'),
(77, 'Merci pour ce mariage magnifique :) Toutes mes fÃ©licitations !', 25, '2019-11-25 00:00:00'),
(76, 'FÃ©licitations ! Bisous', 24, '2019-11-25 00:00:00'),
(75, 'Tous mes voeux de bonheur Ã  tous les deux :)', 23, '2019-11-25 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(21, 'admin', '$2y$10$02I8Ovt1muDmJCXha50R9u.Ieye9P/kOxPViaBpmR4I2Qt/.3nkM2'),
(23, 'amelie13', '$2y$10$/q.CFa4DnHI64J44OclvL.71ImyHCKwZTbemk8iCu2yUTM/3nDBpm'),
(24, 'matthieub', '$2y$10$UvLaR9xbCvGSUd6mfC3M9.NaocTRDF62.Dmc0ZP8TTZtY8AGtvF1q'),
(25, 'nanais45', '$2y$10$vMT42rKrA6XTuGds3KZSluaHu4lL2EiQc0RA521ajg8XwtNByiLt6'),
(26, 'sarah13', '$2y$10$LILB5rv6s2f8S/NHQFilbeORI18c0xQGg3QTsfZIOF5weOkhZyE6C');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
