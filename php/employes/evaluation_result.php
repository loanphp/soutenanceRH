<?php
require_once "../php/functions/gs_employes.php";
$responses = getAllResponse();
$questions = getAllEvaluationQuestions();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/evaluation_result.css">
    <title>Tableau Resultats Evaluations</title>
</head>
<body class="y-scroll scroll">
    <h1>Resultats des évaluations</h1>
    <div class="form-container">
        <table>
            <thead>
                <tr>
                    <th class="code_employe_id">Code Employé ID</th>
                    <th>Nom Employé</th>
                    <th class="question">Question</th>
                    <th class="reponse">Réponse</th>
                    <th class="details">Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $key => $response):?>
                    <?php $firstquestion = getQuestionBy("titre","realisations");
                    $employe = getEmployeBy("numero_securite_sociale", $response["code_employe_id"]);
                    ?>
                <tr>
                    <td class="code_employe_id"><?= $response["code_employe_id"]?></td>
                    <td><?= $employe["nom_employe"] ." ". $employe["prenom_employe"] ; ?></td>
                    <td class="question"><?= $firstquestion["questions"]?></td>
                    <td class="reponse"><?= $response["realisations"]?></td>
                    <td class="details"><a href="/details/evaluation?id=<?=$response["id"]?>">Voir les détails</a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>
