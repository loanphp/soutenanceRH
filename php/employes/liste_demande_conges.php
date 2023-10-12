<?php

require_once "../php/functions/gs_employes.php";
require_once "../php/functions/voteurs.php";
if(!isset($_SESSION["sessionuser"])){
    header("Location:/connection");
}
$isLogged = isLogged();
$conges = getLeaveRequest();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/view_conges.css">
    <link rel="stylesheet" href="../../css/index.css">
    <title>Liste de demande de congés</title>
</head>
<body>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark grand" style="width: 220px;">
        <?php require_once("../php/partials/sidebar.php")?>
    </div>
    
    <div class="container y-scroll scroll">
        <h1>Tableau de congés</h1>
        <div class="line-div">
            <a href="/demande/conges" class="form_conges_btn">Demande de congé</a>
            <a href="/calendrier/conges" class="form_conges_btn1 searchSelect">Calendrier de congés</a>
        </div>
        <div class="button-container" data-id = "-1"></div>
        <div class="first-div-container">
        <input type="text" id="search" placeholder="Rechercher un employé">
            <table class="table" id="table-leave">
                <thead>
                    <tr>
                        <!-- <th scope="col">Image</th> -->
                        <th scope="col">Nom</th>
                        <th scope="col">Date demande</th>
                        <th scope="col">Date debut</th>
                        <th scope="col">Date fin</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Type congés</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Commentaire</th>
                        <th scope="col">Gestionnaire</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($allconges = $conges->fetch(PDO::FETCH_ASSOC)): ?>
                        <?php
                            $id_employes = $allconges["employe_id"];
                            $image = getEmployesImage($id_employes);
                            // var_dump($id_employes,$allconges);
                        ?>
                        
                    <tr class="leave<?= $allconges["id"]?>">
                        
                        <td data-texte="nom_employe"><?= $allconges["nom_employe"] ?></td>
                        <td data-texte="date_de_demande"><?= $allconges["date_de_demande"] ?></td>
                        <td data-texte="date_de_debut"><?= $allconges["date_de_debut"] ?></td>
                        <td data-texte="date_de_fin"><?= $allconges["date_de_fin"] ?></td>
                        <td data-texte="duree"><?= $allconges["duree"] ?></td>
                        <td data-texte="type_conges"><?= $allconges["type_conges"] ?></td>
                        <td data-texte="motif"><?= $allconges["motif"] ?></td>
                        <td data-texte="commentaire"><?= $allconges["commentaire"] ?></td>
                        <td data-texte="gestionnaire"><?= $allconges["gestionnaire"] ?></td>
                        <td>
                            <div class="action-container slide-top">
                                <a  href="/demande/conges?id=<?= $allconges["id"]?>"  id="edite-action"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M16.477 3.004c.167.015.24.219.12.338l-8.32 8.32a.75.75 0 0 0-.195.34l-1 3.83a.75.75 0 0 0 .915.915l3.829-1a.751.751 0 0 0 .34-.196l8.438-8.438a.198.198 0 0 1 .339.12a45.723 45.723 0 0 1-.06 10.073c-.223 1.905-1.754 3.4-3.652 3.613a47.468 47.468 0 0 1-10.461 0c-1.899-.213-3.43-1.708-3.653-3.613a45.672 45.672 0 0 1 0-10.611C3.34 4.789 4.871 3.294 6.77 3.082a47.512 47.512 0 0 1 9.707-.078Z"/><path fill="currentColor" d="M17.823 4.237a.25.25 0 0 1 .354 0l1.414 1.415a.25.25 0 0 1 0 .353L11.298 14.3a.253.253 0 0 1-.114.065l-1.914.5a.25.25 0 0 1-.305-.305l.5-1.914a.25.25 0 0 1 .065-.114l8.293-8.294Z"/></svg></a>
                                <button type="button" class="div-delete-action" data-delete="<?= $allconges["id"]?>" id="delete-action"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M9 17h2V8H9v9Zm4 0h2V8h-2v9Zm-8 4V6H4V4h5V3h6v1h5v2h-1v15H5Z"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile ;?>
                    
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
    <script src="../../js/gs_conges.js" type="module"></script>
</body>
</html>
