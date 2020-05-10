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

                <?php
                    if($score_party>$last_score)
                    {
                        $confi = true;
                        echo '<div id="recap-titre" style="color: green">Quelle performence ! Félicitation pour votre nouveau record</div>';
                        echo '<br>';
                        echo '<img class="ic-success" src="'.URL.'public/source/images/icones/in-love.png">';
                        //Si le score de la partie est inférieur au score record du joueur et que le nombre de question trouvé est supérieur à la moitié des questions
                    }elseif($score_party<$last_score && count($_SESSION['id_question_true'])>=round(($_SESSION['nbreQuestionParJeux'])/2))
                    {
                        echo '<div id="recap-titre">C\'est bon, mais vous pouvez mieux faire !</div>';
                        echo '<br>';
                        echo '<img class="ic-success" src="'.URL.'public/source/images/icones/clein.png">';
                        //Si le score de la partie est inférieur au score record du joueur et que le nombre de question trouvé est inférieur à la moitié des questions
                    }elseif($score_party<$last_score && count($_SESSION['id_question_true'])<round(($_SESSION['nbreQuestionParJeux'])/2))
                    {
                        echo '<div id="recap-titre">Aïe ! C\'est médiocre</div>';
                        echo '<br>';
                        echo '<img class="ic-success" src="'.URL.'public/source/images/icones/mediocre.png">';
                        //Si le score de la partie est égal au score record
                    }elseif($score_party===$last_score)
                    {
                        echo '<div id="recap-titre">Waw ! Vous êtiez à un pas de battre votre record</div>';
                        echo '<br>';
                        echo '<img class="ic-success" src="'.URL.'public/source/images/icones/smile.png">';
                    }
                ?>
                <div id="recap-score">
                    Fin de la partie, votre Score est de: <span style="color: green"><?=$score_party?> pts</span>
                </div>

                <div id="recap-questions">
                    <?php

                        foreach ($_SESSION['table_num_questions'] as $key=>$question)
                        {

                            switch ($questions_table['question'.$question]['type_reponse'])
                            {
                                //Si la question est de type texte
                                case "texte" :
                                    echo '<span class="question-line">' .($key+1).'. '.$questions_table['question'.$question]['question']. '</span><br>';
                                    echo '<input class="reponse" disabled="disabled" type="text" value="'. $_SESSION['input']['text_reponse'.$question].'">';
                                    if(in_array($question,$_SESSION['id_question_true']))
                                    {
                                        echo'<img src="'.URL.'public/source/images/icones/validate.png" class="ic-validate"><br>';
                                    }else{
                                        echo'<img src="'.URL.'public/source/images/icones/unvalidate.png"  class="ic-validate"><br>';
                                    }
                                break;
                                //Si la question est de type simple
                                case "choixSimple":
                                    echo '<span class="question-line">' .($key+1).'. '.$questions_table['question'.$question]['question']. '</span><br>';
                                    //On affiche les bonnes réponses

                                        foreach($questions_table['question'.$question]['reponses'] as $key=>$value)
                                        {
                                            if(isset($_SESSION['input']['radio_reponse'.$question]))
                                            {
                                                if($value['libelle'] === $_SESSION['input']['radio_reponse'.$question])
                                                {
                                                    echo '<input type="radio" disabled="disabled" checked>';
                                                    echo'<label class="lbl-reponse">'.$value['libelle'].'</label>';
                                                    if(in_array($question,$_SESSION['id_question_true']))
                                                    {
                                                        echo'<img src="'.URL.'public/source/images/icones/validate.png" class="ic-validate"><br>';
                                                    }else{
                                                        echo'<img src="'.URL.'public/source/images/icones/unvalidate.png"  class="ic-validate"><br>';
                                                    }
                                                }else{
                                                    echo '<input type="radio" disabled="disabled">';
                                                    echo'<label class="lbl-reponse">'.$value['libelle'].'</label><br>';
                                                }
                                            }else{
                                             echo '<input type="radio" disabled="disabled">';
                                             echo'<label class="lbl-reponse">'.$value['libelle'].'</label>';
                                             echo'<img src="'.URL.'public/source/images/icones/unvalidate.png"  class="ic-validate"><br>';
                                        }
                                    }
                                break;

                                case "choixMultiple":
                                    echo '<span class="question-line">' .($key+1).'. '.$questions_table['question'.$question]['question']. '</span><br>';
                                    //On affiche les bonnes réponses
                                    foreach(($questions_table['question'.$question]['reponses']) as $key=>$value)
                                    {
                                        if(isset($_SESSION['input']['check_reponse'.$question]))
                                        {
                                            if(in_array($value['libelle'],$_SESSION['input']['check_reponse'.$question]))
                                            {
                                                if($value['statut'] === true)
                                                {
                                                    echo '<input type="checkbox" disabled="disabled" checked>';
                                                    echo'<label class="lbl-reponse">'.$value['libelle'].'</label>';
                                                    echo'<img src="'.URL.'public/source/images/icones/validate.png" class="ic-validate"><br>';
                                                }else{
                                                    echo '<input type="checkbox" disabled="disabled" checked>';
                                                    echo'<label class="lbl-reponse">'.$value['libelle'].'</label>';
                                                    echo'<img src="'.URL.'public/source/images/icones/unvalidate.png" class="ic-validate"><br>';
                                                }
                                            }else{
                                                echo '<input type="checkbox" disabled="disabled">';
                                                echo'<label class="lbl-reponse">'.$value['libelle'].'</label><br>';
                                            }
                                        }else{
                                            echo '<input type="checkbox" disabled="disabled">';
                                            echo'<label class="lbl-reponse">'.$value['libelle'].'</label>';
                                            echo'<img src="'.URL.'public/source/images/icones/unvalidate.png"  class="ic-validate"><br>';
                                        }
                                    }
                                break;
                            }
                        }
                    ?>
                </div>


            </div>
            <form method="POST">
                <input type="submit" name="submit-party-remake" value="Suivant" id="remake-question">
            </form>

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
                                        <span>'.$score_user.' pts</span>
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
        var remake_submit = document.getElementById("remake-question");
            //On remplace par le boutton terminer
            remake_submit.value = "Rejouer";
            remake_submit.style.backgroundColor = "green";
    </script>

<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';

    if($confi===true)
    {
        echo '<script>confetti.start()</script>';
    }

?>


