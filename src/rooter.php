<?php

// require '../vendor/autoload.php';
session_start();

// require_once './resolver.php';
$url = $_SERVER['REQUEST_URI'];
$urlParts = parse_url($url);
$path = $urlParts['path'];
if(is_array($urlParts) && isset($urlParts["query"]) && $urlParts["query"]!==null && $urlParts["query"]!==""){
    $urlquery = $path."?".$urlParts["query"];
}
else{
    $urlquery = $url;
}
// var_dump($urlquery);
switch ($urlquery) {
    case '/employes':
        require '../php/employes/view_employes.php';
        break;
    case '/conges':
        require '../php/employes/gs_conges.php';
        break;
    case '/evaluation_de_performances':
        require '../php/employes/evalue_performe.php';
        break;
    case '/dossier_du_personnel':
        require '../php/employes/dossiers_du_personnels.php';
        break;
    case '/accueil':
        require '../index.php';
        break;
    case '/':
        require '../index.php';
        break;
    case '/connection':
        require '../php/login.php';
        break;
    case '/deconnection':
        require '../php/logout.php';
        break;
    case '/inscription':
        require '../php/signup.php';
        break;
    case '/request/conges/status':
        require '../php/database/db_conges_status.php';
        break;
    case '/request/conges':
        require '../php/database/db_conges.php';
        break;
    case '/request/entretien/individuel':
        require '../php/database/db_entretien_individuel.php';
        break;
    case '/request/supprimer':
        require '../php/database/db_delete.php';
        break;
    case '/request/dossier_du_personnel':
        require '../php/databse/db_dossier_du_personnel.php';
        break;
    case '/request/get/conges':
        require '../php/database/db_get_conges.php';
        break;
    case '/request/employes':
        require '../php/database/db_employes.php';
        break;
    case '/request/get/employe/nss':
        require '../php/database/db_getEmploye_nss.php';
        break;
    case '/request/delete/conges':
        require '../php/database/delete-conges.php';
        break;
    case '/request/evaluation_de_performances':
        require '../php/database/db_evalue_performe.php';
        break;
    case '/request/connection':
        require '../php/database/login_auth.php';
        break;
    case '/request/get/response/evaluation':
        require '../php/database/db_get_response_evaluation.php';
        break;
    case '/request/inscription':
        require '../php/database/signup-auth.php';
        break;
    case '/ajouter/employes':
        require '../php/employes/form_employee.php';
        break;
    case '/evaluation/result':
        require '../php/employes/evaluation_result.php';
        break;
    case '/liste/conges':
        require '../php/employes/liste_demande_conges.php';
        break;
    case '/methode/360':
        require '../php/employes/methode360.php';
        break;
    case '/methode/professionnel':
        require '../php/employes/professionel.php';
        break;
    case '/methode/auto_evaluation':
        require '../php/employes/auto_evaluation.php';
        break;
    case '/methodes/evaluations':
        require '../php/employes/methodes_evaluations.php';
        break;
    case '/demande/conges':
        require '../php/employes/gs_conges.php';
        break;
    case '/methode/individuel'."?".$urlParts["query"]:
        require '../php/employes/individuel.php';
        break;
    case '/details/evaluation'."?".$urlParts["query"]:
        require '../php/employes/details_conges.php';
        break;
    case '/resquest/get/employe':
        require '../php/database/db-getEmploye.php';
        break;
    case '/demande/conges'."?".$urlParts["query"]:
        require '../php/employes/gs_conges.php';
        break;

    default:
        require './404.php';
        break;


}