<?php
namespace App\Service;

class PasswordVerif {

    public function verifPassword($pass1, $pass2) {
        if ($pass1 === $pass2) {
            return $pass1;
        } else { 
            $_SESSION['message'] = 'Erreur de mot de pâsse';
        }
    }

    public function hashPassword($password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $hash;
    }

    public function verifHash($pass, $hash) {

        $hashTester = password_verify($pass, $hash);
        if ($hashTester) {
            return true;
        } else {
            return false;
        }

    }
}