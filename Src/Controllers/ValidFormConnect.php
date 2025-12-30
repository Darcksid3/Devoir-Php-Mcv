<?php
namespace App\Controllers;
use App\Db\Connexion;
use App\Service\SearchEmail;
use App\Service\PasswordVerif;


$email = $_POST['email'];
$password = $_POST['password'];

function recupHash($id){
	$id = 1;
	$connectDb = new Connexion();
	$pdo = $connectDb->appConnect();
	$pass = $pdo->query("select password_hash from utilisateur_enregistre where utilisateur_id = '$id'");
	$resultat = $pass->fetch();
	return $resultat;
}


function verif($email, $password) {
    //* Initialisation des classes
    $searchEmail = new SearchEmail();
    $verifPassword = new PasswordVerif();

    
    //* récupération de l'Id
    $serchMail = $searchEmail->searchEmail($email);
    $id = $serchMail['id'];

    //* récupération du mot de passe haché
    $pass_hash = recupHash($id);

    //* Vérification du hash du mot de passe
    $verifPass = $verifPassword->verifHash($password, $pass_hash['password_hash']);

    if ($serchMail && $verifPass) {
        //* Si ok 
        // mise en session des info de l'utilisateur
        $_SESSION['utilisateur_id'] = $serchMail['id'];
        $_SESSION['utilisateur_nom'] = $serchMail['nom'];
        $_SESSION['utilisateur_prenom'] = $serchMail['prenom'];
        $_SESSION['utilisateur_telephone'] = $serchMail['telephone'];
        $_SESSION['utilisateur_email'] = $serchMail['email'];
        $_SESSION['utilisateur_connect'] = true;
        // Message de succes
        $_SESSION['message'] = "Utilisateur authentifié avec succés";
        // redirection page de succes
        header('Location: /Success');
        exit();

    } else {
        //* Si faux retour au formulaire
        $_SESSION['message'] = $email. ' Non Trouvé!';
        header('Location: /FormInscript');
        exit();
    }
} 
verif($email, $password)


?>