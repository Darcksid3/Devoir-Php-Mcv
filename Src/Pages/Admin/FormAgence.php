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

/**
* Récupération des villes
* @return string
*/
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

$content = '<h2>Formulaires de gestion des agences</h2>'
            .'<fielset class="form form-medium">'
                .'<legend>Création d\'une agence</legend>'
                .'<form class="container-fluid mb-5" action="ValidFormAgence" method="POST" >'
                    .'<div class="row box">'
                        .'<div class="col text-center">'
                            .'<label class="form-label" for="nom">Nom de la ville :</label>'
                        .'</div>'
                        .'<div class="col text-center">'    
                            .'<input type="text" class="form-control" name="nom" id="nom" required>'
                        .'</div>'
                        .'<div class="col text-center">'
                            .'<button type="submit" class="mybtn" name="action" value="create">Créer une agence</button>'
                        .'</div>'
                    .'</div>'
                .'</form>'
            .'</fieldset'

            .'<fielset class="form form-medium">'
                .'<legend>Modification/Suppression d\'une agence</legend>'
                .'<form class="container-fluid mb-5" action="ValidFormAgence" method="POST">'

                    .'<div class="row mb-4 box">'
                        .'<div class="col text-right">'
                            .'<label class="form-label" for="ville">Sélectionner une agence!</label>'
                        .'</div>'
                        .'<div class="col text-left">'
                            .'<select class="form-select" name="ville" id="ville">'.$listeVille.'</select>'
                        .'</div>'
                    .'</div>'

                    .'<div class="row mb-4 box">'
                        .'<div class="col text-center">'
                            .'<button type="submit" class="mybtn" name="action" value="delete">Supprimer une agence</button>'
                        .'</div>'
                    .'</div>'

                    .'<div class="row mb-4 box">'
                        .'<div class="col text-center">'
                            .'<label class="form-label" for="nouveau_nom">Nouveau nom de la ville :</label>'
                        .'</div>'
                            .'<div class="col text-center">'
                            .'<input type="text" class="form-control" name="nouveau_nom" id="nouveau_nom">'
                        .'</div>'
                            .'<div class="col text-center">'
                            .'<button type="submit" class="mybtn" name="action" value="update">Modifier une agence</button>'
                        .'</div>'
                    .'</div>'
                .'</form>'
            .'</fielset>'
        ;
$_SESSION['pages'] = ' - Agence';
require __DIR__ . '/../Layout.php';

?>