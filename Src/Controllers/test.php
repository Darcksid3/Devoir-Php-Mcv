<?php
namespace App\Controllers;

use App\Db\Connexion;
use PDOException;

class Test{
    
    public function test() {
    $test = 'test controller';
    return $test;
    }
    //! récupération multi info pour liste des trajets
    public function connect() {
        try {
            $connexion = new Connexion();
            $pdo = $connexion->rsConnect();
            $query = $pdo->query("SELECT id, email FROM utilisateur");
            return $query;
        } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
        }
    }

    
    private $liste = '';
    private $option = "";

    public function optionTestl() {
        $listEmail = $this->connect();
        foreach ($listEmail as $user) {
            // On CONCATÈNE avec .= au lieu de faire echo
            $this->liste .= $user['email'] . "<br>"; 
            $this->option .= '<option value="'.$user['id'].'">'.$user['email'].'</option>';
        }
        return $this->option;
    }
    //! FIN récup multi info pour liste trajets
}
?>