<?php
namespace App\Pages\Forms;
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$content = 
    '<form action="/ValidFormInscript" method="POST">'
        .'<p>' . $message . '</p>'
        .'<p>email a utiliser alexandre.martin@email.fr </p>'
        .'<label for="email">Email :</label><br>'
        .'<input type="email" id="email" name="email" required>'
        .'<br>'
        .'<label for="password1">Mot de passe :</label><br>'
        .'<input type="password" id="password1" name="password1" required>'
        .'<br>'
        .'<label for="password2">Vérifier le Mot de passe 2:</label><br>'
        .'<input type="password" id="password2" name="password2" required>'
        .'<br>'
        .'<button type="submit">S\'inscrire</button>'
    .'</form>'
;

require __DIR__ . '/../Layout.php';
?>