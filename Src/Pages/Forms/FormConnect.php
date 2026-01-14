<?php
namespace App\Pages\Forms;
//$message = $_SESSION['message'] ?? '';
//unset($_SESSION['message']);

$content = '<fieldset>'
        .'<legend> Formulaire de connexion </legend>'
        .'<form action="/ValidFormConnect" method="POST">'
        .'<p>email a utiliser => alexandre.martin@email.fr => sophie.dubois@email.fr => julien.bernard@email.fr => camille.moreau@email.fr =>lucie.lefevre@email.fr => louis.fontaine@email.fr => hugo.lambert@email.fr => arthur.henry@email.fr</p>'
        .'<label for="email">Email :</label><br>'
        .'<input type="email" id="email" name="email" required>'
        .'<br>'
        .'<p>Mot dse passe a utilisez : azerty </p>'
        .'<label for="password">Mot de passe :</label><br>'
        .'<input type="password" id="password" name="password" required>'
        .'<br>'
        .'<button type="submit">Connexion</button>'
        .'</form>'
        .'</fieldset>'
    ;
require __DIR__ . '/../Layout.php';
?>