<?php
namespace App\Pages\Admin;

use App\Service\StatusVerif;

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


$content = '<h1>Dashboard Admin</h1>'
        . '<p>Bienvenue sur le tableau de bord administrateur.</p>'
        
        .'<p><a href="/ListeUtilisateur">Lister les utilisateurs</a></p>'

		.'<p><a href="/FormAgence">Lister les agences Créer, modifier et supprimer une agence</a></p>'
		
		.'Lister les trajets Supprimer un trajet.'

        ;
require __DIR__ . '/../Layout.php';

?>