<?php require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");
if($loggedin == 'no'){ header('location: /'); exit(); }
if($_USER['USER_PERMISSIONS'] !== 'Administrator') { header('location: /'); exit; }
include($_SERVER["DOCUMENT_ROOT"]."/core/head.php");
?>
