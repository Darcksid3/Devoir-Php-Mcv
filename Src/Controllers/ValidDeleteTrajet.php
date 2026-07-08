<?php
namespace App\Controllers;

use App\Db\DbDeleteService;
use App\Service\RecupId;

$recupId = new RecupId();
$id = $recupId->recupId($_SERVER['REQUEST_URI']);

if ($id === null && $_SESSION["deleteIds"] === null) {
    Header('Location: /');
    exit();
}
$boxChecked = $_SESSION["deleteIds"];
/**
* Supression d'un trajet
* @param int $id du trajet concerné
* @return never
*/
function deleteTrajet(int $id): never {
    $dbDeleteService = new DbDeleteService();
    $dbDeleteService->deleteTrajet($id);

    $_SESSION['message'] = '<div class="msg msg-ok">Trajet supprimé avec succès !!</div>';
    header('Location: /');
    exit();
}
/**
* Supression de plusieurs trajets
* @param array $_SESSION["boxChecked"] du trajet concerné
* @return never
*/
function deleteMultyTrajet($boxes): never {
    $dbDeleteService = new DbDeleteService();
    foreach ($boxes as $box) {
			$dbDeleteService->deleteTrajet($box);
			}
    

    $_SESSION['message'] = '<div class="msg msg-ok">Trajet supprimé avec succès !!</div>';
    header('Location: /');
    exit();
}

if ($id !== null) {
    deleteTrajet($id);
}
if ($_SESSION["deleteIds"] !== null) {
    deleteMultyTrajet($_SESSION["deleteIds"]);
    
    $_SESSION['message'] = '<div class="msg msg-ok">Trajet supprimé avec succès !!</div>';
    header('Location: /');
    exit();
    
}


?>