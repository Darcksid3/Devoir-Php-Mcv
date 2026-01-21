<?php
namespace App\Admin;
use App\Db\DbAddService;
use App\Db\DbSelectService;
use App\Db\DbUpdateService;
use App\Db\DbDeleteService;

$post = $_POST;

/**
* Mise en place du bouton d'action
* @param string $ville
* @return void
*/
function addVille(string $ville) {
    $addVille = ucfirst($ville);
    $dbSelectService = new DbSelectService();
    $response = $dbSelectService->recupVilleByName($addVille);
    if($response['status'] === false){
        $dbAddService = new DbAddService();
        $dbAddService->addVille($addVille);
        $_SESSION['message'] = '$action = create';
        header('Location: /FormAgence');
        exit();
    } else {
        $_SESSION['message'] = 'Cette ville existe déja !!';
        header('Location: /FormAgence');
        exit();
    }
}
/**
* Mise en place du bouton d'action
* @param int $id
* @return void
*/
function deleteVille(int $id) {
    $dbDeleteService = new DbDeleteService();
    $dbDeleteService->deleteVille($id);
    $_SESSION['message'] = 'Ville supprimé avec succes';
    header('Location: /FormAgence');
    exit();
}

/**
* Mise en place du bouton d'action
* @param int $id
* @param string $nouveau_nom
* @return void
*/
function updateVille(int $id, string $nouveau_nom){
    $updateVille = ucFirst($nouveau_nom);
    $dbUpdateService = new DbUpdateService();
    $dbUpdateService->updateVille($id,$updateVille);
    $_SESSION['message'] = 'Ville modifié avec succes';
    header('Location: /FormAgence');
    exit();
}
/**
* Mise en place du bouton d'action
* @param array<mixed> $post
* @return void
*/
function verifForm(array $post){

    if($post['action'] === 'create') {
        addVille($post['nom']);
    } else if ($post['action'] === 'delete') {
        deleteVille($post['ville']);
    } else if ($post['action'] === 'update') {
        updateVille($post['ville'], $post['nouveau_nom']);
    }
}
$_SESSION['pages'] = ' Agences';

verifForm($post);


?>