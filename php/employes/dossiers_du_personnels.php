<?php
require_once "../php/functions/gs_employes.php";
$employes = getAllEmployes(["sort" => "nom_employe"])->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/dossiers_du_personnels.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Champ de Sélection et d'Envoi de Fichiers</title>
</head>

<body>
    <div class="container">
        <div class="message_container">
        </div>
        <select name="nom_employe" id="id_employe">
            <option value="">--------</option>
            <?php foreach ($employes as $key => $value) : ?>
                <?php if ($value["numero_securite_sociale"] !== "" && $value["numero_securite_sociale"] !== null) : ?>
                    <?php $number = $value["numero_securite_sociale"]; ?>
                <?php endif; ?>
                <option value="<?= $number ? $number : ""; ?>"><?= $value["prenom_employe"] . " " . $value["nom_employe"]; ?></option>
            <?php endforeach; ?>
        </select>
        <h1>Champ de Sélection et d'Envoi de Fichiers</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="champsSelect">Sélectionnez les champs :</label>
                <select class="form-control" id="champsSelect" name="file_type">
                    <option value="etat_civil">État Civil</option>
                    <option value="cv">curriculum vitae(cv)</option>
                    <option value="contral_de_travail">Contrat de Travail</option>
                    <option value="affiliation_du_salarie(e)">Affiliation du Salarié(e)</option>
                    <option value="vie_du_salarie(e)">Vie du Salarié(e)</option>
                    <option value="correspondances">Correspondances</option>
                    <option value="sante">Santé</option>
                    <option value="fiches_absences">Fiches d'Absences</option>
                    <option value="remunerations">Rémunérations</option>
                    <option value="depart_a_la_retraite">Départ à la Retraite</option>
                    <option value="suivi_stagiaire">Suivi Stagiaire</option>
                    <option value="suivi_interimaire">Suivi Intérimaire</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fileInput">Téléversez le fichier :</label>
                <div class="custom-file">
                    <input type="file" accept="applicatio/pdf" class="custom-file-input" id="fileInput" name="files">
                    <label class="custom-file-label" for="fileInput">Choisissez un fichier</label>
                </div>

                <div class="file_view_container">
                    <table class="table">
                        <tbody class="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
            <button type="button" class="btn btn-warning add">Ajouter</button>
            <button type="submit" class="btn btn-primary send">Envoyer</button>
        </form>
    </div>
    <div id="pdfModal" class="modal" aria-modal="true" tabindex="-1" role="dialog">
        <div class="modal-content">
            <iframe id="pdfViewer" src=""></iframe>
        </div>
        <button class="btn btn-light" id="closeModalBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
            </svg>
        </button>
    </div>

    <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
    <script src="../../js/dossiers_du_personnels.js" type="module"></script>
    <script src="../../pdfjs/build/pdf.js"></script>
    <script src="../../pdfjs/web/viewer.js"></script>
</body>

</html>