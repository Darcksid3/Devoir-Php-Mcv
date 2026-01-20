<?php
namespace App\Db;

class DbUpdateService extends DbConnexion {

    /**
    * Mise a jour des trajets
    * @param array<mixed> $infoTrajet
    * @return void
    */
    public function updateTrajet(array $infoTrajet): void {
        
        $pdo = $this->connexion(1);
        if (!$pdo instanceof \PDO) {
                
                throw new \Exception("La connexion à la base de données a échoué.");
            }
        $sql = "update trajet set depart_ville_id=:depart_ville_id, depart_gdh=:depart_gdh, depart_date=:depart_date, arrive_ville_id=:arrive_ville_id, arrive_gdh=:arrive_gdh, arrive_date=:arrive_date, place_totale=:place_totale, place_disponible=:place_disponible where id=:id";
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
            'id' => (int)$infoTrajet['id'],
        ]);
        
    }

    public function updateVille(int $id, string $nouveau_nom):void{
        $pdo = $this->connexion(2);
        if (!$pdo instanceof \PDO) {
                
                throw new \Exception("La connexion à la base de données a échoué.");
            }
        $sql = "update ville set nom=:nouveau_nom where id=:id";
        $query = $pdo->prepare($sql);
        $query->execute(['nouveau_nom' => $nouveau_nom, 'id' => $id]);
    }
}
?>