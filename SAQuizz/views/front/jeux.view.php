<?php

ob_start();

?>

    <div id="container-accueil">

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
                <form method="POST">
                    <input type="submit" name="next-question" value="Suivant" id="next-question">
                    <input type="submit" name="before-question" value="Précédent" id="before-question">
                </form>
            </div>


            <div id="container-accueil-score">
                <div id="nav-score">
                    <a href="#" id="menu-top-score">Top scores</a>
                    <a href="#"  id="menu-best-score">Mon meilleur score</a>
                </div>
                <div id="div-score">
                    <p id="comment"></p>
                </div>

            </div>
        </div>

    </div>



<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>