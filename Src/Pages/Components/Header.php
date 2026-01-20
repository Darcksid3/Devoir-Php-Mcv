<?php
namespace App\Pages\Components;

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$utilisateur = $_SESSION['utilisateur'] ?? [];
$menuContent = '';

if (($utilisateur['connect'] ?? false) === true){
	
	if ($utilisateur['status'] === 'utilisateur'){

		// affichage du myMenu utilisateur
		$menuContent = '<div class="logo"><a href="/" >Touche pas au klaxon</a></div>'
						.'<div class="nav"><button class="mybtn mybtn-grey" type="button" onclick="location.href=\'/FormTrajet\'">Créer un trajet</button>'
						.'<p>Bonjour '.$utilisateur['nom'].' '.$utilisateur['prenom'].'</p>'
						.'<button class="mybtn mybtn-grey" type="button" onclick="location.href=\'/Deconnexion\'">Déconnexion</button>'
					.'</div>';
			
	} else if ($utilisateur['status'] === 'admin') {
		//affichage du myMenu admin
		$menuContent = '<div class="logo"><a href="/" >Touche pas au klaxon</a></div>'
				.'<div class="nav">'
					.'<button type="button" class="mybtn" onclick="location.href=\'/ListeUtilisateur\'">Utilisateurs</button>'
					.'<button type="button" class="mybtn" onclick="location.href=\'/FormAgence\'">Agences</button>'
					.'<button type="button" class="mybtn" onclick="location.href=\'/ListeTrajet\'">Trajets</button>'
					.'<p>Bonjour '.$utilisateur['nom'].' '.$utilisateur['prenom'].'</p>'
					.'<button type="button" class="mybtn mybtn-grey" onclick="location.href=\'/Deconnexion\'">Déconnexion</button>'
				.'</div>';
	}

} else {
	$menuContent = '<div class="logo"><a href="/" >Touche pas au klaxon</a></div>'
			.'<div class="nav">'
				.'<button type="button" class="mybtn mybtn-grey" onclick="location.href=\'/FormConnect\'">Connexion</button>'
			.'</div>';
}
$menu = '<div class="myMenu">'.$menuContent.'</div>';
$menu .= $message;
echo $menu;

?>