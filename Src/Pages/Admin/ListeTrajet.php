<?php
namespace App\Admin;

use App\Service\StatusVerif;
use App\Db\DbSelectService;

// Verifivation qu'un utilisateur est connecter. 
$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true){
	
} else {
Header('Location: /');
exit();
}
$statusVerif = new StatusVerif();
$is_admin = $statusVerif->verifStatus($utilisateur);

if (!$is_admin){
header('Location: /');
exit();
}

function actionButton($id) {
	$btnSupp = '<button type="button" onclick="location.href=\'/DeleteTrajet/'.$id.'\'">Supprimer</button>';

	$affichageBouton = 'Option : '.$btnSupp;
	return $affichageBouton;
}

function AffichageTrajet() {
	$dbSelectService = new DbSelectService();

	$resultat = $dbSelectService->listeAllTrajet();
	
	if ($resultat['status'] === false) {
		return $contenu ="<p>Aucun trajet n'est prévu !!</p>";
	} else {
		$trElement =  '';

		foreach ($resultat['liste'] as $trajetInfo) {
				$trajetInfo['depart_ville_nom'] = $dbSelectService->recupVilleById($trajetInfo['depart_ville_id']);
				$trajetInfo['arrive_ville_nom'] = $dbSelectService->recupVilleById($trajetInfo['arrive_ville_id']);
				$trajetInfo['createur_email'] = $dbSelectService->recupOwnerTrajet($trajetInfo['createur_id']);
				
				$trElement .= '<tr>'
					.'<td>'.$trajetInfo['id'].'</td>'
					.'<td>'.$trajetInfo['createur_email'].'</td>'
					.'<td>'.$trajetInfo['depart_ville_nom'].'</td>'
					.'<td>'.$trajetInfo['depart_date'].'</td>'
					.'<td>'.$trajetInfo['depart_heure'].'</td>'
					.'<td>'.$trajetInfo['arrive_ville_nom'].'</td>'
					.'<td>'.$trajetInfo['arrive_date'].'</td>'
					.'<td>'.$trajetInfo['arrive_heure'].'</td>'
					.'<td>'.actionButton($trajetInfo['id']).'</td>'
				.'</tr>';
			}
			$contenu = '<h1>Liste des trajet</h1>'
		.'<table border="1">'
			.'<thead>'
				.'<tr>'
					.'<th>ID</th>'//TODO : ajouter juste pour le débug (vérification de l'affichage par date et heure croissante)
					.'<th>Créateur du trajet</th>'
					.'<th>Ville de départ</th>'
					.'<th>Date de départ</th>'
					.'<th>Heure de départ</th>'
					.'<th>Ville d\'arrivée</th>'
					.'<th>Date d\'arrivée</th>'
					.'<th>Heure d\'arrivée</th>'
					.'<th>Options</th>'
				.'</tr>'
			.'</thead>'
			.'<tbody>'
				.$trElement	
			.'</tbody>'
		.'</table>'
			;
        return $contenu;
		}	
}	
		$content = AffichageTrajet();
		

require __DIR__ . '/../Layout.php';
?>

