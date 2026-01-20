<?php
namespace App\Controllers;

use App\Db\DbSelectService;
use App\Db\DbAddService;
use App\Service\PasswordVerif;


// récupération des données du formulaire.
$email = $_POST['email'] ?? '';
$password1 = $_POST['password1'] ?? '';
$password2 = $_POST['password2'] ?? '';

/**
* Fonction de vérification du formulaire d'inscription.
*
* @param string $email email de l'utilisateur.
* @param string $password1 1er mot de passe.
* @param string $password2 confirmation du premier mot de passe.
*  Redirection vers la page d'inscription en cas déerreur ou vers la page d'accueil en cas de succes.
* @return void
*/
function verifFormInscription(mixed $email, mixed $password1, mixed $password2) {

    //* Récupération des classes de services.
    $dbSelectService = new DbSelectService();
    $verifPassword = new PasswordVerif();
    
    //* 1) Résultat de la vérification que l'email existe chez les employés de l'entreprise.
    $verifMail = $dbSelectService->searchEmail($email);
    var_dump($verifMail);
    //* 2) Résultat de la vérification des mot de passe.
    $verifMdp = $verifPassword->verifPassword($password1, $password2);
    
    //* 3) Analyse des résultats et affichage.
    if (!$verifMail['status'] || !$verifMdp) {
        $_SESSION['message'] = '<div class="msg msg-err">email ou mot de passe incorrect.</div>';
        header('Location: /FormInscript');
        exit();

    } else {
        //* 1) récupération de l'id de l'utilisateur
        $uid = (int) $verifMail['user']['id'];
        //* 2) hash du mot de passe
        $pass_hash = $verifPassword->hashPassword($password1);
        //* 3) ajout de l'utilistaueur dans la base de donnée des utilisteur enregistrés.
        $add = new DbAddService();
        $add->addUser((int) $uid, $pass_hash);
        //* 4) Message de succes et redirection.
        $_SESSION['message'] = '<div class="msg msg-ok">Inscription réussit</div>';
        $_SESSION['inscription'] = true;
        header('Location: /');
        exit();

    }
    
}
verifFormInscription($email, $password1, $password2);