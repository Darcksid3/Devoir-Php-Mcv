<?php
namespace App\Pages;

use App\Service\StatusVerif;
use App\Db\DbSelectService;
use DateTime;

$utilisateur = $_SESSION['utilisateur'] ?? [];
    
$statusVerif = new StatusVerif();
$is_connect = $statusVerif->verifConnect($utilisateur);

$dbSelectService = new DbSelectService();
$listetrajet = [];
$listetrajet = $dbSelectService->afficheAll();

function isOwner($uid, $cuid){if ($uid === $cuid){return true;}}

function affichageBtn($id, $is_connect, $is_owner) {
	$row['ID'] = $id;
	//$btnView = '<button type="button" onclick="location.href=\'/Modale/'.$id.'\'">Voir</button>';
	$btnView = '<a href="#" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal" data-id="'.$id.'">Voir Détails</a>';
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
function formatDh($date) {

	$parties = explode(' ', $date);
	$formatDate = new DateTime($parties[0]);
	$affichage = $formatDate->format('d/m/Y');
	return [
		'date' => $affichage,
		'heure' => $parties[1]
	];
}
function affichageTrElement($listetrajet,$is_connect,$dbSelectService, $utilisateur){
	
	$trElement = '';
	
	if ($listetrajet['status'] !== false) {
		foreach ($listetrajet['liste'] as $trajetInfo) {
			$trajetInfo['createur_email'] = $dbSelectService->recupOwnerTrajet($trajetInfo['createur_id']);
			if(isset($utilisateur['id'])){
				$is_owner = isOwner($utilisateur['id'], $trajetInfo['createur_id']);
			} else {
				$is_owner = false;
			}
			$departDate = formatDh($trajetInfo['depart_date']);
			$arriveDate = formatDh($trajetInfo['arrive_date']);
			$btn = affichageBtn($trajetInfo['id'], $is_connect, $is_owner);
			$trElement .= '<tr>'
				.'<td>'.$trajetInfo['depart_ville_nom'].'</td>'
				.'<td>'.$departDate['date'].'</td>'
				.'<td>'.$departDate['heure'].'</td>'
				.'<td>'.$trajetInfo['arrive_ville_nom'].'</td>'
				.'<td>'.$arriveDate['date'].'</td>'
				.'<td>'.$arriveDate['heure'].'</td>'
				.'<td>'.$trajetInfo['place_disponible'].'</td>'
				.'<td>'.$btn.'</td>'
			.'</tr>';
		}
		return $trElement;
	}else {
		return $trElement = '<tr><td>Aucun trajet de prévu!!</td></tr>';}
}
$trElement = affichageTrElement($listetrajet,$is_connect, $dbSelectService,$utilisateur);


$content = '<h2>Page d\'accueil liste des trajets</h2>'
		.'<table border="1">'
			.'<thead>'
				.'<tr>'
					.'<th>Ville de départ</th>'
					.'<th>Date de départ</th>'
					.'<th>Heure de départ</th>'
					.'<th>Ville d\'arrivée</th>'
					.'<th>Date d\'arrivée</th>'
					.'<th>Heured\'arrivée</th>'
					.'<th>Place disponible</th>'
					.'<th></th>'
				.'</tr>'
			.'</thead>'
			.'<tbody>'
				.$trElement	
			.'</tbody>'
		.'</table>'
			;

		$content .= '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
            .'<div class="modal-dialog" role="document">'
                .'<div class="modal-content">'
                    .'<div class="modal-header">'
                        .'<h5 class="modal-title">Modal du trajet</h5>'
                        .'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                    .'</div>'
                    .'<div class="modal-body">'
                        .'<div class="fetched-data"></div>'
                    .'</div>'
                    .'<div class="modal-footer">'
                        .'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
                        .'<a href="/">Revenir à l\'accueil</a>'
                    .'</div>'
                .'</div>'
            .'</div>'
        .'</div>'
		;
require __DIR__ .'/../Pages/Layout.php';

?>
