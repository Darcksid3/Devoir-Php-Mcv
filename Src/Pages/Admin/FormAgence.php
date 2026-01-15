<?php
namespace App\Admin;

use App\Service\StatusVerif;
use App\Db\DbSelectService;

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

function recupVille() {
    $db = new DbSelectService();
    $liste = $db->recupVille();
    $option = '';
    foreach ($liste as $ville) {
        $option .= '<option value="'.$ville['id'].'">'.$ville['nom'].'</option>';
    }
    return $option;
}

$listeVille = recupVille();

$content = '<h2>Formulaires de gestion des villes</h2>'
        .'<form>'
            
            .'<p>'
                .'<label for="nom">Nom de la ville :</label>'
                .'<input type="text" name="nom" id="nom" required>'
                .'<button type="submit" name="action" value="create">Créer une agence</button>'
            .'</p>'
        .'</form>'
        .'<form>'
            .'<p>'
                .'<select>'.$listeVille.'</select>'
                .'<label for="nouveau_nom">Nouveau nom de la ville :</label>'
                .'<input type="text" name="nouveau_nom" id="nouveau_nom">'
                .'<button type="submit" name="action" value="update">Modifier une agence</button>'
                .'<button type="submit" name="action" value="delete">Supprimer une agence</button>'
            .'</p>'
        .'</form>'
        ;

require __DIR__ . '/../Layout.php';

?>