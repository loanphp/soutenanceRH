<?php
require_once "./php/functions/voteurs.php";
require_once "./php/functions/utile.php";
require_once "./php/functions/gs_employes.php";
session_start();
if(!isset($_SESSION["sessionuser"])){
    header("Location:/connection");
}
$user = getSessionUser();
$isLogged = isLogged();
$canRecruit = canRecruit($user);
$canManageLeave = canManageLeave($user);
$isEmployee = isEmployee($user);
$leavePath = "./php/employes/details_conges.php";
if($canManageLeave){
    $leavePath = "/evaluation_de_performances";
}
$active_hover = "active_home";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Acceuil</title>
</head>
<body>
    <main class="d-flex flex-nowrap" >
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <?php require_once("./php/partials/sidebar.php")?>
        </div>
    <div class="espace-restant">
        <div class="fare-ground">
            <?php if($isLogged): ?>
                <li class="deconnection-btn"><a href="/deconnection">Déconnection</a></li>
            <?php endif; ?>
            <img src="./upload/images/pexels-lisa-fotios-1957478.jpg" alt="">
            <div class="text-container">
                <h1>BIENVENUE</h1>
                <h6>
                    Bienvenue dans notre application de gestion des ressources humaines !

                    Nous sommes ravis de vous accueillir dans notre plateforme dédiée à la 
                    gestion du capital humain au sein de notre entreprise. Notre mission est
                     de simplifier et d'optimiser la manière dont nous collaborons, évoluons 
                     et interagissons au sein de notre organisation.</h6>
            </div>
        </div>
    </div>
    </main>

    <script src="bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>