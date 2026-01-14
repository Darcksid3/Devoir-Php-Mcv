<?php
namespace App\Service;

$_SESSION['message'] = 'Déconnexion Réussit!!';
$_SESSION['utilisateur'] = [
    'connect' => false
];
header('Location: /Success');
exit();

?>