-- Crée la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS `Covoiturage_Interne`;

-- Sélectionne la base de données pour les opérations suivantes
USE `Covoiturage_Interne`;

CREATE TABLE IF NOT EXISTS `ville` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `utilisateur` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `nom` VARCHAR(100) NOT NULL,
    `prenom` VARCHAR(100) NOT NULL,
    `telephone` VARCHAR(20) NULL, -- Le numéro de téléphone peut être facultatif
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `utilisateur_enregistre` (
    -- La clé primaire est l'ID de l'utilisateur de base
    `utilisateur_id` INT UNSIGNED NOT NULL, 
    `password_hash` VARCHAR(255) NOT NULL, -- Stocke le hash du mot de passe (JAMAIS en clair!)
    `status` ENUM('utilisateur', 'admin') NOT NULL DEFAULT 'utilisateur', -- Statut (utilisateur ou admin)
    
    PRIMARY KEY (`utilisateur_id`),
    
    -- Clé étrangère vers la table `utilisateurs` (on delete cascade)
    FOREIGN KEY (`utilisateur_id`)
        REFERENCES `utilisateurs` (`id`)
        ON DELETE CASCADE -- Si l'utilisateur de base est supprimé, cette entrée est aussi supprimée
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `trajet` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    
    -- Clé étrangère vers la table `ville` pour la ville de départ
    `depart_ville_id` INT UNSIGNED NOT NULL,
    
    `depart_date` DATE NOT NULL,
    `depart_heure` heure NOT NULL,
    
    -- Clé étrangère vers la table `ville` pour la ville d'arrivée
    `arrive_ville_id` INT UNSIGNED NOT NULL,
    
    `arrive_date` DATE NOT NULL,
    `arrive_heure` heure NOT NULL,
    
    -- Clé étrangère vers la table `utilisateurs` (le créateur du trajet)
    `createur_id` INT UNSIGNED NOT NULL, 
    
    PRIMARY KEY (`id`),
    
    -- Contrainte pour la ville de départ
    FOREIGN KEY (`depart_ville_id`)
        REFERENCES `ville` (`id`)
        ON UPDATE CASCADE ON DELETE RESTRICT, -- RESTRICT empêche la suppression d'une ville si elle est utilisée dans un trajet
        
    -- Contrainte pour la ville d'arrivée
    FOREIGN KEY (`arrive_ville_id`)
        REFERENCES `ville` (`id`)
        ON UPDATE CASCADE ON DELETE RESTRICT,
        
    -- Contrainte pour le créateur du trajet
    FOREIGN KEY (`createur_id`)
        REFERENCES `utilisateurs` (`id`)
        ON UPDATE CASCADE ON DELETE RESTRICT -- RESTRICT empêche la suppression d'un utilisateur tant qu'il est créateur d'un trajet
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;