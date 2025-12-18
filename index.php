<?php 

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
        require __DIR__ . '/src/pages/Home.php';
    },
    //* FORMULAIRES
    // Inscription
    'GET:/FormInscript' => function() {
        require __DIR__ . '/src/pages/form/formInscript.php';
    },
    'POST:/ValidFormInscript' => function() {;
        require __DIR__ . '/src/controllers/ValidFormInscript.php';
    },
    // Connexion
    'GET:FormConnect' => function() {
        require __DIR__ . '/src/pages/form/FormConnect.php';
    },
    'POST:/ValidFormConnect' => function() {
        require __DIR__ . '/src/services/ValidFormConnect.php';
    },
    // Trajets
    'GET:/FormTrajet' => function() {
        require __DIR__ . '/src/pages/form/FormTrajet.php';
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
        require __DIR__ . '/src/pages/admin/DashboardAdmin.php';
    },
    // Gestion de success test des formulaires
    'GET:/Success' => function() {
        require __DIR__ . '/src/pages/Success.php';
    },
    default => function () {
        echo '404.php';
    },

};
$callable();

?>