<?php
session_start();

ini_set('error_reporting', false);

if(
    !isset($_SESSION["loggedin"]) ||
    !isset($_SESSION["id"])
) {
    $_SESSION["loggedin"] = false;
    $_SESSION["id"] = null;
}

// error_reporting(0);

$sitename = "SIGMABLOXXER";
$sitedomain = "finobe.lol";
$title = $sitename.": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics";
$rccport = 35518;

$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';

$loggedin = false;
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("db connection failed: " . $e->getMessage());
}

/* No more sigma site... :(
$ch = curl_init("https://miimak.xyz/Default.aspx");
curl_exec($ch);
exit; */
/* OHHHHHHHHHHHH
header('location: https://lomando.com/pse/kbsmkoe.mp3');
exit; */

$_USER = [
    "id" => 0,
    "username" => null
];
$uid = 0;
if($_SESSION["loggedin"] && $_SESSION["id"]) {
    $uid = (int)$_SESSION["id"];
}
if($uid) {
    $_USERQ = $db->prepare("SELECT * FROM users WHERE id = :id");
    $_USERQ->execute([':id' => $uid]);
    $_USER = $_USERQ->fetch(PDO::FETCH_ASSOC);
}

if($_USER && $_USER["id"] !== 0) {
    $loggedin = true;
}

if($loggedin) {
    $currenttime = time();

    $q = $db->prepare("UPDATE users SET `lastseen` = :currenttime WHERE id=:id");
    $q->bindParam(':currenttime', $currenttime, PDO::PARAM_INT);
    $q->bindParam(':id', $_USER['id'], PDO::PARAM_INT);
    $q->execute();
}
