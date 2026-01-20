<?php
namespace App\Db;

use App\Db\DbConnexion;

class DbAddService extends DbConnexion {

    /**
    * Ajout d'un utilisateur en base de donnée.
    * @param int $id Identifiant de l'utilisateur.
    * @param string $password Hash du mot de passe de l'utilisateur.
    * @return void
    */
    public function addUser(int $id, mixed $password) {
        $pdo = $this->Connexion(0);
        $sql = "insert into utilisateur_enregistre (utilisateur_id, password_hash) values (:id, :password)";
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $id, 'password' => $password]);
    }

    /**
    * Ajout d'un trajet en base de donnée.
    * @param array<mixed> $infoTrajet Informations du trajet à ajouter.
    * @return void 
    */
    public function addTrajet(mixed $infoTrajet): void {
        //ajoute un trajet
        $pdo = $this->connexion(1);
        $sql ="insert into trajet (depart_ville_id, depart_gdh, depart_date, arrive_ville_id, arrive_gdh, arrive_date, place_totale, place_disponible, createur_id) values (:depart_ville_id, :depart_gdh, :depart_date, :arrive_ville_id, :arrive_gdh, :arrive_date, :place_totale, :place_disponible, :createur_id)";
        $query = $pdo->prepare($sql);
        $query->execute([
            'depart_ville_id' => (int)$infoTrajet['depart_ville'],
            'depart_gdh' => $infoTrajet['depart_gdh'],
            'depart_date' => $infoTrajet['depart_date'],
            'arrive_ville_id' => (int)$infoTrajet['arrive_ville'],
            'arrive_gdh' => $infoTrajet['arrive_gdh'],
            'arrive_date' => $infoTrajet['arrive_date'],
            'place_totale' => (int)$infoTrajet['place_totale'],
            'place_disponible' => (int)$infoTrajet['place_disponible'],
            'createur_id' => (int)$infoTrajet['createur_id']
        ]);
    }

    public function addVille(string $ville): void {
        //ajoute une ville 
        $pdo = $this->connexion(2);
        $sql = "insert into ville (nom) values (:ville)";
        $query = $pdo->prepare($sql);
        
        $query->execute(['ville' => $ville]);
    }

    
}
?>