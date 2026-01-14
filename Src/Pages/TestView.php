<?php
namespace App\Pages;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use App\Service\ExternalService;
$externalService = new ExternalService();

use App\Db\DbSelectService;
$selectDb = new DbSelectService();

$afficheAllVille = $selectDb->selectAllVille();

$content ='';

function contentAlpha($content, $addition) {
	$content .= '<h2>Page de test</h2>';
	$content .= $addition;
	return $content;
}

function additionAlpha($content) {
	$addition = '<p>lol</p>';
	$retour = contentAlpha($content, $addition);
	return $retour;
}

$test = additionAlpha($content);
$content .= $test;

function additionBeta() {
	$add = '<p>Un nouveau paragraphe.</p>';
	return $add;
}

$additionBeta = additionBeta($content);
$content .= $additionBeta;

require __DIR__ . '/Layout.php';
?>

