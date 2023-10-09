<?php 
function checkRole(){
    session_start(); // Vous devez commencer la session avant d'accéder à $_SESSION
    $sessionuser = $_SESSION["sessionuser"];
    $role = "ROLE_USER";
    $roles = json_decode($sessionuser["role"], true); // Ajoutez le deuxième argument pour obtenir un tableau associatif
    if(isset($sessionuser) && is_array($roles)){
        if(in_array("ROLE_EMPLOYEE", $roles)){
            $role = "ROLE_EMPLOYEE";
        }
        if(in_array("ROLE_ADMIN_SYSTEM_RH", $roles)){
            $role = "ROLE_ADMIN_SYSTEM_RH";
        }
        if(in_array("ROLE_ADMIN_RH", $roles)){
            $role = "ROLE_ADMIN_RH";
        }
        if(in_array("ROLE_MANAGER", $roles)){
            $role = "ROLE_MANAGER";
        }
        if(in_array("ROLE_RECRUITER", $roles)){
            $role = "ROLE_RECRUITER";
        }
        if(in_array("ROLE_TRAINING_MANAGER", $roles)){
            $role = "ROLE_TRAINING_MANAGER";
        }
        if(in_array("ROLE_Payroll_Administrator", $roles)){
            $role = "ROLE_Payroll_Administrator";
        }
        if(in_array("ROLE_Health_and_Safety_Officer", $roles)){
            $role = "ROLE_Health_and_Safety_Officer";
        }
        if(in_array("ROLE_General_HR_User", $roles)){
            $role = "ROLE_General_HR_User";
        }
    }
    return $role;
}
