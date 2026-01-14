<?php
namespace App\Pages;

use App\Db\DbSelectService;

function actionButton($id) {
	$btnView = '<button type="button" onclick="location.href=\'/Modale/'.$id.'\'">Voir</button>';
	$btnModif = '<button type="button" onclick="location.href=\'/FormTrajet/'.$id.'\'">Modifier</button>';
	$btnSupp = '<button type="button" onclick="location.href=\'/DeleteTrajet/'.$id.'\'">Supprimer</button>';

	$affichageBouton = 'Option : '.$btnView.$btnModif.$btnSupp;
	return $affichageBouton;
}

function AffichageTrajet() {
	$btnView = '<button>Voir</button>';
	$btnModif = '<button>Modifier</button>';
	$btnSupp = '<button>Supprimer</button>';
	$dbSelectService = new DbSelectService();

	$resultat = $dbSelectService->afficheAll();
	
	if ($resultat['status'] === false) {
		return $contenu ="<p>Aucun trajet n'est prévu !!</p>";
	} else {
		$tdElement =  '';

		foreach ($resultat['liste'] as $trajetInfo) {
				$trajetInfo['depart_ville_nom'] = $dbSelectService->recupVilleById($trajetInfo['depart_ville_id']);
				$trajetInfo['arrive_ville_nom'] = $dbSelectService->recupVilleById($trajetInfo['arrive_ville_id']);
				$trajetInfo['createur_email'] = $dbSelectService->recupOwnerTrajet($trajetInfo['createur_id']);
				
				$tdElement .= '<tr>'
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
			$contenu = '<h1>Bienvenue sur la page d\'accueil</h1>'
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
				.$tdElement	
			.'</tbody>'
		.'</table>'
			;
        return $contenu;
		}	
}	
		$content = AffichageTrajet();
		

require __DIR__ . '/Layout.php';
?>

