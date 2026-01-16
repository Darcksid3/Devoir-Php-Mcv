<?php
namespace App\Controllers;

use App\Db\DbConnexion;
use App\Db\DbAddService;
use App\Db\DbSelectService;




/**
* TEST AJOUT DE TRAJET AUTHOMATISé
*/
function randomVille(){
    $connexion = new DbSelectService();
    $db = $connexion->connexion(2);
    $sql = 'select count(*) from ville';
    $query = $db->query($sql);
    $count = $query->fetchColumn();
    $random = rand(0, $count);
    $ville = $connexion->recupVilleById($random);
    return $ville['id'];
    

}

function randomPlace(){
    $place = [];
    $placeTotale = rand(2, 9);
    $placeDisponible = rand(1, 9);
    
    return $place = ['place_totale' => $placeTotale, 'place_disponible' => $placeDisponible];
}
$place = randomPlace();

function testAddTrajet($place){
            $_POST['depart_ville_id'] = randomVille();
            $_POST['depart_date'] = '';
            $_POST['depart_heure'] = '';
            $_POST['arrive_ville_id'] = randomVille();
            $_POST['arrive_date'] = '' ;
            $_POST['arrive_heure'] = '';
            $_POST['place_totale'] = $place['place_totale'];
            $_POST['place_disponible'] = $place['place_disponible'];
            $_POST['createur_id'] ='' ;
}

testAddTrajet($place)
?>