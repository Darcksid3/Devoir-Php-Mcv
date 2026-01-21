<?php
namespace App\Pages;
$pages = $_SESSION['pages'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    </head><body>
    <link rel="stylesheet" href="/Public/css/main.css">
    <title>Touche pas au Klaxon<?php echo $pages ?></title>
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
        <?php require __DIR__ . '/Components/Footer.php'; ?>
        <!-- Footer commun à toutes les pages -->
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script></body></html>
    <script src="Public/javascript/modale.js"></script>
    </body>
</html>

