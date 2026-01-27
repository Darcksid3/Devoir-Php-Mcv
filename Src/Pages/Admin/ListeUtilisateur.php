<?php
namespace App\Admin;

use App\Db\DbSelectService;
use App\Service\StatusVerif;

$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true){
    
} else {
    Header('Location: /');
    exit();
}
$statusVerif = new StatusVerif();
$is_admin = $statusVerif->verifStatus($utilisateur);


if (!$is_admin){
    header('Location : /');
    exit();
}


$connexion = new DbSelectService();
$liste = $connexion->listeEnregistre();

$trElement = '';
foreach ($liste as $user) {
    $trElement.='<tr>'
                .'<td>'.$user['nom'].'</td>'
                .'<td>'.$user['prenom'].'</td>'
                .'<td>'.$user['telephone'].'</td>'
                .'<td>'.$user['email'].'</td>'
    .'</tr>'
    ;
}

$content = '<h2 class="mb-4">Liste des utilisateurs</h2>' 
        .'<table class="table">'
            .'<thead>'
                .'<th>Nom</th>'
                .'<th>Prénom</th>'
                .'<th>Téléphone</th>'
                .'<th>Email</th>'
            .'</thead>'
            .'<tbody>'
                .$trElement
            .'</tbody>'
        .'</table>' 
        ;
$_SESSION['pages'] = ' - Liste Utilisateur';
require __DIR__ . '/../Layout.php';

?>