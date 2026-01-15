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
$infoTrajet = $edit ? $connexion->recupTrajetById($id) : [];

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

function affichageBtn($edit, $is_admin) {
    $btn = '<div class="btn-action">';
    if (!$edit) {
        $btn .= '<button type="submit" name="action" value="create">Créer le trajet</button>';
    } else {
        $btn .= '<button type="submit" name="action" value="update">Modifier le trajet</button>';
        $btn .= '<button type="submit" name="action" value="delete">Supprimer le trajet</button>';
    }
    $btn .= '</div>';
    return $btn;
}

// Valeurs par défaut ou Valeur de la BDD
$v_depart   = $infoTrajet['depart_ville_id'] ?? ''; 
$v_arrivee  = $infoTrajet['arrive_ville_id'] ?? '';
$d_depart   = $infoTrajet['depart_date'] ?? date("Y-m-d");
$h_depart   = $infoTrajet['depart_heure'] ?? date("H:i");
$d_arrivee  = $infoTrajet['arrive_date'] ?? date("Y-m-d");
$h_arrivee  = $infoTrajet['arrive_heure'] ?? date("H:i", strtotime('+1 hour'));
$p_totale   = $infoTrajet['place_totale'] ?? 4;
$p_restante = $infoTrajet['place_disponible'] ?? 2;

// Récupération des villes
function recupVille($selectedId = null) {
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


$content = '<p>formulaire des trajets</p>'
. '<fieldset class="trajet-fieldset">'
    . '<legend>' . ($edit ? "Modifier le trajet : " . htmlspecialchars($id) : "Créer un trajet") . '</legend>'
    . '<form action="/ValidFormTrajet" method="POST">'
        . '<input type="hidden" name="id_trajet" value="' . ($id ?? '') . '">'
        . '<input type="hidden" id="createur_id" name="createur_id" value="' . $utilisateur['id'] . '">'

        . '<div class="info-utilisateur">'
            . '<div><p><label>Email :</label></p><p><input type="email" value="' . $utilisateur['email'] . '" readonly></p></div>'
            . '<div><p><label>Nom :</label></p><p><input type="text" value="' . $utilisateur['nom'] . '" readonly></p></div>'
            . '<div><p><label>Prenom</label></p><p><input type="text" id="prenom" name="prenom" value="'.$utilisateur['prenom'].'" readonly></p></div>'
            . '<div><p><label>Telephone</label></p><p><input type="text" id="telephone" name="telephone" value="'.$utilisateur['telephone'].'" readonly></p></div>'
        . '</div>'

        . '<div class="info-trajet">'
            . '<div class="info-depart">'
                . '<div><p>Ville de Départ :</p><select name="ville_depart" required>' . $listeVilleDepart . '</select></div>'
                . '<div><p><label>Jour départ</label></p><input type="date" name="date_depart" value="' . $d_depart . '" required></div>'
                . '<div><p><label>Heure départ</label></p><input type="time" name="heure_depart" value="' . $h_depart . '" required></div>'
            . '</div>'
            . '<div class="info-arrivee">'
                . '<div><p>Ville d\'arrivée :</p><select name="ville_arrivee" required>' . $listeVilleArrivee . '</select></div>'
                . '<div><p><label>Jour arrivée</label></p><input type="date" name="date_arrivee" value="' . $d_arrivee . '" required></div>'
                . '<div><p><label>Heure arrivée</label></p><input type="time" name="heure_arrivee" value="' . $h_arrivee . '" required></div>'
            . '</div>'
        . '</div>'

        . '<div class="info-place">'
            . '<div><p><label>Places totales</label></p><input type="number" name="place_totale" value="' . $p_totale . '" max="9" required></div>'
            . '<div><p><label>Places dispos</label></p><input type="number" name="place_disponible" value="' . $p_restante . '" max="9" required></div>'
        . '</div>'
        
        . affichageBtn($edit, $is_admin)
    . '</form>'
. '</fieldset>';

require __DIR__ . '/../Layout.php';

?>