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


function dynamicPath($path,$finalpath, &$matches ) {
    $patch = preg_replace('#\{[a-z]+\}#i', '([^/]+)?', $path);
    return preg_match("#^{$patch}$#", $finalpath, $matches) >= 1 ? $finalpath : '///';
}

//* Mise en place du routeur
$callable = match($finalpath) {
    'GET:/' => function() {
        require __DIR__ . '/Src/Pages/Home.php';
    },
    //* FORMULAIRES
    // Inscription
    'GET:/FormInscript' => function() {
        require __DIR__ . '/Src/Pages/Forms/FormInscript.php';
    },
    'POST:/ValidFormInscript' => function() {;
        require __DIR__ . '/Src/Controllers/ValidFormInscript.php';
    },
    // Connexion
    'GET:/FormConnect' => function() {
        require __DIR__ . '/Src/Pages/Forms/FormConnect.php';
    },
    'POST:/ValidFormConnect' => function() {
        require __DIR__ . '/Src/Controllers/ValidFormConnect.php';
    },
    // Trajets
    
    'GET:/FormTrajet' => function() {
        require __DIR__ . '/Src/Pages/Forms/FormTrajet.php';
    },
    dynamicPath('POST:/ValidFormTrajet/{id}', $finalpath, $matches) => function () use ($matches)  {
        require __DIR__ . '/Src/Controllers/ValidFormTrajet.php';
    },
    'POST:/ValidFormTrajet' => function() {
        require __DIR__ . '/Src/Controllers/ValidFormTrajet.php';    
    },
    dynamicPath('GET:/FormTrajet/{id}', $finalpath, $matches) => function () use ($matches)  {
        require __DIR__ . '/Src/Pages/Forms/FormTrajet.php';
    },
    dynamicPath('GET:/ValidDeleteTrajet/{id}', $finalpath, $matches) => function () use ($matches)  {
        require __DIR__ . '/Src/Controllers/ValidDeleteTrajet.php';
    }, 
    dynamicPath('GET:/DeleteTrajet/{id}', $finalpath, $matches) => function () use ($matches)  {
        require __DIR__ . '/Src/Pages/DeleteTrajet.php';
    },

    //* Administration
    // Dashboard Admin
    'GET:/DashboardAdmin' => function() {
        require __DIR__ . '/Src/Pages/Admin/DashboardAdmin.php';
    },
    'GET:/ListeUtilisateur' => function() {
        require __DIR__ . '/Src/Pages/Admin/ListeUtilisateur.php';
    },
    'GET:/FormAgence' => function() {
        require __DIR__ . '/Src/Pages/Admin/FormAgence.php';
    },
    'GET:/ListeTrajet' => function() {
        require __DIR__ . '/Src/Pages/Admin/ListeTrajet.php';
    },
    'POST:/ValidFormAgence' => function() {
        require __DIR__ . '/Src/Pages/Admin/ValidFormAgence.php';
    },
    // Gestion de success test des formulaires
    'GET:/Success' => function() {
        require __DIR__ . '/Src/Pages/Success.php';
    },
    // Modale
    'POST:/Modale' => function() {
        require __DIR__ . '/Src/Service/Modale.php';
    },
    dynamicPath('POST:/Modale/{id}', $finalpath, $matches) => function () use ($matches) {
        require __DIR__ . '/Src/Service/Modale.php';
    },
    // Gestion de la deconnexion
    'GET:/Deconnexion' => function() {
        require __DIR__ . '/Src/Service/Deconnexion.php';
    },
    // Pages d'affichage des test
    'GET:/TestView' => function() {
        require __DIR__ . '/Src/Pages/TestView.php';
    },
    default => function () {
        require __DIR__ . '/Src/Pages/PageInconnue.php';
    },

};
$callable();

?>