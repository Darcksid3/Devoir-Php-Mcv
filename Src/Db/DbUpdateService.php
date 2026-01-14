<?php
namespace App\Db;

class DbUpdateService extends DbConnexion {

    public function updateTrajet($infoTrajet) {
        
        $connexion = $this->connexion(1);
        $sql = "update trajet set depart_ville_id=:depart_ville_id,depart_date=:depart_date,depart_heure=:depart_heure,arrive_ville_id=:arrive_ville_id,arrive_date=:arrive_date,arrive_heure=:arrive_heure,place_totale=:place_totale,place_disponible=:place_disponible where id=:id";
        $query = $connexion->prepare($sql);
        $query->execute([
            'depart_ville_id' => (int)$infoTrajet['ville_depart'],
            'depart_date' => $infoTrajet['date_depart'],
            'depart_heure' => $infoTrajet['heure_depart'],
            'arrive_ville_id' => (int)$infoTrajet['ville_arrivee'],
            'arrive_date' => $infoTrajet['date_arrivee'],
            'arrive_heure' => $infoTrajet['heure_arrivee'],
            'place_totale' => (int)$infoTrajet['place_totale'],
            'place_disponible' => (int)$infoTrajet['place_disponible'],
            'id' => (int)$infoTrajet['id_trajet']
        ]);
        
    }
}
?>