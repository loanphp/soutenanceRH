<?php
require_once "../php/module/form_exeption.php";
require_once "../php/module/connection.php";
require_once "../php/module/genere_cle.php";
require_once "../php/functions/upload_file.php";
require_once "../php/functions/gs_employes.php";
$db = new Database();
$connect = $db->getConnection();
function response(string $message, bool $success = false, array $data = null) {
    $response = ["success" => $success, "message" => $message, "data" => $data];
    return json_encode($response);

}
$fe = new FormException();
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
    

]);
if(count($messages)<=0){
    $GenerateRandomKeyService = new GenerateRandomKeyService();
    $key = $GenerateRandomKeyService->generateRandomKey();
    $uniquekey = $GenerateRandomKeyService->generateUniqueKey("XXXXXX");
    $photo = upload_file("files", "../upload/images", $uniquekey);
    $nom_employe = strip_tags(trim($_POST["nom_employe"]));
    $prenom_employe	= strip_tags(trim($_POST["prenom_employe"]));
    $date_de_naissance	= strip_tags(trim($_POST["date_de_naissance"]));
    $nationalite = strip_tags(trim($_POST["nationalite"]));
    $date_embauche	= strip_tags(trim($_POST["date_embauche"]));
    $statut	= strip_tags(trim($_POST["statut"]));
    $sexe = strip_tags(trim($_POST["sexe"]));	
    $date_de_depart	= strip_tags(trim($_POST["date_de_depart"]));
    $poste_occupe = strip_tags(trim($_POST["poste_occupe"]));
    $salaire = strip_tags(trim($_POST["salaire"]));
    $tel = strip_tags(trim($_POST["tel"]));
    $adresse = strip_tags(trim($_POST["adresse"]));	
    $email	= strip_tags(trim($_POST["email"]));
    $users = getUser($email);   
    $checkExistingFields = $db->checkExistingData([
        'table' => 'gs_employes',
        'datas' => ['tel'=>$tel,'numero_securite_sociale'=>$key],
    ]);
    if(is_array($users) && count($users) > 0){
        echo response('Cet email existe déjà.');
        die;
    }
    if(is_array($checkExistingFields['result']) && count($checkExistingFields['result']) > 0){
        if($checkExistingFields['field']==="tel"){
            echo response('Ce numéro est déja utilisé par un autre employé');
        }
        if($checkExistingFields['field']==='numero_securite_sociale'){
            echo response('Le numero de sécurité sociale est déja utilisé par un autre employé');
        }
        die;
    }
    $insert = "INSERT INTO `gs_employes` (`photo`,`nom_employe`,`prenom_employe`,`date_de_naissance`, `nationalite`,`date_embauche`,`statut`,`sexe`,
    `numero_securite_sociale`,`date_de_depart`,`poste_occupe`,`salaire`,`tel`,`adresse`,`email`) VALUES (:photo,:nom_employe,:prenom_employe,:date_de_naissance, :nationalite,:date_embauche,:statut,:sexe,
    :numero_securite_sociale,:date_de_depart,:poste_occupe,:salaire,:tel,:adresse,:email)";
    $result = $db->getSelect($insert, [
        ":photo" => $photo["path"],
        ":nom_employe" => $nom_employe,
        ":prenom_employe" => $prenom_employe,
        ":date_de_naissance" => $date_de_naissance,
        ":nationalite" => $nationalite,
        ":date_embauche" => $date_embauche,
        ":statut" => $statut,
        ":sexe" => $sexe,
        ":numero_securite_sociale" => $key,
        ":date_de_depart" => $date_de_depart,
        ":poste_occupe" => $poste_occupe,
        ":salaire" => $salaire,
        ":tel" => $tel,
        ":adresse" => $adresse,
        ":email" => $email,
    ]);
    $employe = getEmployeBy("email",$email);
    $idjob = $employe["poste_occupe"];
    $employejob = getJobBy("id",$idjob);
    $employe["job"] = $employejob;
    echo response("Nouvel employé ajouter avec succès.", true,$employe);
    
}else{
    echo response($fe->getError($messages));
}
