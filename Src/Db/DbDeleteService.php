<?php
namespace App\Db;

use Error;

class DbDeleteService extends DbConnexion {

    public function deleteTrajet(int $id) { 
        try {
        $connexion = $this->connexion(1);
        $sql = "delete from trajet where id = :id";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['id' => $id]);
        } catch (Error) {
            return 'une erreur est survenue';
        }
    }

    public function deleteVille($id) {
        try {
            $connexion = $this->connexion(2);
            $sql = "delete from ville where id = :id";
            $query = $connexion->prepare((string) $sql);
            $query->execute(['id' => $id]);

        } catch(error) {
            return 'une eerreur est survenur';
        }
    }
};

?>