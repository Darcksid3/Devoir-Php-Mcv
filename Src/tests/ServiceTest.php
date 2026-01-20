<?php
namespace App\tests;


use PHPUnit\Framework\TestCase;
use App\Service\PasswordVerif;

class ServiceTest extends TestCase {
    // Chaque méthode de test doit commencer par le mot "test"
    public function testVerifPassRenvoieFalse() {
        $service = new PasswordVerif();
        $resultat = $service->verifPassword("pass", "passs"); // non identique
        
        $this->assertNull($resultat); // On affirme que le résultat DOIT être faux
    }

    public function testVerifPassRenvoieTrue() {
        $service = new PasswordVerif();
        $resultat = $service->verifPassword("pass", "pass");
        
        $this->assertEquals("pass", $resultat);
    }
}
?>