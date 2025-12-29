<?php
namespace App\Pages;

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$content = '<p>' . $message . '</p>'
        ;

require __DIR__ . '/Layout.php';