<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/database.php';
header('content-type: application/json');
if($loggedin !== 'yes') {
	exit(json_encode(["success"=>false,"message"=>"Please login"]));
}
if(!isset($_REQUEST["position"])) {
	exit(json_encode(["success"=>false,"message"=>"No position has been put"]));
}
$position = $_REQUEST["position"];
if(!in_array($position, [
	"default",
	"siu",
	"walk",
	"sit",
	"lefthand",
	"righthand",
	"wave"
])) {
	$position = "default";
}
$q = $db->prepare("UPDATE users SET renderPosition = :position WHERE id = :id");
$q->bindParam(':position', $position, PDO::PARAM_STR);
$q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
$q->execute();

if(!$_REQUEST["norender"]) {
	$q = $db->prepare("SELECT * FROM renders WHERE render_id = :id AND type='user'");
	$q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
	$q->execute();

	if($q->rowCount() <= 0) {
		$q = $db->prepare("INSERT INTO renders (id, render_id, type, version) VALUES (NULL, :id, 'user', '1')");
		$q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
		$q->execute();
	}
}

exit(json_encode(["success"=>true]));