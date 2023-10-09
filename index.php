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
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <div class="inverses">
            <h1 class="inverse">L</h1>
            <h1>L</h1>
        </div>
        <span class="fs-4"></span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="icon.svg#home"/></svg>
            Acceuil
            </a>
        </li>
            <li>
                <a href="/ajouter/employes" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="icon.svg#people"/></svg>
                Employés
                </a>
            </li>
            <li>
                <a href="/liste/conges" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="icon.svg#table"/></svg>
                Congés
                </a>
            </li>
            <li>
                <a href="/methodes/evaluations" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="icon.svg#speedometer2"/></svg>
                Evaluations des performances
                </a>
                <ul>
                    <li><a href="/evaluation/result">Resultat Evaluation</a></li>
                </ul>
            </li>
        <li>
            <a href="/dossier_du_personnel" class="nav-link text-white">
            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="icon.svg#imployee-folder"/></svg>
            Dossiers du personnel
            </a>
        </li>
        </ul>
        <hr>
        <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            
            <?php if($isLogged): ?>
                <img src="<?=$_SESSION["sessionuser"]["avatar"]?>" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong> <?php echo $_SESSION["sessionuser"]["nom"]." ".$_SESSION["sessionuser"]["prenom"]; ?></strong>
                
            <?php else: ?>
                <img src="" alt="" width="32" height="32" class="rounded-circle me-2">
            <?php endif ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <!-- <li><a class="dropdown-item" href="#">Sign out</a></li> -->
                <!-- <li><a class="dropdown-item" href="/connection">Connection</a></li>
             -->
        </ul>
        </div>
    </div>
    <div class="espace-restant">
        <div class="fare-ground">
            <?php if($isLogged): ?>
                <li class="deconnection-btn"><a href="/deconnection">Déconnection</a></li>
            <?php endif; ?>
            <img src="./upload/images/pexels-lisa-fotios-1957478.jpg" alt="">
            <div class="text-container">
                <h1>BIENVENUE</h1>
                <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit quia porro voluptatum
                    reprehenderit eveniet quae, magnam reiciendis sint debitis a facilis! Esse magnam sed
                    error atque minus, repellendus quaerat modi sapiente nesciunt reprehenderit, earum
                    natus expedita? Cumque neque dicta architecto dolor consequuntur quas, reprehenderit 
                    libero minus dolores eveniet deserunt tenetur ut repellendus error facilis quaerat 
                    fugiat iste iusto nam corporis! Quas dignissimos corporis dolorem est ex deserunt 
                    magnam, ea quia maxime eaque ipsam soluta aliquid, voluptas et, autem aut eum animi
                        assumenda distinctio sed ab. Labore magnam itaque 
                    voluptate sit minima eaque natus cupiditate quo dolorum. Animi accusamus nisi ipsam.</h6>
            </div>
        </div>
    </div>
    </main>

    <script src="bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>