<?php

ob_start();

?>

    <div id="container-accueil">
        <!-- EN TETE -->
        <div class="container-accueil-head">
            <div class="head-left">
                <img src="<?=URL.$_SESSION['avatar']?>" alt="<?=$_SESSION['avatar']?>">
                <p><?=$_SESSION['prenom']. ' '.$_SESSION['nom']?></p>
            </div>
            <div class="head-center">
                <h3>créer et paramétrer vos quizz</h3>
            </div>
            <div class="head-right">
                <form action="" method="POST">
                    <input type="submit" value="Déconnexion" name="deconnexion">
                </form>
            </div>
        </div>

        <!-- CORPS -->
        <div class="container-accueil-corps">
            <div class="container-accueil-corps-menu">
                <div class="top">
                    <img src="<?=URL.$_SESSION['avatar']?>" alt="<?=$_SESSION['avatar']?>">
                    <p><?=ucfirst($_SESSION['prenom'])?></p>
                    <p class="nom"><?=strtoupper($_SESSION['nom'])?></p>
                </div>
                <div class="bottom">
                    <!-- MENU -->
                    <?php
                        include "views/commons/menu.php";
                    ?>
                </div>
            </div>
            <div id="container-accueil-corps">

                <!-- ACCUEIL NOMBRE QUESTIONS -->
                <div class="accueil-nbre-question">
                    <form method="POST">
                        <label>Nbre de questions/jeux</label>
                        <input type="text" name="nbre-question" value="<?=(isset($_POST['nbre-question'])) ? $nbre_question : "" ?>">
                        <input type="submit" name="submit-nbre-question" value="OK">
                    </form>
                </div>

                <!-- ACCUEIL-LIST-QUESTION-->
                <div class="accueil-list-question">
                        <?php

                        if($page<=$nbreDePage)
                        {
                            //$indiceFin = ($page) * $nbreParPage;
                            //$indiceDepart = $indiceFin - $nbreParPage;
                            $indiceDepart = ($page-1)*$nbreParPage;
                            $indiceFin = $indiceDepart+$nbreParPage;
                                //On affiche les éléments de la page
                                for($i=$indiceDepart+1;$i<=$indiceFin;$i++)
                                {
                                    //On récupère le type du question
                                    $type_reponse = $questions_table['question'.$i]['type_reponse'];
                                    //On calcul le nombre de bonnes réponses
                                    $bonnes_reponses = $questions_table['question'.$i]['reponses'];
                                    //On calcul le nombre de bonnes réponses
                                    $mauvaises_reponses = $questions_table['question'.$i]['reponses'];

                                    //On affiche la question en fonction de son type de réponse
                                    switch ($type_reponse)
                                    {
                                        case "texte":
                                            //On affiche la question
                                            echo '<span class="question-line">' .$i.'. '.$questions_table['question'.$i]['question']. '</span><br>';
                                            echo '<input class="reponse" disabled="disabled" type="text" value="'.$questions_table['question'.$i]['reponses'].'"><br>';
                                        break;

                                        case "choixSimple":
                                            echo '<span class="question-line">' .$i.'. '.$questions_table['question'.$i]['question']. '<br></span>';
                                                //On affiche les bonnes réponses
                                                 echo '<input type="radio" disabled="disabled" checked>';
                                                 echo'<label class="lbl-reponse">'.$questions_table['question'.$i]['reponses']['bonnes_reponses'][0].'</label><br>';
                                                 //On affiche les mauvaise réponses
                                                 foreach ($questions_table['question'.$i]['reponses']['mauvaises_reponses'] as $key=>$value)
                                                 {
                                                     echo '<input type="radio" disabled="disabled">';
                                                     echo'<label class="lbl-reponse">'.$value.'</label><br>';
                                                 }

                                            break;

                                        case "choixMultiple":
                                            echo '<span class="question-line">' .$i.'. '.$questions_table['question'.$i]['question']. '<br></span>';
                                                //On affiche les bonnes réponses
                                            foreach ($questions_table['question'.$i]['reponses']['bonnes_reponses'] as $key=>$value)
                                            {
                                                echo '<input type="checkbox" disabled="disabled" checked>';
                                                echo'<label class="lbl-reponse">'.$value.'</label><br>';
                                            }
                                                //On affiche les mauvaise réponses
                                                foreach ($questions_table['question'.$i]['reponses']['mauvaises_reponses'] as $key=>$value)
                                                {
                                                    echo '<input type="checkbox" disabled="disabled">';
                                                    echo'<label class="lbl-reponse">'.$value.'</label><br>';
                                                }
                                            break;
                                    }

                                }

                        }
                        ?>
                </div>

                    <!-- ACCUEIL-NEXT-QUESTION-->
                <div class="accueil-question-next">
                    <form method="POST">
                        <input type="submit" name="submit-question-next" value="Suivant" class="button-next">
                    </form>
                    <form method="POST">
                        <input type="submit" name="submit-question-previous" value="Précédent" class="button-previous">
                    </form>
                </div>

            </div>
        </div>

    </div>


    <script type="text/javascript">
        //On récupère le container accueil
        let container_accueil = document.getElementById("container-accueil");
        container_accueil.style.height = "570px";
    </script>

<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>