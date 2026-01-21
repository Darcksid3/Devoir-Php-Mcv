-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 21, 2026 at 08:15 AM
-- Server version: 11.8.3-MariaDB
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covoiturage_interne`
--
CREATE DATABASE IF NOT EXISTS `test_covoiturage_interne` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci;
USE `test_covoiturage_interne`;

-- --------------------------------------------------------

--
-- Table structure for table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
CREATE TABLE IF NOT EXISTS `trajet` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `depart_ville_id` int(10) UNSIGNED NOT NULL,
  `depart_gdh` varchar(15) NOT NULL,
  `depart_date` datetime NOT NULL,
  `arrive_ville_id` int(10) UNSIGNED NOT NULL,
  `arrive_gdh` varchar(15) NOT NULL,
  `arrive_date` datetime NOT NULL,
  `place_totale` int(11) NOT NULL,
  `place_disponible` int(11) NOT NULL,
  `createur_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `depart_ville_id` (`depart_ville_id`),
  KEY `arrive_ville_id` (`arrive_ville_id`),
  KEY `createur_id` (`createur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `trajet`
--

INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(2, 9, '161426Z JAN 26', '2026-01-16 14:26:00', 4, '161626Z JAN 26', '2026-01-16 16:26:00', 4, 0, 1);
INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(3, 10, '211300Z JAN 26', '2026-01-21 13:00:00', 1, '211600Z JAN 26', '2026-01-21 16:00:00', 3, 2, 2);
INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(4, 9, '161731Z JAN 26', '2026-01-16 17:31:00', 3, '161831Z JAN 26', '2026-01-16 18:31:00', 4, 4, 1);
INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(5, 9, '291000Z JAN 26', '2026-01-29 10:00:00', 4, '291300Z JAN 26', '2026-01-29 13:00:00', 6, 4, 1);
INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(6, 8, '031000Z FEB 26', '2026-02-03 10:00:00', 5, '031300Z FEB 26', '2026-02-03 13:00:00', 3, 2, 2);
INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(7, 3, '171341Z JAN 26', '2026-01-17 13:41:00', 8, '171441Z JAN 26', '2026-01-17 14:41:00', 4, 2, 3);
INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(8, 4, '280800Z JAN 26', '2026-01-28 08:00:00', 3, '281500Z JAN 26', '2026-01-28 15:00:00', 4, 2, 2);
INSERT INTO `trajet` (`id`, `depart_ville_id`, `depart_gdh`, `depart_date`, `arrive_ville_id`, `arrive_gdh`, `arrive_date`, `place_totale`, `place_disponible`, `createur_id`) VALUES(9, 2, '040800Z FEB 26', '2026-02-04 08:00:00', 9, '041700Z FEB 26', '2026-02-04 17:00:00', 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(1, 'Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(2, 'Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(3, 'Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(4, 'Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(5, 'Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(6, 'Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(7, 'Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(8, 'Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(9, 'Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(10, 'Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(11, 'Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(12, 'Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(13, 'Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(14, 'Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(15, 'Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(16, 'Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(17, 'Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(18, 'Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(19, 'Masson', 'Julie', '0733445566', 'julie.masson@email.fr');
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`) VALUES(20, 'Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur_enregistre`
--

DROP TABLE IF EXISTS `utilisateur_enregistre`;
CREATE TABLE IF NOT EXISTS `utilisateur_enregistre` (
  `utilisateur_id` int(10) UNSIGNED NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` enum('utilisateur','admin') NOT NULL DEFAULT 'utilisateur',
  PRIMARY KEY (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `utilisateur_enregistre`
--

INSERT INTO `utilisateur_enregistre` (`utilisateur_id`, `password_hash`, `status`) VALUES(1, '$2y$10$4F.3YKrjJwEgwfdZlPVdKOVe3O81hcNvw2wBgFmW3Cra9c10tbX0e', 'admin');
INSERT INTO `utilisateur_enregistre` (`utilisateur_id`, `password_hash`, `status`) VALUES(2, '$2y$10$uDOJdI02Pd9J5nW/Qd2yCumOChQQYPMI/FeuELTesEQbo6zjllglC', 'utilisateur');
INSERT INTO `utilisateur_enregistre` (`utilisateur_id`, `password_hash`, `status`) VALUES(3, '$2y$10$FOPTDK5kdpTI.wxlFehFZeotxt8WOmque9bxmoSOhhDlCOmsJppf.', 'utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `ville`
--

INSERT INTO `ville` (`id`, `nom`) VALUES(9, 'Bordeaux');
INSERT INTO `ville` (`id`, `nom`) VALUES(10, 'Lille');
INSERT INTO `ville` (`id`, `nom`) VALUES(2, 'Lyon');
INSERT INTO `ville` (`id`, `nom`) VALUES(3, 'Marseille');
INSERT INTO `ville` (`id`, `nom`) VALUES(8, 'Montpellier');
INSERT INTO `ville` (`id`, `nom`) VALUES(6, 'Nantes');
INSERT INTO `ville` (`id`, `nom`) VALUES(5, 'Nice');
INSERT INTO `ville` (`id`, `nom`) VALUES(1, 'Paris');
INSERT INTO `ville` (`id`, `nom`) VALUES(12, 'Reims');
INSERT INTO `ville` (`id`, `nom`) VALUES(11, 'Rennes');
INSERT INTO `ville` (`id`, `nom`) VALUES(7, 'Strasbourg');
INSERT INTO `ville` (`id`, `nom`) VALUES(4, 'Toulouse');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`depart_ville_id`) REFERENCES `ville` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trajet_ibfk_2` FOREIGN KEY (`arrive_ville_id`) REFERENCES `ville` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `trajet_ibfk_3` FOREIGN KEY (`createur_id`) REFERENCES `utilisateur` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `utilisateur_enregistre`
--
ALTER TABLE `utilisateur_enregistre`
  ADD CONSTRAINT `utilisateur_enregistre_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/* ---------------------------------------------------------------------- */
/* Gestion des utilisateurs pour la base de donnée de test avec PHPUnit   */
/* ---------------------------------------------------------------------- */

/* Suppression des utilisateurs s'ils existent*/
DROP USER IF EXISTS 'r_service'@'localhost';
DROP USER IF EXISTS 'u_app'@'localhost';
DROP USER IF EXISTS 'a_app'@'localhost';

/* On s'assure que tous les comptes existent */
CREATE USER 'r_service'@'localhost' IDENTIFIED BY 'r_service_mdp';
CREATE USER 'u_app'@'localhost' IDENTIFIED BY 'u_app_mdp';
CREATE USER 'a_app'@'localhost' IDENTIFIED BY 'a_app_mdp';

/* ---------------------------------------------------------------------- */
/* 1. PRIVILÈGES DU SERVICE D'ENREGISTREMENT (Connexion 1) */
/* ----------------------------------------------------------------------*/

/* Accorde uniquement le droit de lecture sur la table de l'entreprise (utilisateur) */
GRANT SELECT ON `test_covoiturage_interne`.`utilisateur` TO 'r_service'@'localhost';

/* Accorde le droit d'écrire dans la table de mot de passe du projet */
GRANT INSERT ON `test_covoiturage_interne`.`utilisateur_enregistre` TO 'r_service'@'localhost';

/* Pas de droits d'UPDATE, DELETE ou SELECT sur utilisateur_enregistre (hormis l'INSERT) */

/* ---------------------------------------------------------------------- */
/* 2. PRIVILÈGES DE L'ADMINISTRATEUR (Connexion 2) */
/* ---------------------------------------------------------------------- */



/* L'admin est limité à l'administration du projet (trajets et villes) */
GRANT ALL PRIVILEGES ON `test_covoiturage_interne`.`ville` TO 'a_app'@'localhost';
GRANT ALL PRIVILEGES ON `test_covoiturage_interne`.`trajet` TO 'a_app'@'localhost';
GRANT SELECT ON `test_covoiturage_interne`.`utilisateur_enregistre` TO 'a_app'@'localhost';
GRANT SELECT ON `test_covoiturage_interne`.`utilisateur` TO 'a_app'@'localhost';
/* ---------------------------------------------------------------------- */
/* 3. PRIVILÈGES DE L'UTILISATEUR STANDARD (Connexion 3) */
/* ---------------------------------------------------------------------- */

/* L'utilisateur standard a seulement besoin de SELECT (lecture) sur les tables du projet */
/* et de droits complets sur ses propres trajets. */

/* L'utilisateur N'A PAS de droit sur utilisateur. */
/* Il a besoin de droits sur villes pour l'affichage des listes de villes */
GRANT SELECT ON `test_covoiturage_interne`.`ville` TO 'u_app'@'localhost';
GRANT SELECT ON `test_covoiturage_interne`.`utilisateur_enregistre` TO 'u_app'@'localhost';
/* Droits de base sur les trajets (gestion par le code PHP pour la condition 'si créateur') */
GRANT SELECT, INSERT, UPDATE, DELETE ON `test_covoiturage_interne`.`trajet` TO 'u_app'@'localhost';

/* ---------------------------------------------------------------------- */
/* 4. FINALISATION */
/* ---------------------------------------------------------------------- */
FLUSH PRIVILEGES;