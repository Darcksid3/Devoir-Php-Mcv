<?php
namespace App\Service;
use App\Db\Connexion;

class SearchEmail {

	public function searchEmail($email) {
        //importation de la connexion à la BDD
        $connexionDb = new Connexion();
        $pdo = $connexionDb->rsConnect();

        // Requête pour vérifier si l'email existe
        $query = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $query->execute(['email' => $email]);
        
        // Vérification du résultat
        if ($query->rowCount() >= 1) {
            $_SESSION['message'] = "L'email existe dans la base de données.";
            $resultat = $query->fetch();
            return $resultat;
        } else {
            $_SESSION['message'] = "L'email n'existe pas dans la base de données.";
        }
    }

}

?>