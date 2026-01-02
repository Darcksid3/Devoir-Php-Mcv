<?php 

//chargement de l'autoload de composer
require __DIR__ . '/vendor/autoload.php';

//chargement des variables d'environement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Démarrage de la session si pas déjà démarrée
// utilité actuelle : gestion des messages erreur
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//* Routeur simple utilisant la fonction match() de PHP 8
//récupération de l'url demandée
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//récupération de la méthode demandée
$method = $_SERVER['REQUEST_METHOD'];

//mise en place du path final
$finalpath = "{$method}:{$path}";

//* Mise en place du routeur
$callable = match($finalpath) {
    'GET:/' => function() {
        require __DIR__ . '/src/Pages/Home.php';
    },
    //* FORMULAIRES
    // Inscription
    'GET:/FormInscript' => function() {
        require __DIR__ . '/src/Pages/forms/formInscript.php';
    },
    'POST:/ValidFormInscript' => function() {;
        require __DIR__ . '/src/Controllers/ValidFormInscript.php';
    },
    // Connexion
    'GET:/FormConnect' => function() {
        require __DIR__ . '/src/Pages/Forms/FormConnect.php';
    },
    'POST:/ValidFormConnect' => function() {
        require __DIR__ . '/src/Controllers/ValidFormConnect.php';
    },
    // Trajets
    'GET:/FormTrajet' => function() {
        require __DIR__ . '/src/Pages/Forms/FormTrajet.php';
    },
    'POST:/ValidFormTrajet' => function() {
        // 1. Récupèration l'action demandée via le bouton
        $action = $_POST['action'] ?? 'default';

        // 2. Aiguillage vers le bon service ou la bonne logique
        match($action) {
            'create' => require __DIR__ . '/src/services/CreateTrajetService.php',
            'update' => require __DIR__ . '/src/services/UpdateTrajetService.php',
            'delete' => require __DIR__ . '/src/services/DeleteTrajetService.php',
            default  => die("Action non reconnue"),
        };
    },
    //* Administration
    // Dashboard Admin
    'GET:/DashboardAdmin' => function() {
        require __DIR__ . '/src/Pages/Admin/DashboardAdmin.php';
    },
    // Gestion de success test des formulaires
    'GET:/Success' => function() {
        require __DIR__ . '/src/Pages/Success.php';
    },
    // Gestion de la deconnexion
    'GET:/Deconnexion' => function() {
        require __DIR__ . '/src/Service/Deconnexion.php';
    },
    // Pages d'affichage des test
    'GET:/TestView' => function() {
        require __DIR__ . '/src/Pages/TestView.php';
    },
    default => function () {
        echo '404.php';
    },

};
$callable();

?>