<?php
namespace App\Pages;

use App\Service\RecupId;

//Récupération de l'id
$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

if ($id === null) {
    Header('Location: /');
    exit();
}

$content = '<h2>Page de confirmation de supression de trajet</h2>'
        .'<button type="button" onclick="location.href=\'/ValidDeleteTrajet/'.$id.'\'">Confirmer la suppression</button>';
;





require __DIR__ . '/Layout.php';

?>
