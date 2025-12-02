<?php 
//TODO 
// ----------------------------------------------------------------------
// FICHIER: /www/devoir/Public/index.php
// Rôle: Front Controller
// ----------------------------------------------------------------------

// Démarre l'application
require_once __DIR__ . '/../vendor/autoload.php';
// Exemple de récupération de l'URL demandée pour le routage
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';

// Optionnel : Retirer le sous-dossier de base pour obtenir l'URI propre
$base_path = '/devoir/Public';
$uri_to_route = str_replace($base_path, '', $request_uri);

// Assurez-vous d'avoir toujours un slash au début
if (empty($uri_to_route) || $uri_to_route === '/') {
    $uri_to_route = '/';
}

// Exemple de lancement du routeur (cette partie sera développée plus tard)
// echo "Requête traitée pour l'URI: " . htmlspecialchars($uri_to_route);
// $router->dispatch($uri_to_route); 

// Exemple simple de test
echo "<h1>Application Démarrée</h1>";
echo "<p>L'URI demandée à Apache est: <code>" . htmlspecialchars($request_uri) . "</code></p>";
echo "<p>L'URI passée au Routeur est: <code>" . htmlspecialchars($uri_to_route) . "</code></p>";


?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Devoir - Touche Pas Au Klaxon</title>

    </head>
    <body>
        <!-- Insertion du HEADER -->

        <!-- Insertion du FOOTER -->

        <!-- Insertion des scripts Javascript Bootstrap et personel -->
    </body>

</html>