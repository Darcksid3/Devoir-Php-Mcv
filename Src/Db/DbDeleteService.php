<?php
namespace App\Db;

use Error;

class DbDeleteService extends DbConnexion {

    public function deleteTrajet($id) { 
        try {
        $connexion = $this->connexion(1);
        $query = $connexion->prepare("delete from trajet where id = :id");
        $query->execute(['id' => $id]);
        } catch (Error) {
            return 'une erreur est survenue';
        }
    }

    public function deleteVille($id) {
        try {
            $connexion = $this->connexion(2);
            $query = $connexion->prepare("delete from ville where id = :id");
            $query->execute(['id' => $id]);

        } catch(error) {
            return 'une eerreur est survenur';
        }
    }
};

?>