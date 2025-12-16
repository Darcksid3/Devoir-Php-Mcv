USE `covoiturage_interne`;
/* Suppression des utilisateurs s'ils existent*/
DROP USER IF EXISTS 'registration_service'@'localhost';
DROP USER IF EXISTS 'utilisateur_app'@'localhost';
DROP USER IF EXISTS 'admin_app'@'localhost';


-- On s'assure que tous les comptes existent
CREATE USER 'registration_service'@'localhost' IDENTIFIED BY 'motdepasse_service_fort';
CREATE USER 'utilisateur_app'@'localhost' IDENTIFIED BY 'motdepasse_utilisateur_app';
CREATE USER 'admin_app'@'localhost' IDENTIFIED BY 'motdepasse_admin_app';

-- ----------------------------------------------------------------------
-- 1. PRIVILÈGES DU SERVICE D'ENREGISTREMENT (Connexion 1)
-- ----------------------------------------------------------------------

-- Accorde uniquement le droit de lecture sur la table de l'entreprise (utilisateur)
GRANT SELECT ON `covoiturage_interne`.`utilisateur` TO 'registration_service'@'localhost';

-- Accorde le droit d'écrire dans la table de mot de passe du projet
GRANT INSERT ON `covoiturage_interne`.`utilisateur_enregistre` TO 'registration_service'@'localhost';

-- Pas de droits d'UPDATE, DELETE ou SELECT sur utilisateur_enregistre (hormis l'INSERT)

-- ----------------------------------------------------------------------
-- 2. PRIVILÈGES DE L'ADMINISTRATEUR (Connexion 2)
-- ----------------------------------------------------------------------

-- Confirme qu'AUCUN DROIT n'est donné sur utilisateur et utilisateur_enregistre
-- L'admin est limité à l'administration du projet (trajets et villes)
GRANT ALL PRIVILEGES ON `covoiturage_interne`.`ville` TO 'admin_app'@'localhost';
GRANT ALL PRIVILEGES ON `covoiturage_interne`.`trajet` TO 'admin_app'@'localhost';

-- ----------------------------------------------------------------------
-- 3. PRIVILÈGES DE L'UTILISATEUR STANDARD (Connexion 3)
-- ----------------------------------------------------------------------

-- L'utilisateur standard a seulement besoin de SELECT (lecture) sur les tables du projet
-- et de droits complets sur ses propres trajets.

-- L'utilisateur N'A PAS de droit sur utilisateur.
-- Il a besoin de droits sur villes pour l'affichage des listes de villes
GRANT SELECT ON `covoiturage_interne`.`ville` TO 'utilisateur_app'@'localhost';

-- Droits de base sur les trajets (gestion par le code PHP pour la condition 'si créateur')
GRANT SELECT, INSERT, UPDATE, DELETE ON `covoiturage_interne`.`trajet` TO 'utilisateur_app'@'localhost';

-- ----------------------------------------------------------------------
-- 4. FINALISATION
-- ----------------------------------------------------------------------
FLUSH PRIVILEGES;