<?php
define('BASE_PATH', __DIR__); 
require_once(BASE_PATH . '/../module/connection.php');
$db = new Database();
function getFoldersEmploye(string $dossier_personnel_id){
    global $db ;
    $sql = "SELECT gs_employes.*, dossiers_du_personnels.* FROM gs_employes
    LEFT JOIN dossiers_du_personnels ON gs_employes.dossier_personnel_id = $dossier_personnel_id";
    $result = $db->getFetchResult($sql);
    return $result->fetch(PDO::FETCH_ASSOC);

}
function getAllEmployes(?array $orderBy=null){
    global $db;
    $query = "SELECT * FROM `gs_employes`";
    if($orderBy!==null){
        $sort = $orderBy['sort'];
        $order = $orderBy['order']??"ASC";
        $query = "SELECT * FROM `gs_employes` ORDER BY `$sort` $order";
    }
    $result = $db->getFetchResult($query);
    return $result;
}
function getLeaveRequest(){
    global $db;
    $query = "SELECT * FROM `conges`";
    $result = $db->getFetchResult($query);
    return $result;
}
function getEmployesImage($id){
    global $db;
    $query = "SELECT `photo` FROM `gs_employes` WHERE `id` =$id";
    $result = $db->getFetchResult($query);
    return $result->fetch(PDO::FETCH_ASSOC);

}
function getOneLeave(?string $id = null){
    global $db;
    if($id==null){
        $session = getSessionUser();
        if(is_array($session) && count($session) > 0){
            $email = $session["email"];
            $employe = getEmployeBy("email",$email);
            if(is_array($employe) && count($employe)>0){
                $id = $employe["id"];
            }
        }
    }
    if($id!==null){
        $query = "SELECT * FROM `conges` WHERE `employe_id` =$id";
        $result = $db->getFetchResult($query);
        return $result->fetch(PDO::FETCH_ASSOC);

    }

}
function getOneEvaluationResponse(?string $id = null){
    global $db;
    if($id!==null){
        $query = "SELECT * FROM `reponse_evaluation` WHERE `id` =$id";
        $result = $db->getFetchResult($query);
        return $result->fetch(PDO::FETCH_ASSOC);

    }

}
function getEvaluationQuestions(){
    global $db;
    $query = "SELECT * FROM `questions_evaluation`";
    $result = $db->getFetchResult($query);
    $gAEQ = $result->fetchAll(PDO::FETCH_ASSOC);
    return $gAEQ;
}
function getAllResponse(){
    global $db;
    $query = "SELECT * FROM `reponse_evaluation`";
    $result = $db->getFetchResult($query);
    $gAEQ = $result->fetchAll(PDO::FETCH_ASSOC);
    return $gAEQ;
}
function getLeaveBy(string $field ,string $value){
    global $db;
    
    $query = "SELECT * FROM `conges` WHERE `$field` = :$field";
    $connect = $db->getConnection();
    $stmt = $connect->prepare($query);
    $stmt->bindParam(":$field", $value, PDO::PARAM_STR);
    $stmt->execute();
    $leave = $stmt->fetch(PDO::FETCH_ASSOC);

    return $leave;
}
function getAllConges(?array $orderBy=null){
    global $db;
    $query = "SELECT * FROM `conges`";
    if($orderBy!==null){
        $sort = $orderBy['sort'];
        $order = $orderBy['order']??"ASC";
        $query = "SELECT * FROM `conges` ORDER BY `$sort` $order";
    }
    $result = $db->getFetchResult($query);
    return $result;
}
function getSessionUser(){
    $user = null;
    if(isset($_SESSION["sessionuser"]) && count($_SESSION["sessionuser"])>0){
        $user = getUser($_SESSION["sessionuser"]["email"]);
    }
    return $user;
    
}
function getUser(string $email) {
    global $db;
    
    // Utilisation d'une requête préparée pour éviter l'injection SQL
    $query = "SELECT * FROM `users` WHERE `email` = :email";
    $connect = $db->getConnection();
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer les données de l'utilisateur sous forme d'un tableau associatif
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}
function getEmployeBy(string $field ,string $value) {
    global $db;
    
    // Utilisation d'une requête préparée pour éviter l'injection SQL
    $query = "SELECT * FROM `gs_employes` WHERE `$field` = :$field";
    $connect = $db->getConnection();
    $stmt = $connect->prepare($query);
    $stmt->bindParam(":$field", $value, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer les données de l'utilisateur sous forme d'un tableau associatif
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;
}
function getDossiersBy(string $field ,string $value){ 
    global $db;
    
    $query = "SELECT * FROM `dossiers_du_personnels` WHERE `$field` = :$field";
    $connect = $db->getConnection();
    $stmt = $connect->prepare($query);
    $stmt->bindParam(":$field", $value, PDO::PARAM_STR);
    $stmt->execute();

    $dossier = $stmt->fetch(PDO::FETCH_ASSOC);

    return $dossier;
}
function getQuestionBy(string $field ,string $value) {
    global $db;
    
    // Utilisation d'une requête préparée pour éviter l'injection SQL
    $query = "SELECT * FROM `questions_evaluation` WHERE `$field` = :$field";
    $connect = $db->getConnection();
    $stmt = $connect->prepare($query);
    $stmt->bindParam(":$field", $value, PDO::PARAM_STR);
    $stmt->execute();

    // Récupérer les données de l'utilisateur sous forme d'un tableau associatif
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    return $question;
}
function getJob(){
    global $db;
    $query = "SELECT * FROM `job`";
    $result = $db->getFetchResult($query);
    return $result;  
}
function getJobBy(string $field , string $value){
    global $db;
    $query = "SELECT * FROM `job` WHERE `$field` = :$field";
    $connect = $db->getConnection();
    $stmt = $connect->prepare($query);
    $stmt->bindParam(":$field", $value, PDO::PARAM_STR);
    $stmt->execute();  
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user;

}
function setRole(string $user_email, string $role){
    global $db;
    $request = $db->getConnection();
    $currentRoles = json_decode(getUser($user_email)["role"], true);
    if (!in_array($role, $currentRoles)) {
        $currentRoles[] = $role;
        $newRole = json_encode($currentRoles);
        $query = "UPDATE `users` SET `role` = :newRole WHERE `email` = :user_email";
        $statement = $request->prepare($query);
        $statement->bindParam(':newRole', $newRole, PDO::PARAM_STR);
        $statement->bindParam(':user_email', $user_email, PDO::PARAM_STR);        
        try {
            $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du rôle : " . $e->getMessage();
        }
    }
}
function getAllEvaluationQuestions(){
    global $db;
    $query = "SELECT * FROM `evaluationpoints`";
    $result = $db->getFetchResult($query);
    $gAEQ = $result->fetchAll(PDO::FETCH_ASSOC);
    return $gAEQ;
}

?>