<?php

namespace App\Pages;

use PDO;
use PDOException;
use App\Db\Connexion;
use App\Controllers\test;


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

function vp($phash) {
	if(password_verify('azerty', $phash)) {
		return 'true';
	}else {
		return 'false';
	}
};
$vpass = vp($phash);

function testNconnect($id) {

	$connect = new Connexion();
	$pdo = $connect->rsConnect();
	$query = $pdo->prepare("SELECT email FROM utilisateur WHERE id = :id");
	
	$query->execute(['id' => $id]);
	$resultat = $query->fetch();
	return $resultat;

}
$testnco = testNconnect(5);
var_dump($testnco);

$content = '<h1>PAGE DE TEST</h1>'
	. '<p>Ceci est le contenu de la page d\'accueil.</p>'
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
	. '<select>'.$option.'</select>'
	;

require __DIR__ . '/Layout.php';
?>

