<?php

require_once 'config/config.php';



/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE DE CONNEXION
 */
function getPageConnexion(){

    $title = "Se Connecter";
    if(isset($_SESSION) && !empty($_SESSION)){
        if($_SESSION['acces'] === "admin"){
            header("location:dashboard");
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
                        if($json_user_file_decode['user'.$idLogin]['acces'] === "admin"){
                            $_SESSION['idLogin'] = $idLogin;
                            $_SESSION['login'] = $login;
                            $_SESSION['password'] = $password;
                            $_SESSION['acces'] = "admin";
                            $_SESSION['prenom'] = $json_user_file_decode['user'.$idLogin]['prenom'];
                            $_SESSION['nom'] = $json_user_file_decode['user'.$idLogin]['nom'];
                            $_SESSION['avatar'] = $json_user_file_decode['user'.$idLogin]['avatar'];
                            header("location:dashboard");
                        }
                        if($json_user_file_decode['user'.$idLogin]['acces'] === "joueur"){
                            $_SESSION['idLogin'] = $idLogin;
                            $_SESSION['login'] = $login;
                            $_SESSION['password'] = $password;
                            $_SESSION['acces'] = "joueur";
                            $_SESSION['prenom'] = $json_user_file_decode['user'.$idLogin]['prenom'];
                            $_SESSION['nom'] = $json_user_file_decode['user'.$idLogin]['nom'];
                            $_SESSION['avatar'] = $json_user_file_decode['user'.$idLogin]['avatar'];
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

/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE D'INSCRIPTION
 */
function getPageInscription(){

    $title = "Créer un admin";

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

            //On récupère le nom de l'image
            $image              = $_FILES["choice-file"]["name"];
            //On récupère lien de l'image (destination)
            $imagePath          = 'public/source/images/avatar/'. basename($image);
            //On récupère l'extension de l'image
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
                "acces" => "joueur",
                "prenom" => $prenom,
                "nom" => $nom,
                "avatar" => $imagePath,
                "score"  => 0
            );

            $array_data['user'.$newIdUser] = $data;
            $finally_array = json_encode($array_data);
            $databaseURL = "data/utilisateur.json";
            if(file_put_contents($databaseURL,$finally_array))
            {
                afficheMessageAlert("Félicitation ! Vous pouvez vous connecter pour commencer à jouer dès à présent !");
                echo '<script> location.replace("login"); </script>';
            }
        }

    require_once  'views/front/inscription.view.php';
}

