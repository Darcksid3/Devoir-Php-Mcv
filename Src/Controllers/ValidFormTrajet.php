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
// Fonction de traitement des informations reçues

/**
* Vérification que les villes sélèctionné soit diférentes
*
* @param string $villeD Ville de départ.
* @param string $villeA Ville d'arrivée.
* @return void. renvoie l'utilisateur azu formulaire si les villes sont identiques.
*/
function verifVille($villeD, $villeA, $header) {
if($villeD === $villeA) {
    $header = 'Location: /FormTrajet';
    $_SESSION['message'] = "Les ville de départ et d'arrivée doivent être différentes.";
    header($header);
    exit();
    }
};

/**
* Vérification que les dates soient cohérentes.
*
* @param string $dateD Date de départ.
* @param string $dateA Date d'arrivée.
* @return void. renvoie l'utilisateur au formulaire si la date d'arrivée est inférieure à la date de départ.
*/
function verifDate($dateD, $dateA, $header) {
    $dateA = new DateTime($dateA);
    $dateD = new DateTime($dateD);
    if($dateA < $dateD) {
        $_SESSION['message'] = "L'arrivée ne peut pas se situer avant le départ.";
        
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
* @return void. Renvoie l'utilisateur au formulaire si il y as incohérence dans les places.
*/
function verifPlace ($placeD, $placeT, $header) {
    if ($placeD > $placeT) {
        $_SESSION['message'] = "Le nombre de place disponible ne peut pas etre supérieur au nombre de place totale.";
        header($header);
        exit();
    } 
};

function generateGDH($date, $timezone = "UTC") {
    $dt = new DateTime($date, new DateTimeZone($timezone));
    
    // Format : Jour(2) + Heure(2) + Min(2) + Zone(1) + " " + Mois(3) + " " + Année(2)
    // On met le mois en majuscules (strtoupper)
    return strtoupper($dt->format('dHi\Z M y'));
}

// Fin des fonctions de traitement des informations reçues

/**
* Validation du formulaire de création detrajet.
*
* @param array $post Données du formulaire.
* @return void. Ajoute le trajet en base de donnée et redirige l'utilisateur en cas de succes.
*/
function verifFormTrajet($post) {
    if ($post['action'] !== 'delete') {

        if ($post['action'] === 'create') {
            $header = 'Location: /FormTrajet';
            $post['depart_gdh'] = generateGDH($post['depart_date']);
            $post['arrive_gdh'] = generateGDH($post['arrive_date']);

            verifVille($post['depart_ville'], $post['arrive_ville'], $header);
            verifDate($post['depart_date'], $post['arrive_date'], $header);
            verifPlace($post['place_disponible'], $post['place_totale'], $header);
            $add = new DbAddService();
            $add->addTrajet($post);
            $_SESSION['message'] = "Trajet crée avec succes";
            header('Location: /');
            exit();
        } else {
            //Récupération de l'id
            $recupId = new RecupId();
            $id = $recupId->recupId($_SERVER['REQUEST_URI']);
            $header = 'Location: /FormTrajet/'.$id;
            
            $post['depart_gdh'] = generateGDH($post['depart_date']);
            $post['arrive_gdh'] = generateGDH($post['arrive_date']);
            verifVille($post['depart_ville'], $post['arrive_ville'], $header);
            verifDate($post['depart_date'], $post['arrive_date'], $header);
            verifPlace($post['place_disponible'], $post['place_totale'], $header);
            $update = new DbUpdateService();
            $update->updateTrajet($post);
            $_SESSION['message'] = "Trajet Modifier avec succes";
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