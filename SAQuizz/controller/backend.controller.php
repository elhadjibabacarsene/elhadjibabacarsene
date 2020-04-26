<?php

require_once 'config/config.php';



/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE D'ACCUEIL (admin)
 */
function getPageAccueil(){
    $title = "Accueil";

    if(isset($_SESSION) && !empty($_SESSION))
    {
        if($_SESSION['acces'] !== "admin")
        {
            //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("jeux"); </script>';
        }
        //Gestion de la déconnexion
        if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion")
        {
            session_destroy();
            header("location:login");
            echo '<script> location.replace("login"); </script>';
        }
    }else
        {
        echo '<script> location.replace("login"); </script>';
        }



    require_once 'views/back/accueil.view.php';
}


function getPageCreateUser(){
    $title = "Créer un admin";

    //On contrôle les privilièges
    if(isset($_SESSION) && !empty($_SESSION)){
        if($_SESSION['acces'] !== "admin"){
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("jeux"); </script>';
        }

        //On gère la déconnexion
        if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion"){
            session_destroy();
            echo '<script> location.replace("login"); </script>';
        }

            $prenom = $nom = $login = $password = $confirmpassword = $choiceFile = "";
            $prenomError = $nomError = $loginError = $passwordError = $confirmPasswordError = "";
            $imageError = "Avatar";

            //On récupère les données envoyer
            if(isset($_POST['create-user']))
            {

                $prenom             = $_POST['prenom-user'];
                $nom                = $_POST['nom-user'];
                $login              = $_POST['login-user'];
                $password           = $_POST['password-user'];
                $confirmpassword    = $_POST['confirm-password-user'];
                $image              = $_FILES["choice-file"]["name"];
                $imagePath          = 'public/source/images/avatar/'. basename($image);
                $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
                $isUploadSuccess    = false;
                $isSucces           = true;


                    if(empty($image))
                    {

                        $imageError = 'Ce champ ne peut pas être vide';
                        $isSucces = true;
                    }
                    else
                    {
                        $isUploadSuccess = true;
                        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
                        {
                            $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                            $isUploadSuccess = false;
                        }
                        if(file_exists($imagePath))
                        {
                            $imageError = "Le fichier existe deja";
                            $isUploadSuccess = false;
                        }
                        if($_FILES["choice-file"]["size"] > 500000)
                        {
                            $imageError = "Le fichier ne doit pas depasser les 500KB";
                            $isUploadSuccess = false;
                        }
                        if($isUploadSuccess)
                        {
                            if(!move_uploaded_file($_FILES["choice-file"]["tmp_name"], $imagePath))
                            {
                                $imageError = "Il y a eu une erreur lors de l'upload";
                                $isUploadSuccess = false;
                            }
                        }
                    }
            }

                //On contrôle si le login est unique
                    //Decode du fichier JSON d'utilisateur
                    $json_user_file_decode = transformFileJson("utilisateur.json");
                    if(loginIsset($login,$json_user_file_decode) != 0)
                    {
                        $loginError = "Ce login existe déjà";
                        $isSucces = false;
                    }



                if($isSucces && $isUploadSuccess)
                {
                        //On  envoie l'image de l'avatar
                        move_uploaded_file($_FILES['choice-file']['tmp_name'],
                        'public/source/images/avatar/'.basename($_FILES['choice-file']['name']));

                            //on affecte au nouveau user sont ID
                            $array_data = $json_user_file_decode;
                            $newIdUser = countJson($json_user_file_decode) + 1;
                            $data = array(
                                "login" => $login,
                                "password" => $password,
                                "acces" => "admin",
                                "prenom" => $prenom,
                                "nom" => $nom,
                                "avatar" => $imagePath
                            );

                            $array_data['user'.$newIdUser] = $data;
                            $finally_array = json_encode($array_data);
                            $databaseURL = "data/utilisateur.json";
                            if(file_put_contents($databaseURL,$finally_array)){
                                afficheMessageAlert("Le nouveau admin a été enregistré !");
                                echo '<script> location.replace("create-user"); </script>';
                            }
                }


            }else
    {
        echo '<script> location.replace("login"); </script>';
    }

    require_once 'views/back/create_user.view.php';
}


function getPageListeJoueurs(){

    $title = "Liste des joueurs";

    if(isset($_SESSION) && !empty($_SESSION))
    {
        if($_SESSION['acces'] === "admin")
        {

            //Gestion de la déconnexion
            if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion")
            {
                session_destroy();
                header("location:login");
                echo '<script> location.replace("login"); </script>';
            }

            $retourner = false;
            //Decode du fichier JSON d'utilisateur
            $json_user_file_decode = transformFileJson("utilisateur.json");
            //On compte le nombre d'utilisateur
            $taille = countJson($json_user_file_decode);
            //On récupère le nombre de joueur
            $nbreJoueurs = count(indicesJoueurs($json_user_file_decode));
            $joueurs = indicesJoueurs($json_user_file_decode);
            //NOMBRE DE VALEUR PAR PAGE
            $nbreParPage = 15;
            //NOMBRE DE PAGES
            $nbreDePage = ceil($nbreJoueurs / $nbreParPage);
            //Affichage de la valeur de la première page
            if(!isset($_GET['indice']))
            {
                $page = 1;
            }else{
                $page = $_GET['indice'];
            }
            $page = (int)$page;
            if(isset($_POST['submit-question-next']))
            {
                header_remove();
                header("location:liste-joueurs&indice=".((int)$page+1));
            }
        }else{
            //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("jeux"); </script>';
        }
    }else{
        echo '<script> location.replace("login"); </script>';
    }

    require_once 'views/back/listejoueurs.view.php';
}



function getPageCreateQuestion()
{
    $title = "Créer une question";


    //On gère les privilièges
    if(isset($_SESSION) && !empty($_SESSION))
    {
        if($_SESSION['acces'] === "admin")
        {
            //On gère la déconnexion
            if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion")
            {
                session_destroy();
                header("location:login");
                echo '<script> location.replace("login"); </script>';
            }

            //Si l'admin veut enregistrer une question
            if(isset($_POST['save_question']))
            {
                //var_dump($_POST);
                //echo getNbreInputResponse($_POST);
                $nbre_point_messageError = "";

                $question = $_POST['question'];
                $type_reponse = $_POST['type_reponse'];
                $nbre_point = $_POST['nbre_point'];
                $isSuccess = true;

                $nbre_de_reponse = getNbreInputResponse($_POST);


                //On vérifie si le nombre de point est supérieur ou égale à 1
                if($nbre_point<1)
                {
                    $nbre_point_messageError = "Le nombre doit être supérieur ou égale à 1";
                    $isSuccess = false;
                }

                //On vérifie si au mois la question contient une réponse
                if(verifyAllInputReponse($_POST,$nbre_de_reponse))
                {
                    afficheMessageAlert("La question doit contenir au moins une réponse");
                    $isSuccess = false;
                }


                if($isSuccess)
                {
                    //Si la question est de type TEXTE
                    switch ($_POST['type_reponse'])
                    {
                        case "texte":
                            $reponse = $_POST['reponse1'];
                            //On décode le fichier JSON
                            $json_user_file_decode = transformFileJson("question.json");

                            //on affecte au nouveau user sont ID
                            $array_data = $json_user_file_decode;
                            $newIdQuestion = countJson($json_user_file_decode) + 1;
                            $data = array(
                                "question" => $question,
                                "nbre_point" => $nbre_point,
                                "type_reponse" => $type_reponse,
                                "reponses" => $reponse
                            );

                            $array_data['question'.$newIdQuestion] = $data;
                            $finally_array = json_encode($array_data);
                            $databaseURL = "data/question.json";
                            if(file_put_contents($databaseURL,$finally_array)){
                                afficheMessageAlert("La question a été enregistrer avec success");
                                echo '<script> location.replace("create-question"); </script>';
                            }
                        break;

                        case "choixSimple":
                            $bonnes_reponse = array();
                            $mauvaise_reponse = array();
                            for($i=0;$i<getNbreInputResponse($_POST);$i++)
                            {
                                if(isset($_POST['reponse'.$i]))
                                {
                                    if(isset($_POST['radio-reponse']))
                                    {
                                        if('reponse'.$i === $_POST['radio-reponse'])
                                        {
                                            $bonnes_reponse [] = $_POST['reponse'.$i];
                                        }else{
                                            $mauvaise_reponse [] = $_POST['reponse'.$i];
                                        }
                                    }
                                }
                            }
                            //On décode le fichier JSON
                            $json_user_file_decode = transformFileJson("question.json");

                            //on affecte au nouveau user sont ID
                            $array_data = $json_user_file_decode;
                            $newIdQuestion = countJson($json_user_file_decode) + 1;
                            $data = array(
                                "question" => $question,
                                "nbre_point" => $nbre_point,
                                "type_reponse" => $type_reponse,
                                "reponses" => array(
                                    "bonnes_reponses" => $bonnes_reponse,
                                    "mauvaise_reponses" => $mauvaise_reponse
                                )
                            );

                            $array_data['question'.$newIdQuestion] = $data;
                            $finally_array = json_encode($array_data);
                            $databaseURL = "data/question.json";
                            if(file_put_contents($databaseURL,$finally_array)){
                                afficheMessageAlert("La question a été enregistrer avec success");
                                echo '<script> location.replace("create-question"); </script>';
                            }
                            break;

                        case "choixMultiple":
                            $bonnes_reponse = array();
                            $mauvaise_reponse = array();
                            for($i=0;$i<getNbreInputResponse($_POST);$i++)
                            {
                                if(isset($_POST['reponse'.$i]))
                                {
                                    if(isset($_POST['checkreponse']))
                                    {
                                        foreach ($_POST['checkreponse'] as $key=>$value)
                                        {
                                            if(('reponse'.$i) === $value)
                                            {
                                                $bonnes_reponse [] = $_POST[$value];
                                            }
                                            if(('reponse'.$i) !== $value)
                                            {
                                                $mauvaise_reponse [] = $_POST[$value];
                                            }
                                        }

                                    }
                                }
                            }
                            //On décode le fichier JSON
                            $json_user_file_decode = transformFileJson("question.json");

                            //on affecte au nouveau user sont ID
                            $array_data = $json_user_file_decode;
                            $newIdQuestion = countJson($json_user_file_decode) + 1;
                            $data = array(
                                "question" => $question,
                                "nbre_point" => $nbre_point,
                                "type_reponse" => $type_reponse,
                                "reponses" => array(
                                    "bonnes_reponses" => $bonnes_reponse,
                                    "mauvaise_reponses" => $mauvaise_reponse
                                )
                            );

                            $array_data['question'.$newIdQuestion] = $data;
                            $finally_array = json_encode($array_data);
                            $databaseURL = "data/question.json";
                            if(file_put_contents($databaseURL,$finally_array)){
                                afficheMessageAlert("La question a été enregistrer avec success");
                                echo '<script> location.replace("create-question"); </script>';
                            }
                            break;

                    }
                }
            }


        }else{
            //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("jeux"); </script>';
        }
    }else{
        echo '<script> location.replace("login"); </script>';
    }
    
    require 'views/back/create_question.view.php';
}