-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 12 août 2023 à 20:54
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `inptic1`
--

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `id_conges` int(11) NOT NULL,
  `nom_employe` varchar(255) NOT NULL,
  `type_conges` varchar(255) NOT NULL,
  `date_de_debut` date NOT NULL,
  `date_de_fin` date NOT NULL,
  `duree` text NOT NULL,
  `motif` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_de_demande` datetime NOT NULL,
  `date_de_traitement` date NOT NULL,
  `gestionnaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`id_conges`, `nom_employe`, `type_conges`, `date_de_debut`, `date_de_fin`, `duree`, `motif`, `commentaire`, `date_de_demande`, `date_de_traitement`, `gestionnaire`) VALUES
(9, 'LENDAMBA-PINDI Loan Wendy', 'maladie', '2023-09-09', '2023-10-13', '35 Jours', 'enfant malade', 'mon enfant est malade et il n\'ya personne pour s\'occuper de lui en soirée', '2023-08-09 00:00:00', '0000-00-00', 'MAVOUGOU Alban'),
(11, 'LENDAMBA-PINDI Loan Wendy', '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00 00:00:00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Structure de la table `evaluations_de_performances`
--

CREATE TABLE `evaluations_de_performances` (
  `id_evaluation` int(11) NOT NULL,
  `id_employe` int(10) NOT NULL,
  `nom_employe` varchar(255) NOT NULL,
  `departement_service` varchar(100) NOT NULL,
  `poste_occupe` varchar(100) NOT NULL,
  `date_evaluation` datetime NOT NULL,
  `evaluateur` varchar(100) NOT NULL,
  `objectifs_fixes` varchar(255) NOT NULL,
  `evaluation_des_competences` varchar(255) NOT NULL,
  `realisations` varchar(100) NOT NULL,
  `points_forts` varchar(100) NOT NULL,
  `domaines_a_ameliorer` varchar(255) NOT NULL,
  `note_evaluation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evaluations_de_performances`
--

INSERT INTO `evaluations_de_performances` (`id_evaluation`, `id_employe`, `nom_employe`, `departement_service`, `poste_occupe`, `date_evaluation`, `evaluateur`, `objectifs_fixes`, `evaluation_des_competences`, `realisations`, `points_forts`, `domaines_a_ameliorer`, `note_evaluation`) VALUES
(2, 0, 'ONDO Eli', 'archive', 'secrétaire RH', '2023-08-19 00:00:00', 'MAVOUGOU Junior', 'vous devez accomplir les taches suivantes', 'zertyuio rtyuio', 'sdfghj chj', 'aucuns', 'tous', 13);

-- --------------------------------------------------------

--
-- Structure de la table `gs_employes`
--

CREATE TABLE `gs_employes` (
  `id` int(11) NOT NULL,
  `photo` tinyblob NOT NULL,
  `nom_employe` varchar(255) NOT NULL,
  `prenom_employe` varchar(255) NOT NULL,
  `date_de_naissance` date NOT NULL,
  `nationalite` varchar(20) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `numero_securite_sociale` text NOT NULL,
  `date_embauche` datetime NOT NULL,
  `date_de_depart` date NOT NULL,
  `poste_occupe` varchar(255) NOT NULL,
  `statut` varchar(10) NOT NULL,
  `salaire` float NOT NULL,
  `tel` int(255) NOT NULL,
  `adresse` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gs_employes`
--

INSERT INTO `gs_employes` (`id`, `photo`, `nom_employe`, `prenom_employe`, `date_de_naissance`, `nationalite`, `sexe`, `numero_securite_sociale`, `date_embauche`, `date_de_depart`, `poste_occupe`, `statut`, `salaire`, `tel`, `adresse`, `email`) VALUES
(1, 0x2e2e2f2e2e2f75706c6f61642f696d616765732f46333964333931322e6a7067, 'pindi', 'loan', '2023-08-05', 'gabonaise', 'masculin', '2C1e-C30d-34A2-1326', '2023-08-05 00:00:00', '2023-08-05', 'Vigile', 'cdd', 234567, 98765432, 'pk9', 'loanlendamba575@gmail.com'),
(3, 0x2e2e2f2e2e2f75706c6f61642f696d616765732f393942393441413136313566696d616765312e6a7067, 'LILI', 'lala', '2023-08-05', 'camérounaise', 'masculin', 'Fa83-Ea03-f428-656E', '2023-08-05 00:00:00', '2023-08-05', 'secrétaire RH', 'cdd', 234567, 667788, 'olam', 'lalalali@gmail.com'),
(4, 0x2e2e2f2e2e2f75706c6f61642f696d616765732f363932373441696d616765332e6a7067, 'Eli', 'ONDO', '2023-08-05', 'Qatarien', 'masculin', '65a4-3121-b544-DE0C', '2023-08-05 00:00:00', '2023-08-05', 'chauffeur', 'cdd', 234567, 7744553, 'AZERT', 'eli@gmail.com'),
(5, 0x2e2e2f2e2e2f75706c6f61642f696d616765732f303565336330696d616765322e6a7067, 'reteno', 'lala', '2023-08-05', 'gabonaise', 'masculin', '0d6D-1CA5-4540-b432', '2023-08-05 00:00:00', '2023-08-05', 'chauffeur', 'cdd', 345678, 44233344, 'aze', 'reteno@gmail.com'),
(6, 0x2e2e2f2e2e2f75706c6f61642f696d616765732f313861313741696d616765362e6a7067, 'L0RD', 'amirlia', '2023-08-06', 'camérounaise', 'feminin', '8194-6d12-4C45-b5b0', '2023-08-06 00:00:00', '2023-08-06', 'Comptable', 'CDI', 2000020, 8877453, 'PK9', 'LORD@gmail.com'),
(7, 0x2e2e2f2e2e2f75706c6f61642f696d616765732f354435396463696d61676531362e6a7067, 'MAVOUGOU', 'Alban', '2023-08-09', 'camérounaise', 'masculin', 'A126-b9BC-F19b-5aBA', '2023-09-10 00:00:00', '2023-08-09', 'gestionnaire', 'cdd', 4000000, 66971123, 'PK8', 'mavougoualban@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'ROLE_USER',
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `role`, `is_verified`) VALUES
(2, 'pindi', 'loan', 'loanlendamba575@gmail.com', '$2y$10$.o3y6p6JpZFI4ecieYGOI.pAoOcY68HuKDQpO4VsTd4fCxypoiqMi', '', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id_conges`);

--
-- Index pour la table `evaluations_de_performances`
--
ALTER TABLE `evaluations_de_performances`
  ADD PRIMARY KEY (`id_evaluation`);

--
-- Index pour la table `gs_employes`
--
ALTER TABLE `gs_employes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `numero_securite_sociale` (`numero_securite_sociale`) USING HASH;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `id_conges` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `evaluations_de_performances`
--
ALTER TABLE `evaluations_de_performances`
  MODIFY `id_evaluation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `gs_employes`
--
ALTER TABLE `gs_employes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
