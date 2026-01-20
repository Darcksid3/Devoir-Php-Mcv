<?php
namespace App\Service;

class RecupId {

    /**
    * Récupération de l'ID dans l'uri
    * @param string $uri
    * @return null|int
    */
    public function recupId(string $uri) {
        //$uri = $_SERVER['REQUEST_URI']; // Récupère "/Pages/id"
        $segments = explode('/', trim($uri, '/')); // Découpe par les "/"
        if (count($segments) < 2) {
            return null;
        } else if (!(int) end($segments)){
            return null; // on vérifie que l'id est bien un integer ou une chaine numérique
        } else {
            $id = (int)end($segments); // Récupère le dernier élément : "id"
            return $id;
        }
    }
}


?>
