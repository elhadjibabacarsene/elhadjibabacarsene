<?php

ob_start();

?>

<div class="form-login">

    <div class="form-login-head">
        <h3>Login Form</h3>
    </div>
    <div class="form-login-form">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" id="form-login">
                <img class="icone-login" src="<?=URL?>public/source/images/icônes/ic-login.png" alt="">
                    <input type="text" name="login" error="error-1" id="login" placeholder="Login" value="<?=(isset($_POST['login'])) ? $login : ""?>">
                    <p class="comment" id="error-1"><?=$loginError?></p>
                <img class="icone-password" src="<?=URL?>public/source/images/icônes/icone-password.png" alt="">
                    <input type="password" name="password" error="error-2" id="password" placeholder="Password" value="<?=(isset($_POST['password'])) ? $password : ""?>"">
                    <p class="comment" id="error-2"><?=$passwordError?></p>
                    <input type="submit" value="Connexion">
            <a href="#">S'inscrire pour jouer ?</a>
        </form>
    </div>
</div>



<?php
    $content=ob_get_clean();
    require_once 'views/commons/template.php';
?>