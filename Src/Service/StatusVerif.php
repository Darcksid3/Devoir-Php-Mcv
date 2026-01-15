<?php
namespace App\Service;


class StatusVerif {
// vérification su status de l'utilisateur
    public function verifConnect($utilisateur) {

        // si l'utilisateur erst connecté

        if ($utilisateur['connect'] === true) {
            return true;
            
        }else {
            return false;
        }
    }

    public function verifStatus($utilisateur) {

        // vérification du status de l'utilisateur

        if ($utilisateur['status'] === 'admin') {
            return true;
            
        }else {
            return false;
        }
    }

}
?>
