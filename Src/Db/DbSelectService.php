<?php
namespace App\Db;
use PDO;

class DbSelectService extends DbConnexion{
        
    public function selectUser($id, $password) {
            $pdo = $this->connexion(0);
            $query = $pdo->prepare("select * from utilisateur_enregistre where utilisateur_id = :id and password_hash = :password");
            $query->execute(['id' => $id, 'password'=> $password]);
            $result = $query->fetch();
            return $result;
    }

  

    public function searchEmail($email) {
        $pdo = $this->connexion(0);
        $query = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $query->execute(['email' => $email]);
    
        // Vérification du résultat
        if ($query->rowCount() >= 1) {
            $resultat = $query->fetch();
            $responce = ['status' => true, 'user' => $resultat];
            return $responce;
        } else {
            return $responce = ['status' => false];
        }
    }

    public function recupHash($id){
	$pdo = $this->connexion(1);
    $query = $pdo->prepare("select password_hash, status from utilisateur_enregistre where utilisateur_id = :id");
    $query->execute(['id' => $id]);
	
	$resultat = $query->fetch();
	return $resultat;
    }


    //gestion des trajet
    public function selectAllVille(){
        $pdo = $this->connexion(1);
        $query = $pdo->prepare("select * from ville");
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function afficheAll() {
        // connexion a la base de donnée
        $connexion = $this->connexion(1);

        // récupération de tout les trajet à venir
        $query = $connexion->prepare("select * from trajet where concat(depart_date, ' ', depart_heure) >= NOW() order by depart_date ASC, depart_heure ASC");
        $query->execute();
        
        if ($query->rowCount() >= 1) {
            // Renvoie de la liste
            $resultat = $query->fetchAll();
            return $responce = ['status' => true, 'liste' =>$resultat];
        } else {
            
            return $responce = ['status' => false];
        }
    }

    public function recupVille() {

        $connexion = $this->connexion(1);
        $query = $connexion->prepare('select * from ville');
        $query->execute();
        $resultat = $query->fetchAll();
        return $resultat;
    }

    public function recupVilleById($idVille) {
        $connexion = $this->connexion(1);
        $query = $connexion->prepare("select nom from ville where id = :id");
        $query->execute(['id' => (int)$idVille]);
        $resultat = $query->fetch();
        return $resultat['nom'];
    }

    public function recupOwnerTrajet($idCreateur) {
        $connexion = $this->connexion(0);
        $query = $connexion->prepare("select email from utilisateur where id = :id");
        $query->execute(['id' => (int)$idCreateur]);
        $resultat = $query->fetch();
        return $resultat['email'];
    }

    public function recupTrajetById($id) {
        $connexion = $this->connexion(1);
        $query = $connexion->prepare("select * from trajet where id = :id");
        $query->execute(['id' => (int)$id]);
        $resultat = $query->fetch();
        return $resultat;
    }

    //Modale
    public function infoOwner($id) {
        $connexion = $this->connexion(0);
        $query = $connexion->prepare("select * from utilisateur where id = :id");
        $query->execute(['id' => $id]);
        $resultat = $query->fetch();
        return $resultat;
    }  
    //Admin
    public function selectAllUser() {
        $pdo = $this->connexion(2);
        $sql = "select * from utilisateur_enregistre";
        $query = $pdo->prepare($sql);
        $query->execute();
        $resultat = $query->fetchAll();
        return $resultat;
    }
    public function selectAllEmployee() {
        $pdo = $this->connexion(2);
        $sql = "select * from utilisateur";
        $query = $pdo->prepare($sql);
        $query->execute();
        $resultat = $query->fetchAll();
        return $resultat;
    }
    public function selectUserById($id) {
        $pdo = $this->connexion(2);
        $sql = "select * from utilisateur where id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $id]);
        $resultat = $query->fetch();
        return $resultat;

    }
    public function listeEnregistre() {

        $pdo = $this->connexion(2);
        $sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN utilisateur_enregistre ON utilisateur.id = utilisateur_enregistre.utilisateur_id";

        $stmt = $pdo->prepare($sql);

        // 2. On lie la valeur de l'ID (par exemple récupérée d'un formulaire ou d'une session)
        
        $stmt->execute();

        // 3. On récupère les données
        $user_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user_info;
    }
    public function listeAllTrajet() {
        // connexion a la base de donnée
        $connexion = $this->connexion(1);

        // récupération de tout les trajet à venir
        $query = $connexion->prepare("select * from trajet order by depart_date ASC, depart_heure ASC");
        $query->execute();
        
        if ($query->rowCount() >= 1) {
            // Renvoie de la liste
            $resultat = $query->fetchAll();
            return $responce = ['status' => true, 'liste' =>$resultat];
        } else {
            
            return $responce = ['status' => false];
        }
    }
}

?>