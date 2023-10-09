<?php

function upload_file(string $file, string $destination, string $key = ""){
        $name = strip_tags(trim($_FILES[$file]["name"]));
        $tmp_name = strip_tags(trim($_FILES[$file]["tmp_name"]));
        $type = strip_tags(trim($_FILES[$file]["type"]));
        $extension = preg_split("#/#", $type);
        // if($type == "image/jpeg" || $type == "image/png"){
            $destination = $destination.'/'.$key.$name;
            move_uploaded_file($tmp_name, $destination);
            return [
                "name" => $key.$name,
                "type" => $type,
                "tmp_name" => $tmp_name,
                "path" => $destination,
                "extension" => $extension[1]
            ];

        // }return null;

   

}
