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


$dbSelectService = new DbSelectService();
$createurTrajetInfo = $dbSelectService->modale($id);
if (!$createurTrajetInfo) {
    echo "Trajet introuvable.";
    exit();
}
// Affichage des infos de la modale

echo '<p>Auteur : '.$createurTrajetInfo['nom'] .' '.$createurTrajetInfo['prenom'].'</p>';
echo '<p>Telephone : '.$createurTrajetInfo['telephone'].'</p>';
echo '<p>Email : '.$createurTrajetInfo['email'].'</p>';
echo '<p>Nombre total de places : '.$createurTrajetInfo['place_disponible'] .'</p>';

?>