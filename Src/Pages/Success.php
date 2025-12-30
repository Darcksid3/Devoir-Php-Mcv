<?php
namespace App\Pages;

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$content ='<h2>Pages De Succes</h2>' 
        . '<hr>'
        . '<p>' . $message . '</p>'
        ;

require __DIR__ . '/Layout.php';