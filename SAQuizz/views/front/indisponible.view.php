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

                <div id="recap-titre">Jeux indisponible, veuillez revenir plutard !</div>

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

    </script>

<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>