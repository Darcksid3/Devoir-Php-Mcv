<?php
namespace App\Pages;

use App\Service\StatusVerif;
use App\Db\DbSelectService;
use DateTime;
use DateTimeZone;

$content = '<h2>Test View</h2>';
function randomVille(){
    $connexion = new DbSelectService();
    $db = $connexion->connexion(2);
    $sql = 'select count(*) from utilisateur';
    $query = $db->query($sql);
	$count = $query->fetchColumn();
	return $count;
    

}

$content .= randomVille();
$content .= '<input type="datetime-local" lang="fr-FR">';

function generateGDH($date = "now", $timezone = "UTC") {
    $dt = new DateTime($date, new DateTimeZone($timezone));
    
    // Format : Jour(2) + Heure(2) + Min(2) + Zone(1) + " " + Mois(3) + " " + Année(2)
    // On met le mois en majuscules (strtoupper)
    return strtoupper($dt->format('dHi\Z M y'));
}

// Exemple d'utilisation :
$content .='<hr>'
        .'Génaration GDH'
        . generateGDH()
        ;

function splitGDH($gdh) {
    // Regex pour capturer : Jour(2), HeureMin(4), Zone(1), Mois(3), Année(2)
    $pattern = '/^(\d{2})(\d{4})([A-Z])\s([A-Z]{3})\s(\d{2})$/i';
    
    if (preg_match($pattern, $gdh, $matches)) {
        return [
            'jour'   => $matches[1],
            'heure'  => substr($matches[2], 0, 2) . ":" . substr($matches[2], 2, 2),
            'fuseau' => $matches[3],
            'mois'   => $matches[4],
            'annee'  => "20" . $matches[5],
            'lecture_humaine' => "Le {$matches[1]} {$matches[4]} 20{$matches[5]} à " . substr($matches[2], 0, 2) . "h" . substr($matches[2], 2, 2) . " (Zone {$matches[3]})"
        ];
    }
    return false;
}

// Exemple d'utilisation :
$monGdh = generateGDH();
$infos = splitGDH($monGdh);

if ($infos) {
    $content .= '<hr><p>Le gdh utilisez est : '.generateGDH().'</p><p>le GDH décripté est : '.$infos['lecture_humaine'].'</p>'; 
    // Affiche : Le 16 JAN 2026 à 09h33 (Zone Z)
} else {
    $content .= '<hr><p>Pas de GDH</p>';
}

require __DIR__ .'/../Pages/Layout.php';
?>