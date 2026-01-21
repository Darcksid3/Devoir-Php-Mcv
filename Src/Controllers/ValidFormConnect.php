<?php
namespace App\Controllers;

use App\Db\DbSelectService;
use App\Service\PasswordVerif;

// Récupération des informations du formulaire.
$email = $_POST['email'];
$password = $_POST['password'];

/**
* Fonction de vérification du formumaire de connexion.
*
* @param string $email Email fournis dans le formulaire.
* @param string $password Mot de passe fournis dans le formulaire.
* * Redirection vers la page d'inscription en cas d'erreur ou vers la page d'accueil en cas de  success.
* @return void
*/
function verifFormConnexion(mixed $email, mixed $password) {
    //* 1) import des classes de services
    $dbSelectService = new DbSelectService();
    $passwordVerif = new PasswordVerif();
    //* 2) récupération de l'id de l'utilisateur par son email
    $searchMail = $dbSelectService->searchEmail($email);
    

    if ($searchMail['status']===true) {
        //* Si ok 
        $infoUser = $searchMail['user'];
        $id = $infoUser['id'];
        //* 3) Récupération du mot de passe hashé
        $pass_hash = $dbSelectService->recupHash($id);
        //* 4) Vérifdication du hash du mot de passe 
        $verifPass = $passwordVerif->verifHash($password, $pass_hash['password_hash']);
        if($verifPass) {
            //* mise en session des info de l'utilisateur
            $_SESSION['utilisateur'] = [
                'id' => $infoUser['id'], 
                'nom' => $infoUser['nom'], 
                'prenom' => $infoUser['prenom'], 
                'telephone' => $infoUser['telephone'], 
                'email' => $infoUser['email'], 
                'status' => $pass_hash['status'], 
                'connect' => true
                ];

            //* Succes
            $_SESSION['message'] = '<div class="msg msg-ok">Utilisateur authentifié avec succés.</div>';
            header('Location: /');
            exit();
        } else{
            //* Erreur
            $_SESSION['message'] = '<div class="msg msg-err">Une erreur est survenue veuillez vérifiez vos informations</div>';
            header('Location: /FormConnect'); 
            exit();
        }

    } else {
        //* Si faux retour au formulaire
        $_SESSION['message'] = '<div class="msg msg-err">Une erreur est survenue veuillez vérifiez vos informations</div>';
        header('Location: /FormConnect'); 
        exit();
    }

}

verifFormConnexion($email, $password);


?>