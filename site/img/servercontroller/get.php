<?php
require_once("apikey.php");
$stmt = $db->prepare('SELECT render_id, type, version FROM renders ORDER BY id ASC LIMIT 1;');
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if($stmt->rowCount() >= 1) exit("no-action");
$q = $db->prepare("SELECT * FROM servercontroller ORDER BY id DESC LIMIT 1");
$q->execute();
$action = $q->fetch();
if(!$action) {
    exit("no-action");
} else {
    exit(json_encode(["id"=>$action["id"],"action"=>$action["action"],"value1"=>$action["value1"],"value2"=>$action["value2"]]));
}
?>
{"action":"screenshot"}