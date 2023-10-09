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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css"> -->
    <link rel="stylesheet" href="../css/login.css">
    <title>Connection</title>
    
</head>
<body>

    <div class="container">
        <hr>
        <div class="message_container"></div>
        <h1 class="mt-5">Connection</h1>
        <form method="post" class="mt-3">
            <div class="box">
                <!-- <label for="email" class="form-label">Email:</label> -->
                <input type="text" class="form-control" id="email" name="email">
                <label><i class="fa fa-user"></i></label>
            </div>
            <div class="box">
                <!-- <label for="password" class="form-label">Mot de passe:</label> -->
                <input type="password" class="form-control" id="password" name="password">
                <label><i class="fa fa-unlock-alt"></i></label>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
        <hr>
        <div class="signup_button centre">
            <h6>Pas encore inscrit ?</h6>
            <a href="/inscription" class="d-block">Inscrivez-vous.</a>
        </div>
    </div>

    <!-- <script src="../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.js"></script> -->
    <script src="../js/login_auth.js" type="module"></script>
</body>
</html>
