<?php
namespace App\Pages;


        session_destroy();
        

require __DIR__ . '/Layout.php';

?>
<script>
    // redirection vers la page d'accueil.
    setTimeout(() => { window.location.href = "/"; }, 2000);
</script>