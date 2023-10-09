<?php
require_once "../php/module/connection.php";
require_once "../php/module/form_exeption.php";
$db = new Database();
$connect = $db->getConnection();
function response(string $message, bool $success = false)
{
    $response = ["success" => $success, "message" => $message];
    return json_encode($response);
}
$fe = new FormException();
$messages = $fe->emptyField([
    "nom" => "nom",
    "prenom"=>"prenom",
    "email" => "email",
    "password" => "mot de passe",
    "repeat_password"=>"confirmation du mot de passe ",
]);
if(count($messages)<=0){
    
if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    if ($_POST["password"] === $_POST["repeat_password"]) {
        $nom = strip_tags(trim($_POST["nom"]));
        $prenom = strip_tags(trim($_POST["prenom"]));
        $email = strip_tags(trim($_POST["email"]));
        $password = strip_tags(trim($_POST["password"]));
        $repeat_password = strip_tags(trim($_POST["repeat_password"]));
        $query = "SELECT * FROM `users` WHERE `email` = :email";
        $result = $db->getSelect($query, [":email" => $email]);
        if ($result) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $insert = "INSERT INTO `users` (`nom`,`prenom`,`email`, `password`) VALUES (:nom, :prenom, :email, :password1)";
            $result = $db->getSelect($insert, [
                ":nom" => $nom,
                ":prenom" => $prenom,
                ":email" => $email,
                ":password1" => $passwordHash,

            ]);
            echo response("inscription réussie", true);
            die();
        } else {
            echo response("Ce compte exite déjà");
            die();
        }
    } else {
        echo response("Les mots de passe ne correspondent pas");
        die();
    }
} else {
    echo response("Veuillez saisir un mot de passe");
    die();
}
}else{
    echo response($fe->getError($messages));

}

