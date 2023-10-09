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
    "id" => "id",
]);
if(count($messages)<=0){
    $id = strip_tags(trim($_POST['id']));
    $response = getOneEvaluationResponse($id);
    if(is_array($response) && count($response)>0){
        echo response("",true, $response);
    }
}
else{
    echo response($fe->getError($messages));
}
?>