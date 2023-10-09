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
    $idArray = explode(",",$id);
    $query = "";
    if(count($idArray)==1 && $idArray[0]==0){
        $query = "DELETE FROM `gs_employes`";
        $request = $connect->prepare($query);
        $request->execute();
    }
    if(count($idArray)==1 && $idArray[0]!==0){
        $id = $idArray[0];
        $query = "DELETE FROM `gs_employes` WHERE`id`=$id";
        $request = $connect->prepare($query);
        $request->execute();
    }
    if(count($idArray)>1){
        $query = "DELETE FROM `gs_employes` WHERE `id` IN (" . implode(',', $idArray) . ")";
        $request = $connect->prepare($query);
        $request->execute();
    }
    echo response("", true);
}
else{
    echo response($fe->getError($messages));
}
?>