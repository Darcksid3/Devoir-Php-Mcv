<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Db\DbUpdateService;
use PDO;

class DbUpdateServiceTest extends TestCase {
    private DbUpdateService $service;
    private PDO $dbVerify;

    protected function setUp(): void {
        $this->service = new DbUpdateService();
        $this->dbVerify = new PDO("mysql:host=localhost;dbname=test_covoiturage_interne", "a_app", "a_app_mdp");
    }

    public function testUpdateTrajetPlaces(): void {
        // On modifie le trajet ID 2 (Bordeaux -> Toulouse dans votre SQL)
        $data = [
            'id' => 2,
            'depart_ville' => 9,
            'depart_gdh' => '161426Z JAN 26',
            'depart_date' => '2026-01-16 14:26:00',
            'arrive_ville' => 4,
            'arrive_gdh' => '161626Z JAN 26',
            'arrive_date' => '2026-01-16 16:26:00',
            'place_totale' => 4,
            'place_disponible' => 1, // On change de 0 à 1
        ];

        $this->service->updateTrajet($data);

        $stmt = $this->dbVerify->query("SELECT place_disponible FROM trajet WHERE id = 2");
        $result = $stmt->fetch();
        
        $this->assertEquals(1, $result['place_disponible'], "Le nombre de places devrait être mis à jour à 1.");
    }
    
    public function testUpdateVilleName(): void {
        // On modifie la ville ID 1 (Paris)
        $nouveauNom = "Paris Centre";
        $this->service->updateVille(1, $nouveauNom);

        $stmt = $this->dbVerify->query("SELECT nom FROM ville WHERE id = 1");
        $result = $stmt->fetch();
        
        $this->assertEquals($nouveauNom, $result['nom']);
    }

    
}