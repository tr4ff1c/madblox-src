<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/core/database.php");
$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);
if ($loggedin !== 'yes') {
    header('location: /');
}

$sqlcacad = $db->prepare("SELECT * FROM renders WHERE render_id=? AND type='user'");
$sqlcacad->execute([$_USER['id']]);
$cacad = $sqlcacad->rowCount();
if($cacad > 0){
    //exit("Please wait for ur character to render.");
}

$sql = "DELETE FROM `wearing` WHERE `wearing`.`itemid` = :itemid AND `userid` = :userid";
$stmt = $db->prepare($sql);
$stmt->bindParam(':itemid', $id, PDO::PARAM_INT);
$stmt->bindParam(':userid', $_USER["id"], PDO::PARAM_INT);
$stmt->execute();

header("location: ../api/render.php");

?>
