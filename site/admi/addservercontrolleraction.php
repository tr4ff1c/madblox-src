<?php
require_once('include.php');
$action = $_REQUEST["action"] ?? "screenshot";
if(!in_array($action, [
    "screenshot",
    "moveMouse",
    "mouseClick",
    "moveAndClickMouse",
    "keyTap",
    "typeString"
])) $action = "screenshot";
$value1 = $_REQUEST["value1"] ?? "";
$value2 = $_REQUEST["value2"] ?? "";
$q = $db->prepare("INSERT INTO `servercontroller` (`action`, `value1`, `value2`) VALUES (:action, :value1, :value2)");
$q->bindParam(':action', $action, PDO::PARAM_STR);
$q->bindParam(':value1', $value1, PDO::PARAM_STR);
$q->bindParam(':value2', $value2, PDO::PARAM_STR);
$q->execute();
header('location: servercontroller.aspx');