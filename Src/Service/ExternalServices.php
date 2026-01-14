<?php
namespace App\Service;

class ExternalService {

    public function ConvertisseurTime($Time) {
        // 1. On transforme le float en int (on arrondit à la seconde près)
        $totalSeconds = (int)round($Time);

        // 2. On calcule les heures (3600 secondes par heure)
        $heures = floor($totalSeconds / 3600);

        // 3. On récupère le reste pour les minutes
        $resteSecondes = $totalSeconds % 3600;
        $minutes = floor($resteSecondes / 60);

        // 4. Le reste final correspond aux secondes
        $secondes = $resteSecondes % 60;

        // 5. Retour du résultat formaté
        return "{$heures} h {$minutes} min {$secondes} s";
    }
    /**
    *Obtenir le temps de trajet entre les deux villes sélectionnées.
    *@param string $city1 Le nom de lma première ville
    *@param string $city2 Le nom de la seconde ville
    *@return array Un tableau contenant le temps de trajet formaté et la distance en Km
    */
    
    public function getTravelTime($city1, $city2) {
        // 1. Geocoding (on transforme les noms en coordonnées)
        // Note: Nominatim demande un User-Agent personnalisé
        $opts = ["http" => ["header" => "User-Agent: MonAppCovoiturage/1.0\r\n"]];
        $context = stream_context_create($opts);

        $geo1 = json_decode(file_get_contents("https://nominatim.openstreetmap.org/search?q=".urlencode($city1)."&format=json&limit=1", false, $context), true);
        $geo2 = json_decode(file_get_contents("https://nominatim.openstreetmap.org/search?q=".urlencode($city2)."&format=json&limit=1", false, $context), true);

        if (!$geo1 || !$geo2) return "Ville introuvable";

        $loc1 = $geo1[0]['lon'] . "," . $geo1[0]['lat'];
        $loc2 = $geo2[0]['lon'] . "," . $geo2[0]['lat'];

        // 2. Calcul d'itinéraire via OSRM
        $url = "http://router.project-osrm.org/route/v1/driving/$loc1;$loc2?overview=false";
        $route = json_decode(file_get_contents($url), true);

        if ($route['code'] == 'Ok') {
            $duration = $route['routes'][0]['duration'];
            $distance = $route['routes'][0]['distance']; // en mètres
            $time = $this->ConvertisseurTime($duration);
            return [
                'temps' => $time,
                'km' => round($distance / 1000, 1) . " km"
            ];
        }
        return "Erreur de calcul";
    }

}