<?php
namespace App\Admin;
use App\Db\DbAddService;
use App\Db\DbSelectService;
use App\Db\DbUpdateService;
use App\Db\DbDeleteService;

$post = $_POST;
var_dump($post);
function addVille($ville) {
    $dbSelectService = new DbSelectService();
    $response = $dbSelectService->recupVilleByName($ville);
    if($response['status'] === false){
        $dbAddService = new DbAddService();
        $dbAddService->addVille($ville);
        $_SESSION['message'] = '$action = create';
        header('Location: /Success');
        exit();
    } else {
        $_SESSION['message'] = 'Cette ville existe déja !!';
        header('Location: /FormAgence');
        exit();
    }
}

function deleteVille($id) {
    $dbDeleteService = new DbDeleteService();
    $dbDeleteService->deleteVille($id);
    $_SESSION['message'] = 'Ville supprimé avec succes';
    header('Location: /Success');
    exit();
}

function updateVille($id, $nouveau_nom){
    $dbUpdateService = new DbUpdateService();
    $dbUpdateService->updateVille($id,$nouveau_nom);
    $_SESSION['message'] = 'Ville modifié avec succes';
    header('Location: /Success');
    exit();
}
function verifForm($post){

    if($post['action'] === 'create') {
        addVille($post['nom']);
    } else if ($post['action'] === 'delete') {
        deleteVille($post['ville']);
    } else if ($post['action'] === 'update') {
        updateVille($post['ville'], $post['nouveau_nom']);
    }
}

verifForm($post);


?>