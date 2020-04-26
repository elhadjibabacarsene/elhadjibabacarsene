<?php

ob_start();

?>
    <!-- ID DE LA PAGE -->
    <div id="create-joueur"></div>

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
                    <label class="lbl-param-question">Paramétrer votre question</label>
                </div>

                <!-- ACCUEIL-LIST-QUESTION-->
                <div id="create-question-div">

                    <!-- FORMULAIRE DE CREATION DE QUESTION -->
                    <form id="form-create-question" method="POST">

                        <!-- QUESTION -->
                        <div id="question">
                            <label>Question</label>
                            <input type="text" name="question"  error="error-1">
                            <p class="comment-1" id="error-1"></p>
                        </div>

                        <!-- NBRE QUESTION -->
                        <div id="nbre-point">
                            <label>Nbre Points</label>
                            <input type="number" name="nbre_point" error="error-2">
                            <p class="comment-1" id="error-2"></p>
                        </div>

                        <!-- TYPE QUESTION -->
                        <div id="type-reponse">
                            <label>Type réponse</label>
                            <select name="type_reponse">
                                <option value="texte">Texte</option>
                                <option value="choixSimple">Choix Simple</option>
                                <option value="choixMultiple">choix Multiple</option>
                            </select>
                            <img src="public/source/images/icônes/ic-ajout-réponse.png" id="ic-ajout-rep">
                        </div>

                        <!-- TYPE REPONSE -->
                        <div id="reponses">
                            <div id="reponse-1" class="reponse-div">
                                <label>Réponse 1</label>
                                <input type="text" name="reponse1" id="reponse1" error="error-3">
                                <input type="checkbox" reponse="reponse1" class="reponse-check" name="checkbox-reponse1">
                                <input type="radio" reponse="reponse1" class="reponse-radio" name="radio-reponse1">
                                <img src="public/source/images/icônes/ic-supprimer.png" id="ic-delete" reponse="reponse1" class="ic-delete-1">
                                <p class="comment-1" id="error-3"></p>
                            </div>

                        </div>

                        <!-- BUTTON ENREGISTRER QUESTION -->
                        <div id="save-question">
                            <input type="submit" name="save_question" value="Enregistrer" id="save_question">
                        </div>

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