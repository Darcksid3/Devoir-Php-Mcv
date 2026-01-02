<?php
namespace App\Pages;

$utilisateur = $_SESSION['utilisateur'] ?? ['connect' => false];
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

//var_dump($utilisateur['connect']);

if ($utilisateur['connect']){
    $content ='<h2>Pages De Succes</h2>' 
        . '<hr>'
        . '<p>' . $message . '</p>'
        . '<div>'
        . '<p>'.$utilisateur['id'].'</p>'
        . '<p>'.$utilisateur['nom'].'</p>'
        . '<p>'.$utilisateur['prenom'].'</p>'
        . '<p>'.$utilisateur['telephone'].'</p>'
        . '<p>'.$utilisateur['email'].'</p>'
        . '<p>'.$utilisateur['status'].'</p>'
        . '</div>'
        ;
} else {
        $content ='<h2>Pages De Succes</h2>' 
        . '<hr>'
        . '<p>' . $message . '</p>'
        ;
        session_destroy();
        
}
require __DIR__ . '/Layout.php';

?>
<script>
    setTimeout(() => { window.location.href = "/"; }, 3000);
</script>