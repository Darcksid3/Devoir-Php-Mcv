<?php
namespace App\Db;

use Error;

class DbDeleteService extends DbConnexion {

    /**
    * Supression d'un trajet
    * @param int $id
    * @return void|string
    */
    public function deleteTrajet(int $id) { 
        try {
        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
                
                throw new \Exception("La connexion à la base de données a échoué.");
            }
        $sql = "delete from trajet where id = :id";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['id' => $id]);
        } catch (Error) {
            return 'une erreur est survenue';
        }
    }

    /**
    * Supression d'une agence
    * @param int $id
    * @return void|string
    */
    public function deleteVille(int $id) {
        try {
            
            $connexion = $this->connexion(2);
            if (!$connexion instanceof \PDO) {
                
                throw new \Exception("La connexion à la base de données a échoué.");
            }
            $sql = "delete from ville where id = :id";
            $query = $connexion->prepare((string) $sql);
            $query->execute(['id' => $id]);

        } catch(error) {
            return 'une eerreur est survenur';
        }
    }
};

?>