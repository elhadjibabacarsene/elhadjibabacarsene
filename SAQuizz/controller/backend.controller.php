<?php

require_once 'config/config.php';



/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE D'ACCUEIL (admin)
 */
function getPageAccueil(){
    $title = "SaQuizz:Accueil";
    if(isset($_SESSION) && !empty($_SESSION)){
        if($_SESSION['acces'] !== "admin"){
            //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("jeux"); </script>';
        }
        //Gestion de la déconnexion
        if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion"){
            session_destroy();
            header("location:login");
            echo '<script> location.replace("login"); </script>';
        }
    }else{
        echo '<script> location.replace("login"); </script>';
    }



    require_once 'views/back/accueil.view.php';
}