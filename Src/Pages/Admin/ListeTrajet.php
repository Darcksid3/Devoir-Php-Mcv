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
/**
* Mise en place du bouton d'action
* @param int $id
* @return string
*/
function actionButton(int $id) {
	$btnSupp = '<a type="button" class="option option-trash" onclick="location.href=\'/DeleteTrajet/'.$id.'\'"><img src="/Public/asset/trash3.svg" alt="Supprimer le trajet"></a>';

	$affichageBouton = $btnSupp;
	return $affichageBouton;
}
/**
* Mise en place du bouton d'action
* @param string $date
* @return array<mixed>
*/
function formatDh(string $date) {

	$parties = explode(' ', $date);
	$formatDate = new DateTime($parties[0]);
	$affichage = $formatDate->format('d/m/Y');
	return [
		'date' => $affichage,
		'heure' => $parties[1]
	];
}
/**
* Mise en place de l'affichage
* @return string
*/
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
				$createur_email = (string) $dbSelectService->recupOwnerTrajet($trajetInfo['createur_id']);
				$departDate = formatDh($trajetInfo['depart_date']);
				$arriveDate = formatDh($trajetInfo['arrive_date']);
				$trElement .= '<tr><td>'
					.$createur_email
					.'</td>'
					.'<td>'.$trajetInfo['depart_ville_nom'].'</td>'
					.'<td>'.$departDate['date'].'</td>'
					.'<td>'.$departDate['heure'].'</td>'
					.'<td>'.$trajetInfo['arrive_ville_nom'].'</td>'
					.'<td>'.$arriveDate['date'].'</td>'
					.'<td>'.$arriveDate['heure'].'</td>'
					.'<td>'.$trajetInfo['place_totale'].'</td>'
					.'<td>'.$trajetInfo['place_disponible'].'</td>'
					.'<td>'.actionButton($trajetInfo['id']).'</td>'
				.'</tr>';
			}
			$contenu = '<h2>Administration des trajets</h2>'
					.'<button type="button" class="mybtn" onclick="location.href=\'/FormTrajet\'">Crée un trajet</button>'
					.'<h3>Liste des trajets</h3>'
						.'<table class="table">'
						.'<thead>'
							.'<tr>'
								.'<th>Créateur du trajet</th>'
								.'<th>Ville de départ</th>'
								.'<th>Date de départ</th>'
								.'<th>Heure de départ</th>'
								.'<th>Ville d\'arrivée</th>'
								.'<th>Date d\'arrivée</th>'
								.'<th>Heured\'arrivée</th>'
								.'<th>Place Totale</th>'
								.'<th>Place disponible</th>'
								.'<th></th>'
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
		
$_SESSION['pages'] = ' Liste Trajet';
require __DIR__ . '/../Layout.php';
?>