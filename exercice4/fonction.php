<?php
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

/*
 * FONCTION QUI PERMET DE SAVOIR SI UNE CARACRTERE EST EN MAJUSCULE
 */
function is_majuscule($car){
    return ($car>="A" && $car<="Z");
}

/*
 * FONCTION QUI PERMET DE SAVOIR SI UNE CARACRTERE EST EN MINISCULE
 */
function is_minuscule($car){
    return ($car>="a" && $car<="z");
}

/*
 * FONCTION QUI VERIFIE QUE LA CHAINE EST UNE PHRASE OU PAS
 */
function isSentence($chaine){
    return(preg_match('#^[A-Z][a-z0-9_, ]+[.?!]$#',$chaine));
}
/*
 * FONCTION QUI PERMET DE CORRIGER LA PREMIERE LETTRE EN MAJUSCULE
 */
function correctionFirstLetter($chaine){
   return ucfirst($chaine);
}
/*
 * FONCTION QUI ELIMINE LES ESPACES EN DEBUT DE PHRASE
 */
function removeSpaceInFirst($chaine){
    return preg_replace("/^\s+/","",$chaine);
}
/*
 * FONCTION QUI ELIMINE LES ESPACES APRES LES APOSTROPHES
 */
function removeSpaceAfterApos($chaine){
    return preg_replace("/(?<=\')\s+/","",$chaine);
}

function removeSpaceBeforePonctuation($chaine){
    return preg_replace("/\s+(?=[.?!,])/","",$chaine);
}



/*
 * FONCTION QUI VA DECOUPER UNE CHAINE EN PHRASES ET LES CORRIGEES
 */
function paragraphToSentences($chaine){
    $phrasesNew = array();
    //Cherche un point précédé d'un espace ou pas, de lettre (maj/min)
    //et ses lettres peuvent être suivis par un espace
    $phrasesBrut = preg_split('/(?<=[.?!])\s?(?=[a-z_ ])/i', $chaine);

        for($i=0;$i<count($phrasesBrut);$i++){

            //On élimine les espaces en début de phrase
            $phrasesBrut[$i] = removeSpaceInFirst($phrasesBrut[$i]);
            //On élimine les espaces après les apostrophes
            $phrasesBrut[$i] = removeSpaceAfterApos($phrasesBrut[$i]);
            //On élimine les espaces avant les ponctuations
            $phrasesBrut[$i] = removeSpaceBeforePonctuation($phrasesBrut[$i]);

            //On si c'est une phrase en se basant sur la première lettre(MAJ) et la ponctuation
           if(isSentence($phrasesBrut[$i])){
               $phrasesNew[] = $phrasesBrut[$i];
           }else{
                //On corrige la première lettre minuscule en MAJ
                $phrasesNew[] = correctionFirstLetter($phrasesBrut[$i]);
           }
        }
     return $phrasesNew;
}