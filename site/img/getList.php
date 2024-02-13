<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
if($_REQUEST["apikey"] !== $_RENDERSERVER["apiKey"]) exit("Wrong api key!");

$time = time();
$q = $db->prepare("UPDATE renderserver SET lastPing = :time");
$q->bindParam(':time', $time, PDO::PARAM_INT);
$q->execute();
  
  $stmt = $db->prepare('SELECT render_id, type, version FROM renders ORDER BY id ASC LIMIT 1;');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if($stmt->rowCount() == 0) {
    echo 'no-render';
  } else {
        if($result['type'] == 'server') {
            header('content-type: text/plain');
            echo 'no-render';
        } else {
	    $name = null;
	    if($result["type"] === "user") {
            	$q = $db->prepare("SELECT id, username FROM users WHERE id = :id");
	    	$q->bindParam(':id', $result["render_id"], PDO::PARAM_INT);
	    	$q->execute();
	    	$usr = $q->fetch();
		$name = $usr["username"];
	    }
            header('content-type: application/json');
            echo json_encode(["type"=>$result["type"],"userid"=>$result["render_id"],"name"=>$name]);
        }
  }