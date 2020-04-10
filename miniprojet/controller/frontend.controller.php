<?php

require_once 'config/config.php';



/**
 * FONCTION QUI NOUS PERMET D'ACCEDER A LA PAGE DE CONNEXION
 */
function getConnexion(){
    $title = "Se Connecter";

    require_once 'views/front/login.view.php';
}
