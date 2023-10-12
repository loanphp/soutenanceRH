<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
  <!-- <link rel="stylesheet" href="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css"> -->
  <link rel="stylesheet" href="../../css/form-conges.css">
  <title>Formulaire de congés</title>
  <!-- Chargement des fichiers CSS de Bootstrap (Assurez-vous d'avoir une connexion internet pour cela) -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
</head>

<body>

  <div class="container mt-5 container-leave">
    <h1>Demande de congés</h1>
    <form class="formcenter">
      <div class="message_container"></div>
      <fieldset class="fieldset1">
        <legend>Identité personnelle</legend>
        <div class="form-group">
          <label for="nom_employe">Nom employé :</label>
          <input type="text" class="form-control" id="nom_employe" value="" placeholder="Entrez le nom de l'employé" name="nom_employe">
        </div>
      </fieldset>

      <fieldset class="fieldset2">
        <legend>Séjour</legend>
        <div class="line-div">
          <div class="form-group">
            <label for="date_de_demande">Date de demande :</label>
            <input type="date" class="form-control date" id="date_de_demande" name="date_de_demande">
          </div>
          <div class="form-group">
            <label for="date_de_debut">Date de début :</label>
            <input type="date" class="form-control date" id="date_de_debut" name="date_de_debut">
          </div>
          <div class="form-group">
            <label for="date_de_fin">Date de fin :</label>
            <input type="date" class="form-control date" id="date_de_fin" name="date_de_fin">
          </div>
        </div>
        <div class="form-group">
          <label for="duree">Durée :</label>
          <input type="text" readonly class="form-control duree" id="duree" name="duree">
        </div>
      </fieldset>
      <fieldset class="fieldset3">
        <legend>Justificatif</legend>
        <div class="form-group">
          <label for="type_conges">Type de congés :</label>
          <input type="text" class="form-control" id="type_conges" placeholder="Entrez le type de congés" name="type_conges">
        </div>
        <div class="form-group">
          <label for="motif">Motif :</label>
          <textarea type="text" class="form-control" id="motif" placeholder="Entrez le motif" name="motif"></textarea>
        </div>
      </fieldset>
      <!-- <div class="form-group">
        <label for="date_de_traitement">Date de traitement :</label>
        <input type="date" class="form-control" id="date_de_traitement">
      </div> -->
      <fieldset class="fieldset4">
        <legend>Approbation</legend>
        <div class="form-group">
          <label for="commentaire">Commentaire :</label>
          <textarea class="form-control" id="commentaire" rows="3" name="commentaire"></textarea>
        </div>
        <div class="form-group">
          <label for="gestionnaire">Gestionnaire :</label>
          <input type="text" class="form-control" id="gestionnaire" placeholder="Entrez le nom du gestionnaire" name="gestionnaire">
        </div>
      </fieldset>
      <button type="submit" class="btn btn-primary getbutton">Envoyer</button>
    </form>
  </div>
  <div id="calendar"></div>

  <!-- Chargement des fichiers JavaScript de Bootstrap (Assurez-vous d'avoir une connexion internet pour cela) -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <script src="../../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
  <script src="../../js/gs_conges.js" type="module"></script>
  <script src="../../js/function/calendrier.js" type="module"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
</body>

</html>