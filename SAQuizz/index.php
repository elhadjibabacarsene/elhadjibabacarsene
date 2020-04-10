<?php
session_start();
    require_once 'config/config.php';
    require_once 'controller/frontend.controller.php';


//contrôle de la superglobale PAGE
if(isset($_GET['page']) && !empty($_GET['page'])){

    switch($_GET['page']){
        case "login": getConnexion();
        break;
    }

}else{
    getConnexion();
}





