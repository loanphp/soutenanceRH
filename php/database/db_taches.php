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
    "date_de_fin" => "date de fin",
    "employe_id" => "employe",
    "tache_a_effectuee" => "tache a effectuée",
    
]);
if(count($messages)<=0){
    $date_de_fin =  strip_tags(trim($_POST["date_de_fin"]));
    $employe_id = strip_tags(trim($_POST["employe_id"]));
    $tache_a_effectuee =  strip_tags(trim($_POST["tache_a_effectuee"]));
    $form_type =  strip_tags(trim($_POST["formtype"]));
    if($form_type === "" || null === $form_type){
        echo response("Ooups ! Une erreur s'est produit.");
        die;
    }
    if($form_type === "update"){
        $status =  strip_tags(trim($_POST["status"]));
        $update = "UPDATE `dossiers_du_personnels` SET `$file_type` = :_file WHERE numero_securite_sociale = :_numero_securite_sociale";
        $result = $db->getSelect($update, [
            ":_file" => $file_name,
            ":_numero_securite_sociale" => $numero_securite_sociale
        ]);
        echo response("Les dossiers de l'employé on été mis à jour.", true);
        die;
    }
    if($form_type === "create"){
        $insert = "INSERT INTO `taches` (`employe_id`, `date_de_fin`,`tache_a_effectuee`) VALUES (:employe_id, :date_de_fin,:tache_a_effectuee)";
        $result = $db->getSelect($insert, [
            ":employe_id" => $employe_id,
            ":date_de_fin" => $date_de_fin,
            ":tache_a_effectuee" => $tache_a_effectuee
        ]);
        $tache = getTachesBy("employe_id", $employe_id);
        $employe = getEmployeBy("id", $employe_id);
        $photo = $employe['photo'];
        $tache['photo'] = $photo;
        echo response("Nouvelle tache soumise avec succès.", true,$tache);
        die;
    } 
}else{
    echo response($fe->getError($messages));
}

?>