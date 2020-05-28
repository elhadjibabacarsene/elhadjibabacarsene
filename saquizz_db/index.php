<?php 
require_once 'config/config.php';
require_once 'controllers/frontend.controllers.php';
require_once 'controllers/backend.controllers.php';

$page = $_GET['page'];

if(isset($page) && !empty($page)){

    switch($page){
        //On fait appel à la page de connexion
        case "login":getPageConnexion(); 
        break;
        
        default: getPageConnexion();
        break;
    }
}else{
    getPageConnexion();
}