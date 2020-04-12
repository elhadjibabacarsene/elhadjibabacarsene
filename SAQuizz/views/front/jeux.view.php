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

    </div>



<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>