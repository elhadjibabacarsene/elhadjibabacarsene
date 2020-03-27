<?php



    /**
     * FONCTION DE CONTROLE NUMERIQUE
     */
        function isNumeric($arg){
            return preg_match("#[^0-9]#",$arg);
        }


    /**
     * @param string $arg valeur du champ
     * renvoi true si la valeur est vide ou false si c'est le contraire
     */
        function isEmpty($arg){
            if($arg == ""){
            $st = true;
            }else{
                $st = false;
            }
            return $st;
        }

    /**
    * retourne la taille d'une chaine
    */
        function nombreCaracteres($chaines){
            $nbc = 0;
            $i = 0;
            while(!empty($chaines[$i])){
                $nbc++;
                $i++;
            }
            
            return $nbc;
        }
    /**
    * retourne 1 si le mot contient un espace ou 0 si c'est le contraire
    */
        function contientSpace($mot){
            $c=false;
            for($i=0;$i<nombreCaracteres($mot);$i++){
                if($mot[$i]===" "){
                    $c=true;
                    break;
                }else{
                    $c=false;
                }
            }
            return $c;
        }
    
    /**
     * retourne 1 si le mot ne contient pas de caractère non Alphabétique
     */
        function contientCaractereNonAlphabetique($mot){
            $c=false;
            for($i=0;$i<nombreCaracteres($mot);$i++){

                if($mot[$i]>="a" && $mot[$i]<="z" || $mot[$i]>="A" && $mot[$i]<="Z"){
                    $c=true;
                }else{
                    $c=false;
                    break;
                }

            }
            return $c;
        }

    /**
    * retourne 1 si le mot contient la lettre m ou M et 0 si c'est le contraire
    */
        function contientM($mot){
            $c=false;
            for($i=0;$i<nombreCaracteres($mot);$i++){
                if($mot[$i]== "m" || $mot[$i]=="M"){
                    $c=true;
                    break;
                }else{
                    $c=false;
                }
            }
            return $c;
        }