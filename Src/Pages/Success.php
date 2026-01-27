<?php
namespace App\Pages;


        session_destroy();
        
$_SESSION['pages'] = ' - Sucess';
require __DIR__ . '/Layout.php';

?>
<script>
    // redirection vers la page d'accueil.
    setTimeout(() => { window.location.href = "/"; }, 2000);
</script>