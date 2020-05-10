<?php

require_once 'config/config.php';



/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE DE CONNEXION
 */
function getPageConnexion(){
    //session_destroy();
    //session_destroy();
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
                    session_destroy();
                }
                //Si le login est incorrecte
                if($idLogin === 0 && $idPassword !== 0){
                    $loginError = "Le login est incorrecte";
                    $infosConnexionIsCorrect = false;
                    session_destroy();
                }
                //Si le mot de pass est incorrecte
                if($idLogin !== 0 && $idPassword===0){
                    $passwordError = "Le mot de pass est incorrecte";
                    $infosConnexionIsCorrect = false;
                    session_destroy();
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
                            $_SESSION['reponse_true'] = $json_user_file_decode['user'.$idLogin]['reponse_true'];
                            $_SESSION['user_table'] = $json_user_file_decode;
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
                            $_SESSION['user_table'] = $json_user_file_decode;
                            header("location:jeux");
                        }
                    }
                }
                $_SESSION['genererQuestion'] = true;
            }
    require_once 'views/front/login.view.php';
    }


/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE de jeux
 */
function getPageJeux(){

    $title = "SaQuizz:Jeux";
    if(isset($_SESSION) && !empty($_SESSION))
    {

        //Vérification des autorisations
        if($_SESSION['acces']=== "joueur")
        {

            //Gestion de la déconnexion
            if(isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion")
            {
                session_destroy();
                echo '<script> location.replace("login"); </script>';
            }

            //on vide la variable de contrôle d'accès aux pages récapitulatif et indisponible
            unset( $_SESSION['isRecap']);
            unset($_SESSION['isNoDispo']);
            unset($_SESSION['quitterPartie']);
            $confi = false;

            //On récupère la table user
            $table_user = transformFileJson("utilisateur.json");

            //On crée le tableau des couleurs de score
            $tab_color = array("#49d1cb","#44a3d1","orange","#FF8913","silver");


            //On récupère nos fichiers JSON
            $json_config_decode = transformFileJson("config.json");
            $json_question_decode = transformFileJson("question.json");
            $table_questions = $json_question_decode;
            //On récupère le nombre de question par jeux
            $nbreQuestionParJeux = $json_config_decode['nombreQuestionParJeux']['value'];
            $_SESSION['nbreQuestionParJeux'] = $nbreQuestionParJeux;
            //On compte la taille des questions enregistrées
            $nombreQuestions = countJson($json_question_decode);

            //($_SESSION['genererQuestion']);
            if($_SESSION['genererQuestion'] === true)
            {
                //On décode le fichier json utilisateur
                $json_user = transformFileJson("utilisateur.json");
                $tab_rep_true = $json_user['user'.$_SESSION['idLogin']]['reponse_true'];

                unset($_SESSION['input']);
                //unset($_SESSION['questions']);
                //On générère les questions aléatoires
                //$table_num_questions = array();
                //$table_num_questions [] = rand(1,$nombreQuestions);//On initialise notre tableau num-question

                //On récupère les ids des questions
                $all_id_questions = array();
                for($i=1;$i<=$nombreQuestions;$i++)
                {
                    $all_id_questions[] = $i;
                }
                //On récupère les ids de all_id_question mélangé
                $all_id_question_alea = shuffle_extra($all_id_questions);
                //On récupère les ids unique par rapport à $tab_rep_true => correspondant au question non trouvé par le user
                $id_question_false = array();

                if(!empty($tab_rep_true))
                {
                    foreach ($all_id_question_alea as $key=>$id_question_alea)
                    {
                        foreach ($tab_rep_true as $item=>$rep_true)
                        {
                            if($id_question_alea != $rep_true)
                            {
                                $c=true;
                            }else{
                                $c=false;
                                break;
                            }
                        }
                        if($c)
                        {
                            $id_question_false [] = $id_question_alea;
                        }
                    }
                }else{
                    $id_question_false = $all_id_question_alea;
                }




                /*for($i=1;$i<$nbreQuestionParJeux;$i++)
                {
                    $st=true;
                    while($st==true)//Tout le numéro généré se trouve dans le tableau
                    {
                        $numQuestion = rand(1,$nombreQuestions);
                        if(!in_array($numQuestion,$table_num_questions) && !in_array($numQuestion,$tab_rep_true))//Si le numéro générer ne se trouve dans le tableau
                        {
                            $table_num_questions [] = $numQuestion;
                            $st=false;
                            //On récupère le libellé de la question
                            $_SESSION['questions'][$numQuestion] = $table_questions['question'.$numQuestion];
                        }
                    }
                }*/

                if(count($id_question_false)<$nbreQuestionParJeux)
                {
                    $_SESSION['isNoDispo'] = true;
                    echo '<script> location.replace("indisponible"); </script>';
                }else{
                    if(count($id_question_false)>=$nbreQuestionParJeux)
                    {
                        $tab_num_finally = array();
                        for($i=0;$i<$nbreQuestionParJeux;$i++)
                        {
                            $tab_num_finally [] = $id_question_false[$i];
                            $_SESSION['table_num_questions'] = $tab_num_finally;
                            $_SESSION['genererQuestion'] = false;
                        }
                    }
                }



            }
            //Gestion de l'affichage des questions en fonction de leur id respectifs
            if(!isset($_GET['question']))
            {
                $numQuestionEnCours = 1;
            }else{
                $numQuestionEnCours = $_GET['question'];
            }

            //Si la page dépasse le nombre de question
            if($numQuestionEnCours>$nbreQuestionParJeux)
            {
                header("location:jeux&question=1");
            }
            //Si la page est inférieur au nombre de question
            if($numQuestionEnCours<1)
            {
                header("location:jeux&question=1");
            }

            //On détermine l'id question
            $id_question = $_SESSION['table_num_questions'][$numQuestionEnCours-1];

            //On récupère tout les ids des questions générer
            foreach ($_SESSION['table_num_questions'] as $key=>$value)
            {
                $tab_id_question [] = $value;
            }

            //Si on clique sur le bouton next question
            if(isset($_POST['submit-question-next']) && !empty($_POST['submit-question-next']) || isset($_POST['terminer-partie']) || !empty($_POST['terminer-partie']))
            {
                //Si la question est de type choixSimple
                switch ($table_questions['question'.$id_question]['type_reponse'])
                {
                    case "texte" :
                        if(isset($_POST['text_reponse'.$id_question]) && !empty($_POST['text_reponse'.$id_question]))
                        {
                            $_SESSION['input']['text_reponse'.$id_question] = $_POST['text_reponse'.$id_question];
                        }
                    break;
                    case "choixSimple" :
                        if(isset($_POST['radio_reponse'.$id_question]) && !empty($_POST['radio_reponse'.$id_question]))
                        {
                           $_SESSION['input']['radio_reponse'.$id_question] = $_POST['radio_reponse'.$id_question];
                        }
                    break;
                    case "choixMultiple" :
                        if(isset($_POST['check_reponse'.$id_question]) && !empty($_POST['check_reponse'.$id_question]))
                        {
                            $_SESSION['input']['check_reponse'.$id_question] = $_POST['check_reponse'.$id_question];
                        }
                    break;

                }
                if($numQuestionEnCours<$nbreQuestionParJeux)
                {
                    header_remove();
                    header("location:jeux&question=".((int)$numQuestionEnCours+1));
                    //echo '<script> location.replace("jeux&question="'.((int)$numQuestionEnCours+1).'); </script>';
                }


            }
            //Si on clique sur le bouton previous question
            if(isset($_POST['submit-question-previous']) && !empty($_POST['submit-question-previous']))
            {
                if($numQuestionEnCours>1)
                {
                    header_remove();
                    header("location:jeux&question=".((int)$numQuestionEnCours-1));
                }

            }

            //Si on clique sur boutton terminer la partie
            if(isset($_POST['terminer-partie']) && !empty($_POST['terminer-partie']) || isset($_POST['exit-party-game']))
            {
                //On crée le tableau qui collectera les questions trouvées
                $tab_id_question_true = array();
                //On crée le tableau qui collectera les questions non-trouvées
                $tab_id_question_false = array();
                //On crée le tableau qui contiendra au total le nombre de point
                $tab_user_score_party = array();
                foreach ($tab_id_question as $key=>$value)
                {
                    //Si la question est de type choixSimple
                    switch ($table_questions['question'.$value]['type_reponse'])
                    {
                        case "texte" :
                            if(isset($_SESSION['input']['text_reponse'.$value]))
                            {
                               //Traitement
                               if(strtolower($_SESSION['input']['text_reponse'.$value]) === strtolower($table_questions['question'.$value]['reponses']['reponse1']))
                               {
                                   //On prend l'id de la question
                                   $tab_id_question_true [] = $value;
                                   //On prend le nombre de points de la question
                                   $tab_user_score_party [] = $table_questions['question'.$value]['nbre_point'];
                               }else{
                                   //On prend l'id de la question
                                   $tab_id_question_false [] = $value;
                                   //On prend le nombre de points de la question
                                   $tab_user_score_party [] = 0;
                               }
                            }else{
                                //On prend l'id de la question
                                $tab_id_question_false [] = $value;
                                //On prend le nombre de points de la question
                                $tab_user_score_party [] = 0;
                            }
                            break;
                        case "choixSimple" :
                            if(isset($_SESSION['input']['radio_reponse'.$value]))
                            {
                                $c=true;
                                //Traitement
                                foreach ( $table_questions['question'.$value]['reponses'] as $reponse)
                                {
                                    if($_SESSION['input']['radio_reponse'.$value] === $reponse['libelle'] && $reponse['statut'] === true)
                                    {
                                        $c=true;
                                        break;

                                    }else{
                                        $c=false;
                                    }
                                }
                                    if($c)
                                    {
                                        //On prend l'id de la question
                                        $tab_id_question_true [] = $value;
                                        //On prend le nombre de points de la question
                                        $tab_user_score_party [] = $table_questions['question'.$value]['nbre_point'];
                                    }else{
                                        //On prend l'id de la question
                                        $tab_id_question_false [] = $value;
                                        //On prend le nombre de points de la question
                                        $tab_user_score_party [] = 0;
                                    }

                            }else{
                                //On prend l'id de la question
                                $tab_id_question_false [] = $value;
                                //On prend le nombre de points de la question
                                $tab_user_score_party [] = 0;
                            }
                            break;
                        case "choixMultiple" :
                            if(isset($_SESSION['input']['check_reponse'.$value]))
                            {
                                //On récupère toute les items réponses vrai depuis le fichier JSON
                                $tab_all_true_reponse = array();
                                foreach ($table_questions['question'.$value]['reponses'] as $reponse)
                                {
                                    if($reponse['statut'] === true)
                                    {
                                        $tab_all_true_reponse [] = $reponse['libelle'];
                                    }
                                }
                                //Traitement
                                $c=true;
                                foreach ($_SESSION['input']['check_reponse'.$value] as $check_reponse)
                                {
                                    if(in_array($check_reponse,$tab_all_true_reponse))
                                    {
                                        $c=true;
                                    }else{
                                        $c=false;
                                        break;
                                    }
                                }
                                    if($c)
                                    {
                                        //On prend l'id de la question
                                        $tab_id_question_true [] = $value;
                                        //On prend le nombre de points de la question
                                        $tab_user_score_party [] = $table_questions['question'.$value]['nbre_point'];
                                    }else{
                                        //On prend l'id de la question
                                        $tab_id_question_false [] = $value;
                                        //On prend le nombre de points de la question
                                        $tab_user_score_party [] = 0;
                                    }
                            }else{
                                //On prend l'id de la question
                                $tab_id_question_false [] = $value;
                                //On prend le nombre de points de la question
                                $tab_user_score_party [] = 0;
                            }
                            break;
                    }
                }


                //On récupère nos tableau dans des sessions
                $_SESSION['id_question_true'] = $tab_id_question_true;
                $_SESSION['id_question_false'] = $tab_id_question_false;
                $_SESSION['user_score_party'] = $tab_user_score_party;

                //On décode le fichier json utilisateur
                $json_user = transformFileJson("utilisateur.json");
                //On récupère les données dans un tableau
                $array_data = $json_user;
                //On injecte les questions trouvées
                $data= $_SESSION['id_question_true'];
                foreach ($data as $key=>$value)
                {
                    $c=true;
                    foreach ($array_data['user'.$_SESSION['idLogin']]['reponse_true'] as $item)
                    {
                        if($item !== $value)
                        {
                            $c=true;
                        }else{
                            $c=false;
                            break;
                        }
                    }
                    if($c)
                    {
                        array_push($array_data['user'.$_SESSION['idLogin']]['reponse_true'],$value);
                    }
                }

                $finally_array = json_encode($array_data);
                $databaseURL = "data/utilisateur.json";
                //On injecte la nouvelle table modifiée dans le fichier
                file_put_contents($databaseURL,$finally_array);

                $_SESSION['isRecap'] = true;
                $_SESSION['evolute'] = true;
                echo '<script> location.replace("recapitulatif"); </script>';
            }
        }else{
            //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("login"); </script>';
        }
    }else{
        echo '<script> location.replace("login"); </script>';
    }
    require_once  'views/front/jeux.view.php';
}


/**
 * FONCTION QUI ME PERMET DE GENERER LA PAGE RECAP DES REPONSES
 */
function getPageRecapitulatif()
{
    $title = "SaQuizz:Récap";
    if (isset($_SESSION) && !empty($_SESSION)) {
        //Vérification des autorisations
        if ($_SESSION['acces'] === "joueur")
        {

            //Gestion de la déconnexion
            if (isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion") {
                session_destroy();
                echo '<script> location.replace("login"); </script>';
            }
                if(isset($_SESSION['isRecap']) && !empty($_SESSION['isRecap']) && $_SESSION['isRecap'] === true)
                {
                    //On appelle le fichier json des questions
                    $questions_table = transformFileJson("question.json");

                    //On récupère la table user
                    $table_user = transformFileJson("utilisateur.json");

                    //On crée le tableau des couleurs de score
                    $tab_color = array("#49d1cb","#44a3d1","orange","#FF8913","silver");

                    //On calcule le score de la partie
                    $score_party = 0;

                    foreach ($_SESSION['user_score_party'] as $key=>$score)
                    {
                        $score_party += ((int)$score);
                    }

                    //On récupère le dernier score obtenu
                    $last_score = $_SESSION['user_table']['user'.$_SESSION['idLogin']]['score'];
                    $score_user = $table_user['user'.$_SESSION['idLogin']]['score'];
                    if($score_party>$last_score)
                    {
                        //On décode le fichier json utilisateur
                        $json_user = transformFileJson("utilisateur.json");
                        //On récupère les données dans un tableau
                        $array_data = $json_user;

                        //On prépare le nouveau score
                        $array_data['user'.$_SESSION['idLogin']]['score'] = $score_party;
                        $score_user = $score_party;
                        //On encode les données modifiées
                        $finally_array = json_encode($array_data);
                        $databaseURL = "data/utilisateur.json";
                        //On injecte la nouvelle table modifiée dans le fichier
                        file_put_contents($databaseURL,$finally_array);

                    }

                    //Si on clique sur le boutton
                    if(isset($_POST['submit-party-remake']) && !empty($_POST['submit-party-remake']))
                    {
                        $_SESSION['genererQuestion'] = true;
                        echo '<script> location.replace("login"); </script>';
                    }
                }else{
                    //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
                    afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
                    echo '<script> location.replace("login"); </script>';
                }



        }else{
            //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("login"); </script>';
        }

    }
    require_once 'views/front/recapitulatif.view.php';
}


function getPageIndisponible()
{
    $title = "SaQuizz:Indisponible";

    if(isset($_SESSION) && !empty($_SESSION))
    {
        //Vérification des autorisations
        if ($_SESSION['acces'] === "joueur")
        {

            //Gestion de la déconnexion
            if (isset($_POST['deconnexion']) && $_POST['deconnexion'] === "Déconnexion")
            {
                session_destroy();
                echo '<script> location.replace("login"); </script>';
            }
                if(isset($_SESSION['isNoDispo']) && !empty($_SESSION['isNoDispo']) && $_SESSION['isNoDispo'] === true)
                {
                    //On récupère la table user
                    $table_user = transformFileJson("utilisateur.json");

                    //On crée le tableau des couleurs de score
                    $tab_color = array("#49d1cb","#44a3d1","orange","#FF8913","silver");
                }else{
                    //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
                    afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
                    echo '<script> location.replace("login"); </script>';
                }

        }else{
            //Affichage message erreur et redirection si l'utilisateur n'est pas un admin
            afficheMessageAlert("Vous n'avez pas les autorisations pour accéder à cette page");
            echo '<script> location.replace("login"); </script>';
        }
    }
    require_once 'views/front/indisponible.view.php';
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
            }
        }

        //On contrôle si le login est unique
        //Decode du fichier JSON d'utilisateur
        $json_user_file_decode = transformFileJson("utilisateur.json");
        if(loginIsset($login,$json_user_file_decode) != 0)
        {
            $loginError = "Ce login existe déjà";
            $isSucces = false;
            $_SESSION['isError'] = true;
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
                "score"  => 0,
                "reponse_true" => array()
            );

            $array_data['user'.$newIdUser] = $data;
            $finally_array = json_encode($array_data);
            $databaseURL = "data/utilisateur.json";
            if(file_put_contents($databaseURL,$finally_array))
            {
                unset($_SESSION['isError']);
                afficheMessageAlert("Félicitation ! Vous pouvez vous connecter pour commencer à jouer dès à présent !");
                echo '<script> location.replace("login"); </script>';
            }
        }

    require_once  'views/front/inscription.view.php';
}

