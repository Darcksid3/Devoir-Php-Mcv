<?php
namespace App\Pages;

$content = "<h2>La page que vous demandez n'existe pas !!</h2>"
        ."Vous allez être redirigé a la pâge d'accueil."
        ;

$_SESSION['pages'] = ' 404';
require __DIR__ . '/Layout.php';

?>
<script>
    // redirection vers la page d'accueil.
    setTimeout(() => { window.location.href = "/"; }, 2000);
</script>