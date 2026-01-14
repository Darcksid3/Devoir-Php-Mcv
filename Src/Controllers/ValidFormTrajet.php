<?php
namespace App\Controllers;

use App\Db\DbAddService;
use App\Db\DbUpdateService;
use App\Service\RecupId;


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
function verifVille($villeD, $villeA) {
if($villeD === $villeA) {
    $_SESSION['message'] = "Les ville de départ et d'arrivée doivent être différentes.";
    header('Location: /FormTrajet');
    exit();
    }
};

/**
* Vérification que les heures et dates soient cohérentes.
*
* @param string $heureD Heure de départ.
* @param string $heureA Heure d'arrivée.
* @return False si l'heure d'arrivée est inférieure ou égale à l'heure de départ. 
*/
function verifHeure($heureD, $heureA) {
    if ($heureA <= $heureD) {
        return false;
    }
};

/**
* Vérification que les dates soient cohérentes.
*
* @param string $dateD Date de départ.
* @param string $dateA Date d'arrivée.
* @return void. renvoie l'utilisateur au formulaire si la date d'arrivée est inférieure à la date de départ.
*/
function verifDate($dateD, $dateA) {
    
    if($dateA < $dateD) {
        $_SESSION['message'] = "La date de d'arrivée ne peut pas se situer avant la date de départ.";
        return $_SESSION['message'];
        header('Location: /FormTrajet');
        exit();
    } else if ($dateA === $dateD) {
        $verif = verifHeure($_POST['heure_depart'], $_POST['heure_arrivee']);
        if ($verif === false) {
            $_SESSION['message'] = "L'heure d'arrivée ne peut pas etre inférieure a l'heure de départ.";
            header('Location: /FormTrajet');
            exit();
        } 
    }
};

/**
* Vérification que le nombre de place disponible ne soit pas supérieur au nombre de place totale.
*
* @param int $placeD Nombre de place disponible.
* @param int $placeT Nombre de place totale.
* @return void. Renvoie l'utilisateur au formulaire si il y as incohérence dans les places.
*/
function verifPlace ($placeD, $placeT) {
    if ($placeD > $placeT) {
        $_SESSION['message'] = "Le nombre de place disponible ne peut pas etre supérieur au nombre de place totale.";
        header('Location: /FormTrajet');
        exit();
    } 
};

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

            verifVille($post['ville_depart'], $post['ville_arrivee']);
            verifDate($post['date_depart'], $post['date_arrivee']);
            verifPlace($post['place_disponible'], $post['place_totale']);
            $add = new DbAddService();
            $add->addTrajet($post);
            $_SESSION['message'] = "Trajet crée avec succes";
            header('Location: /Success');
            exit();
        } else {
            verifVille($post['ville_depart'], $post['ville_arrivee']);
            verifDate($post['date_depart'], $post['date_arrivee']);
            verifPlace($post['place_disponible'], $post['place_totale']);
            $update = new DbUpdateService();
            $update->updateTrajet($post);
            $_SESSION['message'] = "Trajet Modifier avec succes";
            header('Location: /Success');
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