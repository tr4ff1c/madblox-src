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
$q = $db->prepare("SELECT * FROM serversrq WHERE gameserver = :id ORDER BY id DESC LIMIT 1");
$q->bindParam(':id', $gameserver["id"], PDO::PARAM_INT);
$q->execute();
$rq = $q->fetch();
if(!$rq) {
    exit("no-games");
} else {
    exit(json_encode(["id"=>$rq["id"],"action"=>$rq["action"],"value1"=>$rq["value1"],"value2"=>$rq["value2"]]));
}