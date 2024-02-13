<?php
include $_SERVER["DOCUMENT_ROOT"].'/core/database.php';
header('content-type: application/json');
if($loggedin !== 'yes') {
	exit(json_encode(["success"=>false,"message"=>"Please login"]));
}
if(!isset($_REQUEST["daytime"])) {
	exit(json_encode(["success"=>false,"message"=>"No daytime has been put"]));
}
$daytime = (int)$_REQUEST["daytime"];
if($datetime > 23 || $datetime < 0) {
	$daytime = 12;
}
$q = $db->prepare("UPDATE users SET renderDaytime = :daytime WHERE id = :id");
$q->bindParam(':daytime', $daytime, PDO::PARAM_INT);
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