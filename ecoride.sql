-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 22 juil. 2025 à 07:36
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecoride`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id_annonce` int(11) NOT NULL,
  `departement` varchar(100) NOT NULL,
  `depart` varchar(255) NOT NULL,
  `arrive` varchar(255) NOT NULL,
  `vehicule` varchar(100) NOT NULL,
  `place` int(11) NOT NULL,
  `tarif` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `departement`, `depart`, `arrive`, `vehicule`, `place`, `tarif`, `description`, `id`) VALUES
(4, 'Aisne', 'st quentin', 'marseille', 'Camionette', 5, 12, 'Array', 5),
(12, 'Essonne', 'corbeille-essonne', 'paris ', 'Voiture', 4, 23, 'xiuhj xndixn iijx', 5),
(13, 'Bouches-du-Rhône', 'martigue', 'tours', 'Moto', 12, 22, 'xskinxzsix,zsiox,zsxz zzox,zso,xso,x', 5),
(14, 'Savoie', 'la-cluzas', 'dijon', 'Mini-Bus', 12, 22, 'zijxzçi zxiz,xi zsxiz,xix,zs zxiz,sz', 6),
(15, 'Calvados', 'Dives', 'Caen', 'Voiture', 3, 15, 'depart vers 8h30 de carrfour market plac leon blum', 9),
(16, 'Landes', 'Lacanaux', 'LaRochelle', 'Camping-car', 2, 25, 'Nous partirons vers 5h du matin \r\nRDV sur le parking de la gare saint jean\r\nPas de fumeur  merci bonne journée', 11);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `etoile` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `commentaire`, `etoile`, `id`) VALUES
(6, 'uebce ebceu ednxein ', 3, 4),
(7, '_cxhe uxzuejx xnzzx zxnzx zxniçx ijzxiçjzx  zxnzinxin ', 5, 5),
(8, 'kpkspx,oaowsw w asxwsxwszsp;s', 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo_profil` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'NOT NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `photo_profil`, `role`) VALUES
(2, 'Simpson', 'Homer', 'simpson@homer.com', '$2y$10$QhpdBdRYMLp4sABNisk/f.2L.HdLqvZJXj1bKU4hwL9XY3zXQQ546', 'EP3OzKetFfMnb3kXKpsjeBP2a_homer.jpg', 'user'),
(3, 'Parker', 'Peter', 'parker@peter.fr', '$2y$10$2i9iK/xSydul.eAHN64vaeoFt4ppx3xkcdIDl1Ed4pSucG.STVfxK', 'uCda7msp3d2qeTm3wVzMOldtD_peter.jpg', 'user'),
(4, 'Gaillet', 'Stephane', 'exemple@test.com', '$2y$10$7QqfEP4sQ74sOe0cez1iVuu/lZTEErx4qNQUsYL.ENqD1Ds.VQChq', 'eLgbHqreJtBFo3VTgddN9UZAH_A4.jpg', 'user'),
(5, 'Solo', 'Han', 'solo@han.com', '$2y$10$DZNGK7OqygmCtNo0nONZE.tmIDH.eCWH3aQx.JU20h.bkpEA5E8mu', '3bwPzRWRJdJXparBcVaiHDv0J_han_solo.jpg', 'user'),
(6, 'Skywalker', 'Luc', 'jedi@sith.com', '$2y$10$S2Wvpii/0O/S19PgeCSk6e/9kDj6/ceUXZWm2NvAhpATkZWVm1Z4C', 'W7PVIfJKyGO9tztky8YnDUaPf_luc.jpg', 'user'),
(9, 'Ricard', 'Paul', 'ricard@paul.fr', '$2y$10$tiE.TCE9974B2ctN7WOA8OTLmbksEwwUELUKwBc87KqDOvGjzzvSO', 'kIjgWBdXPgbobNPrMUQfBRI0L_cats.jpg', 'user'),
(10, 'amstrong', 'neil', 'appollo@onze.com', '$2y$10$8v5Tvi1Ku.VtCRr/TlZR0eNlwdejB6rRUJAjlwA9R41T6H38.xljO', 'KnBPzOx4sklh7fbT9x9WM6qdb_amstrong.jpg', 'user'),
(11, 'aldrim', 'buzz', 'buzz@buzz.com', '$2y$10$1.dOMB/qcR0ORTFYnDLoj.el8OiaTFmVpdbhAfXZ0aDdOi6PU4sYy', 'oBTwSQ2dPMVW0sLHeAzxUiha2_A2.jpg', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `Etragère` (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `Etrangère` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `UsersAnnonce` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `UserAvis` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
