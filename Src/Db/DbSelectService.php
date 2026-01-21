<?php
namespace App\Db;
use PDO;

class DbSelectService extends DbConnexion{
        
    /**
    * récupère l'email de l'utilisateur
    * @param string $email
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function searchEmail(string $email) {

        $pdo = $this->connexion(0);
        if (!$pdo instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "SELECT * FROM utilisateur WHERE email = :email";
        $query = $pdo->prepare((string) $sql);
        $query->execute(['email' => $email]);
    
        if ($query->rowCount() >= 1) {
            $resultat = $query->fetch();
            $responce = ['status' => true, 'user' => $resultat];
            return $responce;
        } else {
            return $responce = ['status' => false];
        }
    }

    /**
    * récupération du hash du mot de passe
    * @param int $id
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function recupHash(int $id){

        $pdo = $this->connexion(1);
        if (!$pdo instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select password_hash, status from utilisateur_enregistre where utilisateur_id = :id";
        $query = $pdo->prepare((string) $sql);
        $query->execute(['id' => $id]);

        $resultat = $query->fetch();
        return $resultat;
    }

    /**
    * Liste tout les trajet par date future et place disponible
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function afficheAll() {
        
        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select t.*, v1.nom as depart_ville_nom, v2.nom as arrive_ville_nom from trajet t inner join ville v1 on t.depart_ville_id = v1.id inner join ville v2 on t.arrive_ville_id = v2.id where t.depart_date >= NOW() and t.place_disponible > 0 order by depart_date ASC";
        $query = $connexion->prepare((string) $sql);
        $query->execute();

        if ($query->rowCount() >= 1) {
            $resultat = $query->fetchAll();
            return $response = ['status' => true, 'liste' =>$resultat];
        } else {
            return $response = ['status' => false];
        }
    }

    /**
    * Liste les villes
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function recupVille() {

        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select * from ville";
        $query = $connexion->prepare((string) $sql);
        $query->execute();

        $resultat = $query->fetchAll();
        return $resultat;
    }

    /**
    * Sélèctionne une ville par son id
    * @param int $idVille
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function recupVilleById($idVille) {

        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select nom from ville where id = :id";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['id' => (int)$idVille]);

        $resultat = $query->fetch();
        return $resultat['nom'];
    }

    /**
    * récupère une ville par son nom
    * @param string $nomVille
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function recupVilleByName($nomVille) {

        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select nom from ville where nom = :nom";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['nom' => (string)$nomVille]);

        if ($query->rowCount() >= 1) {
        $resultat = $query->fetch();
            $response = ['status' => true, 'nom' => $resultat];
            return $response;
        } else{
            return $response = ['status' => false];
        }
    }
    
    /**
    * récupère le créateur du trajet
    * @param int $idCreateur
    * @throw Exeption erreur de connection à la base de donnée
    * @return string
    */
    public function recupOwnerTrajet(int $idCreateur):string {

        $connexion = $this->connexion(0);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select email from utilisateur where id = :id";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['id' => (int)$idCreateur]);

        $resultat = $query->fetch();
        return ($resultat && isset($resultat['email'])) ? (string)$resultat['email'] : 'Utilisateur inconnu';
    }

    /**
    * récupère un trajet spécifique par son id
    * @param int $id
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function recupTrajetById(int $id) {

        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select t.*,  v1.nom as depart_ville_nom,  v2.nom as arrive_ville_nom  from trajet t  inner join ville v1 on t.depart_ville_id = v1.id  inner join ville v2 on t.arrive_ville_id = v2.id where t.id = :id";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['id' => (int)$id]);

        $resultat = $query->fetch();
        return $resultat;
    }

    //Modale
    /**
    * Liste les informations du créteur du trajet
    * @param int $id
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function infoOwner(int $id) {

        $connexion = $this->connexion(0);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select * from utilisateur where id = :id";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['id' => $id]);

        $resultat = $query->fetch();
        return $resultat;
    }

    /**
    * sélèctionne les information pour la modale
    * @param int $id
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function modale(int $id){

        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select place_disponible, createur_id from trajet where id = :id";
        $query = $connexion->prepare((string) $sql);
        $query->execute(['id' => $id]);

        $resultat = $query->fetch();
        $response = $this->infoOwner($resultat['createur_id']);
        $response['place_disponible'] = $resultat['place_disponible'];
        return $response;
    }

    //Admin
    /**
    * Liste les utilisateur enregistré
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function selectAllUser() {

        $pdo = $this->connexion(2);
        if (!$pdo instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select * from utilisateur_enregistre";
        $query = $pdo->prepare((string) $sql);
        $query->execute();

        $resultat = $query->fetchAll();
        return $resultat;
    }

    /**
    * Liste les utilisateur enregistré
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function selectAllEmployee() {

        $pdo = $this->connexion(2);
        if (!$pdo instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select * from utilisateur";
        $query = $pdo->prepare((string) $sql);
        $query->execute();

        $resultat = $query->fetchAll();
        return $resultat;
    }

    /**
    * Liste les utilisateur enregistré
    * @param int $id
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function selectUserById(int $id) {

        $pdo = $this->connexion(2);
        if (!$pdo instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select * from utilisateur where id = :id";
        $query = $pdo->prepare((string) $sql);
        $query->execute(['id' => $id]);

        $resultat = $query->fetch();
        return $resultat;
    }

    /**
    * Liste les utilisateur enregistré
    * @throw Exeption erreur de connection à la base de donnée
    * @return array<mixed>
    */
    public function listeEnregistre() {

        $pdo = $this->connexion(2);
        if (!$pdo instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select utilisateur.* from utilisateur inner join utilisateur_enregistre on utilisateur.id = utilisateur_enregistre.utilisateur_id";
        $query = $pdo->prepare((string) $sql);
        $query->execute();

        $user_info = $query->fetchAll(PDO::FETCH_ASSOC);
        return $user_info;
    }

    /**
    * Liste tout les trajet pour l'admin
    * @throw Exeption erreur de connection à la base de donnée 
    * @return array<mixed>
    */
    public function listeAllTrajet() {
        
        $connexion = $this->connexion(1);
        if (!$connexion instanceof \PDO) {
            throw new \Exception("La connexion à la base de données a échoué.");
        }
        $sql = "select t.*, v1.nom as depart_ville_nom, v2.nom as arrive_ville_nom from trajet t inner join ville v1 on t.depart_ville_id = v1.id inner join ville v2 on t.arrive_ville_id = v2.id order by depart_date ASC";
        // récupération de tout les trajet à venir
        $query = $connexion->prepare((string) $sql);
        $query->execute();
        
        if ($query->rowCount() >= 1) {
            $resultat = $query->fetchAll();
            return $responce = ['status' => true, 'liste' =>$resultat];
        } else {
            return $responce = ['status' => false];
        }
    }
}

?>