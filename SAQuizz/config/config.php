<?php

/**
 * FONCTION QUI PERMET DE TRANSFORMER UN FILES JSON EN TABLEAU PHP
 * @param $nameFileJson string nom du fichier JSON
 * @return mixed le fichier json decoder
 */
    function transformFileJson($nameFileJson){
        $file_json = file_get_contents(URL."json/".$nameFileJson);
        return json_decode($file_json);
    }


/**
 * FONCTION QUI NOUS PERMET DE CONNAITRE LE NOMBRE D'ELEMENT DANS LE FICHIER JSON
 * @param $jsonFileDecode array fichier json decoder
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
            $loginJson = $jsonFileDecode->{'user'.$i}->login;
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
            $passwordJson = $jsonFileDecode->{'user'.$i}->password;
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
            $loginJson = $jsonFileDecode->{'user'.$i}->login;
            $passwordJson = $jsonFileDecode->{'user'.$i}->password;
                if($loginJson === $loginUser && $passwordJson === $passwordUser){
                    $st=$i;
                }
        }
        return $st;
    }

    function afficheMessageAlert($message){
        echo '<script>alert("'.$message.'")</script>';
    }

//CONSTANTE QUI NOUS PERMET D'ACCEDER A L'URL SOURCE
define("URL",str_replace("index.php","", (isset($_SERVER["HTTPS"])? "https" : "http"). "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
