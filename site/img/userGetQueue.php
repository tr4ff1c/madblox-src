<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
header('content-type: application/json');
if($loggedin !== "yes") {
	exit(json_encode(["success"=>false,"message"=>"Not logged in"]));
}

$q = $db->prepare("SELECT * FROM renders");
$q->execute();
$renders = $q->fetchAll();
$allRows = count($renders);

$q = $db->prepare("SELECT * FROM renders WHERE render_id = :id");
$q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
$q->execute();
$render = $q->fetch();
if(!$render) {
	exit(json_encode(["success"=>true,"inqueue"=>false,"allRows"=>$allRows,"rsLastPing"=>(time() - $_RENDERSERVER["lastPing"])]));
}

$temp = 0;
$queuePlace = 1;
foreach ($renders as $index => $r) {
    if ($r['render_id'] === $render['render_id']) {
        $queuePlace = $index + 1;
        break;
    }
}

echo json_encode(["success"=>true,"inqueue"=>true,"queuePlace"=>$queuePlace,"allRows"=>$allRows,"rsLastPing"=>(time() - $_RENDERSERVER["lastPing"])]);