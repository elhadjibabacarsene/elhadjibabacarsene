<?php

ob_start();

?>

    <div id="container-accueil">
        <div id="joueur-id"></div>
        <div class="container-accueil-head">
            <div class="head-left">
                <img src="<?=URL.$_SESSION['avatar']?>" alt="<?=$_SESSION['avatar']?>">
                <p><?=$_SESSION['prenom']. ' '.$_SESSION['nom']?></p>
            </div>
            <div class="head-center">
                <h3>BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br><span>JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</span></h3>
            </div>
            <div class="head-right">
                <form action="" method="POST">
                    <input type="submit" value="Déconnexion" name="deconnexion">
                </form>
            </div>
        </div>

        <div id="container-accueil-jeux">

            <div id="container-accueil-question">

                <div id="question-jeux">
                    <div id="questions" class="border-right-bottom">
                        <span class="titre-question">Question <?=$numQuestionEnCours?>/<?=$nbreQuestionParJeux?>:</span><br><br>
                        <span class="question"><?=$table_questions['question'.$id_question]['question']?></span>
                    </div>
                    <div id="points" class="border-right-bottom">
                        <span><?=$table_questions['question'.$id_question]['nbre_point']?> pts</span>
                    </div>
                    <div id="reponses-1">
                        <form method="POST">
                        <?php

                            switch ($table_questions['question'.$id_question]['type_reponse'])
                            {
                                case "texte" :
                                    echo '<input class="reponse rep-quest-text"  type="text" name="text_reponse'.$id_question.'" value="'.
                                        ((isset($_SESSION['input']['text_reponse'.$id_question]) && !empty($_SESSION['input']['text_reponse'.$id_question])) ? $_SESSION['input']['text_reponse'.$id_question] : "").'" autofocus>';

                                break;

                                case "choixSimple" :
                                    //On affiche les bonnes réponses
                                    foreach($table_questions['question'.$id_question]['reponses'] as $key=>$value)
                                    {
                                        echo '<input type="radio" value="'.$value['libelle'].'" name="radio_reponse'.$id_question.'" 
                                        '.((isset($_SESSION['input']['radio_reponse'.$id_question]) && $_SESSION['input']['radio_reponse'.$id_question]==$value['libelle']) ? "checked" : "").'>';
                                        echo'<label class="lbl-reponse">'.$value['libelle'].'</label><br>';
                                    }
                                break;

                                case "choixMultiple" :
                                    //On affiche les bonnes réponses
                                    foreach($table_questions['question'.$id_question]['reponses'] as $key=>$value)
                                    {
                                        echo '<input type="checkbox" value="'.$value['libelle'].'" name="check_reponse'.$id_question.'[]"'.
                                            ((isset($_SESSION['input']['check_reponse'.$id_question]) && in_array($value['libelle'],$_SESSION['input']['check_reponse'.$id_question])) ? "checked" : "").'>';
                                        echo '<label class="lbl-reponse">'.$value['libelle'].'</label><br>';
                                    }
                                break;

                            }
                        ?>
                    </div>
                </div>



                        <input type="submit" name="submit-question-next" value="Suivant" id="next-question">
                        <input type="submit" name="exit-party-game" value="Quitter la partie" id="exit-party">
                        <input type="submit" name="submit-question-previous" value="Précédent" id="before-question">
                    </form>

            </div>


            <div id="container-accueil-score">
                <div id="nav-score">
                    <form method="POST">
                        <div id="div-top-score">
                            <input type="submit" name="menu-top-score" value="Top scores" id="menu-top-score" class="menu-score">
                        </div>
                        <div id="div-best-score">
                            <input type="submit" name="menu-best-score" value="Mon meilleur score" id="menu-best-score" class="menu-score">
                        </div>
                    </form>
                </div>
                <div id="div-score">

                    <table class="table-top-score">
                        <?php

                            //Si on clique sur le bouton top score
                            if(isset($_POST['menu-top-score']) && !empty($_POST['menu-top-score']))
                            {
                                echo '<div id="top-score"></div>';
                                //On récupère les 5 premier
                                $top_5_id = top5score();
                                $i=0;
                                foreach ($top_5_id as $item)
                                {
                                    echo '<tr>';
                                    echo '<td class="td-top-score-prn">' . $table_user['user' .  $item['id']]['prenom'].' '.$table_user['user' .  $item['id']]['nom']. '</td>';
                                    echo '<td class="td-top-score-sc">' . $item['score'] .'<span id="pts"> pts</span></td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="td-top-score-col" style="width:2px;height: 2px;background-color: '.$tab_color[$i].'"></td>';
                                    $i++;
                                }
                            }else{
                                echo '<div id="best-score"></div>';
                                echo '<div class="title-score">Votre meilleur score:<br>
                                        <span>'.$table_user['user'.$_SESSION['idLogin']]['score'].' pts</span>
                                      </div>';
                            }
                        ?>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <script type="text/javascript">
        //On récupère les bouttons précédent et suivant
        var previous_submit = document.getElementById("before-question");
        var next_submit = document.getElementById("next-question");

        //On récupère le numéro du question en cours
        let num_question = "<?php echo $numQuestionEnCours?>";
        let nbre_question_par_jeux = "<?php echo $nbreQuestionParJeux?>";

        //Si le numéro question en cours est égale à 1
        if(parseInt(num_question) === 1)
        {
            //On désactive le boutton précédent
            previous_submit.disabled = true;
            previous_submit.style.backgroundColor = "silver";
        }
        //Si le numéro question en cours est égale à 5
        if(parseInt(num_question) === parseInt(nbre_question_par_jeux))
        {
            //On remplace par le boutton terminer
            next_submit.value = "Terminer";
            next_submit.name = "terminer-partie";
            next_submit.style.backgroundColor = "green";
        }
        //On récupère le boutton quitter
        var submit_exit = document.getElementById("exit-party");
        submit_exit.addEventListener("click",function(e){
            if(!confirm("Voulez-vous vraiment quitter la partie ?"))
            {
                e.preventDefault();
            }
        });
    </script>

<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>