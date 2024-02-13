<?php
    $apikey = $_GET['apikey'];
    if ($apikey !== "jv9BkLv8TFfcs67q"){
        exit();
    }else{
        $yes = 'yes';
    }
    $image64 = file_get_contents('php://input');
    $userid = $_GET['uid'];
    $image = base64_decode($image64);
    $type = $_GET['typeofasset'];

    if ($type == "character"){
        $type = "user";
    }
    if ($type == "hats"){
        $type = "catalog/hats";
    }
    if ($type == "heads"){
        $type = "catalog/heads";
    }
    if ($type == "shirts"){
        $type = "catalog/shirts";
    }
    if ($type == "pants"){
        $type = "catalog/pants";
    }
    if (file_exists("../img/$type/$userid.png")){
        unlink("../img/$type/$userid.png");
        $file = "../img/$type/$userid.png";
        file_put_contents($file, $image);
    } else {   
        $file = "../img/$type/$userid.png";
        file_put_contents($file, $image);
    }

?>