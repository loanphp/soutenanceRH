<?php 
require_once "../php/functions/gs_employes.php";
$employes = getAllEmployes();
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Liens vers les fichiers Bootstrap -->

  <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css">
  <link rel="stylesheet" href="../../css/view_employe.css">
</head>
<body>
  <div class="container">
    <a href="/ajouter/employes" class="btn btn-dark mb-3" >Ajouter un employé</a>
    <div class="row">
      <?php while ($allemployes = $employes->fetch(PDO::FETCH_ASSOC)): ?>
        <?php 
          // $dossier_personnel_id = $allemployes["dossier_personnel_id"];
          // $dossier = getFoldersEmploye($dossier_personnel_id);
          // $cv = $dossier["cv"];
          $job = getJobBy("id",$allemployes["poste_occupe"])
        
        ?>
        <div class="col-md-4 card_container"> 
          <div class="card mb-4"> 
            <img src="<?= $allemployes["photo"] ?>" class="card-img-top employe_image" alt="Image de la carte">
            <div class="card-body">
              <h5 class="card-title"><?= $allemployes["nom_employe"] ?></h5>
              <p class="card-text"><?= $job["name"] ?></p>
              <button type="button" class="btn btn-danger supprime" data-id ="<?= $allemployes["id"]?>">Supprimer</button>
              <a href="#" class="btn btn-primary cv" data-id ="<?= $allemployes["id"]?>">Voir le cv</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Scripts Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
  <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
  <script src="../../js/gs_employes.js" type="module"></script>
</body>
</html>
