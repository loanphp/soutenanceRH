<?php 
require_once "../php/module/form_exeption.php";
require_once "../php/module/connection.php";
require_once "../php/functions/gs_employes.php";
$db = new Database();
$connect = $db->getConnection();

function response(string $message, bool $success = false, array $data = null) {
    $response = ["success" => $success, "message" => $message, "data" => $data];
    return json_encode($response);
}
$fe = new FormException();
$messages = $fe->emptyField([
    "numero_securite_sociale" => "nom de l'employe",
    "formtype" => "type de formulaire"
]);
if(count($messages)<=0){
    $numero_securite_sociale = strip_tags(trim($_POST['numero_securite_sociale']));
    $formtype = strip_tags(trim($_POST['formtype']));
    if($formtype=="get"){
        if($numero_securite_sociale!==null && $numero_securite_sociale!==""){
            $dossier = getDossiersBy("numero_securite_sociale",$numero_securite_sociale);
            if(is_bool($dossier) && false === $dossier){
                echo response('',true);
                die;
            }
            echo response('',true,$dossier);
            die;
        }
    }
    if($formtype==="delete"){
        if(isset($_POST["colonne"])){
            $colonne = strip_tags(trim($_POST["colonne"]));
            $query = "UPDATE `dossiers_du_personnels` SET `$colonne` = '' WHERE numero_securite_sociale = :numero_securite_sociale";
            $connect = $db->getConnection();
            $stmt = $connect->prepare($query);
            $stmt->bindParam(':numero_securite_sociale', $numero_securite_sociale, PDO::PARAM_STR);
            $stmt->execute();
            echo response("", true);
            die();
            
        }
        echo response("Oups quelque chose s'est mal passé !!!!!");
        
    }
}
else{
    echo response($fe->getError($messages));
    die;
}
?>