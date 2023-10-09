<?php
require_once "../php/module/form_exeption.php";
require_once "../php/module/connection.php";
require_once "../php/functions/gs_employes.php";
$db = new Database();
$connect = $db->getConnection();
function response(string $message, bool $success = false) {
    $response = ["success" => $success, "message" => $message];
    return json_encode($response);

}
$fe = new FormException();
$messages = $fe->emptyField([
    "form_type" => "type du formulaire",
    "nom_employe" => "nom de l'employé",
    "type_conges"=>"type de congés",
    "date_de_debut" => "date de début",
    "date_de_fin" => "date de fin",
    "duree"=>"durée",
    "motif"=>"motif",
    "commentaire"=> "commentaire",
    "date_de_demande"=> "date de demande",
    "gestionnaire" => "gestionnaire",
    
]);
if(count($messages)<=0){
    $nom_employe = strip_tags(trim($_POST["nom_employe"]));
    $type_conges	= strip_tags(trim($_POST["type_conges"]));
    $date_de_debut	= strip_tags(trim($_POST["date_de_debut"]))	;
    $date_de_fin = strip_tags(trim($_POST["date_de_fin"]))	;
    $duree	= strip_tags(trim($_POST["duree"]))	;
    $motif	= strip_tags(trim($_POST["motif"]))	;
    $commentaire = strip_tags(trim($_POST["commentaire"]))	;	
    $date_de_demande	= strip_tags(trim($_POST["date_de_demande"]))	;
    $gestionnaire = strip_tags(trim($_POST["gestionnaire"]))	;
    $id = (int)strip_tags(trim($_POST["id"]));
    $employe = getEmployeBy("email",$_SESSION["sessionuser"]["email"]);
    $formType = strip_tags(trim($_POST["form_type"]));
    if($id==0 && $formType==="add"){
        $insert = "INSERT INTO `conges` (`nom_employe`,`type_conges`,`date_de_debut`, `date_de_fin`,`duree`,`motif`,`commentaire`,
        `date_de_demande`,`gestionnaire`) VALUES (:nom_employe,:type_conges,:date_de_debut, :date_de_fin,:duree,:motif,:commentaire,
        :date_de_demande,:gestionnaire)";
        $result = $db->getSelect($insert, [   
            ":nom_employe" => $nom_employe,
            ":type_conges" => $type_conges,
            ":date_de_debut" => $date_de_debut,
            ":date_de_fin" => $date_de_fin,
            ":duree" => $duree,
            ":motif" => $motif,
            ":commentaire" => $commentaire,
            ":date_de_demande" => $date_de_demande,
            ":gestionnaire" => $gestionnaire,
    
        ]);
        echo response("demande de congé envoyer avec succès", true);
    }
    if($id>0 && $formType=="update"){
        $update = "UPDATE `conges` SET 
            `nom_employe` = :nom_employe,
            `type_conges` = :type_conges,
            `date_de_debut` = :date_de_debut,
            `date_de_fin` = :date_de_fin,
            `duree` = :duree,
            `motif` = :motif,
            `commentaire` = :commentaire,
            `date_de_demande` = :date_de_demande,
            `gestionnaire` = :gestionnaire
            WHERE `id` = :id";

        $result = $db->getSelect($update, [   
            ":id" => $id,
            ":nom_employe" => $nom_employe,
            ":type_conges" => $type_conges,
            ":date_de_debut" => $date_de_debut,
            ":date_de_fin" => $date_de_fin,
            ":duree" => $duree,
            ":motif" => $motif,
            ":commentaire" => $commentaire,
            ":date_de_demande" => $date_de_demande,
            ":gestionnaire" => $gestionnaire,
        ]);
        echo response("La demande de congée a été modifié avec succès.", true);
  
    }
    elseif($id<=0 && $formType == "update"){
        echo response("L'id de l'employé n'a pas pue etre recuperé");
        

    }
    
    
}else{
    echo response($fe->getError($messages));
}

