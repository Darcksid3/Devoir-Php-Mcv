<?php
namespace App\Service;

/**
* Classe de gestion et de sécurisation des mots de passe
*/
class PasswordVerif {
    /**
    * Vérifie si deux mot de passe sont identiques.
    * * En cas d'erreur, un message est stocker en session.
    *
    * @param string $pass1 Le premier mot de passe (saisie).
    * @param string $pass2 Le second mot de passe (confirmation).
    * @return string / null Retourne  le mot de passe s'il correspond, sinon rien.
    */
    public function verifPassword(string $pass1, string $pass2): string | null {
        if ($pass1 === $pass2) {
            return $pass1;
        } else { 
            $_SESSION['message'] = 'Erreur de mot de passe';
            return null;
        }
    }

    /**
    * Crée une empreinte (hash) sécurusé pour le mot de passe.
    *
    * @parem string $password Le mot de passe en clair.
    * @return string $hash Le hash généré via l'algorithme BCRYPT.
    */
    public function hashPassword(string $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $hash;
    }

    /**
    * Vérifie la correspondance entre un mot de passe en clair et un hash.
    *
    * @param string $pass Le mot de passe à tester.
    * @param string $hash Le hash stocker en base de donnée.
    * @return Boolean True si le mot de passe correspond au hash , sinon False.
    */
    public function verifHash($pass, $hash) {
        return password_verify($pass, $hash);
    }
}

?>