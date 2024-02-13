<?php
include($_SERVER["DOCUMENT_ROOT"]."/core/head.php");

$id = (int)$_GET["id"] ?? 0;
$gameq = $db->query("SELECT * FROM games WHERE id='$id'");
$game = $gameq->fetch(PDO::FETCH_ASSOC);

$stmt = $db->prepare("SELECT * FROM games WHERE id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);

$creatorq = $db->query("SELECT * FROM users WHERE id='".$game['creatorid']."'");
$creator = $creatorq->fetch(PDO::FETCH_ASSOC);

$creator_query = $db->prepare("SELECT * FROM users WHERE id=:id");
$creator_query->bindParam(':id', $game['creatorid']);
$creator_query->execute();



$creator = $creator_query->fetch(PDO::FETCH_ASSOC);

if($creator['id'] == $_USER['id']) {
}else{
    die("<h1>You do not own this place.</h1>");
    exit;
}

$q = $db->prepare("INSERT INTO serversrq (id, action, value1, value2, gameserver) VALUES (NULL, 'stop-game', :value1, :value2, :gameserver)");
$q->bindParam(':value1', $game["id"], PDO::PARAM_INT);
$q->bindParam(':value2', $game["port"], PDO::PARAM_INT);
$q->bindParam(':gameserver', $game["gameserver"], PDO::PARAM_INT);
$q->execute();

header('location: /PlaceItem.aspx?ID='.$id);