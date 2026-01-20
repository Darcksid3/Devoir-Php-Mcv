<?php
namespace App\Pages;

use App\Service\RecupId;

$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

if ($id === null) {
    Header('Location: /');
    exit();
}

$content = '<h2>Page de confirmation de supression de trajet</h2>'
        .'<button type="button" class="mybtn mybtn-grey" onclick="location.href=\'/ValidDeleteTrajet/'.$id.'\'">Confirmer la suppression</button>';
;





require __DIR__ . '/Layout.php';

?>
