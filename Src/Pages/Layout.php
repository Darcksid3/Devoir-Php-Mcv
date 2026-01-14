<?php
namespace App\Pages;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/src/assets/css/style.css">
    <link rel="stylesheet" href="/Public/css/FormTrajet.css">
    <link rel="stylesheet" href="/Public/css/Home.css">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

