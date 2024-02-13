<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
$id = (int)$_REQUEST["id"] ?? 0;
$apikey = $_REQUEST["apikey"] ?? "";
$q = $db->prepare("SELECT * FROM gameservers WHERE apikey = :apikey");
$q->bindParam(':apikey', $apikey, PDO::PARAM_STR);
$q->execute();
$gameserver = $q->fetch();
if(!$gameserver) {
    exit("Wrong API Key!");
}
$q = $db->prepare("SELECT * FROM games WHERE id = :id");
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();
$game = $q->fetch();
if(!$game) {
    exit("Game does not exist!");
}
if($game["gameserver"] !== $gameserver["id"]) {
    exit("This game does not use this gameserver!");
}
echo file_get_contents("files/".$game["id"].".rbxl");