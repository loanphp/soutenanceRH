<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Formulaire d'Évaluation</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Formulaire d'Évaluation</h2>
        <form>
            <div class="message_container"></div>
            <div class="mb-3">
                <label for="nom_employe" class="form-label">Nom de l'employé</label>
                <input type="text" class="form-control" id="nom_employe" name="nom_employe">
            </div>
            <div class="mb-3">
                <label for="departement_service" class="form-label">Département ou service</label>
                <input type="text" class="form-control" id="departement_service" name="departement_service">
            </div>
            <div class="mb-3">
                <label for="poste_occupe" class="form-label">Poste occupé</label>
                <input type="text" class="form-control" id="poste_occupe" name="poste_occupe">
            </div>
            <div class="mb-3">
                <label for="date_evaluation" class="form-label">Date d'évaluation</label>
                <input type="date" class="form-control" id="date_evaluation" name="date_evaluation">
            </div>
            <div class="mb-3">
                <label for="evaluateur" class="form-label">Évaluateur</label>
                <input type="text" class="form-control" id="evaluateur" name="evaluateur">
            </div>
            <div class="mb-3">
                <label for="objectifs_fixes" class="form-label">Objectifs Fixes</label>
                <textarea class="form-control" id="objectifs_fixes" name="objectifs_fixes" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="evaluation_des_competences" class="form-label">Évaluation des Compétences</label>
                <textarea class="form-control" id="evaluation_des_competences" name="evaluation_des_competences" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="realisations" class="form-label">Réalisations</label>
                <textarea class="form-control" id="realisations" name="realisations" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="points_forts" class="form-label">Points Forts</label>
                <textarea class="form-control" id="points_forts" name="points_forts" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="domaines_a_ameliorer" class="form-label">Domaines à Améliorer</label>
                <textarea class="form-control" id="domaines_a_ameliorer" name="domaines_a_ameliorer" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="note_evaluation" class="form-label">Note d'Évaluation</label>
                <input type="number" class="form-control" id="note_evaluation" name="note_evaluation" step="0.01">
            </div>
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>
    <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
    <script src="../../js/gs_evalue_performe.js" type="module"></script>
</body>
</html>
