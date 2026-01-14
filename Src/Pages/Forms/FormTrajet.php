<?php

namespace App\Pages\Forms;

use App\Db\DbSelectService;

// verification que l'utilisateur est connecter sinon redirection.
// Si l'utilisateur est connecté récupération de ces donnée pour préremplir le formulaire.
$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true){
} else {
    Header('Location: /');
    exit();
}

// Création des objet date et heure.

$date = date("Y-m-d"); //date actuelle.
$heure = date("h:i"); // heure actuelle.
$heureSupp = date("h:i", strtotime('+1 hour'));// Ajout d'une heure supplémùentaire à l'heure actuelle pour l'heure d'arrivé (limitation de conflit).

/**
* Fonction du formatage de la date pour la metre au format sql.
*
* @param date $datepost .
* @return $objDate objet date Formaté. 
*/
function formatDate($datePost) {
    $objdate = date_create_from_format('Y-m-d', $datePost);
        return $objdate;
}
if (isset($_POST['date_depart'])) {
    return $dateDepart = formatDate($_POST['date_depart']);
}
if (isset($_POST['date_arrivee'])) {
    return $dateArrivee = formatDate($_POST['date_arrivee']);
}

// Récupération des villes pour l'insertion dans le formulaire.
function recupVille() {
	$ville = new DbSelectService();
	$liste = $ville->recupVille();
	$option = '';
	foreach ($liste as $ville) {
            
            $option .= '<option value="'.$ville['id'].'">'.$ville['nom'].'</option>';
        }
        return $option;

}
$recup = recupVille();
    
// recuperation des info de l'utilisateur pour alimenter le formulaire

$content ='<p>formulaire des trajets</p>'
.'<fieldset class="trajet-fieldset">'
    .'<legend>Création de trajet</legend>'
    .'<form action="/ValidFormTrajet" method="POST">'
        .'<input type="hidden" id="createur_id" name="createur_id" value="'.$utilisateur['id'].'" >'

        // Information de l'utilisateur connecté
        .'<div class="info-utilisateur">'
            .'<div>'
                .'<p><label>email :</label></p>'
                .'<p><input type="email" id="email" name="email" value="'.$utilisateur['email'].'" readonly></p>'
            .'</div>'
            .'<div>'
                .'<p><label>Nom</label></p>'
                .'<p><input type="text" id="nom" name="nom" value="'.$utilisateur['nom'].'" readonly></p>'
            .'</div>'
            .'<div>'
                .'<p><label>Prenom</label></p>'
                .'<p><input type="text" id="prenom" name="prenom" value="'.$utilisateur['prenom'].'" readonly></p>'
            .'</div>'
            .'<div>'
                .'<p><label>Telephone</label></p>'
                .'<p><input type="text" id="telephone" name="telephone" value="'.$utilisateur['telephone'].'" readonly></p>'
            .'</div>'
        .'</div>'
        // Fin info utilisateur

        // Information sur le trajet
        .'<div class="info-trajet">'
            // Info départ
            .'<div class="info-depart">'
                .'<div>'
                    .'<p>Ville de Départ</p>'
                    .'<select id="ville_depart" name="ville_depart" required>'
                        .$recup
                    .'</select>'
                .'</div>'
                .'<div>'
                    .'<p><label>Jours de départ</label></p>'
                    .'<p><input type="date" id="date_depart" name="date_depart" value="'.$date.'" required></p>'
                .'</div>'
                .'<div>'
                    .'<p><label>Heure de départ</label></p>'
                    .'<p><input type="time" id="heure_depart" name="heure_depart" value="'.$heure.'" required></p>'
                .'</div>'
            .'</div>'
            // info arrivée
            .'<div class="info-arrivee">'
                .'<div>'
                    .'<p>Ville de arrivé</p>'
                    .'<select id="ville_arrivee" name="ville_arrivee" required>'
                        .$recup
                    .'</select>'
                .'</div>'
                .'<div>'
                    .'<p><label>Jours de arrivé</label></p>'
                    .'<p><input type="date" id="date_arrivee" name="date_arrivee" value="'.$date.'" required></p>'
                .'</div>'
                .'<div>'
                    .'<p><label>Heure de arrivé</label></p>'
                    .'<p><input type="time" id="heure_arrivee" name="heure_arrivee" value="'.$heureSupp.'" required></p>'
                .'</div>'
            .'</div>'
        .'</div>'
        // fin info villes

        // Info places
        .'<div class="info-place">'
            .'<div>'
                .'<p><label>Nombre de place Totale</label></p>'
                .'<p><input type="Number" id="place_totale" name="place_totale" value="4" max="9"required></p>'
            .'</div>'
            .'<div>'
                .'<p><label>Nombre de place disponible</label></p>'
                .'<p><input type="number" id="place_restante" name="place_disponible" value="2" max="9"required></p>'
            .'</div>'
        .'</div>'
        // fin info places
        
        // Boutons d'actions
        .'<div class="btn-action">'
            .'<button type="submit" id="action" name="action" value="create">Créer le trajet</button>'
            .'<button type="submit" id="action" name="action" value="update">Modifier le trajet</button>'
            .'<button type="submit" id="action" name="action" value="delete">Supprimer le trajet</button>'
        .'</div>'
    .'</form>'
.'</fieldset>'
;



require __DIR__ . '/../Layout.php';
?>

