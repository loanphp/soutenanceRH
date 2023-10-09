<?php
require_once "../php/module/form_exeption.php";
require_once "../php/module/connection.php";
require_once "../php/module/genere_cle.php";
require_once "../php/functions/upload_file.php";

$GenerateRandomKeyService = new GenerateRandomKeyService();
$key = $GenerateRandomKeyService->generateRandomKey();
$uniquekey = $GenerateRandomKeyService->generateUniqueKey("XXXXXX");
$db = new Database();
$connect = $db->getConnection();
function response(string $message, bool $success = false) {
    $response = ["success" => $success, "message" => $message];
    return json_encode($response);

}
$fe = new FormException();
$messages = $fe->emptyField([
    "file_type" => "type de fichier",
    "files" => "fichier",
]);
if(count($messages)<=0){
    $file_type =  strip_tags(trim($_POST["file_type"]));
    $file = upload_file("files","../upload/pdf", $uniquekey);
    $file_name = $file["name"];
    $extension = $file["extension"];
    if($extension=="pdf"){
        $insert = "INSERT INTO `dossiers_du_personnels` (`$file_type`) VALUES (:_file)";
        $result = $db->getSelect($insert, [
            ":_file" => $file_name,
        ]);
        echo response("Nouveau fichier ajouter avec succès.", true);
    }
    else{
        echo response("Ce fichier n'est pas un fichier pdf.");
    }

    
    
}else{
    echo response($fe->getError($messages));
}

?>