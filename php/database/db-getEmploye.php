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
    "formtype" => "type du formulaire"
]);
if(count($messages)<=0){
    $formtype = strip_tags(trim($_POST['formtype']));
    if($formtype=="get"){
        $id = strip_tags(trim($_POST['id']));
        $Employe = getEmployeBy("id",$id); 
        echo response("",true, $Employe);
        die;
    }
    if($formtype=="edite"){
        $messages = $fe->emptyField([
            "files" => "photo",
            "nom_employe"=>"nom de l'employé",
            "prenom_employe" => "prénom de l'employé",
            "date_de_naissance" => "date de naissance",
            "nationalite"=>"nationalité",
            "sexe"=>"sexe",
            "date_embauche"=> "date d'embauche",
            "date_de_depart"=> "date de départ",
            "poste_occupe"=> "poste occupé",
            "statut" => "status",
            "salaire" => "salaire",
            "tel" => "numéro téléphone",
            "adresse"=> "adresse",
            "email" => "email",
            "numero_securite_sociale" => "numéro d'itendification sociale"
        ]);
        if(count($messages)<=0){
            $photo = upload_file("files", "../upload/images", $uniquekey);
            $nom_employe = strip_tags(trim($_POST["nom_employe"]));
            $prenom_employe	= strip_tags(trim($_POST["prenom_employe"]));
            $date_de_naissance	= strip_tags(trim($_POST["date_de_naissance"]))	;
            $nationalite = strip_tags(trim($_POST["nationalite"]))	;
            $date_embauche	= strip_tags(trim($_POST["date_embauche"]))	;
            $statut	= strip_tags(trim($_POST["statut"]))	;
            $sexe = strip_tags(trim($_POST["sexe"]))	;	
            $date_de_depart	= strip_tags(trim($_POST["date_de_depart"]))	;
            $poste_occupe = strip_tags(trim($_POST["poste_occupe"]))	;
            $salaire = strip_tags(trim($_POST["salaire"]))	;
            $tel = strip_tags(trim($_POST["tel"]))	;
            $adresse = strip_tags(trim($_POST["adresse"]))	;	
            $email	= strip_tags(trim($_POST["email"]))	;
            $users = getUser($email);
            $numero_securite_sociale = strip_tags(trim($_POST["numero_securite_sociale"]))	;
            $id = strip_tags(trim($_POST["id"]));   
            $update = "UPDATE `gs_employes` SET `photo` = :photo, `nom_employe` = :nom_employe, `prenom_employe` = :prenom_employe,
            `date_de_naissance` = :date_de_naissance, `nationalite` = :nationalite, `date_embauche` = :date_embauche, `statut` = :statut,
           `sexe` = :sexe, `date_de_depart` = :date_de_depart, `poste_occupe` = :poste_occupe, `salaire` = :salaire,
           `tel` = :tel, `adresse` = :adresse, `email` = :email, `numero_securite_sociale` = :numero_securite_sociale WHERE `id` = :id";

            $result = $db->getSelect($update, [
            "id" => $id,
            "photo" => $photo["path"],
            "nom_employe" => $nom_employe,
            "prenom_employe" => $prenom_employe,
            "date_de_naissance" => $date_de_naissance,
            "nationalite" => $nationalite,
            "date_embauche" => $date_embauche,
            "statut" => $statut,
            "sexe" => $sexe,
            "date_de_depart" => $date_de_depart,
            "poste_occupe" => $poste_occupe,
            "salaire" => $salaire,
            "tel" => $tel,
            "adresse" => $adresse,
            "email" => $email,
            "numero_securite_sociale" => $numero_securite_sociale
            ]);
            $Employe = getEmployeBy("id",$id); 
            echo response("L'employé a été mit a jour.", true, $Employe);
            die;
        }else{
            echo response($fe->getError($messages));
            die;
        }
    }
}
else{
    echo response($fe->getError($messages));
    die;
}
?>