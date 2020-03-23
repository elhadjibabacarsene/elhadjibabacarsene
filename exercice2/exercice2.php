<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="exo2.css<?php echo "?".rand();?>" rel="stylesheet">
    <title>Exercice 2</title>
</head>
    <body>

        <?php

            /**
             * Permet de styliser les lignes du tableau
             */

            $tabColor = array('#6c7ae0','#7e8aebfd','#9aa1dbfd','#6c7ae0');
            function formatage($color){
                if($color==1){
                    $c = "#6c7ae0";
                }else{
                    $c = "#6c7ae0";
                }
                return 'style="background-color:'.$c.'"';
            }

            /**
             * Permet d'afficher le tableau des mois
             */
            function affichageTableau($tab,$tabColor,$key){
                $j=1;
                $s=1;
                $x=0;
                echo '<table class="tab">';
                for($i=1;$i<=4;$i++){//affichage des lignes
                    $k=0;
                    echo '<tr class="row" style="background-color:'.$tabColor[$x].'">';
                   while($j<=12){//affichage des numéros de mois

                       echo '<td class="data">';
                       echo $j;
                       echo '</td>';
                       echo '<td class="data">';
                       echo $tab[$j][$key];
                       echo '</td>';
                        $k++;
                        $j++;
                        if($k==3){//arrête l'affichage pour faire un retour à la ligne
                            break;
                            $s++;
                        }
                   }
                   $x++;
                   echo '</tr>';
                }
                echo '</table>';
            }

            /**
             * Tableau contenant les mois en français et en anglais
             */
            $tabDesMois = array(
                '1' => array('Janvier','January'),
                '2' => array('Février','February'),
                '3' => array('Mars','March'),
                '4' => array('Avril', 'April'),
                '5' => array('Mai', 'May'),
                '6' => array('Juin', 'June'),
                '7' => array('Juillet','July'),
                '8' => array('Aout','August'),
                '9' => array('Septembre','September'),
                '10' => array('Octobre','October'),
                '11' => array('Novembre', 'November'),
                '12' => array('Décembre','December') 
            );
            
            /* echo '<pre>';
            print_r($tabDesMois);
            echo '</pre>'; */
        
                
        ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="form">
            <label class="lblPut">Choisissez votre langue:</label><br><br>
                <select name="langue" id="">
                    <option value="français">Français</option>
                    <option value="anglais">Anglais</option>
                </select>
                <br>
                <input type="submit" value="Afficher" class="submit" name="en">
        </form>
        
            <?php

                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $langue = $_POST['langue'];
                    if($langue == "français"){
                        affichageTableau($tabDesMois,$tabColor,0);
                    }
                    if($langue == "anglais"){
                        affichageTableau($tabDesMois,$tabColor,1);
                    }
                    
                }
            ?>
        
    </body>
</html>