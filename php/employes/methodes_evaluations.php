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
                            <button id="aFaire" onclick="filtrerTaches('aFaire')">
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                            <div class="modale_form">
                                <form action="traitement.php" class="form_modale_form" method="POST">
                                    <div class="field_container">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <input placeholder="Tâche à effectuer" type="text" id="tache_a_effectuer" name="tache_a_effectuer" required><br>
                                    </div>
                                    <div class="field_container">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <input type="date" id="date_fin" name="date_fin"><br>
                                    </div>
                                    <div class="field_container">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <input type="text" id="nom_employe" name="nom_employe"><br>
                                    </div>
                                    <div class="field_container">
                                    <input type="submit" value="Soumettre">
                                    </div>
                                </form>
                            </div>
                            <div class="tache_frame">
                                <div class="field_container tache_name_frame">
                                    <div class="tache_name_child">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <h6>tapper les enfants a la pause</h6>
                                    </div>
                                    <div class="select_tache">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <select name="" id="">
                                            <option value="">A faire</option>
                                            <option value="">En cours</option>
                                            <option value="">Terminé</option>
                                            <option value="">Annulé</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="field_container date_frame">
                                    <div class="date_frame_container">
                                        <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                        <small>12/10</small>
                                    </div>
                                    <img src="../../upload/images/0380f8pexels-lisa-fotios-1957478.jpg" class="img_employee" alt="">
                                </div>
                            </div>
                        </td>
                        <td>
                            <button id="enCours" onclick="filtrerTaches('enCours')">
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </td>
                        <td>
                            <button id="termine" onclick="filtrerTaches('termine')">
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </td>
                        <td>
                            <button id="annule" onclick="filtrerTaches('annule')">
                                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                                <span>Ajouter une tache</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
</body>
</html>
