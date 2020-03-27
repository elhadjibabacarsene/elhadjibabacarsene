<?php

//UTILISER LES TABLEAUX OUR LA CONSERVATION DES DONNEES


require_once 'exo3.functions.php';

$isSuccess = false;
$isResult = false;
$nbreChampsError = "";
$nbreChamps = (int)$_POST['nbrechamps'];
$nbreDeMotsM = 0;

    

if($_SERVER['REQUEST_METHOD']=="POST"){//LA REQUETE POST EST ENVOYEE AU SERVEUR
    $isSuccess = true;

        if($isSuccess){
                

                if(isNumeric($nbreChamps)){
                    $nbreChampsError = "Veuillez saisir une valeur numérique";
                    $isSuccess = false;
                }

                if(empty($nbreChamps)){
                    $nbreChampsError = "Veuillez saisir le nombre de champs";
                    $isSuccess = false;
                }
        }


        
        
}

?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="exo3.css<?php echo "?".rand();?>">
    <title>Exercice 3</title>
</head>
<body>



      <form method="POST" class="form">
            <label class="lblPut">Saisir le nombre de mots:</label><br><br>
                <input type="text" name="nbrechamps" id="nbrechamps" value="<?=$nbreChamps?>">
                <p class="comment"><?=$nbreChampsError?></p>
                <input type="submit" value="Afficher" class="submit" name="afficher">
                <input type="reset" value="Annuler" class="reset" name="reset">

                <?php
                    

                    if($isSuccess){

                            for($i=1;$i<=$nbreChamps;$i++){//Création dynamique des champs de mots
                                $errorChamps = 'erreur'.$i;
                                

                                if(isset($_POST['resultat'])){
                                    $isResult = true; //PERMET DE CONTROLER L'AFFICHAGE ET LE TRAITEMENT FINAL
                                    $haveMessage=false; //PERMET DE CONTROLER L'AFFICHAGE DES MESSAGES D'ERREUR

                                    //CONTROLE SI LA VALEUR DU CHAMP NE CONTIENT PAS DE CHIFFRE
                                    if(!isNumeric($_POST['mot'.$i])){
                                        $errorChamps = "Vous devez saisir que des lettres uniquement";
                                        $haveMessage=true;
                                        $isResult = false;
                                    }
                                    //CONTROLE SI LA VALEUR DU CHAMP NE CONTIENT PAS D'ESPACE
                                    if(contientSpace($_POST['mot'.$i])){
                                        $errorChamps = "Vous devez saisir que des lettres uniquement";
                                        $haveMessage=true;
                                        $isResult = false;
                                    }
                                    //CONTROLE SI LE MOT CONTIENT UN CARACTERE NON-ALPHABETIQUE
                                    if(!contientCaractereNonAlphabetique($_POST['mot'.$i])){
                                        $errorChamps = "Vous devez saisir que des lettres alphabétique seulement";
                                        $haveMessage=true;
                                        $isResult = false;
                                    }
                                    //CONTROLE SI LE NOMBRE DE CARACTERE N'EST PAS SUPERIEUR A 20
                                    if(nombreCaracteres($_POST['mot'.$i])>20){
                                        $errorChamps = "Le nombre de caractère ne doit pas dépassé 20";
                                        $haveMessage=true;
                                        $isResult = false;
                                    }
                                    //CONTROLE SI LA VALEUR DU CHAMP EST VIDE
                                    if(empty($_POST['mot'.$i])){
                                        $errorChamps = "Aucun mot n'a été saisi sur ce champ";
                                        $haveMessage=true;
                                        $isResult = false;
                                    }
                                    
                                        if($isResult){
                                            if(contientM($_POST['mot'.$i])){
                                                $nbreDeMotsM++;
                                            }
                                        }

                                    
                                }
                                echo '
                                <br><br><label>Mot N°'.$i.'</label>
                                <input class="input-mot" type="text" name="mot'.$i.'" value="'.(isset($_POST['mot'.$i]) ? $_POST['mot'.$i] : "").'">
                                <p class="comment">'.($haveMessage ? $errorChamps : "").'</p>
                                ';
    
                            }
                        

                        echo '<br><br><input type="submit" value="Résultat" class="resultat" name="resultat">';

                            if($isResult){
                                echo '<br><br><span class="resultat-text">Vous avez saisi '.$nbreChamps.' mot(s), dont <span style="color:green">'.$nbreDeMotsM.' avec la lettre M</span></span>';
                            }
                    }

                    /* echo '<pre>';
                    var_dump($_POST);
                    echo '</pre>';
                    echo $isResult; */
                ?>
                
        </form>

            
</body>
</html>