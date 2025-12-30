<?php
namespace App\Pages;

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

var_dump($_SESSION['utilisateur_connect']);

if ($_SESSION['utilisateur_connect']){
    $content ='<h2>Pages De Succes</h2>' 
        . '<hr>'
        . '<p>' . $message . '</p>'
        . '<div>'
        . '<p>'.$_SESSION['utilisateur_id'].'</p>'
        . '<p>'.$_SESSION['utilisateur_nom'].'</p>'
        . '<p>'.$_SESSION['utilisateur_prenom'].'</p>'
        . '<p>'.$_SESSION['utilisateur_telephone'].'</p>'
        . '<p>'.$_SESSION['utilisateur_email'].'</p>'
        . '</div>'
        ;
} else {
        $content ='<h2>Pages De Succes</h2>' 
        . '<hr>'
        . '<p>' . $message . '</p>'
        ;
        header('Location: /');
        exit();
}
require __DIR__ . '/Layout.php';