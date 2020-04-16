<?php

require_once 'config/config.php';



/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE DE CONNEXION
 */
function getPageConnexion(){
    $title = "Se Connecter";
    if(isset($_SESSION) && !empty($_SESSION)){
        if($_SESSION['acces'] === "admin"){
            header("location:accueil");
        }
        if($_SESSION['acces'] === "joueur"){
            header("location:jeux");
        }
    }else{
        /*** DEBUT VALIDATION ***/
        $isSuccess = false;
        $loginError = $passwordError = "<br>";
        if($_SERVER['REQUEST_METHOD'] === "POST") {

            $login = $_POST['login'];
            $password = $_POST['password'];
            $isSuccess = true;

            if($login === ""){
                $loginError = "Ce champs est obligatoire pour l'authentification";
                $isSuccess = false;
            }
            //On vérifie si le user a donné son password
            if($password === ""){
                $passwordError = "Ce champs est obligatoire pour l'authentification";
                $isSuccess = false;
            }
        }
        }
        if($isSuccess){

                //Decode du fichier JSON d'utilisateur
                $json_user_file_decode = transformFileJson("utilisateur.json");
                //Récupération des identifiants du login et du password
                $idLogin = loginIsset($login,$json_user_file_decode);
                $idPassword = passwordIsset($password,$json_user_file_decode);

                $infosConnexionIsCorrect = true;//Variable qui contrôle si le login et le password sont correcte

                //Si le login et le mot pass n'existe pas
                if($idLogin === 0 && $idPassword === 0){
                    afficheMessageAlert("Cet utilisateur n'existe pas ! Veuillez vous inscrire si vous n'avez pas de compte");
                    $infosConnexionIsCorrect = false;
                }
                //Si le login est incorrecte
                if($idLogin === 0 && $idPassword !== 0){
                    $loginError = "Le login est incorrecte";
                    $infosConnexionIsCorrect = false;
                }
                //Si le mot de pass est incorrecte
                if($idLogin !== 0 && $idPassword===0){
                    $passwordError = "Le mot de pass est incorrecte";
                    $infosConnexionIsCorrect = false;
                }
                //Si le login et le password est correct
                if($infosConnexionIsCorrect){
                    if($idLogin === $idPassword){
                        if($json_user_file_decode->{'user'.$idLogin}->acces === "admin"){
                            $_SESSION['idLogin'] = $idLogin;
                            $_SESSION['login'] = $login;
                            $_SESSION['password'] = $password;
                            $_SESSION['acces'] = "admin";
                            $_SESSION['prenom'] = $json_user_file_decode->{'user'.$idLogin}->prenom;
                            $_SESSION['nom'] = $json_user_file_decode->{'user'.$idLogin}->nom;
                            $_SESSION['avatar'] = $json_user_file_decode->{'user'.$idLogin}->avatar;
                            header("location:accueil");
                        }
                        if($json_user_file_decode->{'user'.$idLogin}->acces === "joueur"){
                            $_SESSION['idLogin'] = $idLogin;
                            $_SESSION['login'] = $login;
                            $_SESSION['password'] = $password;
                            $_SESSION['acces'] = "joueur";
                            $_SESSION['prenom'] = $json_user_file_decode->{'user'.$idLogin}->prenom;
                            $_SESSION['nom'] = $json_user_file_decode->{'user'.$idLogin}->nom;
                            $_SESSION['avatar'] = $json_user_file_decode->{'user'.$idLogin}->avatar;
                            header("location:jeux");
                        }
                    }
                }
            }
    require_once 'views/front/login.view.php';
    }


/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE de jeux
 */
function getPageJeux(){
    $title = "SaQuizz:Jeux";
    if(isset($_SESSION) && !empty($_SESSION)){
        //Vérification des autorisations
        if($_SESSION['acces']=== "admin" || $_SESSION['acces']==="joueur"){

            //Gestion de la déconnexion
            if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion"){
                session_destroy();
                echo '<script> location.replace("login"); </script>';
            }

        }
    }else{
        echo '<script> location.replace("login"); </script>';
    }
    require_once  'views/front/jeux.view.php';
}
