<?php
namespace App\Pages\Forms;

$content = '<fieldset class="form">'
        .'<legend> Formulaire d\'inscription </legend>'
        .'<form action="/ValidFormInscript" method="POST">'
            .'<p>email a utiliser alexandre.martin@email.fr </p>'
            .'<label for="email" class="form-label">Email :</label>'
            .'<input type="email" class="form-control" id="email" name="email" required>'

            .'<label for="password1" class="form-label">Mot de passe :</label>'
            .'<input type="password" class="form-control" id="password1" name="password1" required>'

            .'<label for="password2" class="form-label">Vérifier le Mot de passe 2:</label>'
            .'<input type="password" class="form-control" id="password2" name="password2" required>'
            .'<br>'
            .'<div class="validation"><button type="submit" class="mybtn mybtn-grey">S\'inscrire</button></div>'
        .'</form>'
    .'</fieldset>'
;

require __DIR__ . '/../Layout.php';
?>