<?php
namespace App\Admin;

use App\Service\StatusVerif;
use App\Db\DbSelectService;
use DateTime;

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

	$affichageBouton = $btnSupp;
	return $affichageBouton;
}

function formatDh($date) {

	$parties = explode(' ', $date);
	$formatDate = new DateTime($parties[0]);
	$affichage = $formatDate->format('d/m/Y');
	return [
		'date' => $affichage,
		'heure' => $parties[1]
	];
}

function AffichageTrajet() {
	$dbSelectService = new DbSelectService();

	$resultat = $dbSelectService->listeAllTrajet();
	
	if ($resultat['status'] === false) {
		return $contenu ='<h2>Administration des trajets</h2>'
		.'<button type="button" onclick="location.href=\'/FormTrajet\'">Crée un trajet</button>'
		.'<h3>Liste des trajet</h3>'
		.'Aucun trajet n\'est prévu!!'
		;
	} else {
		$trElement =  '';

		foreach ($resultat['liste'] as $trajetInfo) {
				$trajetInfo['createur_email'] = $dbSelectService->recupOwnerTrajet($trajetInfo['createur_id']);
				$departDate = formatDh($trajetInfo['depart_date']);
				$arriveDate = formatDh($trajetInfo['arrive_date']);
				$trElement .= '<tr>'
					.'<td>'.$trajetInfo['id'].'</td>'
					.'<td>'.$trajetInfo['createur_email'].'</td>'
					.'<td>'.$trajetInfo['depart_ville_nom'].'</td>'
					.'<td>'.$departDate['date'].'</td>'
					.'<td>'.$departDate['heure'].'</td>'
					.'<td>'.$trajetInfo['arrive_ville_nom'].'</td>'
					.'<td>'.$arriveDate['date'].'</td>'
					.'<td>'.$arriveDate['heure'].'</td>'
					.'<td>'.actionButton($trajetInfo['id']).'</td>'
				.'</tr>';
			}
			$contenu = '<h2>Administration des trajets</h2>'
					.'<button type="button" onclick="location.href=\'/FormTrajet\'">Crée un trajet</button>'
					.'<h3>Liste des trajet</h3>'
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
								.'<th>Heured\'arrivée</th>'
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

