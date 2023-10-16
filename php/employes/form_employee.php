<?php
require_once "../php/functions/gs_employes.php";
require_once "../php/functions/voteurs.php";
if(!isset($_SESSION["sessionuser"])){
    header("Location:/connection");
}
$isLogged = isLogged();
$jobs = getJob();
$employes = getAllEmployes(["sort"=>"date_embauche"]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/form_employes.css">
    <link rel="stylesheet" href="../../css/index.css">
    <title>Formulaire de gestion des employés</title>
</head>

<body class="body">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark grand" style="width: 230px;">
        <?php require_once("../php/partials/sidebar.php")?>
    </div>
    <div class="range-div y-scroll scroll">
        <h1 class="h11">Gestion des Employés</h1>
        <input type="text" id="search" placeholder="Rechercher un employé">
        <button type="button" id="addEmployee">Ajouter Employé</button>
        <div class="button-container" data-id = "-1"></div>
        <!-- Tableau -->
        <div class="div-grand">
            <div class="table-grand table-wrap x-scroll y-scroll scroll">
                <table id="employeeTable" class="table">
                    <thead class="thead-primary">
                        <tr class="tr-primary">
                            <th>
                                <?php if ($employes->rowCount() > 0): ?>
                                    <input class="parent-checkbox" id="c1" type="checkbox">
                                <?php else: ?>
                                    <input class="parent-checkbox disabled" id="c1" type="checkbox" disabled>
                                <?php endif; ?>
                            </th>
                            <th><h6>Photo</h6></th>
                            <th><h6>Nom</h6></th>
                            <th><h6>Prénom</h6></th>
                            <th><h6>Date Naissance</h6></th>
                            <th><h6>Nationalité</h6></th>
                            <th><h6>Date Embauche</h6></th>
                            <th><h6>Status</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($allemployes = $employes->fetch(PDO::FETCH_ASSOC)): ?>
                            <?php $job = getJobBy("id",$allemployes["poste_occupe"])?>
                            <tr data-id="<?= $allemployes["id"]?>">
                                 <td><input data-id="<?= $allemployes["id"]?>" class="child-checkbox" type="checkbox" name="" id=""></td>
                                <td class="photo-employe"><img src="<?= $allemployes["photo"]?>" alt="Photo"></td>
                                <td><h6 data-texte="nom_employe"><?=$allemployes["nom_employe"]?></h6></td>
                                <td><h6 data-texte="prenom_employe"><?=$allemployes["prenom_employe"]?></h6></td>
                                <td><h6 data-texte="date_de_naissance"><?=$allemployes["date_de_naissance"]?></h6></td>
                                <td><h6 data-texte="nationalite"><?=$allemployes["nationalite"]?></h6></td>
                                <td><h6 data-texte="date_embauche"><?=$allemployes["date_embauche"]?></h6></td>
                                <td><h6 data-texte="statut"><?=$allemployes["statut"]?></h6></td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if ($employes->rowCount() == 0): ?>
                            <tr class="empty-message">
                                <td colspan="8"><h1 style="color:#555;">Aucun employé n'a été ajouté.</h1></td>
                            </tr>
                        <?php endif; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once "../php/modale/employes-form_modale.php"?>
    <script src="../../js/gs_employes.js" type="module"></script>
</body>

</html>