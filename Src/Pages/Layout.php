<?php
namespace App\Pages;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/assets/css/style.css">
    <title>Touche pas au Klaxon</title>
</head>
<body>
    <header>
        <!-- Header commun à toutes les pages -->
        <?php require __DIR__ . '/Components/Header.php'; ?>
    </header>
    
    <main>
        <?php
            // Contenu spécifique à chaque page sera injecté ici
            // Toute page incluant ce layout doit définir la variable $content
            if (isset($content)) {
                echo $content;
            }
        ?>
    </main> 
    <footer>
        <!-- Footer commun à toutes les pages -->
    </footer>
</body>
</html>