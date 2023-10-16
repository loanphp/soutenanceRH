<?php
require_once "../php/functions/gs_employes.php";
$responses = getAllResponse();
$getAllEvaluationQuestions = getAllEvaluationQuestions();
$id = str_replace("id=","",$urlParts["query"]);

// var_dump($responses);

?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/details_conges.css">
  <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
  <title>Details des evaluationResponse</title>
</head>
<body class="y-scroll scroll">
  <div class="container mt-5">
  <button id="printButton">Imprimer le tableau</button>
  <a href="/evaluation/result" class="btn btn-primary leave">Resultats évaluation</a>
    <?php if(is_array($responses) && count($responses)>0):?>
      <h2>Récapitulatif de l'évaluation</h2>
      <table class="table table-bordered">
        <tbody>
          <?php foreach ($responses as $keyresponse => $response):?>
            <?php if($id!==null && $id!=="" && $response["id"]==$id):?>
                <tr class="reponse">
                  <th>Champ</th>
                  <th>Valeur</th>
                </tr>
                <tr class="employe">
                  <td><strong>Code Employé:</strong></td>
                  <td id="code_employe_id"><?= $response["code_employe_id"] ?></td>
                </tr>
                  <?php foreach ($getAllEvaluationQuestions as $keyquestionevalution => $value):?>
                    <?php 
                        $data = json_decode($value["Data"],true) ;
                        $questionsdata = $data["Questions"] ;
                        $title = $data["Title"] ;
                        $questiondata = json_decode($value["Data"], true);
                      ?>
                      <?php foreach ($questionsdata as $keyquestion => $valuequestion):
                        
                        // $getquestions = getQuestionBy("titre", $title[$keyquestion["titre"]]);
                        $employe = getEmployeBy("numero_securite_sociale", $response["code_employe_id"]);
                      ?>
                        <tr class="question">
                          <td><strong><?= $valuequestion?></strong></td>
                          <td id="info_type_conges"><?= $response[str_replace("-","_",$title[$keyquestion])] ?></td>
                        </tr>
                    <?php endforeach;?>
                  <?php endforeach;?>
            <?php endif ;?>
          <?php endforeach;?>
        </tbody>
      </table>
    <?php else:?>
      <h1 class="empty_message">Vous n'avez fais aucune demande de congés.</h1>
    <?php endif?>
</div>
<script src="../../js/function/details_evaluation.js" type="module"></script>        
            
    </body>
</html> 