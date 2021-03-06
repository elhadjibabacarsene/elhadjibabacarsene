<?php

ob_start();


?>

    <div id="container-create-user">

        <div id="admin-id"></div>
        <!-- EN TETE -->
        <div class="container-accueil-head">
            <div class="head-left" id="head-left-hidden">
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

                    <h1 class="title-create-user">Ajouter un admin</h1>
                    <p class="comment-create-user">Pour proposer des quizz</p>
                    <hr class="hr-create-user">

                    <form method="POST" action="" id="form-create-user" enctype="multipart/form-data">
                        <!-- PRENOM -->
                        <label class="label-create-user">Prénom</label>
                        <input type="text" error="error-1" name="prenom-user" value="<?=(isset($_POST['prenom-user']) ? $prenom : "")?>">
                        <p class="comment2" id="error-1"><?=$prenomError?></p>
                        <!-- NOM -->
                        <label class="label-create-user">Nom</label>
                        <input type="text" error="error-2" name="nom-user" value="<?=(isset($_POST['nom-user']) ? $nom : "")?>">
                        <p class="comment2" id="error-2"><?=$nomError?></p>
                        <!-- LOGIN -->
                        <label class="label-create-user">Login</label>
                        <input type="text" error="error-3" name="login-user" value="<?=(isset($_POST['login-user']) ? $login : "")?>">
                        <p class="comment2" id="error-3"><?=$loginError?></p>
                        <!-- PASSWORD-->
                        <label class="label-create-user">Password</label>
                        <input type="password" error="error-4" name="password-user" typepassword="password" value="<?=(isset($_POST['password-user']) ? $password : "")?>">
                        <p class="comment2" id="error-4"><?=$passwordError?></p>
                        <!-- CONFIRMER PASSWORD -->
                        <label class="label-create-user">Confirmer Password</label>
                        <input type="password" error="error-5" name="confirm-password-user" typepassword="confirmpassword" value="<?=(isset($_POST['confirm-password-user']) ? $confirmpassword : "")?>">
                        <p class="comment2" id="error-5"><?=$confirmPasswordError?></p>
                        <!-- CHOISIR UN FICHIER -->
                        <label class="avatar-create-user" id="error-6"><?=$imageError?></label>
                        <button id="choice-file-button">Choisir un fichier</button>
                        <input type="file" name="choice-file" id="choice-file" error="error-6">
                        <!-- ENVOYER LES DONNEES -->
                        <input type="submit" name="create-user" id="create-user" value="Créer un compte">
                    </form>

                    <!-- VISUALISATION DE L'AVATAR -->
                    <img src="<?=YOURTOF?>" class="avatar-create-user-img" id="avatar-create-user-img">
                    <label class="lbl-avatar-admin" id="lbl-avatar-admin">Avatar admin</label>

                </div>
            </div>

        </div>

            <script>
                //Récupération du container-accueil
                let containerAccueil = document.getElementById("container-accueil-corps");
                //containerAccueil.style.height = "640px";
                containerAccueil.style.overflow = "overlay";
                //Récupération du ovelray
                let overlay = document.getElementById("color-overlay");
                overlay.style.height = "125%";
                //Récupération de la div
                let divCorps = document.getElementById("container-accueil-corps");
                divCorps.style.position  = "relative";
                //divCorps.style.height = "590px";
                let containerCreateUser = document.getElementById("container-create-user");
                //containerCreateUser.style.height = "720px";

                var input_file = document.getElementById("choice-file");
                var button_file = document.getElementById("choice-file-button");
                var avatarImg = document.getElementById("avatar-create-user-img");
                button_file.addEventListener("click",function(e){
                    e.preventDefault();
                    input_file.click();

                });

                //Fonction qui me permet d'afficher l'image choisie par l'avatar
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#avatar-create-user-img').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]); // convert to base64 string
                    }
                }

                $("#choice-file").change(function() {
                    readURL(this);
                });

            </script>

<?php
$content=ob_get_clean();
require_once 'views/commons/template.php';
?>

