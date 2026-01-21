<?php
namespace App\Db;

use App\Db\DbConnexion;

class DbAddService extends DbConnexion {

    /**
    * Ajout d'un trajet en base de donnée.
    * @param array<mixed> $infoTrajet Informations du trajet à ajouter.
    * @throw Exeption erreur de connection à la base de donnée
    * @return void 
    */
    public function addTrajet(mixed $infoTrajet): void {
        
        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql ="insert into trajet (depart_ville_id, depart_gdh, depart_date, arrive_ville_id, arrive_gdh, arrive_date, place_totale, place_disponible, createur_id) values (:depart_ville_id, :depart_gdh, :depart_date, :arrive_ville_id, :arrive_gdh, :arrive_date, :place_totale, :place_disponible, :createur_id)";
        $query = $connexion->prepare((string) $sql);
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
    
    /**
    * Ajout d'une nouvelle agence
    * @param string $ville
    * @throw Exeption erreur de connection à la base de donnée
    * @return void
    */
    public function addVille(string $ville): void {

        $connexion = $this->connexion(2);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "insert into ville (nom) values (:ville)";
        $query = $connexion->prepare((string) $sql);
        
        $query->execute(['ville' => $ville]);
    }

    
}
?>