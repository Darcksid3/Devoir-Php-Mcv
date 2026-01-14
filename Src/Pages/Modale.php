<?php
namespace App\Pages;
use App\Service\RecupId;
use App\Db\DbSelectService;

//Récupération de l'id
$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

if ($id === null) {
    Header('Location: /');
    exit();
}

//verification de la connexion de l'utilisateur
$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true ) {
} else {
    Header('Location: /');
    exit();
}


// Classe Select
$dbSelectService = new DbSelectService();

// Récupération du trajet selectionné
$trajetInfo = $dbSelectService->recupTrajetById($id);
//récupération des infos du créateur du trajet
$createurTrajetInfo = $dbSelectService->infoOwner($trajetInfo['createur_id']);
//récupération du nom des villes
$villeD = $dbSelectService->recupVilleById($trajetInfo['depart_ville_id']);
$villeA = $dbSelectService->recupVilleById($trajetInfo['arrive_ville_id']);

// Affichage de la modale
$content = '<p>Vous etes sur la page des modales</p>'
    . '<p>'.$id.'</p>'
    .'<p>trajet entre '.$villeD.' et '.$villeA.'</p>'
    .'<p>Information sur le créateur du trajet</p>'
    .'<p>Email : '.$createurTrajetInfo['email'].'</p>'
    .'<p>Nom : '.$createurTrajetInfo['nom'].'</p>'
    .'<p>Prenom : '.$createurTrajetInfo['prenom'].'</p>'
    ;

require __DIR__ . '/Layout.php';

?>