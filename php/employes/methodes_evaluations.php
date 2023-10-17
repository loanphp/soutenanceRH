<?php
require_once "../php/functions/gs_employes.php";
$taches = getAllTaches(["sort"=>"date_de_debut"]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/methodes_evaluations.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/index.css">
    <title>Liste des Tâches</title>
</head>
<body>
    <div class="div_container_taches">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark col-6" style="width: 280px;">
            <?php require_once("../php/partials/sidebar.php")?>
        </div>
        <div id="taches">
            <h1>Gestion des Tâches</h1>
            <table class="table_taches">
                <thead>
                    <tr>
                        <th>A faire</th>
                        <th>En cours</th>
                        <th>Terminé</th>
                        <th>Annulé</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tr">
                        <td class="todo_container">
                            <button id="aFaire" >
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                            <div class="modale_form">
                                <form class="form_modale_form" method="POST">
                                    <input type="hidden" value ="" name="employe_id">
                                    <div class="field_container">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <input placeholder="Tâche à effectuer" type="text" id="tache_a_effectuer" name="tache_a_effectuee" required><br>
                                    </div>
                                    <div class="field_container">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <input type="date" id="date_fin" name="date_de_fin"><br>
                                    </div>
                                    <div class="field_container input_employe">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <input type="search" autocomplete="false" id="nom_employe" name="nom_employe"><br>
                                        <div class="employe_container">
                                        </div>
                                    </div>
                                    <div class="field_container">
                                    <input type="submit" id="soumettre" value="Soumettre">
                                    </div>
                                </form>
                            </div>
                            <?php if(is_array($taches) && count($taches)>0):?>
                                <?php foreach ($taches as $keytache => $tache):?>
                                    <?php $employe = getEmployeBy("id", $tache["employe_id"])?>
                                    <div class="tache_frame">
                                        <div class="field_container tache_name_frame">
                                            <div class="tache_name_child">
                                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                                <h6><?=$tache["tache_a_effectuee"]?></h6>
                                            </div>
                                            <div class="select_tache">
                                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                                <select name="" id="">
                                                    <option value="todo">A faire</option>
                                                    <option value="pending">En cours</option>
                                                    <option value="end">Terminé</option>
                                                    <option value="cancel">Annulé</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field_container date_frame">
                                            <div class="date_frame_container">
                                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                                <small><?= formatDate("d/m", $tache["date_de_fin"])?></small>
                                            </div>
                                            <img src="<?= $employe["photo"]?>"class="img_employee" alt="">
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>
                        </td>
                        <td>
                            <button id="enCours" >
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </td>
                        <td>
                            <button id="termine">
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </td>
                        <td>
                            <button id="annule">
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../../js/function/methode_evaluation.js" type="module"></script>

    <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
