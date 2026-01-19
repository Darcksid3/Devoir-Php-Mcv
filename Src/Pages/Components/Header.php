<?php
namespace App\Pages\Components;
/*
//todo Nav générale de débug avec toute les options A SUPPRIMER APRES
echo '<nav>'
	.'<a href="/">Accueil</a> |  '
	.'<a href="/Success">Succès</a> | '
	.'<a href="/DashboardAdmin">Admin</a> | '
	.'<a href="/FormInscript">Inscription</a> | '
	.'<a href="/FormConnect">Connexion</a> | '
	.'<a href="/FormTrajet">Trajet</a> | '
	.'<a href="/Deconnexion">Deconnexion</a> | '
	.'<a href="/TestView">TestView</a> | '
	.'<a href="/lol">Pages lol</a>' 
	.'</nav>'
	.'<hr>'
	;
*/
	// Début du Header
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
					.'<button type="button" class="mybtn" onclick="location.href=\'/ListeUtilisateur\'">Utilisateur</button>'
					.'<button type="button" class="mybtn" onclick="location.href=\'/FormAgence\'">Agence</button>'
					.'<button type="button" class="mybtn" onclick="location.href=\'/ListeTrajet\'">Trajet</button>'
					.'<p>Bonjour '.$utilisateur['nom'].' '.$utilisateur['prenom'].'</p>'
					.'<button type="button" class="mybtn mybtn-grey" onclick="location.href=\'/Deconnexion\'">Déconnexion</button>'
				.'</div>';
	}

} else {
	$menuContent = '<div class="logo"><a href="/" >Touche pas au klaxon</a></div>'
			.'<div class="nav">'
				.'<button type="button" class="mybtn" onclick="location.href=\'/FormInscript\'">Inscription</button>'
				.'<button type="button" class="mybtn mybtn-grey" onclick="location.href=\'/FormConnect\'">Connexion</button>'
			.'</div>';
}
$menu = '<div class="myMenu">'.$menuContent.'</div>';
$menu .= $message;
echo $menu;

?>