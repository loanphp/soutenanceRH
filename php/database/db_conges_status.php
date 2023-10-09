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

function changeStatus(){
    global $connect, $fe;
    if(isset($_POST["id"])){
        $id = strip_tags(trim($_POST["id"]));
        $messages = $fe->emptyField([
            "id" => "id",
            "status$id" => "status",
        ]);
        if(count($messages)<=0){
            $status = strip_tags(trim($_POST["status$id"]));
            $query = "UPDATE `conges` SET `status` = '$status' WHERE `conges`.`id` = $id";
            $result = $connect->prepare($query);
            $result->execute();

        }
        else{
            echo response($fe->getError($messages));
        }
    }
}
changeStatus();