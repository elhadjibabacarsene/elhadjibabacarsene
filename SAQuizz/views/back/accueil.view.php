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
                    <p><?=$_SESSION['prenom']?></p>
                    <p class="nom"><?=$_SESSION['nom']?></p>
                </div>
                <div class="bottom">
                    <ul id="menu-admin">
                        <div id="ic-1" categorie="list">
                            <div class="ic-color"></div>
                            <li class="active"><a class="activated" href="#">Liste Questions</a></li>
                            <img class="ic-img" src="<?=URL?>public/source/images/icônes/ic-liste.png">
                        </div>
                        <div id="ic-2" categorie="create">
                            <div class="ic-color"></div>
                            <li><a href="#">Créer utilisateur</a></li>
                            <img class="ic-img" src="<?=URL?>public/source/images/icônes/ic-ajout.png">
                        </div>
                        <div id="ic-3" categorie="list">
                            <div class="ic-color"></div>
                            <li><a href="#">Liste joueur</a></li>
                            <img class="ic-img" src="<?=URL?>public/source/images/icônes/ic-liste.png">
                        </div>
                        <div id="ic-4" categorie="create">
                            <div class="ic-color"></div>
                            <li><a href="#">Créer question</a></li>
                            <img class="ic-img" src="<?=URL?>public/source/images/icônes/ic-ajout.png">
                        </div>
                    </ul>
                </div>
            </div>
            <div id="container-accueil-corps">

            </div>
        </div>

    </div>


<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>