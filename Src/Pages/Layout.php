<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/assets/css/style.css">
    <title>Layout</title>
</head>
<body>
    <header>
        <!-- Header commun à toutes les pages -->
        <?php require __DIR__ . '/Components/Header.php'; ?>
    </header>
    
    <main>
        <?php
            // Contenu spécifique à chaque page sera injecté ici
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