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
    "realisations"=>"realisations",
    "projets" => "projets",
    "objectifs-atteints" => "objectifs-atteints",
    "forces"=>"forces",
    "competences"=>"competences",
    "contributions"=> "contributions",
    "objectifs-developpement"=> "objectifs-developpement",
    "formation"=> "formation",
    "croissance-professionnelle" => "croissance-professionnelle",
    "capacite-collaboration" => "capacite-collaboration",
    "defis-interactions" => "defis-interactions",
    "amelioration"=> "amelioration",
    "obstacles" => "obstacles",
    "defis" => "defis",
    "objectifs-futurs" => "objectifs futurs",
    "objectifs-entreprise" => "ojectifs entreprise",
    "indicateurs" => "indicateurs",
    "satisfaction" => "satisfaction",
    "preoccupations" => "preoccupations",
    "feedback-manager" => "feedback-manager",
    "suggestions" => "suggestions",
    

]);
if(count($messages)<=0){
    $realisations = strip_tags(trim($_POST["realisations"]));
    $projets	= strip_tags(trim($_POST["projets"]));
    $objectifsatteints	= strip_tags(trim($_POST["objectifs-atteints"]))	;
    $forces = strip_tags(trim($_POST["forces"]))	;
    $contributions	= strip_tags(trim($_POST["contributions"]))	;
    $croissanceprofessionnelle	= strip_tags(trim($_POST["croissance-professionnelle"]))	;
    $competences = strip_tags(trim($_POST["competences"]))	;	
    $objectifsdeveloppement	= strip_tags(trim($_POST["objectifs-developpement"]))	;
    $formation = strip_tags(trim($_POST["formation"]))	;
    $capacitecolaboration = strip_tags(trim($_POST["capacite-collaboration"]))	;
    $defisinteractions = strip_tags(trim($_POST["defis-interactions"]))	;
    $amelioration = strip_tags(trim($_POST["amelioration"]))	;	
    $obstacles	= strip_tags(trim($_POST["obstacles"]))	;
    $defis	= strip_tags(trim($_POST["defis"]))	;
    $objectifsfuturs	= strip_tags(trim($_POST["objectifs-futurs"]))	;
    $objectifsentreprise	= strip_tags(trim($_POST["objectifs-entreprise"]))	;
    $indicateurs	= strip_tags(trim($_POST["indicateurs"]))	;
    $satisfaction	= strip_tags(trim($_POST["satisfaction"]))	;
    $preoccupations	= strip_tags(trim($_POST["preoccupations"]))	;
    $feedbackmanager	= strip_tags(trim($_POST["feedback-manager"]))	;
    $suggestions	= strip_tags(trim($_POST["suggestions"]))	;
    $code_employe = strip_tags(trim($_POST["code_employe"]));
    $employe = getEmployeBy("numero_securite_sociale",$code_employe); 
    // var_dump($employe);
    if(is_array($employe) && count($employe)>0){
        $insert = "INSERT INTO `reponse_evaluation` (`code_employe_id`,`realisations`,`projets`,`objectifs_atteints`, `forces`,`contributions`,`croissance_professionnelle`,`competences`,
        `objectifs_developpement`,`formation`,`capacite_collaboration`,`defis_interactions`,`amelioration`,`obstacles`,`defis`,`objectifs_futurs`,`objectifs_entreprise`,`indicateurs`,`satisfaction`,`preoccupations`,`feedback_manager`,`suggestions`) VALUES (:code_employe_id,:realisations,:projets,:objectifs_atteints, :forces,:contributions,:croissance_professionnelle,:competences,
        :objectifs_developpement,:formation,:capacite_collaboration,:defis_interactions,:amelioration,:obstacles,:defis,:objectifs_futurs,:objectifs_entreprise,:indicateurs,:satisfaction,:preoccupations,:feedback_manager,:suggestions)";

        $result = $db->getSelect($insert, [
            ":realisations" => $realisations,
            ":projets" => $projets,
            ":objectifs_atteints" => $objectifsatteints,
            ":forces" => $forces,
            ":contributions" => $contributions,
            ":croissance_professionnelle" => $croissanceprofessionnelle,
            ":competences" => $competences,
            ":objectifs_developpement" => $objectifsdeveloppement,
            ":formation" => $formation,
            ":capacite_collaboration" => $capacitecolaboration,
            ":defis_interactions" => $defisinteractions,
            ":amelioration" => $amelioration,
            ":obstacles" => $obstacles,
            ":defis" => $defis,
            ":objectifs_futurs" => $objectifsfuturs,
            ":objectifs_entreprise" => $objectifsentreprise,
            ":indicateurs" => $indicateurs,
            ":satisfaction" => $satisfaction,
            ":preoccupations" => $preoccupations,
            ":feedback_manager" => $feedbackmanager,
            ":suggestions" => $suggestions,
            ":code_employe_id" => $code_employe
        ]);
   
        echo response("Evaluation passé avec success!", true);
    }
    else{
        echo response("Employé inexistant!",false);
    }
    
}else{
    echo response($fe->getError($messages));
}
