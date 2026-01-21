<?php
namespace App\Service;


class StatusVerif {
    /**
    * Vérification su status de l'utilisateur
    * @param array<mixed|string> $utilisateur
    * @return boolean
    */
    public function verifConnect(array $utilisateur) {
        // si l'utilisateur est connecté
        if (isset($utilisateur['connect'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Vérification du status de l'utilisdateur
    * @param array<mixed|string> $utilisateur
    * @return boolean
    */
    public function verifStatus(array $utilisateur) {

        // vérification du status de l'utilisateur

        if ($utilisateur['status'] === 'admin') {
            return true;
        }else {
            return false;
        }
    }

}
?>
