<?php 
require_once "../php/module/form_exeption.php";
require_once "../php/module/connection.php";
require_once "../php/functions/gs_employes.php";
require_once "../php/functions/upload_file.php";
require_once "../php/module/genere_cle.php";
$GenerateRandomKeyService = new GenerateRandomKeyService();
$key = $GenerateRandomKeyService->generateRandomKey();
$uniquekey = $GenerateRandomKeyService->generateUniqueKey("XXXXXX");
$db = new Database();
$connect = $db->getConnection();

function response(string $message, bool $success = false, array $data = null) {
    $response = ["success" => $success, "message" => $message, "data" => $data];
    return json_encode($response);

}
$fe = new FormException();
$messages = $fe->emptyField([
    "id" => "id",
    "form_type" => "type du formulaire"
]);
if(count($messages)<=0){
    $formtype = strip_tags(trim($_POST['form_type']));
    if($formtype=="get"){
        $id = strip_tags(trim($_POST['id']));
        $leave = getLeaveBy("id",$id); 
        echo response("",true, $leave);
    }
}
else{
    echo response($fe->getError($messages));
}
?>