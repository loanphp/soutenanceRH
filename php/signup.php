<?php
if(isset($_SESSION["sessionuser"])){
    header("Location: /");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css"> -->
    <link rel="stylesheet" href="../css/aut.css">
    <title>Inscription</title>
</head>
<body>



<div class="container">

        <hr>
        <div class="message_container"></div>
        <h1 class="mt-5">Inscription</h1>
        <form class="mt-3" method="post">
            <div class="box">
                <input type="text" class="form-control" id="nom" name="nom">
                <label><i class="fa fa-unlock-alt"></i>Nom</label>
            </div>
            <div class="box">
                <!-- <label for="prenom" class="form-label">Prenom:</label> -->
                <input type="texte" class="form-control" id="prenom" name="prenom">
                <label><i class="fa fa-unlock-alt"></i>Prenom</label>
            </div>
            <div class="box">
                <!-- <label for="email" class="form-label">Email:</label> -->
                <input type="email" class="form-control" id="email" name="email">
                <label><i class="fa fa-unlock-alt"></i>Email</label>
            </div>
            <div class="box">
                <!-- <label for="password" class="form-label">Mot de passe:</label> -->
                <input type="password" class="form-control" id="password" name="password">
                <label><i class="fa fa-unlock-alt"></i>Mot de passe</label>
            </div>
            <div class="box">
                <label for="repeat_password" class="form-label">Repetez le mot de passe:</label>
                <input type="password" class="form-control" id="repeat_password" name="repeat_password">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">S'inscrire</button>
        </form>
        <hr>
        <div class="signup_button centre">
            <h6>Si vous avez déjà un compte ?</h6>
            <a href="/connection" class="d-block">Connectez-vous</a>
        </div>
    </div>

    <script src="../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script>
    <script src="../js/signup_auth.js" type="module"></script>
</body>
</html>