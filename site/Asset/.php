<?php
$id = (int)$_GET["id"];
if(file_exists(__DIR__."/Assets/".$id.".php")) {
    header('content-type: text/xml');
    // file exists REAL
    echo base64_decode(file_get_contents(__DIR__."/Assets/".$id.".php"));
    // require_once(__DIR__."/Assets/".$id.".php");
} else {
    header('location: https://assetdelivery.roblox.com/v1/asset/?'.$_SERVER["QUERY_STRING"]);
    exit;
    $a = curl_init('https://assetdelivery.roblox.com/v1/asset/?'.$_SERVER["QUERY_STRING"]);
    curl_setopt($a, CURLOPT_RETURNTRANSFER, true);
    $result = base64_encode(str_replace('roblox.com','finobe.lol',curl_exec($a)));
    //die(base64_decode($result));
    echo base64_decode($result);
    file_put_contents(__DIR__."/assets/".$id.".php", $result);
    exit;
}