<?php

//CONSTANTE QUI NOUS PERMET D'ACCEDER A L'URL SOURCE
define("URL",str_replace("index.php","", (isset($_SERVER["HTTPS"])? "https" : "http"). "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

//set_time_limit ( 0 );
/**
 * FONCTION QUI PERMET DE TRANSFORMER UN FILES JSON EN TABLEAU PHP
 * @param $nameFileJson string nom du fichier JSON
 * @return mixed le fichier data decoder
 */
    function transformFileJson($nameFileJson){
        $file_json = file_get_contents(URL."data/".$nameFileJson);
        return json_decode($file_json,true);
    }


/**
 * FONCTION QUI NOUS PERMET DE CONNAITRE LE NOMBRE D'ELEMENT DANS LE FICHIER JSON
 * @param $jsonFileDecode array fichier data decoder
 * @return int le nombre d'élément dans le fichier JSON
 */
    function countJson($jsonFileDecode){
        $cpt = 0;
        foreach($jsonFileDecode as $key => $value){
            $cpt ++;
        }
        return $cpt;
    }

/**
 * @param $loginUser string login saisi par l'utilisateur
 * @param $jsonFileDecode array le fichier JSON
 * @return int 0 si le login n'existe pas ou est incorrect OU BIEN  l'id correspondant au login
 */
    function loginIsset($loginUser,$jsonFileDecode){
        $tailleFileJson = countJson($jsonFileDecode);
        $st = 0;
        for($i=1;$i<=$tailleFileJson;$i++){
            $loginJson = $jsonFileDecode['user'.$i]['login'];
            if($loginJson === $loginUser){
                $st=$i;
            }
        }
        return $st;
    }

/**
 * @param $passwordUser string password saisi par l'utilisateur
 * @param $jsonFileDecode  array le fichier JSON
 * @return int 0 si le password n'existe pas ou est incorrect OU BIEN l'id correspondant au password
 */
    function passwordIsset($passwordUser,$jsonFileDecode){
        $tailleFileJson = countJson($jsonFileDecode);
        $st=0;
        for($i=1;$i<=$tailleFileJson;$i++){
            $passwordJson = $jsonFileDecode['user'.$i]['password'];
            if($passwordJson === $passwordUser){
                $st=$i;
            }
        }
        return $st;
    }


/**
 * FONCTION QUI NOUS PERMET DE VERIFIER SI UN UTILISATEUR EXISTE DANS NOTRE FICHIER JSON
 * @param $loginUser string le login saisi par l'utilisateur lors de la connexion
 * @param $passwordUser string le password saisi par l'utilisateur lors de la connexion
 * @param $jsonFileDecode array le fichier JSON  décoder ou l'on doit faire les vérification
 * @return int 0 si l'utilisateur n'existe pas sinon l'id de l'utilisateur de le fichier JSON
 */
    function getConnexionId($loginUser, $passwordUser, $jsonFileDecode){
        $tailleFileJson = countJson($jsonFileDecode);
        $st=0;
        for($i=1;$i<=$tailleFileJson;$i++){
            $loginJson = $jsonFileDecode['user'.$i]['login'];
            $passwordJson = $jsonFileDecode['user'.$i]['password'];
                if($loginJson === $loginUser && $passwordJson === $passwordUser){
                    $st=$i;
                }
        }
        return $st;
    }

/**
 * @param $jsonFileDecode array le fichier JSON décodé
 * @return int le nombre de joueur
 */
    function indicesJoueurs($jsonFileDecode){
        $indicesJoueurs = array();
        $taille = countJson($jsonFileDecode);
        for($i=1;$i<=$taille;$i++){
            if($jsonFileDecode['user'.$i]['acces'] === "joueur"){
                $indicesJoueurs[] = $i;
            }
        }
        //var_dump($indicesJoueurs);
        return $indicesJoueurs;

    }

/**
 * @param $jsonFileDecode array le fichier JSON décodé
 * @return int le nombre de joueur
 */
function indicesAdmins($jsonFileDecode){
    $indiceAdmins = array();
    $taille = countJson($jsonFileDecode);
    for($i=1;$i<=$taille;$i++){
        if($jsonFileDecode['user'.$i]['acces'] === "admin"){
            $indicesAdmins[] = $i;
        }
    }
    return $indicesAdmins;
}




/**
 * FONCTION DE PAGINATION
 */
function pagination($tab){
    $totalValeur = count($tab);
    //TOTAL VALEUR

    //NOMBRE DE VALEUR PAR PAGE
    $nbreParPage = 15;
    //NOMBRE DE PAGES
    $nbreDePage = ceil($totalValeur / $nbreParPage);



    //Affichage de la valeur de la première page
    if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }
    if($page<=$nbreDePage){
        $indiceFin = ($page)*$nbreParPage;
        $indiceDepart = $indiceFin - $nbreParPage;
        echo '<br><br>';
        echo '<table border="1">';

        echo '<tr>';
        for($i=$indiceDepart;$i<$indiceFin;$i++){
            if(!empty($tab[$i])){
                echo '<td>'.$tab[$i].'</td>';
            }

        }
        echo '</tr>';

        echo '</table>';
        //AFFICHAGE DES NUMEROS DE PAGES
        for($page=1;$page<=$nbreDePage;$page++){
            echo '<a href="exercice1.php?page='.$page.'&c=true"> '.$page.' </a>';
        }
    }else{
        echo '<br>Pas de données à afficher';

    }

}

    function afficheMessageAlert($message){
        echo '<script>alert("'.$message.'")</script>';
    }

/**
 * renvoi le nombre d'input reponse
 * @param $tab array $_POST
 * @return int le nombre d'input reponse
 */
    function getNbreInputResponse($tab)
    {
        $cpt=0;
        foreach ($tab as $key=>$value)
        {
            if(preg_match("#^reponse[0-9]#",$key))
            {
                $cpt++;
            }
        }
        return $cpt;
    }


/**
 * @param $tab array $_POST
 * @param $nbre_element int le nbre d'input
 * @return bool true=>si tous les champs sont vides or false=>si il existe un seul champs non vide
 */
    function verifyAllInputReponse($tab,$nbre_element)
    {
        $c=true;
        for($i=1;$i<=$nbre_element;$i++)
        {
            if(empty($tab['reponse'.$i]))
            {
                $c=true;
            }else{
                $c=false;
                break;
            }
        }
        return $c;
    }

/**
 * @param $val string la valeur à tester
 * @return bool true si c'est numérique OU false si c'est le contraire
 */
    function isIntValue($val)
    {
        if(preg_match( '#[^0-9]#' ,$val))
        {
            $st=false;
        }else{
            $st=true;
        }
        return $st;
    }

/**
 * @param $json_question_decode array le fichier des questions décodés
 * @return int le nombre de question dans le fichier json question
 */
    function nbreQuestion($json_question_decode)
    {
        $nbre = 0;
        foreach ($json_question_decode as $question)
        {
            $nbre++;
        }
        return $nbre;
    }



 function allGamerByScore()
 {
     //On inintialise la table qui va contenir l'id du joueur et son score
     $joueur_id_score = array();
     //$top_5 = array();
     //On décode le fichier d'utilisateur JSON
     $json_user_decode = transformFileJson("utilisateur.json");
     //var_dump($json_user_decode);
     //On récupère les id des joueurs dans un tableau
     $joueurs_table = indicesJoueurs($json_user_decode);
     //On récupère la nombre de joueur
     $nbre_joueur = count($joueurs_table);
     foreach ($joueurs_table as $key=>$id)
     {
         //On récupère l'id et les scores de chaque joueurs
         $joueur_id_score [] = array('id'=> $id,'score'=> $json_user_decode['user'.$id]['score']);
     }
     //On fait un trie décroissant
     $tmp=0;
     //var_dump(count($joueur_id_score));
     for($i=0;$i<count($joueur_id_score);$i++)
     {
         for($j=$i;$j<count($joueur_id_score);$j++)
         {
             if($joueur_id_score[$i]["score"]<=$joueur_id_score[$j]["score"])
             {
                 $tmp = $joueur_id_score[$j];
                 $joueur_id_score[$j] = $joueur_id_score[$i];
                 $joueur_id_score[$i] = $tmp;
             }
         }
     }
     return $joueur_id_score;
 }



/**
 * @return array l'id et le score des 5 meilleurs joueurs
 */
    function top5score()
    {
        $joueur_id_score = allGamerByScore();
        //var_dump($joueur_id_score);
        for($i=0;$i<5;$i++)
        {
            $top_5 [] = $joueur_id_score[$i];
        }
        return $top_5;
    }

function shuffle_extra ($array) {
    // vérifie si c'est un tableau
    if (!is_array($array)) {
        return array();
    }

    // mélange les clés du tableau
    shuffle($array);

    // retourne le résultat
    return $array;
}

//CONSTANTE QUI NOUS PERMET D'ACCEDER A L'URL SOURCE

define("YOURTOF", "public/source/images/votre-photo-ici.jpg");