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
                        <input type="text" name="nbre-question">
                        <input type="submit" name="submit-nbre-question" value="OK">
                    </form>
                </div>

                <!-- ACCUEIL-LIST-QUESTION-->
                <div class="accueil-list-question"></div>

                    <!-- ACCUEIL-NEXT-QUESTION-->
                <div class="accueil-question-next">
                    <form method="POST">
                        <input type="submit" name="submit-question-next" value="Suivant">
                    </form>
                </div>

            </div>
        </div>

    </div>


<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>