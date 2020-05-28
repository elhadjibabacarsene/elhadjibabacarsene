<?php ob_start(); ?>

<div class="container-fluid cadre-general">
          <div class="row">
                <div class="col bg-blue-ciel height-window-100vh widht-50-percent">
                </div>
                <div class="col height-window-100vh widht-50-percent">
                </div>
          </div> 
          <div class="row cadre-form rounded-lg position-absolute">
                <div class="cadre-left position-relative">   
                    <img src="<?=URL?>/public/source/images/bg-login3.png" alt="" id="bg-login" class="position-absolute">
                    <p class="titre-cadre police-general font-weight-bold text-white position-absolute">JOUER ET TESTER , <span class="font-weight-normal d-block">VOTRE NIVEAU DE CULTURE GÉNÉRALE</span></p>
                </div>
                <div class="cadre-right position-relative">
                    <div class="lien-authen position-relative font-weight-bold">
                        <a class="text-decoration-none text-dark" href="#" id="lien-login">Connexion</a>
                        <a class="text-decoration-none ml-2 text-dark" href="#" id="lien-inscription">S'incrire</a>
                    </div>
                    <div class="cadre-logo position-absolute">
                        <img src="<?=URL?>/public/source/images/logo-quizzsa.png" alt="">
                    </div>
                    <div id="form" class="position-absolute">
                        <form>
                            <div class="form-group">
                                <div class="input-div">
                                    <input type="text" class="form-control input-text-login rounded-0 text-secondary" id="login" placeholder="Email ou login">
                                    <img src="<?=URL?>/public/source/images/icones/icone-login.png" alt="" class="ic-login-password position-absolute" id="ic-login">
                                    <p class="error text-danger">message erreur</p>
                                </div>
                                <div class="input-div">
                                    <input type="text" class="form-control input-text-login rounded-0 text-secondary" id="password" placeholder="Password">
                                    <img src="<?=URL?>/public/source/images/icones/icone-password.png" alt="" class="ic-login-password position-absolute" id="ic-password">
                                    <p class="error text-danger">message erreur</p>
                                </div>
                               
                            </div>
                            <button type="submit" id="btn-login" class="rounded-lg text-white">Se connecter</button>
                        </form>
                    </div>
                </div>
          </div> 
      </div> 


<?php
$content=ob_get_clean();
require_once 'views/common/templates/souscription.template.php';
?>      