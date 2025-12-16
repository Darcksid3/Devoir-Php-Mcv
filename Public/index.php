<?php 

//* Démarrage l'application PHP apel de l'autoloader Composer
require_once __DIR__ . '/../vendor/autoload.php';


//* Chargement du fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); 
// Assurez-vous que le chemin est correct pour pointer vers le répertoire parent de Public
$dotenv->safeLoad();

use \Router\Router;
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
