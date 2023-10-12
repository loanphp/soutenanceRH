<?php
require_once "../php/functions/gs_employes.php";
$id = str_replace("id=", "", $urlParts["query"]);
$employe = getEmployeBy("id", $id);
$jobs = getJob();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/details_employes.css">
    <title>Formulaire de gestion des employés</title>
</head>

<body class="y-scroll scroll">
    <div class="range-div y-scroll scroll">
        <div class="table-grand table-wrap">
            <div class="photo-employe">
                <img src="<?= $employe["photo"] ?>" alt="Photo"> 
                <h1 class="h11">Informations de l'employé</h1>
            </div>
            <table id="employeeTable" class="table">
                <tbody>

                    <?php $job = getJobBy("id", $employe["poste_occupe"]) ?>
                    <tr>
                        <th>
                            <h6>Nom</h6>
                        </th>
                        <td>
                            <h6 data-texte="nom_employe"><?= $employe["nom_employe"] ?></h6>
                        </td>
                    </tr>



                    <tr>
                        <th>
                            <h6>Prénom</h6>
                        </th>
                        <td>
                            <h6 data-texte="prenom_employe"><?= $employe["prenom_employe"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Date Naissance</h6>
                        </th>
                        <td>
                            <h6 data-texte="date_de_naissance"><?= $employe["date_de_naissance"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Nationalité</h6>
                        </th>
                        <td>
                            <h6 data-texte="nationalite"><?= $employe["nationalite"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Date Embauche</h6>
                        </th>
                        <td>
                            <h6 data-texte="date_embauche"><?= $employe["date_embauche"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Status</h6>
                        </th>
                        <td>
                            <h6 data-texte="statut"><?= $employe["statut"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Sexe</h6>
                        </th>
                        <td>
                            <h6 data-texte="sexe"><?= $employe["sexe"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>NSS</h6>
                        </th>
                        <td>
                            <h6 data-texte="numero_securite_sociale"><?= $employe["numero_securite_sociale"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Date Départ</h6>
                        </th>
                        <td>
                            <h6 data-texte="date_de_depart"><?= $employe["date_de_depart"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Poste occupé</h6>
                        </th>
                        <td>
                            <h6 data-texte="name"><?= $job["name"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Salaire</h6>
                        </th>
                        <td>
                            <h6 data-texte="salaire"><?= $employe["salaire"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Tél</h6>
                        </th>
                        <td>
                            <h6 data-texte="tel"><?= $employe["tel"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Adresse</h6>
                        </th>
                        <td>
                            <h6 data-texte="adresse"><?= $employe["adresse"] ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <h6>Email</h6>
                        </th>
                        <td a href="#" class="btn btn-primary">
                            <h6 data-texte="email"><?= $employe["email"] ?></h6>
                        </td>
                    </tr>
                    <tr data-id="<?= $employe["id"] ?>">
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
    <script src="../../js/gs_employes.js" type="module"></script>
</body>

</html>