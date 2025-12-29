<?php
namespace App\Db;

use PDO;
use PDOException;


class Connexion {

    private $host;
    private $db;
    private $rsUser;
    private $rsPass;
    private $appUser;
    private $appPass;
    private $adminUser;
    private $adminPass;

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
    
    
    public function rsConnect(){
        try {
            $connexion = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->rsUser, $this->rsPass);
            error_log("Connexion réussie à la base de données.");
            //echo 'connexion DB';
            return $connexion ;
        } catch (PDOException $error) {
            die("Erreur de connexion : " . $error->getMessage());
        }
    }
    public function appConnect(){
        try {
            $connexion = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->appUser, $this->appPass);
            error_log("Connexion réussie à la base de données.");
            //echo 'connexion DB';
            return $connexion ;
        } catch (PDOException $error) {
            die("Erreur de connexion : " . $error->getMessage());
        }
    }
    public function adminConnect(){
        try {
            $connexion = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $this->adminUser, $this->adminPass);
            error_log("Connexion réussie à la base de données.");
            //echo 'connexion DB';
            return $connexion ;
        } catch (PDOException $error) {
            die("Erreur de connexion : " . $error->getMessage());
        }
    }
    function addUser($id, $password) {
        
        $pdo = $this->rsConnect();
        $query = $pdo->prepare("insert into utilisateur_enregistre (utilisateur_id, password_hash) values (:id, :password) ");

        // Requête pour vérifier si l'email existe
        $query->execute(['id' => $id, 'password' => $password]);
    }
    

    //! Tentative de simplification de connexion NE FONCTIONNE PAS EN CET ETAT
    public function typeConnexion($type) {
        match($type) {
            'rs' => $this->theConnect($this->rsUser, $this->rsPass),
            
            
            'user' => function() {
                return $this->theConnect($this->appUser, $this->appPass);
            },
            'admin' => function() {
                return $this->theConnect($this->adminUser, $this->adminPass);
            },
            default => function() {
                return 'connexion non authorisé';
            },
        };
    }
    public function theConnect($user,$mdp) {
        try {
            $connexion = new PDO("mysql:host=$this->host;dbname=$this->db;charset=utf8", $user, $mdp);
            error_log("Connexion réussie à la base de données.");
            //echo 'connexion DB';
            return $connexion ;
        } catch (PDOException $error) {
            die("Erreur de connexion : " . $error->getMessage());
        }
    }
    //! FIN Tentative de simplification


}
?>
