<?php
session_start();
    require_once 'config/config.php';
    require_once 'controller/frontend.controller.php';
    require_once 'controller/backend.controller.php';


//contrôle de la superglobale PAGE
if(isset($_GET['page']) && !empty($_GET['page']))
{

    switch($_GET['page'])
    {
        case "dashboard": getPageDashboard();
        break;

        case "login": getPageConnexion();
        break;

        case "accueil" : getPageAccueil();
        break;

        case "jeux": getPageJeux();
        break;

        case  "create-user": getPageCreateUser();
        break;

        case "inscription" : getPageInscription();
        break;

        case "liste-joueurs" : getPageListeJoueurs();
        break;

        case "create-question" : getPageCreateQuestion();
        break;

        case "recapitulatif" : getPageRecapitulatif();
        break;

        case "indisponible"  : getPageIndisponible();
        break;
    }


}else{
    getPageConnexion();
}





