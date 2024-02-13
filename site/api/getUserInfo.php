<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");
header('content-type: application/json');
if($loggedin !== "yes") {
    exit(json_encode(["success"=>false,"message"=>"Please log-in"]));
}
if(!isset($_REQUEST["id"])) {
    exit(json_encode(["success"=>false,"message"=>"Please put an ID"]));
}
$id = (int)$_REQUEST["id"] ?? 0;
$q = $db->prepare("SELECT * FROM users WHERE id = :id");
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();
$user = $q->fetch();
if(!$user) {
    exit(json_encode(["success"=>false,"message"=>"User does not exist"]));
}
$ban = [
    "banned" => false,
    "type" => "None"
];
$q = $db->prepare("SELECT * FROM bans WHERE userid = :id");
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();
$banrow = $q->fetch();
if($banrow && $banrow["typeBan"] !== "None") {
    $ban = [
        "banned" => true,
        "type" => $banrow["typeBan"]
    ];
}
echo json_encode([
    "success"         => true,
    "id"              => (int)$user["id"],
    "username"        => $user["username"],
    "blurb"           => filterText($user["blurb"]),
    "blurbUnfiltered" => $user["blurb"],
    "permissions"     => $user["USER_PERMISSIONS"],
    "joindate"        => $user["joindate"],
    "lastseen"        => $user["lastseen"],
    "madbux"          => (int)$user["mlgbux"],
    "tickets"         => (int)$user["tickets"],
    "ban"             => $ban
], JSON_PRETTY_PRINT);