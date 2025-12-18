<?php


$content = 
    '<form action="/ValidFormInscript" method="POST">'
        .'<p>email a utiliser a@a.com </p>'
        .'<label for="email">Email :</label>'
        .'<input type="email" id="email" name="email" required>'
        .'<br>'
        .'<p>mdp a utilisez azerty</p>'
        .'<label for="password">Mot de passe :</label>'
        .'<input type="password" id="password" name="password" required>'
        .'<br>'
        .'<button type="submit">S\'inscrire</button>'
    .'</form>'
;

require __DIR__ . '/../Layout.php';
?>