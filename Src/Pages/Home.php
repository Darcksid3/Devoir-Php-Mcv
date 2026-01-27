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

/**
* Vérifie si l'utilisateur est créateur d'un trajet
* @param int $uid
* @param int $cuid
* @return boolean
*/
function isOwner(int $uid, int $cuid)
	{if ($uid === $cuid){
		return true;
	}  else {return false;}
}

/**
* Vérifie quel bouton doit etre affiché
* @param int $id
* @param bool $is_connect
* @param bool $is_owner
* @return string
*/
function affichageBtn(int $id, bool $is_connect, bool $is_owner) {
	$row['ID'] = $id;
	//$btnView = '<button type="button" onclick="location.href=\'/Modale/'.$id.'\'">Voir</button>';
	$btnView = '<a class="option option-view" href="#"  data-toggle="modal" data-target="#myModal" data-id="'.$id.'"><img src="/Public/asset/eye.svg" alt="voir les information"></a>';
	$btnModif = '<a class="option option-edit" onclick="location.href=\'/FormTrajet/'.$id.'\'"><img src="/Public/asset/pencil.svg" alt="Modifier le trajet"></a>';
	$btnSupp = '<a class="option option-trash" onclick="location.href=\'/DeleteTrajet/'.$id.'\'"><img src="/Public/asset/trash3.svg" alt="Supprimer le trajet"></a>';
	$afficheBtn = '';
	if ($is_owner){
		$afficheBtn .= $btnView.' '.$btnModif.' '.$btnSupp;
		return $afficheBtn;
	} else if ($is_connect) {
		$afficheBtn .= $btnView;
		return $afficheBtn;
	} else {
		return $afficheBtn;
	}
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
* Mise en place du bouton d'action
* @param bool $is_connect
* @return array<mixed>
*/
function displayIsConnect(bool $is_connect){
	$display = [];
	if(!$is_connect){
		$display = ['status' => false, 'titre' => '<h2>Pour obtenir plus d\'information sur un trajet, veuillez vous connecter</h2>', 'table' => '</tr>'];
		return $display;
	} else {
		$display = ['status' => true, 'titre' => '<h2 class="mb-4" >Liste des trajets</h2>', 'table' => '<th></th></tr>'];
		return $display;
	}
}
$display = displayIsConnect($is_connect);

/**
* Affichage des trajet a venir si de la place est disponible
* @param array <mixed> $listetrajet
* @param bool $is_connect
* @param DbSelectService $dbSelectService
* @param array<mixed> $utilisateur
* @return string
*/
function affichageTrElement(array $listetrajet, bool $is_connect, DbSelectService $dbSelectService, array $utilisateur){
	
	$trElement = '';
	
	if ($listetrajet['status'] !== false) {
		foreach ($listetrajet['liste'] as $trajetInfo) {
			$trajetInfo['createur_email'] = (string) $dbSelectService->recupOwnerTrajet($trajetInfo['createur_id']);
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
				.'<td>'.$trajetInfo['place_disponible'].'</td>';
				if (!$is_connect){
					$trElement .= '</tr>';
				} else {
					$trElement .= '<td class="options">'.$btn.'</td>'
								.'</tr>';
				}
		}return $trElement;
	} else {
		return $trElement = '<tr><td>Aucun trajet de prévu!!</td></tr>';
	}
}

$trElement = affichageTrElement($listetrajet,$is_connect, $dbSelectService,$utilisateur);


$content = $display['titre']
		.'<table class="table">'
			.'<thead>'
				.'<tr>'
					.'<th>Départ</th>'
					.'<th>Date</th>'
					.'<th>Heure</th>'
					.'<th>Destination</th>'
					.'<th>Date</th>'
					.'<th>Heure</th>'
					.'<th>Places</th>'
					. $display['table']
					.'</thead>'
			.'<tbody>'
				.$trElement	
			.'</tbody>'
		.'</table>'
			;
			/** Contenu de la fenetre modale */
		$content .= '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
            .'<div class="modal-dialog" role="document">'
                .'<div class="modal-content">'
                    .'<div class="modal-header">'
                        .'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                    .'</div>'
                    .'<div class="modal-body">'
                        .'<div class="fetched-data"></div>'
                    .'</div>'
                    .'<div class="modal-footer">'
                        .'<button class="mybtn mybtn-grey" type="button" data-dismiss="modal">Fermer</button>'
                    .'</div>'
                .'</div>'
            .'</div>'
        .'</div>'
		;
		$_SESSION['pages'] = ' - Accueil';
require __DIR__ .'/../Pages/Layout.php';

?>
