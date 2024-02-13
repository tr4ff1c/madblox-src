<?php
require_once("apikey.php");
$q = $db->prepare("DELETE FROM servercontroller WHERE id = :id");
$q->bindParam(':id', $_REQUEST["id"], PDO::PARAM_INT);
$q->execute();