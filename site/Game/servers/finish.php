<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
$apikey = $_REQUEST["apikey"] ?? "";
$q = $db->prepare("SELECT * FROM gameservers WHERE apikey = :apikey");
$q->bindParam(':apikey', $apikey, PDO::PARAM_STR);
$q->execute();
$gameserver = $q->fetch();
if(!$gameserver) {
    exit("Wrong API Key!");
}
$q = $db->prepare("SELECT * FROM serversrq WHERE gameserver = :id LIMIT 1");
$q->bindParam(':id', $gameserver["id"], PDO::PARAM_INT);
$q->execute();
$rq = $q->fetch();
if($rq["action"] === "stop-game") {
    $ports = json_decode($gameserver["usedPorts"]);
    $key = array_search((int)$rq["value2"], $ports);
    if($key !== false) unset($ports[$key]);
    $ports = json_encode($ports);
    
    $q = $db->prepare("UPDATE gameservers SET usedPorts = :ports WHERE id = :id");
    $q->bindParam(':ports', $ports, PDO::PARAM_STR);
    $q->bindParam(':id', $gameserver["id"], PDO::PARAM_INT);
    $q->execute();

    $q = $db->prepare("UPDATE games SET players = 0 WHERE id = :id");
    $q->bindParam(':id', $rq["value1"], PDO::PARAM_INT);
    $q->execute();
}
$q = $db->prepare("DELETE FROM serversrq WHERE gameserver = :id LIMIT 1");
$q->bindParam(':id', $gameserver["id"], PDO::PARAM_INT);
$q->execute();