<?php
namespace App\Pages\Components;


$utilisateur = $_SESSION['utilisateur'] ?? [];

if (($utilisateur['connect'] ?? false) === true){
        echo '<div>'
                . '<p>Bonjour '.$utilisateur['nom'].' '.$utilisateur['prenom'].'</p>'
                . '<p>Votre status est : '.$utilisateur['status'].'. et vos informations sont les suivantes :</p>'
                . '<p>Téléphonne: '.$utilisateur['telephone'].'</p>'
                . '<p>Email: '.$utilisateur['email'].'</p>'
                . '<p>id: '.$utilisateur['id'].'</p>'
        . '</div>'
        ;
        if ($utilisateur['status'] === 'utilisateur'){

                // affichage du menu utilisateur

                echo '<div>'
                        .'<nav>'
                                .'<a href="/">Accueil</a> |  '
                                .'<a href="/Success">Succès</a> | '
                                .'<a href="/FormTrajet">Trajet</a> | '
                                .'<a href="/Deconnexion">Deconnexion</a> | '
                                .'<a href="/TestView">TestView</a>'
                        .'</nav>'
                .'<hr>'
                ;
        }

} else {
        echo '<p>Utilisateur non connecté</p>'
        .'<nav>'
        .'<a href="/">Accueil</a> |  '
        .'<a href="/FormInscript">Inscription</a> | '
        .'<a href="/FormConnect">Connexion</a> | '
        .'<a href="/TestView">TestView</a>'
        .'</nav><br>'
        ;
}

echo '<hr>'
        .'<p>header.php</p><br>'
        .'<nav>'
        .'<a href="/">Accueil</a> |  '
        .'<a href="/Success">Succès</a> | '
        .'<a href="/DashboardAdmin">Admin</a> | '
        .'<a href="/FormInscript">Inscription</a> | '
        .'<a href="/FormConnect">Connexion</a> | '
        .'<a href="/FormTrajet">Trajet</a> | '
        .'<a href="/Deconnexion">Deconnexion</a> | '
        .'<a href="/TestView">TestView</a>'
        .'</nav>'
        .'<hr>'
        ;

?>