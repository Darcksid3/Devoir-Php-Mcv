<?php
namespace App\Service;

$_SESSION['message'] = '<div class="msg msg-ok">Déconnexion Réussit!!</div>';
$_SESSION['utilisateur'] = [
    'connect' => false
];
header('Location: /Success');
exit();

?>