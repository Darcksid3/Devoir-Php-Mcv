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
function verifFormConnexion($email, $password) {
    //* 1) import des classes de services
    $dbSelectService = new DbSelectService();
    $passwordVerif = new PasswordVerif();
    //* 2) récupération de l'id de l'utilisateur par son email
    $searchMail = $dbSelectService->searchEmail($email);
    $infoUser = $searchMail['user'];
    $id = $infoUser['id'];
    //* 3) Récupération du mot de passe hashé
    $pass_hash = $dbSelectService->recupHash($id);
    //* 4) Vérifdication du hash du mot de passe 
    $verifPass = $passwordVerif->verifHash($password, $pass_hash['password_hash']);

    if ($searchMail && $verifPass) {
        //* Si ok 
        // mise en session des info de l'utilisateur
        $_SESSION['utilisateur'] = [
            'id' => $infoUser['id'], 
            'nom' => $infoUser['nom'], 
            'prenom' => $infoUser['prenom'], 
            'telephone' => $infoUser['telephone'], 
            'email' => $infoUser['email'], 
            'status' => $pass_hash['status'], 
            'connect' => true
            ];

        // Message de succes
        $_SESSION['message'] = "Utilisateur authentifié avec succés";
        // redirection page de succes
        header('Location: /Success');
        exit();

    } else {
        //* Si faux retour au formulaire
        $_SESSION['message'] = 'Une erreur est survenue veuillez vérifiez vos informations';
        header('Location: /FormInscript');
        exit();
    }

}

verifFormConnexion($email, $password);


?>