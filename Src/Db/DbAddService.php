<?php
namespace App\Db;

use App\Db\DbConnexion;

class DbAddService extends DbConnexion {

    /**
    * Ajout d'un utilisateur en base de donnée.
    * @param string $id Identifiant de l'utilisateur.
    * @param string $password Hash du mot de passe de l'utilisateur.
    * @return void.
    */
    public function addUser($id, $password) {
        $pdo = $this->Connexion(0);
        $query = $pdo->prepare("insert into utilisateur_enregistre (utilisateur_id, password_hash) values (:id, :password) ");
        $query->execute(['id' => $id, 'password' => $password]);
    }

    /**
    * Ajout d'un trajet en base de donnée.
    * @param array $infoTrajet Informations du trajet à ajouter.
    * @return void. 
    */
    public function addTrajet($infoTrajet) {
        //ajoute un trajet
        $pdo = $this->connexion(1);
        $query = $pdo->prepare("insert into trajet (depart_ville_id, depart_date, depart_heure, arrive_ville_id, arrive_date, arrive_heure, place_totale, place_disponible, createur_id) values (:depart_ville_id, :depart_date, :depart_heure, :arrive_ville_id, :arrive_date, :arrive_heure, :place_totale, :place_disponible, :createur_id)");
        $query->execute([
            'depart_ville_id' => (int)$infoTrajet['ville_depart'],
            'depart_date' => $infoTrajet['date_depart'],
            'depart_heure' => $infoTrajet['heure_depart'],
            'arrive_ville_id' => (int)$infoTrajet['ville_arrivee'],
            'arrive_date' => $infoTrajet['date_arrivee'],
            'arrive_heure' => $infoTrajet['heure_arrivee'],
            'place_totale' => (int)$infoTrajet['place_totale'],
            'place_disponible' => (int)$infoTrajet['place_disponible'],
            'createur_id' => (int)$infoTrajet['createur_id']
        ]);
    }

    public function addVille($ville) {
        //ajoute une ville 
        $pdo = $this->connexion(2);
        $query = $pdo->prepare("insert into ville (nom) values (:ville)");
        
        $query->execute(['ville' => $ville]);
    }

    
}

?>