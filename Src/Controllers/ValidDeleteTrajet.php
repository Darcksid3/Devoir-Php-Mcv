<?php
namespace App\Controllers;

use App\Db\DbDeleteService;
use App\Service\RecupId;
//Récupération de l'id
$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

if ($id === null) {
    Header('Location: /');
    exit();
}

function deleteTrajet($id) {
    $dbDeleteService = new DbDeleteService();
    $dbDeleteService->deleteTrajet($id);

    $_SESSION['message'] = 'Trajet '.$id.' supprimer avec success !!';
    header('Location: /Success');
    exit();
}

deleteTrajet($id)


?>