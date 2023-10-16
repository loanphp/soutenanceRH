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
    "numero_securite_sociale" => "nom de l'employé",
    "files" => "fichier",
]);
if(count($messages)<=0){
    $file_type =  strip_tags(trim($_POST["file_type"]));
    $numero_securite_sociale = strip_tags(trim($_POST["numero_securite_sociale"]));
    $form_type =  strip_tags(trim($_POST["form_type"]));
    $file = upload_file("files","../upload/pdf", $uniquekey);
    $file_name = $file["name"];
    $extension = $file["extension"];
    if($extension=="pdf"){
        if($form_type === "" || null === $form_type){
            echo response("Oooop ! Une erreur s'est produit.");
            die;
        }
        if($form_type === "update"){
            $update = "UPDATE `dossiers_du_personnels` SET `$file_type` = :_file WHERE numero_securite_sociale = :_numero_securite_sociale";
            $result = $db->getSelect($update, [
                ":_file" => $file_name,
                ":_numero_securite_sociale" => $numero_securite_sociale
            ]);
            echo response("Les dossiers de l'employé on été mis à jour.", true);
            die;
        }
        if($form_type === "insert"){
            $insert = "INSERT INTO `dossiers_du_personnels` (`$file_type`, `numero_securite_sociale`) VALUES (:_file, :numero_securite_sociale)";
            $result = $db->getSelect($insert, [
                ":_file" => $file_name,
                ":numero_securite_sociale" => $numero_securite_sociale
            ]);
            echo response("Nouveau fichier ajouter avec succès.", true);
            die;
        }
    }
    else{
        echo response("Ce fichier n'est pas un fichier pdf.");
    }

    
    
}else{
    echo response($fe->getError($messages));
}

?>