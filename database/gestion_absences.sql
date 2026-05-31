-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 02:25 AM
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
-- Database: `gestion_absences02`
--

-- --------------------------------------------------------

--
-- Table structure for table `emploi_absences`
--

CREATE TABLE `emploi_absences` (
  `absence_id` int(11) UNSIGNED NOT NULL,
  `emploi_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `absence_val` int(1) UNSIGNED NOT NULL DEFAULT 1,
  `absence_date` date NOT NULL DEFAULT current_timestamp(),
  `absence_observation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_absences`
--

INSERT INTO `emploi_absences` (`absence_id`, `emploi_id`, `user_id`, `absence_val`, `absence_date`, `absence_observation`) VALUES
(1, 4, 3, 1, '2025-06-25', 'ok 25'),
(2, 4, 3, 1, '2025-06-26', 'ok 26');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_annees`
--

CREATE TABLE `emploi_annees` (
  `annee_id` int(11) UNSIGNED NOT NULL,
  `annee_nom` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_annees`
--

INSERT INTO `emploi_annees` (`annee_id`, `annee_nom`) VALUES
(1, '2025-2026');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_cles`
--

CREATE TABLE `emploi_cles` (
  `cle_id` int(11) UNSIGNED NOT NULL,
  `salle_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `cle_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cle_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_cles`
--

INSERT INTO `emploi_cles` (`cle_id`, `salle_id`, `user_id`, `cle_date`, `cle_status`) VALUES
(1, 1, 2, '2026-05-15 15:44:22', '0'),
(2, 1, 2, '2026-05-15 15:44:43', '0'),
(4, 2, 2, '2026-05-15 15:51:58', '1');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_cycles`
--

CREATE TABLE `emploi_cycles` (
  `cycle_id` int(11) UNSIGNED NOT NULL,
  `cycle_nom` varchar(300) NOT NULL,
  `cycle_nbr_semstre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `emploi_cycles`
--

INSERT INTO `emploi_cycles` (`cycle_id`, `cycle_nom`, `cycle_nbr_semstre`) VALUES
(1, 'Licence', 6),
(2, 'Master', 4),
(3, 'Dcotorat', 4),
(4, 'Ingenieur', 10);

-- --------------------------------------------------------

--
-- Table structure for table `emploi_departements`
--

CREATE TABLE `emploi_departements` (
  `departement_id` int(11) UNSIGNED NOT NULL,
  `departement_nom` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_departements`
--

INSERT INTO `emploi_departements` (`departement_id`, `departement_nom`) VALUES
(1, 'Mathematics & Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_emplois`
--

CREATE TABLE `emploi_emplois` (
  `emploi_id` int(11) UNSIGNED NOT NULL,
  `enseignant_id` int(11) UNSIGNED NOT NULL,
  `module_id` int(11) UNSIGNED NOT NULL,
  `emploi_jour` enum('Samdi','Dimanch','Lundi','Mardi','Mercredi','Jeudi') NOT NULL,
  `emploi_temp` varchar(50) NOT NULL,
  `groupe_id` int(11) UNSIGNED NOT NULL,
  `salle_id` int(11) UNSIGNED NOT NULL,
  `emploi_date` varchar(10) NOT NULL,
  `emploi_type` enum('cour','td','tp') NOT NULL,
  `emploi_annee_univ` varchar(50) NOT NULL,
  `emploi_semestre` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_emplois`
--

INSERT INTO `emploi_emplois` (`emploi_id`, `enseignant_id`, `module_id`, `emploi_jour`, `emploi_temp`, `groupe_id`, `salle_id`, `emploi_date`, `emploi_type`, `emploi_annee_univ`, `emploi_semestre`) VALUES
(1, 3, 2, 'Dimanch', '10:00-11:30', 3, 3, '', 'cour', '2025-2026', 2),
(2, 2, 1, 'Dimanch', '09:30-11:10:00-11:30', 4, 2, '', 'cour', '2025-2026', 1),
(4, 2, 1, 'Lundi', '08:30-10:00', 1, 1, '', 'cour', '2025-2026', 1),
(8, 1, 1, 'Mardi', '10:00-11:30', 1, 1, '', 'td', '2025-2026', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emploi_filieres`
--

CREATE TABLE `emploi_filieres` (
  `filiere_id` int(11) UNSIGNED NOT NULL,
  `departement_id` int(11) UNSIGNED NOT NULL,
  `filiere_nom` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_filieres`
--

INSERT INTO `emploi_filieres` (`filiere_id`, `departement_id`, `filiere_nom`) VALUES
(1, 1, 'Mathematics & Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_groupes`
--

CREATE TABLE `emploi_groupes` (
  `groupe_id` int(11) UNSIGNED NOT NULL,
  `section_num` int(11) UNSIGNED NOT NULL,
  `specialite_id` int(11) UNSIGNED NOT NULL,
  `groupe_nom` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_groupes`
--

INSERT INTO `emploi_groupes` (`groupe_id`, `section_num`, `specialite_id`, `groupe_nom`) VALUES
(1, 2, 1, 'groupe 1'),
(3, 1, 1, 'groupe 2'),
(4, 1, 2, 'groupe 01');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_materials`
--

CREATE TABLE `emploi_materials` (
  `material_id` int(11) UNSIGNED NOT NULL,
  `salle_id` int(11) UNSIGNED NOT NULL,
  `material_nom` varchar(300) NOT NULL,
  `material_mat` varchar(20) NOT NULL,
  `material_etat` enum('disponible','non-disonible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_materials`
--

INSERT INTO `emploi_materials` (`material_id`, `salle_id`, `material_nom`, `material_mat`, `material_etat`) VALUES
(1, 2, 'material 01', '1212', 'disponible');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_modules`
--

CREATE TABLE `emploi_modules` (
  `module_id` int(11) UNSIGNED NOT NULL,
  `specialite_id` int(11) UNSIGNED NOT NULL,
  `module_nom` varchar(300) NOT NULL,
  `module_semestre` int(1) UNSIGNED NOT NULL,
  `module_coef` int(2) UNSIGNED NOT NULL,
  `module_credit` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_modules`
--

INSERT INTO `emploi_modules` (`module_id`, `specialite_id`, `module_nom`, `module_semestre`, `module_coef`, `module_credit`) VALUES
(1, 1, 'Data Structures & Algorithms 1', 1, 5, 6),
(2, 1, 'Computer Structure', 1, 4, 6),
(3, 1, 'Intro. to Operating Systems 1', 1, 3, 4),
(4, 1, 'Mathematical Analysis 1', 1, 3, 6),
(5, 1, 'Algebra 1', 1, 3, 3),
(6, 1, 'Fundamental Electronics', 1, 1, 3),
(7, 1, 'Written Expression Techniques', 1, 1, 2),
(8, 1, 'Data Structures & Algorithms 2', 2, 4, 6),
(9, 1, 'Computer Architecture', 2, 4, 6),
(10, 1, 'Mathematical Analysis 2', 2, 3, 6),
(11, 1, 'Algebra 2', 2, 3, 3),
(12, 1, 'Mathematical Logic', 2, 3, 3),
(13, 1, 'Probability & Statistics 1', 2, 2, 4),
(14, 1, 'Oral Expression Techniques', 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `emploi_reclaramations`
--

CREATE TABLE `emploi_reclaramations` (
  `reclaramation_id` int(11) UNSIGNED NOT NULL,
  `reclaramation_sujet` varchar(250) NOT NULL,
  `reclaramation_content` text NOT NULL,
  `reclaramation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_reclaramations`
--

INSERT INTO `emploi_reclaramations` (`reclaramation_id`, `reclaramation_sujet`, `reclaramation_content`, `reclaramation_date`) VALUES
(2, 'fg', 'fg2222', '2026-05-21 12:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_salles`
--

CREATE TABLE `emploi_salles` (
  `salle_id` int(11) UNSIGNED NOT NULL,
  `salle_nom` varchar(300) NOT NULL,
  `salle_capacite` int(5) UNSIGNED NOT NULL,
  `salle_type` enum('cour','td','tp') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_salles`
--

INSERT INTO `emploi_salles` (`salle_id`, `salle_nom`, `salle_capacite`, `salle_type`) VALUES
(1, 'Ampphi 1', 200, 'td'),
(2, 'Salle 1', 40, 'td'),
(3, 'salle tp 1', 10, 'tp'),
(4, 'Ampphi 2', 200, 'cour');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_specialites`
--

CREATE TABLE `emploi_specialites` (
  `specialite_id` int(11) UNSIGNED NOT NULL,
  `filiere_id` int(11) UNSIGNED NOT NULL,
  `specialite_nom` varchar(300) NOT NULL,
  `cycle_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_specialites`
--

INSERT INTO `emploi_specialites` (`specialite_id`, `filiere_id`, `specialite_nom`, `cycle_id`) VALUES
(1, 1, '1st year Engineer', 4),
(2, 1, '2nd year Engineer', 4);

-- --------------------------------------------------------

--
-- Table structure for table `emploi_users`
--

CREATE TABLE `emploi_users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `departement_id` int(11) UNSIGNED NOT NULL,
  `groupe_id` int(11) UNSIGNED NOT NULL,
  `user_login` varchar(50) DEFAULT '',
  `user_prenom` varchar(50) DEFAULT '',
  `user_nom` varchar(50) DEFAULT '',
  `user_date_naissance` varchar(10) DEFAULT '0000-00-00',
  `user_email` varchar(50) DEFAULT '',
  `user_phone` varchar(50) DEFAULT '',
  `user_pass` varchar(32) NOT NULL,
  `user_civilite` varchar(300) NOT NULL,
  `user_grade` varchar(300) NOT NULL,
  `user_type` enum('admin','agent','enseignant','etudiant','technicien') NOT NULL DEFAULT 'agent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `emploi_users`
--

INSERT INTO `emploi_users` (`user_id`, `departement_id`, `groupe_id`, `user_login`, `user_prenom`, `user_nom`, `user_date_naissance`, `user_email`, `user_phone`, `user_pass`, `user_civilite`, `user_grade`, `user_type`) VALUES
(1, 3, 0, 'admin', 'admin', 'admin', '1994-01-01', 'admin@gmail.com', '+213550505050', 'admin', 'Mr', '', 'admin'),
(2, 3, 0, 'eng1', 'enseignant 01', 'enseignant 01', '1994-02-01', 'eng1@gmail.com', '+21350000000', 'eng1', 'Mr', '', 'enseignant'),
(3, 1, 1, 'etu01', 'etudiant 01', 'etudiant 01', '1994-02-01', 'eng2@gmail.com', '+21350000000', 'etu01', 'Mr', '', 'etudiant'),
(4, 1, 1, 'agent', 'agent', 'agent', '2000-02-01', 'agent@gmail.com', '+21350000000', 'agent', 'Mr', '', 'agent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emploi_absences`
--
ALTER TABLE `emploi_absences`
  ADD PRIMARY KEY (`absence_id`),
  ADD KEY `emploi_id` (`emploi_id`);

--
-- Indexes for table `emploi_annees`
--
ALTER TABLE `emploi_annees`
  ADD PRIMARY KEY (`annee_id`);

--
-- Indexes for table `emploi_cles`
--
ALTER TABLE `emploi_cles`
  ADD PRIMARY KEY (`cle_id`);

--
-- Indexes for table `emploi_cycles`
--
ALTER TABLE `emploi_cycles`
  ADD PRIMARY KEY (`cycle_id`);

--
-- Indexes for table `emploi_departements`
--
ALTER TABLE `emploi_departements`
  ADD PRIMARY KEY (`departement_id`);

--
-- Indexes for table `emploi_emplois`
--
ALTER TABLE `emploi_emplois`
  ADD PRIMARY KEY (`emploi_id`),
  ADD UNIQUE KEY `my_condition` (`emploi_jour`,`emploi_temp`,`groupe_id`,`salle_id`) USING BTREE,
  ADD KEY `enseignant_id` (`enseignant_id`),
  ADD KEY `groupe_id` (`groupe_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `salle_id` (`salle_id`);

--
-- Indexes for table `emploi_filieres`
--
ALTER TABLE `emploi_filieres`
  ADD PRIMARY KEY (`filiere_id`),
  ADD KEY `departement_id` (`departement_id`);

--
-- Indexes for table `emploi_groupes`
--
ALTER TABLE `emploi_groupes`
  ADD PRIMARY KEY (`groupe_id`),
  ADD KEY `specialite_id` (`specialite_id`);

--
-- Indexes for table `emploi_materials`
--
ALTER TABLE `emploi_materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `salle_id` (`salle_id`);

--
-- Indexes for table `emploi_modules`
--
ALTER TABLE `emploi_modules`
  ADD PRIMARY KEY (`module_id`),
  ADD KEY `specialite_id` (`specialite_id`);

--
-- Indexes for table `emploi_reclaramations`
--
ALTER TABLE `emploi_reclaramations`
  ADD PRIMARY KEY (`reclaramation_id`);

--
-- Indexes for table `emploi_salles`
--
ALTER TABLE `emploi_salles`
  ADD PRIMARY KEY (`salle_id`);

--
-- Indexes for table `emploi_specialites`
--
ALTER TABLE `emploi_specialites`
  ADD PRIMARY KEY (`specialite_id`),
  ADD KEY `cycle_id` (`cycle_id`),
  ADD KEY `filiere_id` (`filiere_id`);

--
-- Indexes for table `emploi_users`
--
ALTER TABLE `emploi_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emploi_absences`
--
ALTER TABLE `emploi_absences`
  MODIFY `absence_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emploi_annees`
--
ALTER TABLE `emploi_annees`
  MODIFY `annee_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emploi_cles`
--
ALTER TABLE `emploi_cles`
  MODIFY `cle_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emploi_cycles`
--
ALTER TABLE `emploi_cycles`
  MODIFY `cycle_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emploi_departements`
--
ALTER TABLE `emploi_departements`
  MODIFY `departement_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emploi_emplois`
--
ALTER TABLE `emploi_emplois`
  MODIFY `emploi_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `emploi_filieres`
--
ALTER TABLE `emploi_filieres`
  MODIFY `filiere_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emploi_groupes`
--
ALTER TABLE `emploi_groupes`
  MODIFY `groupe_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emploi_materials`
--
ALTER TABLE `emploi_materials`
  MODIFY `material_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emploi_modules`
--
ALTER TABLE `emploi_modules`
  MODIFY `module_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `emploi_reclaramations`
--
ALTER TABLE `emploi_reclaramations`
  MODIFY `reclaramation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emploi_salles`
--
ALTER TABLE `emploi_salles`
  MODIFY `salle_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emploi_specialites`
--
ALTER TABLE `emploi_specialites`
  MODIFY `specialite_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `emploi_users`
--
ALTER TABLE `emploi_users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
