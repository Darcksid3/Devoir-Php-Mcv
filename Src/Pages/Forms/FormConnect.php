<?php
namespace App\Pages\Forms;

$content = '<fieldset class="form">'
        .'<legend> Formulaire de connexion </legend>'
        .'<form action="/ValidFormConnect" method="POST">'
            .'<p>email a utiliser => alexandre.martin@email.fr (admin) => sophie.dubois@email.fr (utilisateur) => julien.bernard@email.fr (utilisateur)</p>'

            .'<label for="email" class="form-label">Email :</label>'
            .'<input type="email" id="email" name="email" class="form-control" required>'
            
            .'<label for="password" class="form-label">Mot de passe :</label>'
            .'<input type="password" id="password" name="password" class="form-control" required>'
            .'<br>'
            .'<div class="validation"><button type="submit" class="mybtn mybtn-grey">Connexion</button></div>'
        .'</form>'
        .'</fieldset>'
    ;
require __DIR__ . '/../Layout.php';
?>