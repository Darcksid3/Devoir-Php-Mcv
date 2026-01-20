<?php

namespace App\Pages\Forms;
use App\Service\StatusVerif;
use App\Db\DbSelectService;
use App\Service\RecupId;



// Verifivation qu'un utilisateur est connecter. 
$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true){
    
} else {
    Header('Location: /');
    exit();
}
$statusVerif = new StatusVerif();
    $is_admin = $statusVerif->verifStatus($utilisateur);
// Vérification de l'uri pour savoir si c'est une modification.
$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

$edit = ($id !== null);

// Récupération des information du trajet.
$connexion = new DbSelectService();
$info = $edit ? $connexion->recupTrajetById($id) : [];

$infoTrajet = $info;
$tempDATA = $_SESSION['tempDATA'] ?? [];
//3 verifier si l'utilisateur connecté est le propriétaire du trajet.
if ($edit) {
    
    if($is_admin){
        
        // on récupère les donnée du créateur du trajet (int)$infoTrajet['createur_id']
        
        $utilisateur = $connexion->infoOwner((int)$infoTrajet['createur_id']);
    }else {
        if ((int)$utilisateur['id'] !== (int)$infoTrajet['createur_id']) {
            header('Location: /');
            exit();
        }
    }
}
/**
    * Liste les utilisateur enregistré
    * @param bool $edit
    * @return string
    */
function affichageBtn(bool $edit) {
    $btn = '<div class="btn-action">';
    if (!$edit) {
        $btn .= '<button type="submit" class="mybtn" name="action" id=="action" value="create">Créer le trajet</button>';
    } else {
        $btn .= '<button type="submit" class="mybtn" name="action" id=="action" value="update">Modifier le trajet</button>';
        $btn .= '<button type="submit" class="mybtn" name="action" id=="action" value="delete">Supprimer le trajet</button>';
    }
    $btn .= '</div>';
    return $btn;
}

// Valeurs de BDD ou Suite erreur ou par default
$v_depart   = $infoTrajet['depart_ville_id'] ?? $tempDATA['depart_ville_id'] ?? ''; 
$v_arrivee  = $infoTrajet['arrive_ville_id'] ?? $tempDATA['arrive_ville_id'] ?? '';
$d_depart   = $infoTrajet['depart_date'] ?? $tempDATA['depart_date'] ?? date("Y-m-d H:i", strtotime('+1 hour'));
$d_arrivee  = $infoTrajet['arrive_date'] ?? $tempDATA['arrive_date'] ?? date("Y-m-d H:i", strtotime('+2 hour'));
$p_totale   = $infoTrajet['place_totale'] ?? $tempDATA['place_totale'] ?? 4;
$p_restante = $infoTrajet['place_disponible'] ?? $tempDATA['place_disponible'] ?? 2;

// Récupération des villes
/**
    * Liste les utilisateur enregistré
    * @param int $selectedId
    * @return string
    */
function recupVille(int $selectedId) {
    $db = new DbSelectService();
    $liste = $db->recupVille();
    $option = '';
    foreach ($liste as $ville) {
        $selected = ($selectedId == $ville['id']) ? 'selected' : '';
        $option .= '<option value="'.$ville['id'].'" '.$selected.'>'.$ville['nom'].'</option>';
    }
    return $option;
}

$listeVilleDepart = recupVille($v_depart);
$listeVilleArrivee = recupVille($v_arrivee);
// On définit la base de l'URL
$urlAction = "/ValidFormTrajet";

// Si un ID est présent (cas modif/suppr), on l'ajoute à l'URL
if (!empty($id)) {
    $urlAction .= "/" . $id;
}
$content = '<fieldset class="form form-large">'
    .'<legend>' . ($edit ? "Modifier le trajet : " . $id : "Créer un trajet") . '</legend>'
    .'<form action="'.$urlAction.'" method="POST">'
        .'<input type="hidden" name="id" value="' . ($id ?? '') . '">'
        .'<input type="hidden" id="createur_id" name="createur_id" value="' . $utilisateur['id'] . '">'
        .'<div class="container-fluid">'
            .'<div class="row mb-5 box">'
                .'<div class="col">'
                    .'<label class="form-label" for="email">Email :</label>'
                    .'<input type="email" class="form-control" name="email" id="email" value="' . $utilisateur['email'] . '" readonly>'
                .'</div>'
                .'<div class="col">'
                    .'<label class="form-label" for="nom">Nom :</label>'
                    .'<input type="text" class="form-control"name="nom" id="nom" value="' . $utilisateur['nom'] . '" readonly>'
                    .'</div>'
                .'<div class="col">'
                    .'<label class="form-label" for="prenom">Prenom :</label>'
                    .'<input type="text" class="form-control" id="prenom" name="prenom" value="'.$utilisateur['prenom'].'" readonly>'
                .'</div>'
                .'<div class="col">'
                    .'<label class="form-label" for="telephone">Telephone :</label>'
                    .'<input type="text" class="form-control" id="telephone" name="telephone" value="'.$utilisateur['telephone'].'" readonly>'
                .'</div>'
            .'</div>'
        
        
            .'<div class="row mb-5 box">'
                .'<div class="col text-center">'
                    .'<div>'
                        .'<label class="form-label mx-2" for="depart_ville">Ville de Départ :</label>'
                        .'<select class="form-select" name="depart_ville" id="depart_ville" required>' . $listeVilleDepart . '</select>'
                    .'</div>'
                    .'<div>'
                        .'<label class="form-label" for="depart_date">Horaire départ</label>'
                        .'<input type="datetime-local" class="form-control"  name="depart_date" id="depart_date" value="' . $d_depart . '" required>'
                    .'</div>'
                .'</div>'
                
                .'<div class="col text-center">'
                    .'<div>'
                        .'<label class="form-label mx-2" for="arrive_ville">Ville d\'arrivée :</label>'
                        .'<select class="form-select" name="arrive_ville" id"arrive_ville" required>' . $listeVilleArrivee . '</select>'
                    .'</div>'
                    .'<div>'
                        .'<label </div>arrive-date">Horaire arrivée</label>'
                        .'<input type="datetime-local" class="form-control" name="arrive_date" id="="arrive_date" value="' . $d_arrivee . '" required>'
                    .'</div>'
                .'</div>'
            .'</div>'
            .'<div class="row justify-content-around mb-5 box">'
                .'<div>'
                    .'<label class="form-label" for="place_totale">Places totales</label>'
                    .'<input type="number" class="form-control" name="place_totale" id="place_totale" value="' . $p_totale . '" max="9" required>'
                .'</div>'
                .'<div>'
                    .'<label class="form-label" for="place_disponible">Places dispos</label>'
                    .'<input type="number" class="form-control" name="place_disponible" id="place_disponible" value="' . $p_restante . '" max="9" required>'
                .'</div>'
            .'</div>'
            .'<div class="row justify-content-center box">'.affichageBtn($edit).'</div>'
        .'</div>'
    . '</form>'
. '</fieldset>';

require __DIR__ . '/../Layout.php';

?>