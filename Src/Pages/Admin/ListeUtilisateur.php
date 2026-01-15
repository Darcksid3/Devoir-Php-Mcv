<?php
namespace App\Admin;

use App\Db\DbSelectService;
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
    header('Location : /');
    exit();
}

//connexion au service de selection
// récupération de la table des utilisateur enregistré
$connexion = new DbSelectService();
$liste = $connexion->listeEnregistre();
//var_dump($liste);
$trElement = '';
foreach ($liste as $user) {
    $trElement.='<tr>'
                .'<td>'.$user['id'].'</td>'
                .'<td>'.$user['nom'].'</td>'
                .'<td>'.$user['prenom'].'</td>'
                .'<td>'.$user['telephone'].'</td>'
                .'<td>'.$user['email'].'</td>'
    .'</tr>'
    ;
}

$content = '<table>'
        .$trElement
        .'</table>' 
        ;
/*
$listeEnregistre = $connexion->selectAllUser();
$listeEmployee = $connexion->selectAllEmployee();
var_dump($listeEmployee[0]);
var_dump($listeEnregistre[0]);
$trElement = '';

function retourneNom($listeEmployee, $listeEnregistre){
    
    for ($i=0;$i<=count($listeEmployee); $i++) {
        for($i=0; $i<=count($listeEnregistre); $i++) {
            if($listeEmployee[$i]['id']===$listeEnregistre[$i]['utilisateur_id']){
                return $listeEmployee[$i] ;
            }
        }
    }
}
$infoUser = retourneNom($listeEmployee, $listeEnregistre);
var_dump($infoUser);
//var_dump(retourneNom($listeEmployee));
*/


require __DIR__ . '/../Layout.php';

?>