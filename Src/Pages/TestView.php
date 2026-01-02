<?php
namespace App\Pages;

use PDO;
use PDOException;
use App\Db\Connexion;
use App\Controllers\test;
use App\Service\Trajet;

//! récupération multi info pour liste des trajets
/*
function connect() {
	try {
		$connexion = new Connexion();
		$pdo = $connexion->rsConnect();
		$query = $pdo->query("SELECT id, email FROM utilisateur");
		return $query;
	} catch (PDOException $e) {
	die("Erreur de connexion : " . $e->getMessage());
	}
}

$theId = '';
$liste = '';
$option = "";
$listEmail = connect();
foreach ($listEmail as $user) {
		// On CONCATÈNE avec .= au lieu de faire echo
		$liste .= $user['email'] . "<br>"; 
		$option .= '<option value="'.$user['id'].'">'.$user['email'].'</option>';
		
}
*/
//! FIN récup multi info pour liste trajets
//* test fonction native pdo
function oneMail() {
	$mailTest = 'laura.garnier@email.fr';

	$host = $_ENV['DB_HOST'];
	$db   = $_ENV['DB_NAME'];
	$user = $_ENV['DB_USER_RS'];
	$pass = $_ENV['DB_PASSWORD_RS'];
	$behost = getenv('DB_HOST');

	try {
	$connexion = new PDO("mysql:host=$behost;dbname=$db;charset=utf8", $user, $pass);

	$resultat = $connexion->query("SELECT id, email FROM utilisateur WHERE email = '$mailTest'");
		if ($resultat ->rowCount() >= 1) {
			return "L'email => ".$mailTest." <=  dans la base de données.";
			$connexion = null;
		} else {
			return "L'email n'existe pas dans la base de données.";
			$connexion = null;
		}
	} catch (PDOException $e) {
	die("Erreur de connexion : " . $e->getMessage());
	}
}


function idTest() {
	$mailTest = 'pierre.fournier@email.fr';

	$db   = $_ENV['DB_NAME'];
	$user = $_ENV['DB_USER_RS'];
	$pass = $_ENV['DB_PASSWORD_RS'];
	$behost = getenv('DB_HOST');

	try {
		$connexion = new PDO("mysql:host=$behost;dbname=$db;charset=utf8", $user, $pass);

		$resultat = $connexion->query("SELECT id, email FROM utilisateur WHERE email = '$mailTest'");
		$test = $resultat->fetch();
		
			return $test;

		
		
	} catch (PDOException $e) {
	die("Erreur de connexion : " . $e->getMessage());
	}
}
$id = '';
$testOne = var_dump(idTest());
$testOneFetch = idTest();

//! Test récupération du mot de passe hashé dans la DB pour comparaison / connexion
function hashTest(){
	$id = 1;
	$connectDb = new Connexion();
	$pdo = $connectDb->appConnect();
	$pass = $pdo->query("select password_hash from utilisateur_enregistre where utilisateur_id = '$id'");
	$resultat = $pass->fetch();
	return $resultat;
}
$pass_hash = hashTest();
$phash = $pass_hash['password_hash'];
error_log('test error log');
$test = new Test();
//* fonction de vérification du mot de passe hashé
function vp($phash) {
	if(password_verify('azerty', $phash)) {
		return 'true';
	}else {
		return 'false';
	}
};
$vpass = vp($phash);
//! Fin test hash MDP

//! Fonction de test utilisation des fonction native de la classe PDO ->prepare() ->execute() ->fetch()
function testNconnect($id) {

	$connect = new Connexion();
	$pdo = $connect->rsConnect();
	$query = $pdo->prepare("SELECT email FROM utilisateur WHERE id = :id");
	
	$query->execute(['id' => $id]);
	$resultat = $query->fetch();
	return $resultat;

}
$testnco = testNconnect(1);

//! FIN test utilisation PDO

// apel à controller\test.php
$test = new Test();
$liste = $test->optionTestl();


//! Affichage des trajets
function AffichageTrajet() {
	$trajet = new Trajet();

	$resultat = $trajet->afficheAll();
	return $resultat;
}
$listeTrajet = AffichageTrajet();
var_dump($listeTrajet);

//! Test TheConnect
function testTc($type){

	$connexionDb = new Connexion();
	$typeCo = $connexionDb->theConnect($type);
	return $typeCo;
}

testTc(1);
$tc = $_SESSION['typeCo'] ?? 'Pas de type défini';


//! AFFICHAGE du résultat des test
$content = '<h1>PAGE DE TEST</h1>'
	. '<p>Ceci est le contenu de la page d\'accueil.</p>'
	. '<hr>'
	. '<p>Type de connexion test : '.$tc.'</p>'
	. '<hr>'
	. '<p>Liste des emails des utilisateurs enregistrés :</p>'
	. '<p>'.$liste.'</p> '
	. '<hr>'
	. '<p>Vérification d\'un email spécifique :</p>'
	. '<p>'.oneMail().'</p>'
	. '<hr>'
	. '<p>test id : '.$testOneFetch['id'].'</p>'
	. '<p>'.$testOne.'</p>'
	. '<hr>'
	. '<p>test Nconect : '.$testnco['email'].'</p>'
	. '<hr>'
	. '<p>hash_test : '.$phash.' // vpas : '.$vpass.'</p>'
	. '<p>test controler = '. $test->test() .'</p>'
	. '<select>'.$liste.'</select>'
	;

require __DIR__ . '/Layout.php';
?>

