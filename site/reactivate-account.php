<?php
include($_SERVER['DOCUMENT_ROOT']."/core/database.php");

$_BANQ = $db->prepare("SELECT * FROM bans WHERE userid=:id");
$_BANQ->execute([':id' => $_USER['id']]);
$_BAN = $_BANQ->fetch(PDO::FETCH_ASSOC);
$banrows = $_BANQ->rowCount();

if($banrows > 0){
$banned = true;
}

if($_BAN['typeBan'] == 'deleted') {die("Your account was blocked, Cannot reactivate");}
if($_BAN['typeBan'] == '1day'){
if ($_BAN['unbantime'] > time()) {
die("You cannot reactivate your account for now.");
}
}
$unbanq = $db->prepare("UPDATE `bans` SET `typeBan` = 'None', `reason` = '' WHERE `bans`.`id` = ?");
$unbanq->execute([$_BAN['id']]);

header('location: /');
exit;
?>
