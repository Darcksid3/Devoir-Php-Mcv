<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Db\DbAddService;
use PDO;

class DbAddServiceTest extends TestCase {
    private DbAddService $service;
    private PDO $dbVerify;

    protected function setUp(): void {
        $this->service = new DbAddService();
        // Connexion directe pour vérifier les résultats en base
        $this->dbVerify = new PDO("mysql:host=localhost;dbname=test_covoiturage_interne", "a_app", "a_app_mdp");
    }

    public function testAddVilleSuccess(): void {
        $nomVille = "Lyon-Sud-" . uniqid(); // Nom unique pour éviter les conflits d'index
        $this->service->addVille($nomVille);

        $stmt = $this->dbVerify->prepare("SELECT * FROM ville WHERE nom = ?");
        $stmt->execute([$nomVille]);
        $this->assertNotEmpty($stmt->fetch(), "La ville devrait être présente en base.");
    }

    public function testAddTrajetSuccess(): void {
        $data = [
            'depart_ville' => 1,
            'depart_gdh' => '211000Z JAN 26',
            'depart_date' => '2026-01-21 10:00:00',
            'arrive_ville' => 2,
            'arrive_gdh' => '211200Z JAN 26',
            'arrive_date' => '2026-01-21 12:00:00',
            'place_totale' => 4,
            'place_disponible' => 4,
            'createur_id' => 1
        ];

        $this->service->addTrajet($data);

        $stmt = $this->dbVerify->query("SELECT * FROM trajet ORDER BY id DESC LIMIT 1");
        $trajet = $stmt->fetch();
        
        $this->assertEquals('211000Z JAN 26', $trajet['depart_gdh']);
        $this->assertEquals(1, $trajet['depart_ville_id']);
    }

    public function testUserCannotAddVille(): void {
        $this->expectException(\PDOException::class);
        // On force l'utilisation du type 1 (u_app) pour une action admin
        $pdo = $this->service->connexion(1); 
        $pdo->exec("INSERT INTO ville (nom) VALUES ('Ville Interdite')");
    }

    public function testSecurityUserCannotDeleteVille(): void {
        // On s'attend à ce qu'une exception PDO soit lancée
        $this->expectException(\PDOException::class);

        // On récupère une connexion de type 1 (u_app)
        $pdo = $this->service->connexion(1); 
        
        // Cette commande doit échouer car u_app n'a que SELECT sur la table ville
        $pdo->exec("DELETE FROM ville WHERE id = 1");
}
}