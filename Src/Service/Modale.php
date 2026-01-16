<?php
namespace App\Pages;
use App\Service\RecupId;
use App\Db\DbSelectService;

//Récupération de l'id
$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

if ($id === null) {
echo "Erreur : ID de trajet manquant.";    
//Header('Location: /');
    exit();
}

//verification de la connexion de l'utilisateur
$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true ) {
} else {
echo "Veuillez vous connecter pour voir les détails.";    
//Header('Location: /');
    exit();
}


// Classe Select
$dbSelectService = new DbSelectService();

// Récupération du trajet selectionné
$trajetInfo = $dbSelectService->recupTrajetById($id);
//récupération des infos du créateur du trajet
if (!$trajetInfo) {
    echo "Trajet introuvable.";
    exit();
}
$createurTrajetInfo = $dbSelectService->infoOwner($trajetInfo['createur_id']);

// Affichage des infos de la modale

echo '<p>trajet entre '.$trajetInfo['depart_ville_nom'].' et '.$trajetInfo['arrive_ville_nom'].'</p>';
echo '<p>Information sur le créateur du trajet</p>';
echo '<p>Email : '.$createurTrajetInfo['email'].'</p>';
echo '<p>Nom : '.$createurTrajetInfo['nom'] .'</p>';
echo '<p>Prenom : '.$createurTrajetInfo['prenom'] .'</p>';
?>



