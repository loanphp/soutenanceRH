<?php 
require_once "../php/module/form_exeption.php";
require_once "../php/module/connection.php";
$db = new Database();
$connect = $db->getConnection();

function response(string $message, bool $success = false) {
    $response = ["success" => $success, "message" => $message];
    return json_encode($response);

}
$fe = new FormException();
$messages = $fe->emptyField([
    "id" => "id",
]);
if(count($messages)<=0){
    $id = strip_tags(trim($_POST['id']));
    $query = "DELETE FROM `conges` WHERE`id`=$id";
    $request = $connect->prepare($query);
    $request->execute();
    echo response("Demande de congé supprimée avec success.", true);
}
else{
    echo response($fe->getError($messages));
}
?>