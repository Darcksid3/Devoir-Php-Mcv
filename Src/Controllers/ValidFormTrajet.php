<?php
namespace App\Controllers;

use App\Db\DbAddService;
use App\Db\DbUpdateService;
use App\Service\RecupId;
use DateTime;
use DateTimeZone;


//* Récupération des informations du formulaire de trajet.

$post = [];
$post = $_POST;

//* Début des fonctions traitement des données

/**
* Vérification que les villes sélèctionné soit diférentes
*
* @param string $villeD Ville de départ.
* @param string $villeA Ville d'arrivée.
* @return void renvoie l'utilisateur azu formulaire si les villes sont identiques.
*/
function verifVille($villeD, $villeA, string $header) {
if($villeD === $villeA) {
    $_SESSION['tempDATA'] = $_POST;
    $_SESSION['message'] = '<div class="msg msg-err">Les ville de départ et d\'arrivée doivent être différentes.</div>';
    header($header);
    exit();
    }
};

/**
* Vérification que les dates soient cohérentes.
*
* @param string $dateD Date de départ.
* @param string $dateA Date d'arrivée.
* @return true Renvoie toujours true si le script n'est pas interrompu.
*/
function verifDate(string $dateD, string $dateA, string $header): bool {
    $dateA = new DateTime($dateA);
    $dateD = new DateTime($dateD);
    if($dateA < $dateD) {
        $_SESSION['tempDATA'] = $_POST;
        $_SESSION['message'] = '<div class="msg msg-err">L\'arrivée ne peut pas se situer avant le départ.</div>';
        
        header($header);
        exit();
    } 
    return true;
    
};

/**
* Vérification que le nombre de place disponible ne soit pas supérieur au nombre de place totale.
*
* @param int $placeD Nombre de place disponible.
* @param int $placeT Nombre de place totale.
* @return void Renvoie l'utilisateur au formulaire si il y as incohérence dans les places.
*/
function verifPlace ($placeD, $placeT, string $header) {
    if ($placeD > $placeT) {
        $_SESSION['tempDATA'] = $_POST;
        $_SESSION['message'] = '<div class="msg msg-err">Le nombre de place disponible ne peut pas etre supérieur au nombre de place totale.</div>';
        header($header);
        exit();
    } 
};

/**
* Génération du format GDH en fonction de la date et de l'heure envoyait
* @param string $date
* @param string $timezone (internationale)
* @return string le GDH formaté pour la BDD
*/
function generateGDH(string $date, string $timezone = "UTC"): string {
    $dt = new DateTime($date, new DateTimeZone((string) $timezone));
    
    // Format : Jour(2) + Heure(2) + Min(2) + Zone(1) + " " + Mois(3) + " " + Année(2)
    // On met le mois en majuscules (strtoupper)
    return strtoupper($dt->format('dHi\Z M y'));
}

//* Fin des fonctions traitement des données

/**
* Validation du formulaire de création detrajet.
*
* @param array<mixed> $post Données du formulaire.
* @return bool renvoie toujours true redirige l'utilisateur en cas de succes.
*/
function verifFormTrajet(array $post): bool {
    if ($post['action'] !== 'delete') {

        if ($post['action'] === 'create') {
            $header = 'Location: /FormTrajet';
            $post['depart_gdh'] = generateGDH($post['depart_date']);
            $post['arrive_gdh'] = generateGDH($post['arrive_date']);

            //* Lancement des vérifications
            verifVille($post['depart_ville'], $post['arrive_ville'], $header);
            verifDate($post['depart_date'], $post['arrive_date'], $header);
            verifPlace($post['place_disponible'], $post['place_totale'], $header);

            $add = new DbAddService();
            $add->addTrajet($post);
            $_SESSION['message'] = '<div class="msg msg-ok">Trajet crée avec succes</div>';
            header('Location: /');
            exit();
        } else {
            //Récupération de l'id
            $recupId = new RecupId();
            $id = $recupId->recupId($_SERVER['REQUEST_URI']);
            $header = 'Location: /FormTrajet/'.$id;
            
            $post['depart_gdh'] = generateGDH($post['depart_date']);
            $post['arrive_gdh'] = generateGDH($post['arrive_date']);

            //* Lancement des vérifications
            verifVille($post['depart_ville'], $post['arrive_ville'], $header);
            verifDate($post['depart_date'], $post['arrive_date'], $header);
            verifPlace($post['place_disponible'], $post['place_totale'], $header);
            $update = new DbUpdateService();
            $update->updateTrajet($post);
            $_SESSION['message'] = '<div class="msg msg-ok">Trajet Modifier avec succes</div>';
            header('Location: /');
            exit();
        }  
    } else {
        //Récupération de l'id
        $recupId = new RecupId();
        $id = $recupId->recupId($_SERVER['REQUEST_URI']);

        if ($id === null) {
            Header('Location: /');
            exit();
        }
        
        header('Location: /DeleteTrajet/'.$id.'');
        exit();
    }

};

verifFormTrajet($post);


?>