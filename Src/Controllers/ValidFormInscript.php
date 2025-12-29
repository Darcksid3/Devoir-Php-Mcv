<?php
namespace App\Controllers;

use App\Db\Connexion;
use App\Service\SearchEmail;


//1) vérification que l'email existe chez les utilisateurs de l'entreprise 
// récupération des données du formulaire
$email = $_POST['email'] ?? '';
$password1 = $_POST['password1'] ?? '';
$password2 = $_POST['password2'] ?? '';


//TODO A exporter dans son propre fichier de gestion des mot de passe avec la vérification de Connexion Utilisateur
function verifPass($pass1, $pass2) {
    if ($pass1 !== $pass2) {
        $_SESSION['message'] = 'Mot de passe incorect';
        header('Location: /FormInscript');
        exit();
    } else {
        return true;
        
    }
}

function verif($email, $password1, $password2) {
    //$verifMail = $
    $search = new SearchEmail();
    $verifMail = $search->searchEmail($email);

    $verifMdp = verifPass($password1, $password2);

    if (!$verifMail && !$verifMdp) {
        $_SESSION['message'] = 'email ou mot de passe incorect.';
        header('Location: /FormInscript');
        exit();
    } else {
        
        $uid = (int) $verifMail['id'];
        $pass_hash = password_hash($password1, PASSWORD_BCRYPT);
        $connect = new Connexion();
        $connect->addUser($uid, $pass_hash);
        $_SESSION['message'] = 'Inscription réussit';
        header('Location: /Success');
        exit();

    }
}
verif($email, $password1, $password2);
