-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 21 mars 2022 à 09:19
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_magasin`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `prenom` varchar(254) DEFAULT NULL,
  `adresse` varchar(254) DEFAULT NULL,
  `telephone` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `pass` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `pass`) VALUES
(0, 'dsdsd', 'dffff', 'fdbdfdvfv', '3141343345', 'sidiammi@gmail.com', 'ggggggggg'),
(1, 'elbokiro ', 'karim', 'Rue ibn chaga nr 17', '0642395019', 'elbokirokarim@gmail.com', 'kariM091'),
(2, 'elwahabi', 'marwa', 'El widadiya nr 5', '0639201529', 'elwahabimarma@gmail.com', 'Marwa120'),
(3, 'Elkalil', 'Kamal', 'Rue elwahda nr 20', '0658392743', 'elkalilkamal@gmail.com', 'Karim234'),
(4, 'ssQQ', 'dffff', 'fdbdfdvfv', '3141343345', 'zaydky7@gmail.com', 'ffffffff'),
(5, 'ZAYD', 'dffff', 'fdbdfdvfv', '3141343345', 'sidiammi@gmail.com', 'jkkkkkkkkkk'),
(6, 'GGGG', 'dffff', 'fdbdfdvfv', '3141343345', 'sidiammi@gmail.com', 'FFFFFFFFFFFF'),
(7, 'ssQQ', 'dffff', 'fdbdfdvfv', '3141343345', 'sidiammi@gmail.com', 'QHDQGDQJQS54');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` char(11) NOT NULL,
  `idClient` char(11) NOT NULL,
  `datePrecise` datetime DEFAULT NULL,
  `adresseLivraison` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `idClient`, `datePrecise`, `adresseLivraison`) VALUES
('M123', 'C123', '2022-03-26 15:07:00', 'Rue ibn tilal nr 21'),
('M124', 'C124', '2022-04-26 01:07:32', 'Rue elgchra nr 28'),
('M125', 'C125', '2023-02-26 15:00:00', 'Rue elwahda nr 20');

-- --------------------------------------------------------

--
-- Structure de la table `detailscommande`
--

CREATE TABLE `detailscommande` (
  `idCommande` char(11) NOT NULL,
  `idProduit` char(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `detailscommande`
--

INSERT INTO `detailscommande` (`idCommande`, `idProduit`, `quantite`) VALUES
('M123', 'P123', 3),
('M124', 'P124', 10),
('M125', 'P125', 6);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` char(11) NOT NULL,
  `libelle` varchar(254) DEFAULT NULL,
  `description` varchar(254) DEFAULT NULL,
  `prix` decimal(8,0) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `libelle`, `description`, `prix`, `stock`, `image`) VALUES
('P123', 'Dr. Hauschka', 'Pour prendre soin de cette harmonie et révéler la beauté intérieure comme extérieure, la marque vient au renfort de toutes les peaux et les encourage à exercer leurs pouvoirs d’auto-régénération avec des soins qui rééquilibrent tous les types de carnatio', '389', 3, './img/img1.jpg'),
('P124', ' Pai Skincare', ' Sarah Brown a créé la marque suite à sa propre expérience :  sa peau est devenue irritée, hyper-sensible et sujette à l’acné du jour au lendemain. Partie du constat qu’aucun produit de soin ne lui convenait, elle a souhaité reprendre le contrôle avec Pa', '459', 9, './img/img2.jpg'),
('P125', 'Sanoflore', ' Ses cosmétiques associent éléments naturels et innovation cosmétique, à travers l’association d’actifs purs et précieux. Les produits séduisent par leur innovation sensorielle et olfactive qui conviennent à tout type de peau. ', '499', 6, './img/img3.jpg'),
('P126', 'Kadalys', 'La banane verte est reconnue pour son action purifiante, elle équilibre et affine le grain de peau.', '499', 0, './img/img4.jpg'),
('P127', 'UNE APPROCHE DE LA BEAUTÉ ', 'Nutrimetics c’est un concept novateur qui associe des produits cosmétiques et des compléments alimentaires pour des performances beauté renforcées. Une approche intelligente, qui vide une action à la fois extérieure et intérieure.\r\n', '219', 11, './img/img5.jpg'),
('P128', 'Fresh', 'Vivre une expérience sensorielle unique, c’est être convaincu. Fresh est une approche à la fois sensorielle et révolutionnaire de la beauté. ', '199', 10, './img/img6.jpeg'),
('P129', 'Chouette mama', 'sont conçus à base de karité biologique et ont beaucoup de succès auprès des fidèles clients de la marque. ', '379', 8, './img/im11.jpg'),
('P130', 'JEUNE POUSSE', 'une gamme de produit naturelle et certifiée. Une qualité de produit reconnue par l\'univers des professionnels qui adoptent rapidement la marque pour son efficacité. Les produits capillaires bio professionnels sont utilisés en salon de coiffure dans toute', '319', 3, './img/im12.jpg'),
('P131', 'Oracle', 'Personnalité magnifique, l’Oracle illumine tout sur son passage. Le charme de cet homme, aux tonalités de gingembre et de cannelle, est captivant. Rassurant, d’une élégante prestance.', '370', 10, './img/Oracle.png'),
('P132', 'Un beau jour', 'L’approche dynamique et gourmande des agrumes se marie à\r\nmerveille aux parfums printaniers . À cette fraîcheur et cette délicatesse succèdera un sillage d’une exquise élégance. ', '400', 11, './img/bj.png'),
('P133', 'UNE VIE EN OR', 'Dans son boitier Or, abritant jalousement un jus ambré aux reflets captivants, le plus précieux des parfums FREDERIC M provoque convoitise et totale séduction par ces accords chyprés floraux. ', '450', 7, './img/or.png'),
('P134', 'Une Vie en Or', 'Une Vie en Or pour Homme, une fragrance Orientale Fruitée qui\r\nrend son possesseur Unique…', '450', 5, './img/une.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
