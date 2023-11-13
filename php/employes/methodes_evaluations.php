<?php
require_once "../php/functions/gs_employes.php";
require_once "../php/functions/voteurs.php";
$user = getSessionUser();
$isLogged = isLogged();
$taches = getAllTaches(["sort" => "date_de_debut"]);
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
            <?php require_once("../php/partials/sidebar.php") ?>
        </div>
        <div id="taches">
            <h1>Gestion des Tâches</h1>
            <table class="table_taches">
                <thead>
                    <tr>
                        <th>
                            <h6>A faire</h6>
                            <button id="aFaire">
                                <span><svg>
                                        <use xlink:href="../../public/svg/alert.svg#add"></use>
                                    </svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </th>
                        <th>
                            <h6>En cours</h6>
                            <button id="enCours">
                                <span><svg>
                                        <use xlink:href="../../public/svg/alert.svg#add"></use>
                                    </svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </th>
                        <th>
                            <h6>Terminé</h6>
                            <button id="termine">
                                <span><svg>
                                        <use xlink:href="../../public/svg/alert.svg#add"></use>
                                    </svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </th>
                        <th>
                            <h6>Annulé</h6>
                            <button id="annule">
                                <span><svg>
                                        <use xlink:href="../../public/svg/alert.svg#add"></use>
                                    </svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tr">
                        <td class="todo_container" data-status="todo">

                            <div class="modale_form">
                                <form class="form_modale_form" method="POST">
                                    <input type="hidden" value="" name="employe_id">
                                    <div class="field_container">
                                        <span><svg>
                                                <use xlink:href="../../public/svg/alert.svg#add"></use>
                                            </svg></span>
                                        <input placeholder="Tâche à effectuer" type="text" id="tache_a_effectuer" name="tache_a_effectuee" required><br>
                                    </div>
                                    <div class="field_container">
                                        <span><svg>
                                                <use xlink:href="../../public/svg/alert.svg#add"></use>
                                            </svg></span>
                                        <input type="date" id="date_fin" name="date_de_fin"><br>
                                    </div>
                                    <div class="field_container input_employe">
                                        <span><svg>
                                                <use xlink:href="../../public/svg/alert.svg#add"></use>
                                            </svg></span>
                                        <input type="search" autocomplete="false" id="nom_employe" name="nom_employe"><br>
                                        <div class="employe_container">
                                        </div>
                                    </div>
                                    <div class="field_container">
                                        <input type="submit" id="soumettre" value="Soumettre">
                                    </div>
                                </form>
                            </div>
                            <?php if (is_array($taches) && count($taches) > 0) : ?>
                                <?php foreach ($taches as $keytache => $tache) : ?>
                                    <?php if ($tache["status"] === "todo") : ?>
                                        <?php $employe = getEmployeBy("id", $tache["employe_id"]) ?>
                                        <div class="tache_frame" data-employe-id="<?= $tache["employe_id"] ?>">
                                            <div class="field_container tache_name_frame">
                                                <div class="tache_name_child">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <h6><?= $tache["tache_a_effectuee"] ?></h6>
                                                </div>
                                                <div class="select_tache">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <select class="select_status" name="status" id="" data-id="<?= $tache["id"] ?>">
                                                        <option value="todo" selected>A faire</option>
                                                        <option value="pending">En cours</option>
                                                        <option value="end">Terminé</option>
                                                        <option value="cancel">Annulé</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="field_container date_frame">
                                                <div class="date_frame_container">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <small><?= formatDate("d/m", $tache["date_de_fin"]) ?></small>
                                                </div>
                                                <img src="<?= $employe["photo"] ?>" class="img_employee" alt="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td data-status="pending">

                            <?php if (is_array($taches) && count($taches) > 0) : ?>
                                <?php foreach ($taches as $keytache => $tache) : ?>
                                    <?php if ($tache["status"] === "pending") : ?>
                                        <?php $employe = getEmployeBy("id", $tache["employe_id"]) ?>
                                        <div class="tache_frame" data-employe-id="<?= $tache["employe_id"] ?>">
                                            <div class="field_container tache_name_frame">
                                                <div class="tache_name_child">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <h6><?= $tache["tache_a_effectuee"] ?></h6>
                                                </div>
                                                <div class="select_tache">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <select class="select_status" name="status" id="" data-id="<?= $tache["id"] ?>">
                                                        <option value="todo">A faire</option>
                                                        <option value="pending" selected>En cours</option>
                                                        <option value="end">Terminé</option>
                                                        <option value="cancel">Annulé</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="field_container date_frame">
                                                <div class="date_frame_container">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <small><?= formatDate("d/m", $tache["date_de_fin"]) ?></small>
                                                </div>
                                                <img src="<?= $employe["photo"] ?>" class="img_employee" alt="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td data-status="end">

                            <?php if (is_array($taches) && count($taches) > 0) : ?>
                                <?php foreach ($taches as $keytache => $tache) : ?>
                                    <?php if ($tache["status"] === "end") : ?>
                                        <?php $employe = getEmployeBy("id", $tache["employe_id"]) ?>
                                        <div class="tache_frame" data-employe-id="<?= $tache["employe_id"] ?>">
                                            <div class="field_container tache_name_frame">
                                                <div class="tache_name_child">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <h6><?= $tache["tache_a_effectuee"] ?></h6>
                                                </div>
                                                <div class="select_tache select_tache_appreciation" >
                                                    <div class="status_container">
                                                        <span><svg>
                                                                <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                            </svg></span>
                                                        <select class="select_status" name="status" id="" data-id="<?= $tache["id"] ?>">
                                                            <option value="todo">A faire</option>
                                                            <option value="pending">En cours</option>
                                                            <option value="end" selected>Terminé</option>
                                                            <option value="cancel">Annulé</option>
                                                        </select>
                                                    </div>
                                                    <div class="appreciation_container">
                                                        <input type="text" value="<?= $tache["appreciation"]?$tache["appreciation"]:"" ?>" placeholder="appréciation en pourcentage" name="appreciation" class="appreciation_input">
                                                        <button type="button" data-id="<?= $tache["id"]?>"  class="appreciation_button"><svg>
                                                                <use xlink:href="../../public/svg/alert.svg#send"></use>
                                                                </svg></button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="field_container date_frame">
                                                <div class="date_frame_container">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <small><?= formatDate("d/m", $tache["date_de_fin"]) ?></small>
                                                </div>
                                                <img src="<?= $employe["photo"] ?>" class="img_employee" alt="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td data-status="cancel">

                            <?php if (is_array($taches) && count($taches) > 0) : ?>
                                <?php foreach ($taches as $keytache => $tache) : ?>
                                    <?php if ($tache["status"] === "cancel") : ?>
                                        <?php $employe = getEmployeBy("id", $tache["employe_id"]) ?>
                                        <div class="tache_frame" data-employe-id="<?= $tache["employe_id"] ?>">
                                            <div class="field_container tache_name_frame">
                                                <div class="tache_name_child">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <h6><?= $tache["tache_a_effectuee"] ?></h6>
                                                </div>
                                                <div class="select_tache select_tache_appreciation">
                                                    <div class="status_container">
                                                        <span><svg>
                                                                <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                            </svg></span>
                                                        <select class="select_status" name="status" id="" data-id="<?= $tache["id"] ?>">
                                                            <option value="todo">A faire</option>
                                                            <option value="pending">En cours</option>
                                                            <option value="end">Terminé</option>
                                                            <option value="cancel" selected>Annulé</option>
                                                        </select>
                                                    </div>
                                                    <div class="appreciation_container">
                                                        <input type="text" value="<?= $tache["appreciation"]?$tache["appreciation"]:"" ?>" placeholder="appréciation en pourcentage" name="appreciation" class="appreciation_input">
                                                        <button type="button" data-id="<?= $tache["id"]?>" class="appreciation_button"><svg>
                                                                <use xlink:href="../../public/svg/alert.svg#send"></use>
                                                                </svg></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field_container date_frame">
                                                <div class="date_frame_container">
                                                    <span><svg>
                                                            <use xlink:href="../../public/svg/alert.svg#add"></use>
                                                        </svg></span>
                                                    <small><?= formatDate("d/m", $tache["date_de_fin"]) ?></small>
                                                </div>
                                                <img src="<?= $employe["photo"] ?>" class="img_employee" alt="">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
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