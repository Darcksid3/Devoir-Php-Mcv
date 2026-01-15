<?php
namespace App\Pages;

use App\Service\StatusVerif;
use App\Db\DbSelectService;

$utilisateur = $_SESSION['utilisateur'] ?? [];
    
$statusVerif = new StatusVerif();
$is_connect = $statusVerif->verifConnect($utilisateur);

$dbSelectService = new DbSelectService();
$listetrajet = $dbSelectService->afficheAll();

function isOwner($uid, $cuid){if ($uid === $cuid){return true;}}

function affichageBtn($id, $is_connect, $is_owner) {
	$btnView = '<button type="button" onclick="location.href=\'/Modale/'.$id.'\'">Voir</button>';
	$btnModif = '<button type="button" onclick="location.href=\'/FormTrajet/'.$id.'\'">Modifier</button>';
	$btnSupp = '<button type="button" onclick="location.href=\'/DeleteTrajet/'.$id.'\'">Supprimer</button>';
	$afficheBtn = '';
	if ($is_owner){
		$afficheBtn .= $btnModif.''.$btnSupp;
		return $afficheBtn;
	} else if ($is_connect) {
		$afficheBtn .= $btnView;
		return $afficheBtn;
	} else {
		return $afficheBtn;
	}

}

$trElement = '';

foreach ($listetrajet['liste'] as $trajetInfo) {
		$trajetInfo['depart_ville_nom'] = $dbSelectService->recupVilleById($trajetInfo['depart_ville_id']);
		$trajetInfo['arrive_ville_nom'] = $dbSelectService->recupVilleById($trajetInfo['arrive_ville_id']);
		$trajetInfo['createur_email'] = $dbSelectService->recupOwnerTrajet($trajetInfo['createur_id']);
		$owner = $dbSelectService->infoOwner($trajetInfo['createur_id']);
		if(isset($utilisateur['id'])){
			$is_owner = isOwner($utilisateur['id'], $trajetInfo['createur_id']);
		} else {
			$is_owner = false;
		}
		$btn = affichageBtn($trajetInfo['id'], $is_connect, $is_owner);
		$trElement .= '<tr>'
			.'<td>'.$trajetInfo['id'].'</td>'
			.'<td>'.$trajetInfo['createur_email'].'</td>'
			.'<td>'.$trajetInfo['depart_ville_nom'].'</td>'
			.'<td>'.$trajetInfo['depart_date'].'</td>'
			.'<td>'.$trajetInfo['depart_heure'].'</td>'
			.'<td>'.$trajetInfo['arrive_ville_nom'].'</td>'
			.'<td>'.$trajetInfo['arrive_date'].'</td>'
			.'<td>'.$trajetInfo['arrive_heure'].'</td>'
			.'<td>'.$btn.'</td>'
		.'</tr>';
	}

$content = '<h2>Liste Trajet TestView</h2>'
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

require __DIR__ .'/../Pages/Layout.php';
?>