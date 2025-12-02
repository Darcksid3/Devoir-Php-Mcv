USE `Covoiturage_Interne`;

-- On s'assure que tous les comptes existent
CREATE USER IF NOT EXISTS 'registration_service'@'localhost' IDENTIFIED BY 'motdepasse_service_fort';
CREATE USER IF NOT EXISTS 'utilisateur_app'@'localhost' IDENTIFIED BY 'motdepasse_utilisateur_app';
CREATE USER IF NOT EXISTS 'admin_app'@'localhost' IDENTIFIED BY 'motdepasse_admin_app';

-- ----------------------------------------------------------------------
-- 1. PRIVILÈGES DU SERVICE D'ENREGISTREMENT (Connexion 1)
-- ----------------------------------------------------------------------

-- Révoque tout ce qui n'est pas nécessaire
REVOKE ALL PRIVILEGES ON `Covoiturage_Interne`.* FROM 'registration_service'@'localhost';

-- Accorde uniquement le droit de lecture sur la table de l'entreprise (utilisateur)
GRANT SELECT ON `Covoiturage_Interne`.`utilisateur` TO 'registration_service'@'localhost';

-- Accorde le droit d'écrire dans la table de mot de passe du projet
GRANT INSERT ON `Covoiturage_Interne`.`utilisateur_enregistre` TO 'registration_service'@'localhost';

-- Pas de droits d'UPDATE, DELETE ou SELECT sur utilisateur_enregistre (hormis l'INSERT)

-- ----------------------------------------------------------------------
-- 2. PRIVILÈGES DE L'ADMINISTRATEUR (Connexion 2)
-- ----------------------------------------------------------------------

-- Révoque tout ce qui pourrait exister
REVOKE ALL PRIVILEGES ON `Covoiturage_Interne`.* FROM 'admin_app'@'localhost';

-- Confirme qu'AUCUN DROIT n'est donné sur utilisateur et utilisateur_enregistre
-- L'admin est limité à l'administration du projet (trajets et villes)
GRANT ALL PRIVILEGES ON `Covoiturage_Interne`.`ville` TO 'admin_app'@'localhost';
GRANT ALL PRIVILEGES ON `Covoiturage_Interne`.`trajet` TO 'admin_app'@'localhost';

-- ----------------------------------------------------------------------
-- 3. PRIVILÈGES DE L'UTILISATEUR STANDARD (Connexion 3)
-- ----------------------------------------------------------------------

-- Révoque tout ce qui pourrait exister
REVOKE ALL PRIVILEGES ON `Covoiturage_Interne`.* FROM 'utilisateur_app'@'localhost';

-- L'utilisateur standard a seulement besoin de SELECT (lecture) sur les tables du projet
-- et de droits complets sur ses propres trajets.

-- L'utilisateur N'A PAS de droit sur utilisateur.
-- Il a besoin de droits sur villes pour l'affichage des listes de villes
GRANT SELECT ON `Covoiturage_Interne`.`ville` TO 'utilisateur_app'@'localhost';

-- Droits de base sur les trajets (gestion par le code PHP pour la condition 'si créateur')
GRANT SELECT, INSERT, UPDATE, DELETE ON `Covoiturage_Interne`.`trajet` TO 'utilisateur_app'@'localhost';

-- ----------------------------------------------------------------------
-- 4. FINALISATION
-- ----------------------------------------------------------------------
FLUSH PRIVILEGES;