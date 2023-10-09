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
    "numero_securite_sociale" => "numéro d'indentification social de l'employé",
    "form-type" => "type du formulaire"
]);
if(count($messages)<=0){
    $formtype = strip_tags(trim($_POST['form-type']));
    if($formtype=="getEmploye"){
        $codeEmploye = strip_tags(trim($_POST['numero_securite_sociale']));
        $employe = getEmployeBy("numero_securite_sociale",$codeEmploye); 
        if(is_array($employe) && count($employe)>0){
            echo response("",true, $employe);
        }
        else{
            echo response("Employé inexistant!",false);
        }
    }
}
else{
    echo response($fe->getError($messages));
}
?>