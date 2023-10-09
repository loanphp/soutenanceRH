<?php
require_once "../php/functions/gs_employes.php";
$getAllEvaluationQuestions =  getAllEvaluationQuestions();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Formulaire d'Évaluation de la Performance</title>
    <link rel="stylesheet" href="../../css/methode_individuel.css">
</head>

<body>
    <div class="grand_div">
        <h1>Évaluation de Performance</h1>
        <form action="" method="post">
            <div>
                <div class="fieldset-container">
                    <?php foreach ($getAllEvaluationQuestions as $key=>$value) : ?>
                        <?php
                            $data = json_decode($value["Data"],true) ;
                            $questions = $data["Questions"] ;
                            $title = $data["Title"] ;
                            $firstKey = array_key_first($getAllEvaluationQuestions); 
                            $lastKey = array_key_last($getAllEvaluationQuestions);
                        ?>

                        <fieldset>
                            <legend><?= $value["Name"] ?></legend>
                            <?php foreach($questions as $index=>$question):?>
                                <?php $getquestions = getQuestionBy("titre", $title[$index])?>
                                <label for="<?= $getquestions["id"]?>"><?= $getquestions["questions"] ?></label>
                                <textarea required id="<?= $getquestions["id"]?>" name="<?= $getquestions["titre"]?>" rows="4" cols="50"></textarea><br><br>
                            <?php endforeach?>
                          
                            <?php if ($firstKey===$key) : ?>
                                <button class="next-btn btn" type="button">Suivant</button>
                            <?php elseif ($lastKey===$key) : ?>
                                <div class="button-container">
                                    <button class="prev-btn btn" type="button">Précédent</button>
                                    <button class="save-btn btn" type="submit">Soumettre</button>
                                </div>
                            <?php else : ?>
                                <div class="button-container">
                                    <button class="prev-btn btn" type="button">Précédent</button>
                                    <button class="next-btn btn" type="button">Suivant</button>
                                </div>
                            <?php endif ?>
                        </fieldset>
                    <?php endforeach; ?>
                </div>
            </div>
        </form>
    </div>
    <script src="../../js/function/individuel.js" type="module"></script>
</body>

</html>