<?php

class FormException {
    public function emptyField(array $fields) {
        $errors = [];

        foreach ($fields as $key => $value) {
            if (isset($_FILES[$key]) && $_FILES[$key]["error"] !== 0) {
                $errors[$key] = "Le champ $value est obligatoire.";
            } elseif ($key !== "files" && isset($_POST[$key])) {
                $fieldValue = $_POST[$key];

                if (is_array($fieldValue) && empty($fieldValue)) {
                    $errors[$key] = "Le champ $value est obligatoire.";
                    
                }
                if (is_string($fieldValue) && $fieldValue === "") {
                    $errors[$key] = "Le champ $value est obligatoire.";
                    
                }
            } else {
                if($key!=="files"){
                    $errors[$key] = "Le champ $value n'a pas pu être récupéré.";
        
                }
            }
        }

        return $errors;
    }
    public function getError(array $errors){
        $keys = array_keys($errors);
        $key = $keys[0];
        $error = $errors[$key];
        return $error;

    }
}
