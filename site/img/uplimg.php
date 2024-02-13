<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
    $apikey = $_GET['apikey'];
    if ($apikey !== $_RENDERSERVER["apiKey"]){
        exit("FUCK YOU wrong api key!!");
    }else{
        $yes = 'yes';
    }
$time = time();
$q = $db->prepare("UPDATE renderserver SET lastPing = :time");
$q->bindParam(':time', $time, PDO::PARAM_INT);
$q->execute();
    $image64 = $_REQUEST["image"];//file_get_contents('php://input');
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
    if ($type == "place"){
        $type = "games";
    }
    if (file_exists("../img/$type/$userid.png")){
        unlink("../img/$type/$userid.png");
        $file = "../img/$type/$userid.png";
        file_put_contents($file, $image);
    } else {   
        $file = "../img/$type/$userid.png";
        file_put_contents($file, $image);
    }
    exit("Sigma!");

?>