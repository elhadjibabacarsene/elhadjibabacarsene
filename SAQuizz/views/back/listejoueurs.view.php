<?php

ob_start();

?>
    <div id="liste-joueurs"></div>
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
                        <label>Liste des joueurs par score</label>
                    </form>
                </div>

                <!-- ACCUEIL-LIST-QUESTION-->
                <div class="accueil-list-question">

                        <?php
                                if($page<=$nbreDePage)
                                {
                                    $indiceFin = ($page)*$nbreParPage;
                                    $indiceDepart = $indiceFin - $nbreParPage;

                                    echo'<table id="list-joueurs">';
                                    echo'<tr>';
                                        echo'<td class="td-first">Nom</td>';
                                        echo'<td class="td-first">Prénom</td>';
                                        echo'<td class="td-first">Score</td>';
                                    echo'</tr>';
                                      for($i=$indiceDepart;$i<$indiceFin;$i++)
                                      {
                                          if($nbreJoueurs>$i)
                                          {
                                              echo '<tr>';
                                              echo '<td class="td-simple">' . $json_user_file_decode['user' . $joueurs[$i]]['nom'] . '</td>';
                                              echo '<td class="td-simple">' . $json_user_file_decode['user' . $joueurs[$i]]['prenom'] . '</td>';
                                              echo '<td class="td-simple">' . $json_user_file_decode['user' . $joueurs[$i]]['score'] . '<span id="pts"> pts</span></td>';
                                              echo '</tr>';
                                          }

                                      }

                                    echo'</table>';
                                }else{
                                    echo "<script>alert('Aucunes données à afficher')</script>";
                                    header("location:liste-joueurs&indice=".((int)$page-1));

                                }
                        ?>

                </div>

                <!-- ACCUEIL-NEXT-QUESTION-->
                <div class="accueil-question-next">
                    <form method="POST">
                        <input type="submit" name="submit-question-next" value="Suivant" class="button-next">
                    </form>
                </div>

            </div>
        </div>

    </div>


        <script>
            let accueilListQuestion = document.getElementsByClassName("accueil-list-question");
            accueilListQuestion[0].style.borderColor = "#52bfd1";
        </script>

<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>