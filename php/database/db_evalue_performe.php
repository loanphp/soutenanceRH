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
    "nom_employe" => "nom de l'employé",
    "departement_service"=>"département ou service",
    "poste_occupe" => "poste occupé",
    "date_evaluation" => "date de l'evaluation",
    "evaluateur"=>"évaluateur",
    "objectifs_fixes"=>"objectifs fixés",
    "evaluation_des_competences"=> "évaluation des compétences",
    "realisations"=> "réalisations",
    // "date_de_traitement"=> "date de traitement",
    "points_forts" => "points forts",
    "domaines_a_ameliorer" => "domaines_a_ameliorer",
    "note_evaluation" => "note de l'évaluation",
    
]);
if(count($messages)<=0){
    $nom_employe = strip_tags(trim($_POST["nom_employe"]));
    $departement_service	= strip_tags(trim($_POST["departement_service"]));
    $poste_occupe	= strip_tags(trim($_POST["poste_occupe"]))	;
    $date_evaluation = strip_tags(trim($_POST["date_evaluation"]))	;
    $evaluateur	= strip_tags(trim($_POST["evaluateur"]))	;
    $objectifs_fixes	= strip_tags(trim($_POST["objectifs_fixes"]))	;
    $evaluation_des_competences = strip_tags(trim($_POST["evaluation_des_competences"]))	;	
    $realisations	= strip_tags(trim($_POST["realisations"]))	;
    $points_forts = strip_tags(trim($_POST["points_forts"]))	;
    $domaines_a_ameliorer = strip_tags(trim($_POST["domaines_a_ameliorer"]))	;
    $note_evaluation = strip_tags(trim($_POST["note_evaluation"]))	;
    $insert = "INSERT INTO `evaluations_de_performances` (`nom_employe`,`departement_service`,`poste_occupe`,`date_evaluation`,`evaluateur`,`objectifs_fixes`,`evaluation_des_competences`,
    `realisations`,`points_forts`,`domaines_a_ameliorer`,`note_evaluation`) VALUES (:nom_employe,:departement_service,:poste_occupe, :date_evaluation,:evaluateur,:objectifs_fixes,:evaluation_des_competences,
    :realisations,:points_forts,:domaines_a_ameliorer,:note_evaluation)";
    $result = $db->getSelect($insert, [
        ":nom_employe" => $nom_employe,
        ":departement_service" => $departement_service,
        ":poste_occupe" => $poste_occupe,
        ":date_evaluation" => $date_evaluation,
        ":evaluateur" => $evaluateur,
        ":objectifs_fixes" => $objectifs_fixes,
        ":evaluation_des_competences" => $evaluation_des_competences,
        ":realisations" => $realisations,
        ":points_forts" => $points_forts,
        ":domaines_a_ameliorer" => $domaines_a_ameliorer,
        ":note_evaluation" => $note_evaluation,
    
    ]);
    echo response("Formulaire d'évaluation envoyer avec succès", true);
    
    
}else{
    echo response($fe->getError($messages));
}
