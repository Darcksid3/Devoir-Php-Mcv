<?php

namespace App\Service;

class VerifInscript {

    public function verifMail($email){

        
    }

    public function verifMdp($mdp1, $mdp2) {
        if($mdp1 !== $mdp2) {
            return false;
        } else {
            return true;
        }
    }
}
