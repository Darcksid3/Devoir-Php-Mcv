<?php

session_destroy();
$_SESSION['message'] = 'Déconnexion Réussit!!';
header('Location: /Success');
exit();

?>