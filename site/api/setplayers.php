<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
$id = (int)$_REQUEST["gameid"] ?? 0;
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
$newCount = $_REQUEST["count"] += 1;
$q = $db->prepare("UPDATE games SET players = :new WHERE id = :id");
$q->bindParam(':new', $newCount, PDO::PARAM_INT);
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();
/*if($game["players"] <= 1) {
    $q = $db->prepare("INSERT INTO serversrq (id, action, value1, value2, gameserver) VALUES (NULL, 'stop-game', :value1, :value2, :gameserver)");
    $q->bindParam(':value1', $game["id"], PDO::PARAM_INT);
    $q->bindParam(':value2', $game["port"], PDO::PARAM_INT);
    $q->bindParam(':gameserver', $game["gameserver"], PDO::PARAM_INT);
    $q->execute();
}*/