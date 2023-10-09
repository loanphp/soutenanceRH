<?php
require_once "../php/module/connection.php";
require_once "../php/module/session.php";
require_once "../php/functions/gs_employes.php";
$db = new Database();
$connect = $db->getConnection();
function response(string $message, bool $success = false) {
    $response = ["success" => $success, "message" => $message];
    return json_encode($response);
}

if (isset($_POST["email"] , $_POST["password"])){
    if(!empty($_POST["email"])){
        if(!empty($_POST["password"])){
            $email = strip_tags(trim($_POST["email"]));
            $password = strip_tags(trim($_POST["password"]));
            $query = "SELECT * FROM `users` WHERE `email` = :email";
            $result = $db->getSelect($query, [":email" => $email], true);
             if ($result){
                if (password_verify($password, $result["password"])){ 
                    $session = new Session("sessionuser");
                    $session->create_session([
                        "id" => $result["id"],
                        "avatar" => $result["avatar"],
                        "nom" => $result["nom"],
                        "prenom" => $result["prenom"],
                        "email" => $result["email"],
                        "role" => $result["role"],
                        "is_verified" => $result["is_verified"]

                    ]);
                    echo response("vous etes maintenant connecter", true);
                    die();

                }else{
                    echo response( "compte inexistant");
                    die();
                }
                
             }else{
                echo response("compte inexistant");
                die();
             }
        }else{
           echo response("veuillez bien entrer votre mot de passe ");
            die();
        }

    }else {
       echo response("veuillez bien entrer votre email");
        die();

    }
}else {
   echo response("veuillez bien rentrer tous les champs");
    die();
}