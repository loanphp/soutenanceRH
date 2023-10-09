<?php
require_once "../php/functions/gs_employes.php";

$jobs = getJob();
$employes = getAllEmployes();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/form_employes.css">
    <title>Formulaire de gestion des employés</title>
    <!-- <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css"> -->
</head>

<body>
    <div class="range-div">
        <h1 class="h11">Gestion des Employés</h1>
        <div class="searchSelect">
            <label for=""><h6 class="seah6">Type de recherche</h6></label>
            <select name="" id="select-search">
                <option value="nom_employe">Nom</option>
                <option value="prenom_employe">Prénom</option>
                <option value="date_de_naissance">date naissance</option>
                <option value="nationalite">nationalite</option>
                <option value="date_embauche">date embauche</option>
                <option value="statut">status</option>
                <option value="sexe">sexe</option>
                <option value="numero_de_securite_sociale">numero de sécurite sociale</option>
                <option value="date_de_depart">date de depart</option>
                <option value="name">name</option>
                <option value="salaire">salaire</option>
                <option value="tel">tel</option>
                <option value="adresse">adresse</option>
                <option value="email">email</option>
            </select>
        </div>
        <input type="text" id="search" placeholder="Rechercher un employé">
        <button type="button" id="addEmployee">Ajouter Employé</button>
        <div class="button-container" data-id = "-1"></div>
        <!-- Tableau -->
        <div class="div-grand">
            <div class="table-grand">
                <table id="employeeTable">
                    <thead>
                        <tr>
                            <th>
                                <input class="parent-checkbox" id="c1" type="checkbox">
                            </th>
                            <th><h6>Photo</h6></th>
                            <th><h6>Nom</h6></th>
                            <th><h6>Prénom</h6></th>
                            <th><h6>Date Naissance</h6></th>
                            <th><h6>Nationalité</h6></th>
                            <th><h6>Date Embauche</h6></th>
                            <th><h6>Status</h6></th>
                            <th><h6>Sexe</h6></th>
                            <th><h6>NSS</h6></th>
                            <th><h6>Date Départ</h6></th>
                            <th><h6>Poste occupé</h6></th>
                            <th><h6>Salaire</h6></th>
                            <th><h6>Tél</h6></th>
                            <th><h6>Adresse</h6></th>
                            <th><h6>Email</h6></th>
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
                                <td><h6 data-texte="sexe"><?=$allemployes["sexe"]?></h6></td>
                                <td><h6 data-texte="numero_securite_sociale"><?=$allemployes["numero_securite_sociale"]?></h6></td>
                                <td><h6 data-texte="date_de_depart"><?=$allemployes["date_de_depart"]?></h6></td>
                                <td><h6 data-texte="name"><?=$job["name"]?></h6></td>
                                <td><h6 data-texte="salaire"><?=$allemployes["salaire"]?></h6></td>
                                <td><h6 data-texte="tel"><?=$allemployes["tel"]?></h6></td>
                                <td><h6 data-texte="adresse"><?=$allemployes["adresse"]?></h6></td>
                                <td><h6 data-texte="email"><?=$allemployes["email"]?></h6></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <?php require_once "../php/modale/employes-form_modale.php"?>
    <script src="../../js/gs_employes.js" type="module"></script>

    <!-- Bootstrap JS scripts (jQuery and Popper.js required) -->
    <!-- <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script> -->
</body>

</html>