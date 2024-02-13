<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
if($loggedin !== "yes"){
    header("location: /Login/NewAge.aspx");
    exit;
}
$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

$findq = $db->prepare("SELECT * FROM friends WHERE id=? AND user_to=? AND areFriends=0 AND declined=0");
$findq->execute([$id, $_USER['id']]);
if($rows = $findq->rowCount() && $rows < 1){
    header("location: /");
    exit;
}else{
    $update = $db->prepare("UPDATE friends SET declined=1 WHERE id=?");
    $update->execute([$id]);
    header("location: /");
    exit;
}
?>