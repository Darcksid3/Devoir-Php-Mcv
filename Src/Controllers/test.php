<?php
/*
namespace App\Controllers;

use App\Db\DbConnexion;
use App\Db\DbAddService;
use App\Db\DbSelectService;


class Test {
    public function displayError(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        ini_set('error_log', 'php://stderr');
        error_reporting(E_ALL);
    }

public function myLog($message, $color = "white"){
    $colors = [
        "red"    => "31m",
        "green"  => "32m",
        "yellow" => "33m",
        "blue"   => "34m",
        "white"  => "37m",
        "magenta" => "35m",
        "cyan" => "36m",
        "grey" => "38m"
    ];
    $code = $colors[$color] ?? "37m";
    
    
    error_log("\033[1;" . $code . " => " . $message . "\033[0m");
}
/**
* TEST AJOUT DE TRAJET AUTHOMATISé
*/
/*
public function randomVille(){
    $connexion = new DbSelectService();
    $db = $connexion->connexion(2);
    $sql = 'select count(*) from ville';
    $query = $db->query($sql);
    $count = $query->fetchColumn();
    $random = rand(0, $count);
    $ville = $connexion->recupVilleById($random);
    return $ville['id'];
    

}

public function randomPlace(){
    $place = [];
    $placeTotale = rand(2, 9);
    $placeDisponible = rand(1, 9);
    
    return $place = ['place_totale' => $placeTotale, 'place_disponible' => $placeDisponible];
}


public function testAddTrajet($place){
            $_POST['depart_ville_id'] = $this->randomVille();
            $_POST['depart_date'] = '';
            $_POST['depart_heure'] = '';
            $_POST['arrive_ville_id'] = $this->randomVille();
            $_POST['arrive_date'] = '' ;
            $_POST['arrive_heure'] = '';
            $_POST['place_totale'] = $place['place_totale'];
            $_POST['place_disponible'] = $place['place_disponible'];
            $_POST['createur_id'] ='' ;
}


}
*/
?>