<?php

namespace App\Pages;
use App\Service\Trajet;

function AffichageTrajet() {
	$trajet = new Trajet();

	$resultat = $trajet->afficheAll();
	return $resultat;
}
$listeTrajet = AffichageTrajet();
//var_dump($listeTrajet);

$content = '<h1>Bienvenue sur la page d\'accueil</h1>'
		. '<p>'.$listeTrajet.'</p>'
	;

require __DIR__ . '/Layout.php';
?>

