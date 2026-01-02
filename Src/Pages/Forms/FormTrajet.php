<?php

namespace App\Pages\Forms;

// verification que l'utilisateur est connecter sinon redirection
$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true){
    $content = '<p>Utilisateur connecté</p>';
    } else {
        Header('Location: /');
        exit();
    }

// recuperation des info de l'utilisateur pour alimenter le formulaire

$content .='formulaire des trajets'
.'<fieldset>'
    .'<legend>Création de trajet</legend>'
    .'<input type="number" value="'.$utilisateur['id'].'" disabled>'
    .'<div>'
        .'<p><label>email :</label></p>'
        .'<p><input type="email" value="'.$utilisateur['email'].'" readonly></p>'
    .'</div>'
    .'<div>'
        .'<p><label>Nom</label></p>'
        .'<p><input type="text" value="'.$utilisateur['nom'].'" readonly></p>'
    .'</div>'
    .'<div>'
        .'<p><label>Prenom</label></p>'
        .'<p><input type="text" value="'.$utilisateur['prenom'].'" readonly></p>'
    .'</div>'
    .'<div>'
        .'<p><label>Telephone</label></p>'
        .'<p><input type="text" value="'.$utilisateur['telephone'].'" readonly></p>'
    .'</div>'
    .'<div>'
        .'<p>Ville de Départ</p>'
        .'<select>'
            .'<option></option>'
        .'</select>'
    .'</div>'
    .'<div>'
        .'<p><label>Jours de départ</label></p>'
        .'<p><input type="date" value="" ></p>'
    .'</div>'
    .'<div>'
        .'<p><label>Heure de départ</label></p>'
        .'<p><input type="time" value=""></p>'
    .'</div>'
    .'<div>'
        .'<p>Ville de arrivé</p>'
        .'<select>'
            .'<option></option>'
        .'</select>'
    .'</div>'
    .'<div>'
        .'<p><label>Jours de arrivé</label></p>'
        .'<p><input type="date" value="" ></p>'
    .'</div>'
    .'<div>'
        .'<p><label>Heure de arrivé</label></p>'
        .'<p><input type="time" value=""></p>'
    .'</div>'
    .'<div>'
        .'<p><label>Nombre de place Totale</label></p>'
        .'<p><input type="Number" value="" ></p>'
    .'</div>'
    .'<div>'
        .'<p><label>Nombre de place restante</label></p>'
        .'<p><input type="number" value=""></p>'
    .'</div>'
    .'<input type="submit" value="Crée">'
    .'<input type="submit" value="Modifier">'
    .'<input type="submit" value="Supprimer">'
.'</fieldset>';



require __DIR__ . '/../Layout.php';
?>

