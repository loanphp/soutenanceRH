<?php
function canRecruit(array|null $user = null){
   if($user !== null && count($user) > 0){
    $roles = json_decode($user["role"]);
    if(in_array("ROLE_ADMIN_SYSTEM_RH" ,$roles) || in_array("ROLE_ADMIN_RH", $roles)){
        return true;
    }
   }
    return false;
}
function canManageLeave(array|null $user = null){
    if($user !== null && count($user) > 0){
        $roles = json_decode($user["role"]);
        if(in_array("ROLE_RESPONSIBLE_LEAVE",$roles)){
            return true;
        }
    }

    return false;
}
function isLogged(){
    if(isset($_SESSION["sessionuser"])){
        return true;

    }
    return false;
}
function isEmployee(array|null $user = null){
    if($user !== null && count($user) > 0){
        $roles = json_decode($user["role"]);
        if(in_array("ROLE_USER" ,$roles) && in_array("ROLE_EMPLOYEE", $roles)){
            return true;
        }
       }
        return false;
}