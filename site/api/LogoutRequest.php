<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
if(!$loggedin) {
    header('location: /');
    exit;
}
if(!isset($_REQUEST["all"])) {
    $q = $db->prepare("DELETE FROM sessions WHERE sessKey = :session");
    $q->bindParam(':session', $_COOKIE["_MADBLOXSESSION"], PDO::PARAM_STR);
    $q->execute();
} else {
    $q = $db->prepare("DELETE FROM sessions WHERE userId = :id");
    $q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
    $q->execute();
}
setSessionCookie(null);
header('location: /');