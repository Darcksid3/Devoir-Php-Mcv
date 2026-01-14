<?php
namespace App\Service;

class RecupId {

    public function recupId($uri) {
        //$uri = $_SERVER['REQUEST_URI']; // Récupère "/Pages/id"
        $segments = explode('/', trim($uri, '/')); // Découpe par les "/"
        if (count($segments) < 2) {
            return null;
        } else if (!(int) end($segments)){
            return null; // on vérifie que l'id est bien un integer ou une chaine numérique
        } else {
            $id = end($segments); // Récupère le dernier élément : "id"
            return $id;
        }
    }
}


?>
