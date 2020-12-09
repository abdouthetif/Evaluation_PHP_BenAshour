-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 déc. 2020 à 17:04
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `cp` int(11) NOT NULL,
  `surface` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `type_id`, `description`) VALUES
(1, 'T3/4 Moderne avec Terrasse', '12 rue du Prés', 'Vénissieux', 69200, 73, 239000, 2, 'Les Chasseurs de Pierre vous présentent en Exclusivité ce charmant appartement T3 (possibilité T4), de 73 m2.\r\n\r\nSitué à seulement 7 minutes à pied du métro D et 2 minutes du Tram T4.\r\n\r\nAu 3e étage sur 4 avec ascenseur, dans une résidence moderne et sécurisée de 2015. Au calme, en arrière-cour.\r\n\r\nIl se compose d\'une spacieuse pièce de vie avec sa cuisine entièrement équipée ainsi que son espace de télétravail (possibilité 3e chambre) donnant sur une terrasse de 7 m2. Deux chambres avec placards intégrés. Salle d\'eau et WC indépendant.\r\n\r\nLocal vélo et place de parking privée couverte.\r\n\r\nPlus d\'infos, vidéo et visite virtuelle sur notre site...\r\n\r\nMentions légales : honoraire d\'agence inclus - Votre Agent immobilier Mr Nicolas HECTOR (RCS 800938292) - LES CHASSEURS DE PIERRE - Tel : 06 21 08 33 17 - Référence interne : VA1042'),
(2, 'Villa climatisée 6 pièces avec Piscine et Garage double', '14 rue louis pasteur', 'Vénissieux', 69200, 150, 430000, 2, 'EXCLUSIVITE\r\n\r\nSituée en retrait dans le très calme et résidentiel \"QUARTIER DES ITALIENS\", secteur du Laquay (limite Vénissieux/Corbas), venez visiter en exclusivité cette magnifique villa climatisée de 150 m², construite dès 1996, chauffée au gaz de ville et qui inclut : un T2 (50m² avec porte d\'entrée indépendante), une piscine, un garage double et un terrain de pétanque.\r\n\r\nVous trouverez à l\'étage :\r\n\r\n    3 Chambres avec placards incorporés (11m²) chacune\r\n    Entrée + Séjour traversant (39m²)\r\n    Cuisine équipée (14m²)\r\n    Salle de bain : baignoire, douche et meuble double-vasque (7m²)\r\n    Toilette indépendant\r\n\r\n\r\nAu rez-de-chaussée, un grand T2 (50 m2) comprenant :\r\n\r\n    Séjour/Cuisine ouverte (28m²)\r\n    Chambre (13m²)\r\n    Salle d’eau avec WC\r\n    Garage double à ouverture électrique (55m²)\r\n\r\n\r\nEt à l\'extérieur, sur sa parcelle totale de 509m²\r\n\r\n    Balcon et Terrasse exposés Ouest et Sud\r\n    Piscine\r\n    Terrain de pétanque\r\n    Abris de jardin\r\n    2 places de stationnement supplémentaires\r\n\r\n\r\nA noter également que la chaudière a été changée en 2019 et l\'imperméabilité de la toiture a été refaite au printemps dernier.\r\n\r\nHonoraires d\'agence inclus\r\nM. Mario PAOLELLA\r\n(RSAC de Lyon : 881606784)\r\n06 32 64 37 45\r\nLes Chasseurs de Pierre\r\n(Référence interne du bien : VM384)'),
(3, 'Maison Dardilly 200M2', '28 avenue Roosevelt', 'Dardilly', 69570, 200, 510000, 2, 'Grande maison de 200m2 (246m2 au sol) avec potentiel d\'aménagement au RDC. Sur un terrain de 480m2.\r\nProximité immédiate de la RN6 vous permettant d\'être à Lyon en moins de 10 min (9km).\r\n\r\nLa maison s\'agence de la manière suivante:\r\n\r\nRDC :\r\nhall d\'entrée, buanderie, grande pièce 45m2 (avec bar),wc, Garage d\'env 40m2.\r\nPlusieurs possibilités s\'offrent  à vous :\r\n-Création d\'un appartement T2 avec son entrée et sa terrasse indépendante à mettre en location.\r\n-Installation d\'une activité professionnelle.\r\n- agrandissement de l\'habitation\r\n\r\n1er étage :\r\nTrès belle pièce de vie avec sa cuisine semi ouverte entièrement équipée, une chambre ainsi qu\'une salle de bain avec baignoire d\'angle et douche. terrasse d\'env 40m2\r\n\r\n2eme:\r\nUn pallier permettant un coin bureau, 2 chambres ainsi qu\'une salle de bain.\r\n\r\nPlus d\'info et photo sur notre...\r\n\r\nMentions légales : honoraire d\'agence inclus - Votre Agent immobilier Mr Nicolas HECTOR (RCS 800938292) - LES CHASSEURS DE PIERRE - Tel : 06 21 08 33 17 - Référence interne : VM380');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id_picture` int(11) NOT NULL,
  `logement_id` int(11) NOT NULL,
  `picture_1` varchar(40) NOT NULL,
  `picture_2` varchar(40) NOT NULL,
  `picture_3` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id_picture`, `logement_id`, `picture_1`, `picture_2`, `picture_3`) VALUES
(1, 1, 'T3_venissieux_1.jpg', 'T3_venissieux_2.jpg', 'T3_venissieux_3.jpg'),
(2, 2, 'maison_venissieux_1.jpg', 'maison_venissieux_2.jpg', 'maison_venissieux_3.jpg'),
(3, 3, 'maison_dardilly_1.jpg', 'maison_dardilly_2.jpg', 'maison_dardilly_3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `label` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `label`) VALUES
(1, 'location'),
(2, 'vente'),
(3, 'colocation');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`),
  ADD KEY `type_id` (`type_id`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id_picture`),
  ADD KEY `logement_id` (`logement_id`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id_picture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
