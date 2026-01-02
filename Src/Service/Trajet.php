<?php
namespace App\Service;

use App\Db\Connexion;
class Trajet {

    public function afficheAll() {
        // connexion a la base de donnée
        $connexionDb = new Connexion();
        $connexion = $connexionDb->appConnect();

        // récupération de tout les trajet
        $query = $connexion->prepare("select * from trajet");
        $query->execute();
        
        if ($query->rowCount() >= 1) {
            // Renvoie de la liste
            $resultat = $query->fetchAll();
            return $resultat;
        } else {
            $retour = "Aucun tajet n'est prévu !!";
            return $retour;
        }

        
    }

    
}


?>