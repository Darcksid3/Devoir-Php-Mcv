<?php
namespace App\Pages\Components;

//todo Nav générale de débug avec toute les options A SUPPRIMER APRES
echo '<nav>'
        .'<a href="/">Accueil</a> |  '
        .'<a href="/Success">Succès</a> | '
        .'<a href="/DashboardAdmin">Admin</a> | '
        .'<a href="/FormInscript">Inscription</a> | '
        .'<a href="/FormConnect">Connexion</a> | '
        .'<a href="/FormTrajet">Trajet</a> | '
        .'<a href="/Deconnexion">Deconnexion</a> | '
        .'<a href="/TestView">TestView</a> | '
        .'<a href="/lol">Pages lol</a>' 
        .'</nav>'
        .'<hr>'
        ;

        // Début du Header
$message = $_SESSION['message'] ?? 'Pas de message';
unset($_SESSION['message']);
$utilisateur = $_SESSION['utilisateur'] ?? [];
if (($utilisateur['connect'] ?? false) === true){
        
        if ($utilisateur['status'] === 'utilisateur'){

                // affichage du menu utilisateur
                echo '<div>'
                                .'<a href="/" style="display:inline;margin-right:200px;font-size:2rem;font-weight:700;text-decoration:none;color:black;">Touche pas au klaxon</a>'
                                .'<button type="button" style="margin-right:20px;" onclick="location.href=\'/FormTrajet\'">Trajet</button>'
                                . '<p style="display:inline;margin-right:20px;">Bonjour '.$utilisateur['nom'].' '.$utilisateur['prenom'].'</p>'
                                .'<button type="button" onclick="location.href=\'/Deconnexion\'">Déconnexion</button>'
                                
                        . '</div>'
                        .'<hr style="color:red;">'
                        . '<div><p>'.$message.'</p></div>'
                        .'<hr style="color:red;">'
                        ;
                
        } else if ($utilisateur['status'] === 'admin') {
                //affichage du menu admin
                echo '<div>'
                        .'<a href="/" style="display:inline;margin-right:200px;font-size:2rem;font-weight:700;text-decoration:none;color:black;">Touche pas au klaxon</a>'
                        .'<button type="button" style="margin-right:20px;" onclick="location.href=\'/ListeUtilisateur\'">Utilisateur</button>'
                        .'<button type="button" style="margin-right:20px;" onclick="location.href=\'/FormAgence\'">Agence</button>'
                        .'<button type="button" style="margin-right:20px;" onclick="location.href=\'/ListeTrajet\'">Trajet</button>'
                        . '<p style="display:inline;margin-right:20px;">Bonjour '.$utilisateur['nom'].' '.$utilisateur['prenom'].'</p>'
                        .'<button type="button" onclick="location.href=\'/Deconnexion\'">Déconnexion</button>'
                . '</div>'
                .'<hr style="color:yellow;">'
                . '<div><p>'.$message.'</p></div>'
                .'<hr style="color:yellow;">'
                ;
        }

} else {
        echo '<div>'
                .'<a href="/" style="display:inline;margin-right:200px;font-size:2rem;font-weight:700;text-decoration:none;color:black;">Touche pas au klaxon</a>'
                .'<button type="button" style="margin-right:20px;" onclick="location.href=\'/FormInscript\'">Inscription</button>'
                
                .'<button type="button" style="margin-right:20px;" onclick="location.href=\'/FormConnect\'">Connexion</button>'
        .'</div>'
        .'<div><p>'.$message.'</p></div>'
        ;
}



?>