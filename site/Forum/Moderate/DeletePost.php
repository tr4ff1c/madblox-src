<?php
require ("../../core/database.php");

if($_USER['USER_PERMISSIONS'] !== 'Administrator') {header('location: /Forum/Default.aspx');exit;}

if(!isset($_REQUEST["PostID"])) {header('location: /Forum/Default.aspx');exit;}

$id = (int)$_REQUEST["PostID"];

$q = $db->prepare("DELETE FROM forum WHERE reply_to = :id");
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();

$q = $db->prepare("DELETE FROM forum WHERE id = :id");
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();

header('location: /Forum/Default.aspx');