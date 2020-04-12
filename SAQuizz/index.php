<?php
session_start();
    require_once 'config/config.php';
    require_once 'controller/frontend.controller.php';
    require_once  'controller/backend.controller.php';


//contrôle de la superglobale PAGE
if(isset($_GET['page']) && !empty($_GET['page'])){

    switch($_GET['page']){
        case "login": getPageConnexion();
        break;
        case "accueil" : getPageAccueil();
        break;
        case "jeux": getPageJeux();
    }

}else{
    getPageConnexion();
}





