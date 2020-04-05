<?php

    require_once 'fonction.php';

    //$phase = array();
    $chaineError = "";
    $isSuccess = false;

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $isSuccess = true;
        $chaine = $_POST['chaine'];

            if(empty($chaine)){
                $chaineError = "Veuillez saisir les phrases svp";
                $isSuccess = false;
            }
    }
?>
<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Exercice 4</title>
        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <label>Saisir les phrases à traiter</label><br>
            <textarea name="chaine" id="chaine" cols="30" rows="10"><?=($chaine != "" ? $chaine : "")?></textarea><br>
            <input type="submit" value="Résultats">
            <p class="comment"><?=$chaineError?></p>
        </form>
    </body>
</html>

<?php
        if($isSuccess){

            $phrases = paragraphToSentences($chaine);
            echo '<span class="titre">La liste des phrases après correction:</span><br><br>';
                foreach ($phrases as $phrase){

                    echo $phrase;
                    echo '<br>';
                }


        }



/* while($c==true){
            $phrase .= $chaine[$i];
            if($chaine[$i] === "." || $chaine[$i] === "?" || $chaine[$i] === "!"){
                $c = false;
            }
        }*/
