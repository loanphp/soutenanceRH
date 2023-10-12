-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 05:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inptic1`
--

-- --------------------------------------------------------

--
-- Table structure for table `conges`
--

CREATE TABLE `conges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `nom_employe` varchar(255) NOT NULL,
  `type_conges` varchar(255) NOT NULL,
  `date_de_debut` date NOT NULL,
  `date_de_fin` date NOT NULL,
  `duree` text NOT NULL,
  `motif` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_de_demande` datetime NOT NULL,
  `status` int(5) NOT NULL DEFAULT -1,
  `date_de_traitement` date NOT NULL,
  `gestionnaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conges`
--

INSERT INTO `conges` (`id`, `user_id`, `employe_id`, `nom_employe`, `type_conges`, `date_de_debut`, `date_de_fin`, `duree`, `motif`, `commentaire`, `date_de_demande`, `status`, `date_de_traitement`, `gestionnaire`) VALUES
(10, 0, 0, 'AMINA', 'Mariage', '2023-10-11', '2023-10-25', '2 semaine(s) et 0 jour(s)', 'je vais me marié', 'azerty', '2023-10-01 00:00:00', -1, '0000-00-00', 'MALOUOU'),
(12, 0, 0, 'MOUKEYI grace', 'Mariage', '2023-10-24', '2023-10-26', '0 semaine(s) et 2 jour(s)', 'azert', 'qsdfg', '2023-10-25 00:00:00', -1, '0000-00-00', 'GIGUI laurent'),
(14, 0, 0, 'LENDAMBA Loana julie', 'Mariage', '2023-10-12', '2023-10-25', '1 semaine(s) et 6 jour(s)', 'azerty', 'zerty', '2023-10-11 00:00:00', -1, '0000-00-00', 'GIGUI laurent'),
(15, 0, 0, 'AZERTY', 'ZERTY', '2023-10-18', '2023-11-02', '2 semaine(s) et 1 jour(s)', 'ZERTYU', 'ZERTY', '2023-10-17 00:00:00', -1, '0000-00-00', 'ZERTYU'),
(17, 0, 0, 'AZERTY', 'ZERTY', '2023-10-13', '2023-10-27', '2 semaine(s) et 0 jour(s)', 'ZERTY', 'AZERTY', '2023-10-10 00:00:00', -1, '0000-00-00', 'QSDFGH'),
(18, 0, 0, 'MOUKEYI', 'Mariage', '2023-10-25', '2023-11-02', '1 semaine(s) et 1 jour(s)', 'azerty', 'zerty', '2023-10-12 00:00:00', -1, '0000-00-00', 'GIGUI laurent'),
(19, 0, 0, 'MOUKEYI', 'azert', '2023-10-18', '2023-11-02', '2 semaine(s) et 1 jour(s)', 'sdfgh', 'erty', '2023-10-11 00:00:00', -1, '0000-00-00', 'erty'),
(20, 0, 0, 'AMINA', 'erty', '2023-10-25', '2023-11-11', '2 semaine(s) et 3 jour(s)', 'sdfg', 'ertyui', '2023-10-18 00:00:00', -1, '0000-00-00', 'GIGUI laurent');

-- --------------------------------------------------------

--
-- Table structure for table `dossiers_du_personnels`
--

CREATE TABLE `dossiers_du_personnels` (
  `id` int(11) NOT NULL,
  `numero_securite_sociale` varchar(255) NOT NULL,
  `etat_civil` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `contral_de_travail` varchar(255) NOT NULL,
  `affiliation_du_salarie(e)` varchar(255) NOT NULL,
  `vie_du_salarie(e)` varchar(255) NOT NULL,
  `correspondances` varchar(255) NOT NULL,
  `sante` varchar(255) NOT NULL,
  `fiches_absences` varchar(255) NOT NULL,
  `remunerations` varchar(255) NOT NULL,
  `depart_a_la_retraite` varchar(255) NOT NULL,
  `suivi_stagiaire` varchar(255) NOT NULL,
  `suivi_interimaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dossiers_du_personnels`
--

INSERT INTO `dossiers_du_personnels` (`id`, `numero_securite_sociale`, `etat_civil`, `cv`, `contral_de_travail`, `affiliation_du_salarie(e)`, `vie_du_salarie(e)`, `correspondances`, `sante`, `fiches_absences`, `remunerations`, `depart_a_la_retraite`, `suivi_stagiaire`, `suivi_interimaire`) VALUES
(15, 'f9ef-a975-DA4D-74a7', '3D2104EDZANG', '', '', '', '', '', '', '', '', '', '', ''),
(16, 'D645-Ea72-0cf4-4ac3', '529b89EDZANG', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `evaluationpoints`
--

CREATE TABLE `evaluationpoints` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluationpoints`
--

INSERT INTO `evaluationpoints` (`ID`, `Name`, `Data`) VALUES
(1, 'Réalisations passées', '{\"Title\": [\"realisations\", \"projets\", \"objectifs-atteints\"], \"Questions\": [\"Pouvez-vous partager certaines de vos réalisations notables au cours de la période d\'évaluation précédente ?\", \"Quels sont les projets ou les tâches sur lesquels vous avez le plus travaillé et dont vous êtes le plus fier ?\", \"Avez-vous atteint les objectifs que nous avons fixés lors de l\'entretien précédent ? Si oui, comment ?\"], \"Champs\": \"[\\\"textarea\\\", \\\"textarea\\\", \\\"textarea\\\"]\"}'),
(2, 'Forces et compétences', '{\"Title\": [\"forces\", \"competences\", \"contributions\"], \"Questions\": [\"Quelles sont vos principales forces en tant qu\'employé ?\", \"Avez-vous développé de nouvelles compétences au cours de la période écoulée ?\", \"Comment ces compétences ont-elles contribué à votre travail et à l\'entreprise ?\"], \"Champs\": \"[\\\"input\\\", \\\"input\\\", \\\"textarea\\\"]\"}'),
(3, 'Développement professionnel', '{\"Title\": [\"objectifs-developpement\", \"formation\", \"croissance-professionnelle\"], \"Questions\": [\"Quels sont vos objectifs de développement professionnel pour l\'année à venir ?\", \"Avez-vous des besoins spécifiques en matière de formation ou de développement ?\", \"Comment pouvons-nous vous soutenir dans votre croissance professionnelle ?\"], \"Champs\": \"[\\\"textarea\\\", \\\"textarea\\\", \\\"textarea\\\"]\"}'),
(4, 'Collaboration et communication', '{\"Title\": [\"capacite-collaboration\", \"defis-interactions\"], \"Questions\": [\"Comment évaluez-vous votre capacité à travailler en équipe et à communiquer avec vos collègues ?\", \"Avez-vous rencontré des défis dans vos interactions professionnelles que nous devrions aborder ?\"], \"Champs\": \"[\\\"input\\\",\\\"textarea\\\"]\"}'),
(5, 'Défis et opportunités d\'amélioration', '{\"Title\": [\"amelioration\", \"obstacles\", \"defis\"], \"Questions\": [\"Y a-t-il des domaines où vous pensez pouvoir améliorer votre performance ?\", \"Avez-vous identifié des obstacles ou des défis qui ont affecté votre travail ?\", \"Comment pouvons-nous travailler ensemble pour résoudre ces défis ?\"], \"Champs\": \"[\\\"textarea\\\",\\\"textarea\\\",\\\"textarea\\\"]\"}'),
(6, 'Objectifs futurs', '{\"Title\": [\"objectifs-futurs\", \"objectifs-entreprise\", \"indicateurs\"], \"Questions\": [\"Quels sont vos objectifs professionnels pour la prochaine période d\'évaluation ?\", \"Comment ces objectifs s\'alignent-ils avec les objectifs de l\'entreprise ?\", \"Quels indicateurs de performance utiliserons-nous pour mesurer votre succès ?\"], \"Champs\": \"[\\\"textarea\\\", \\\"textarea\\\", \\\"textarea\\\"]\"}'),
(7, 'Satisfaction au travail', '{\"Title\": [\"satisfaction\", \"preoccupations\"], \"Questions\": [\"Comment vous sentez-vous par rapport à votre travail et à votre environnement professionnel ?\", \"Y a-t-il des préoccupations ou des suggestions que vous aimeriez partager pour améliorer votre expérience au travail ?\"], \"Champs\": \"[\\\"textarea\\\", \\\"textarea\\\"]\"}'),
(8, 'Feedback sur le manager ou l\'entreprise', '{\"Title\": [\"feedback-manager\", \"suggestions\"], \"Questions\": [\"Avez-vous des commentaires sur la manière dont votre manager vous a soutenu au cours de la période d\'évaluation ?\", \"Y a-t-il des suggestions pour améliorer les pratiques de gestion ou les politiques de l\'entreprise ?\"], \"Champs\": \"[\\\"textarea\\\", \\\"textarea\\\", ]\"}');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations_de_performances`
--

CREATE TABLE `evaluations_de_performances` (
  `id_evaluation` int(11) NOT NULL,
  `employe_id` int(11) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `gs_employes`
--

CREATE TABLE `gs_employes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `photo_blob` tinyblob NOT NULL,
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
  `tel` int(255) DEFAULT NULL,
  `adresse` text NOT NULL,
  `email` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gs_employes`
--

INSERT INTO `gs_employes` (`id`, `user_id`, `photo`, `photo_blob`, `nom_employe`, `prenom_employe`, `date_de_naissance`, `nationalite`, `sexe`, `numero_securite_sociale`, `date_embauche`, `date_de_depart`, `poste_occupe`, `statut`, `salaire`, `tel`, `adresse`, `email`) VALUES
(1, 0, '../upload/images/903C761Ce327image1.jpg', '', 'A', 'loan', '2023-11-11', 'camerounaise', 'M', 'f9ef-a975-DA4D-74a7', '2023-10-13 00:00:00', '2023-11-11', '1', 'cdd', 345678, 567898765, 'bikele', 'loanlendamba575@gmail.com'),
(4, 0, '../upload/images/eB381B1Ce327image1.jpg', '', 'LLL', 'l', '2023-10-02', 'punu', 'F', 'D645-Ea72-0cf4-4ac3', '2023-10-21 00:00:00', '2023-10-04', '4', 'cdi', 23457, 66666, 'MAKOKOU', 'MAKO@gmail.com'),
(5, 0, '../upload/images/b6159d0AA1126363E9istockphoto-1152603187-612x612.jpg', '', 'AMINANA', 'lucKI', '2023-10-03', 'tchadienne', 'M', '5269-9962-a5c7-28E6', '2023-10-14 00:00:00', '2023-10-21', '10', 'cdd', 123456, 976540000, 'awoungou', 'A@gmail.com'),
(6, 0, '../upload/images/DC45981A027Cpexels-life-of-pix-7974.jpg', '', 'Moussa', 'grace', '2023-11-11', 'gabonaise', 'F', '3F2E-07e0-dd9E-930F', '2023-11-04 00:00:00', '2023-10-21', '10', 'cdd', 126, 66345689, 'kébé', 'loanlendamba858@gmail.com'),
(7, 0, '../upload/images/c4cB7A0Ae37627049.jpg', '', 'Lendamba', 'loan', '2023-10-05', 'tchadienne', 'M', '9843-0b3a-70FD-83a0', '2023-10-04 00:00:00', '2023-10-21', '1', 'cdd', 2005, 9999009, 'PK0', 'ndongstyfler@gmail.com'),
(8, 0, '../upload/images/bf937Fpexels-andrea-davis-3653849.jpg', '', 'malolo', 'mara', '2023-10-10', 'tchadienne', 'F', 'a36B-5593-247C-d746', '2023-10-02 00:00:00', '2023-10-04', '12', 'cdd', 20000, 99778866, 'pk12', 'mara@gmail.com'),
(9, 0, '../upload/images/828065OIP (4).jpeg', '', 'OVOURY', 'lixi', '2023-10-02', 'camerounaise', 'M', '41C8-BcA9-D334-3CF9', '2023-10-04 00:00:00', '2023-10-14', '6', 'cdd', 20000, 66971141, 'PK0', 'ovoury@gmail.com'),
(10, 0, '../upload/images/38B0e6télécharger.jpeg', '', 'azur', 'gabon', '2023-10-11', 'camerounaise', 'F', 'aa53-D3DD-1D89-d856', '2023-10-01 00:00:00', '2023-10-20', '2', 'cdi', 150000000, 74656003, 'sainte marie', 'azur@gmail.com'),
(11, 0, '../upload/images/aC6A23OIP (2).jpeg', '', 'charles', 'hugo', '2023-10-03', 'tchadienne', 'M', 'F916-0b00-505D-7e82', '2023-10-04 00:00:00', '2023-10-12', '6', 'cdd', 200, 65661234, 'PK18', 'charles@gmail.com'),
(12, 0, '../upload/images/5BA7d2télécharger.jpeg', '', 'AMINA', 'loan', '2023-10-19', 'tchadienne', 'M', 'E438-cA83-36a6-FF8a', '2023-10-11 00:00:00', '2023-10-28', '1', 'cdd', 123457000, 2147483647, 'PK0', 'chelse11a@gmail.com'),
(13, 0, '../upload/images/Dfe7AaR.png', '', 'Luth', 'MOUTIMBI', '2023-10-02', 'tchadienne', 'M', 'DC6e-1763-528B-9267', '2023-10-05 00:00:00', '2023-10-14', '1', 'cdd', 234567, 234000000, 'PK0', 'ZE@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `name`, `description`) VALUES
(1, 'Directeur des ressources humaines (DRH)', 'Le DRH est responsable de la gestion stratégique des ressources humaines de l\'entreprise, y compris la planification, la politique RH, le recrutement, la formation, et la résolution des conflits.'),
(2, 'Responsable du recrutement', 'Le responsable du recrutement identifie les besoins en personnel de l\'entreprise, recherche des candidats appropriés, les sélectionne et les intègre au sein de l\'organisation.'),
(3, 'Responsable de la formation et du développement', 'Ce professionnel conçoit et met en œuvre des programmes de formation pour les employés, favorisant ainsi leur développement professionnel au sein de l\'entreprise.'),
(4, 'Gestionnaire de la rémunération et des avantages sociaux', 'Le gestionnaire de la rémunération gère les politiques de rémunération, les salaires, les avantages sociaux et les incitatifs pour les employés.'),
(5, 'Gestionnaire des relations avec les employés', 'Ce gestionnaire favorise un environnement de travail positif en gérant les relations employé-employeur, en résolvant les conflits et en veillant au respect des politiques internes.'),
(6, 'Analyste RH', 'Les analystes RH collectent et analysent des données pour soutenir la prise de décision en matière de ressources humaines, fournissant ainsi des informations clés pour la planification stratégique.'),
(7, 'Spécialiste en avantages sociaux', 'Ce spécialiste gère les programmes d\'avantages sociaux tels que l\'assurance santé, la retraite, les congés payés, et assure leur administration.'),
(8, 'Spécialiste en conformité RH', 'Les spécialistes en conformité RH veillent à ce que l\'entreprise respecte les lois et réglementations en matière de ressources humaines et garantissent la conformité de ses politiques internes.'),
(9, 'Chargé de communication RH', 'Les chargés de communication RH sont responsables de la diffusion d\'informations liées aux RH, tant en interne qu\'en externe, notamment sur les avantages sociaux, les opportunités de développement, etc.'),
(10, 'Assistant RH', 'Les assistants RH fournissent un soutien administratif aux professionnels des RH, en gérant la documentation, en organisant des entretiens, en planifiant des formations, etc.'),
(11, 'Responsable de la diversité et de l\'inclusion', 'Ce responsable se concentre sur la promotion de la diversité et de l\'inclusion au sein de l\'entreprise en mettant en place des politiques et des programmes visant à créer un environnement inclusif.'),
(12, 'Chargé de la mobilité internationale', 'Les chargés de la mobilité internationale s\'occupent des déplacements et des affectations internationales des employés, y compris les visas, les permis de travail, la gestion des expatriés, etc.'),
(13, 'Consultant en RH', 'Les consultants en RH aident les entreprises à résoudre des problèmes spécifiques liés aux RH, tels que la restructuration, la gestion du changement, en fournissant des conseils et des recommandations.'),
(14, 'Responsable de la paie', 'Le responsable de la paie gère le traitement des salaires, la collecte des données de présence, et la distribution des salaires aux employés.'),
(15, 'Responsable de la santé et de la sécurité au travail', 'Ce responsable se concentre sur la sécurité des employés au travail, assure la conformité aux normes de sécurité et gère les risques professionnels.'),
(16, ' Responsable de la gestion des congés ', 'Le Responsable de la gestion des congés est un professionnel clé au sein du département des ressources humaines (RH) d\'une organisation. Ce rôle est essentiel pour assurer une gestion efficace des demandes de congés des employés, garantir le respect des politiques de l\'entreprise et contribuer à maintenir un équilibre entre les besoins opérationnels de l\'entreprise et le bien-être des employés.');

-- --------------------------------------------------------

--
-- Table structure for table `questions_evaluation`
--

CREATE TABLE `questions_evaluation` (
  `id` int(11) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions_evaluation`
--

INSERT INTO `questions_evaluation` (`id`, `questions`, `titre`) VALUES
(1, 'Pouvez-vous partager certaines de vos réalisations notables au cours de la période d\'évaluation précédente ?', 'realisations'),
(2, 'Quels sont les projets ou les tâches sur lesquels vous avez le plus travaillé et dont vous êtes le plus fier ?', 'projets'),
(3, 'Avez-vous atteint les objectifs que nous avons fixés lors de l\'entretien précédent ? Si oui, comment ?', 'objectifs-atteints'),
(4, 'Quelles sont vos principales forces en tant qu\'employé ?', 'forces'),
(5, 'Avez-vous développé de nouvelles compétences au cours de la période écoulée ?', 'competences'),
(6, 'Comment ces compétences ont-elles contribué à votre travail et à l\'entreprise ?', 'contributions'),
(7, 'Quels sont vos objectifs de développement professionnel pour l\'année à venir ?', 'objectifs-developpement'),
(8, 'Avez-vous des besoins spécifiques en matière de formation ou de développement ?', 'formation'),
(9, 'Comment pouvons-nous vous soutenir dans votre croissance professionnelle ?', 'croissance-professionnelle'),
(10, 'Comment évaluez-vous votre capacité à travailler en équipe et à communiquer avec vos collègues ?', 'capacite-collaboration'),
(11, 'Avez-vous rencontré des défis dans vos interactions professionnelles que nous devrions aborder ?', 'defis-interactions'),
(12, 'Y a-t-il des domaines où vous pensez pouvoir améliorer votre performance ?', 'amelioration'),
(13, 'Avez-vous identifié des obstacles ou des défis qui ont affecté votre travail ?', 'obstacles'),
(14, 'Comment pouvons-nous travailler ensemble pour résoudre ces défis ?', 'defis'),
(15, 'Quels sont vos objectifs professionnels pour la prochaine période d\'évaluation ?', 'objectifs-futurs'),
(16, 'Comment ces objectifs s\'alignent-ils avec les objectifs de l\'entreprise ?', 'objectifs-entreprise'),
(17, 'Quels indicateurs de performance utiliserons-nous pour mesurer votre succès ?', 'indicateurs'),
(18, 'Comment vous sentez-vous par rapport à votre travail et à votre environnement professionnel ?', 'satisfaction'),
(19, 'Y a-t-il des préoccupations ou des suggestions que vous aimeriez partager pour améliorer votre expérience au travail ?', 'preoccupations'),
(20, 'Avez-vous des commentaires sur la manière dont votre manager vous a soutenu au cours de la période d\'évaluation ?', 'feedback-manager'),
(21, 'Y a-t-il des suggestions pour améliorer les pratiques de gestion ou les politiques de l\'entreprise ?', 'suggestions');

-- --------------------------------------------------------

--
-- Table structure for table `reponse_evaluation`
--

CREATE TABLE `reponse_evaluation` (
  `id` int(11) NOT NULL,
  `code_employe_id` varchar(255) NOT NULL,
  `realisations` text DEFAULT NULL,
  `projets` text DEFAULT NULL,
  `objectifs_atteints` text DEFAULT NULL,
  `forces` text DEFAULT NULL,
  `competences` text DEFAULT NULL,
  `contributions` text DEFAULT NULL,
  `objectifs_developpement` text DEFAULT NULL,
  `formation` text DEFAULT NULL,
  `croissance_professionnelle` text DEFAULT NULL,
  `capacite_collaboration` text DEFAULT NULL,
  `defis_interactions` text DEFAULT NULL,
  `amelioration` text DEFAULT NULL,
  `obstacles` text DEFAULT NULL,
  `defis` text DEFAULT NULL,
  `objectifs_futurs` text DEFAULT NULL,
  `objectifs_entreprise` text DEFAULT NULL,
  `indicateurs` text DEFAULT NULL,
  `satisfaction` text DEFAULT NULL,
  `preoccupations` text DEFAULT NULL,
  `feedback_manager` text DEFAULT NULL,
  `suggestions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reponse_evaluation`
--

INSERT INTO `reponse_evaluation` (`id`, `code_employe_id`, `realisations`, `projets`, `objectifs_atteints`, `forces`, `competences`, `contributions`, `objectifs_developpement`, `formation`, `croissance_professionnelle`, `capacite_collaboration`, `defis_interactions`, `amelioration`, `obstacles`, `defis`, `objectifs_futurs`, `objectifs_entreprise`, `indicateurs`, `satisfaction`, `preoccupations`, `feedback_manager`, `suggestions`) VALUES
(1, 'f9ef-a975-DA4D-74a7', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'Oui', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', NULL),
(2, 'f9ef-a975-DA4D-74a7', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'Oui', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');', 'const params = new URLSearchParams(window.location.search);\r\n    const id = params.get(\'id\');'),
(3, '9843-0b3a-70FD-83a0', 'oui je veux bien le faire', 'application E_commerce', 'Oui', 'salut', 'rtyui', 'zertyu', 'bien', 'tourne', 'la route', 'bien et toi', 'comment', 'jsoncode', 'secode', 'first', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0'),
(4, '9843-0b3a-70FD-83a0', 'oui je veux bien le faire', 'application E_commerce', 'Oui', 'salut', 'rtyui', 'zertyu', 'bien', 'tourne', 'la route', 'bien et toi', 'comment', 'jsoncode', 'secode', 'first', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0'),
(5, '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0', '9843-0b3a-70FD-83a0'),
(6, '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6'),
(7, '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6', '5269-9962-a5c7-28E6'),
(8, '5269-9962-a5c7-28E6', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\',', 'justifyContent : \'center\','),
(9, 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7'),
(10, 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7'),
(11, 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7', 'f9ef-a975-DA4D-74a7zertyu'),
(12, 'f9ef-a975-DA4D-74a7', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result'),
(13, 'f9ef-a975-DA4D-74a7', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result'),
(14, 'f9ef-a975-DA4D-74a7', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result'),
(15, 'f9ef-a975-DA4D-74a7', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result'),
(16, 'f9ef-a975-DA4D-74a7', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result', 'evaluation/result');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` text NOT NULL DEFAULT '["ROLE_USER"]',
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `nom`, `prenom`, `email`, `password`, `role`, `is_verified`) VALUES
(3, '', 'MAGONGUA', 'Hanz', 'hanz@gmail.com', '$2y$10$RsD9M.yFmix2PmkA18G5dOEA0S6E49QowwKM92C6k6NGjo3vjZ50O', '[\"ROLE_USER\",\"ROLE_EMPLOYEE\"]', 0),
(4, '', 'LENDAMBA', 'Loan', 'loanlendamba575@gmail.com', '$2y$10$JWDcOE/Y4mmZB1lIY6eKaeCaa2mQcQIlECXiT33jFXKycFy6656/O', '[\"ROLE_USER\",\"ROLE_EMPLOYEE\"]', 0),
(5, '', 'MARIATA', 'chelsea', 'chelsea@gmail.com', '$2y$10$5vtHCJTQGvgLuBnVgknKcemkegAvLIi1ogLDnIyDnn80D2Go6vbee', '[\"ROLE_USER\",\"ROLE_ADMIN_SYSTEM_RH\",\"ROLE_EMPLOYEE\"]', 0),
(6, '', 'moussounda', 'charles', 'charles@gmail.com', '$2y$10$Gqs/3GPm1ey0bu2fLyn4w.TK9KEJzEKszuKnZCr5kplspHIEhS236', '[\"ROLE_USER\"]', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dossiers_du_personnels`
--
ALTER TABLE `dossiers_du_personnels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluationpoints`
--
ALTER TABLE `evaluationpoints`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `evaluations_de_performances`
--
ALTER TABLE `evaluations_de_performances`
  ADD PRIMARY KEY (`id_evaluation`);

--
-- Indexes for table `gs_employes`
--
ALTER TABLE `gs_employes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tel` (`tel`),
  ADD UNIQUE KEY `email` (`email`) USING HASH,
  ADD UNIQUE KEY `numero_securite_sociale` (`numero_securite_sociale`) USING HASH;

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions_evaluation`
--
ALTER TABLE `questions_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reponse_evaluation`
--
ALTER TABLE `reponse_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conges`
--
ALTER TABLE `conges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `dossiers_du_personnels`
--
ALTER TABLE `dossiers_du_personnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `evaluationpoints`
--
ALTER TABLE `evaluationpoints`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `evaluations_de_performances`
--
ALTER TABLE `evaluations_de_performances`
  MODIFY `id_evaluation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_employes`
--
ALTER TABLE `gs_employes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questions_evaluation`
--
ALTER TABLE `questions_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reponse_evaluation`
--
ALTER TABLE `reponse_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
