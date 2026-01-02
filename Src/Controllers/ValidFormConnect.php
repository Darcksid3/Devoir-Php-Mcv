<?php
namespace App\Controllers;
use App\Db\Connexion;
use App\Service\SearchEmail;
use App\Service\PasswordVerif;

$email = $_POST['email'];
$password = $_POST['password'];

function recupHash($id){
	//$id = 1;
	$connectDb = new Connexion();
	$pdo = $connectDb->theConnect(1);
    $query = $pdo->prepare("select password_hash, status from utilisateur_enregistre where utilisateur_id = :id");
    $query->execute(['id' => $id]);
	
	$resultat = $query->fetch();
	return $resultat;
}


function verif($email, $password) {
    //* Initialisation des classes
    $searchEmail = new SearchEmail();
    $verifPassword = new PasswordVerif();

    
    //* récupération de l'Id
    $serchMail = $searchEmail->searchEmail($email);+
    $id = $serchMail['id'];

    //* récupération du mot de passe haché
    $pass_hash = recupHash($id);

    //* Vérification du hash du mot de passe
    $verifPass = $verifPassword->verifHash($password, $pass_hash['password_hash']);

    if ($serchMail && $verifPass) {
        //* Si ok 
        // mise en session des info de l'utilisateur
        $_SESSION['utilisateur'] = [
            'id' => $serchMail['id'], 
            'nom' => $serchMail['nom'], 
            'prenom' => $serchMail['prenom'], 
            'telephone' => $serchMail['telephone'], 
            'email' => $serchMail['email'], 
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
        $_SESSION['message'] = $email. ' Non Trouvé!';
        header('Location: /FormInscript');
        exit();
    }
} 
verif($email, $password)


?>