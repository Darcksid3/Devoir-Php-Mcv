<?php
namespace App\Pages;

use App\Service\RecupId;
// Récupération de l'Id si il existe pour les supressions via OWNER
$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

// if start
if ($id === null && $_SESSION["deleteIds"] === null) {
    Header('Location: /');
    exit();
//if end elseif start
} elseif($id !== null ) {
    $content = '<h2>Page de confirmation de supression de trajet</h2>'
            .'<button type="button" class="mybtn mybtn-grey" onclick="location.href=\'/ValidDeleteTrajet/'.$id.'\'">Confirmer la suppression</button>';
//elseif end else start
} else {
    // Vérification de la récèption du formulaire JS pour l'ADMIN
    if (isset($_POST['checked_json'])) {
        // On décode la chaîne JSON pour récupérer le vrai tableau PHP
        $_SESSION["deleteIds"] = json_decode($_POST['checked_json'], true);
        if (is_array($_SESSION["deleteIds"])) {
            if (count($_SESSION["deleteIds"]) > 1) {
                $msg_supp = "Confirmer les suppressions";
                $trajet = "trajets";
            } else {
                $msg_supp = "Confirmer la suppression";
                $trajet = "trajet";
            }
            $content = '<h2>Page de confirmation de supression des trajets</h2>'
            .'<p>Supression de '.count($_SESSION["deleteIds"]).' '.$trajet.'</p>'
            .'<button type="button" class="mybtn mybtn-grey" onclick="location.href=\'/ValidDeleteTrajet\'">'.$msg_supp.'</button>';
        }
    }
} 
$_SESSION['pages'] = ' - Suppression';
require __DIR__ . '/Layout.php';

?>
