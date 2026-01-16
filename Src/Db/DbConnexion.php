<?php
namespace App\Db;

use PDO;
use PDOException;


abstract class DbConnexion {

    protected $host, $db, $rsUser, $rsPass, $appUser, $appPass, $adminUser, $adminPass;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->db   = $_ENV['DB_NAME'];
        $this->rsUser = $_ENV['DB_USER_RS'];
        $this->rsPass = $_ENV['DB_PASSWORD_RS'];
        $this->appUser = $_ENV['DB_USER_APP'];
        $this->appPass = $_ENV['DB_PASSWORD_APP'];
        $this->adminUser = $_ENV['DB_USER_ADMIN'];
        $this->adminPass = $_ENV['DB_PASSWORD_ADMIN'];
    }
    
    /**
    * Connexion a la base de donnée en fonction du type d'utilisateur
    * 0:gestionnaire d'enregitrement des utilisateurs
    * 1: Application principale
    * 2: Administrateur
    * @param int $type
    * @return PDO/NULL
    */
    public function connexion($type): ?PDO {
        try {
            $info = $this->typeConnexion($type);
            if ($info === null) {
                $_SESSION['typeCo'] = 'connexion non autorisé';
                return null;
            }

            $connexion = new PDO(
                "mysql:host=$this->host;dbname=$this->db;charset=utf8",
                $info['user'], 
                $info['pass'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );

            //echo 'connexion DB';
            $_SESSION['typeCo'] = $info['user'];

            return $connexion ;

        } catch (PDOException $error) {
            $_SESSION['typeCo'] = 'erreur typeCo';
            die("Erreur de connexion : " . $error->getMessage());
        }
    }

    /**
     * Renvoie les information de l'utilisateur authorisé a efectuer l'action en base de donnée
     * @param int $type
     * @return $array information de connexion
     */
    public function typeConnexion(int $type): ?array {
        return match($type) {
            0       => ['user' => $this->rsUser,    'pass' => $this->rsPass],
            1       => ['user' => $this->appUser,   'pass' => $this->appPass],
            2       => ['user' => $this->adminUser, 'pass' => $this->adminPass],
            default => null,
        };
    }

}
?>
