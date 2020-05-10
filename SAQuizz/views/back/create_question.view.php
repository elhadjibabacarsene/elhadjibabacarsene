<?php

ob_start();

?>
    <!-- ID DE LA PAGE -->

    <div id="create-question"></div>

    <div id="container-accueil">

        <!-- EN TETE -->
        <div class="container-accueil-head">
            <div class="head-left" id="head-left-hidden"">
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
                            <input type="text" name="question"  error="error-1" value="<?=$question?>">
                            <p class="comment-1" id="error-1"></p>
                        </div>

                        <!-- NBRE QUESTION -->
                        <div id="nbre-point">
                            <label>Nbre Points</label>
                            <input type="number" name="nbre_point" error="error-2" value="<?=$nbre_point?>">
                            <p class="comment-1" id="error-2"><?=(!empty($nbre_point_messageError)) ? $nbre_point_messageError : ""?></p>
                        </div>

                        <!-- TYPE QUESTION -->
                        <div id="type-reponse">
                            <label>Type réponse</label>
                            <select name="type_reponse" id="select-type-reponse">
                                <option value="" disabled selected>Choisissez le type de réponse</option>
                                <option value="texte">Texte</option>
                                <option value="choixSimple">Choix Simple</option>
                                <option value="choixMultiple">choix Multiple</option>
                            </select>
                            <img src="<?=URL?>public/source/images/icones/ic-ajout-reponse.png" id="ic-ajout-rep">
                        </div>

                        <!-- TYPE REPONSE -->
                        <div id="reponses">


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