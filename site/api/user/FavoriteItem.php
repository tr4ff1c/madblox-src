<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
if(!isset($_GET['itemid'])){
    die("Wrong input for api request.");
    exit;
}

if($loggedin != "yes"){
    header("location: /Default.aspx");
    exit;
}

$iid = filter_var($_GET['itemid'], FILTER_SANITIZE_NUMBER_INT);

$itemq = $db->prepare("SELECT * FROM catalog WHERE id=?");
$itemq->execute([$iid]);
$item = $itemq->fetch(PDO::FETCH_ASSOC);

$a = $db->prepare("SELECT * FROM favorites WHERE userid=? AND itemid=?");
$a->execute([$_USER['id'], $iid]);
$b = $a->rowCount();

if($b > 0){
	die("Already favorited");
}else{
	 $stmt = $db->prepare("INSERT IGNORE INTO favorites (id, userid, itemid, whenFavorited, type) VALUES (NULL, ?, ?, NOW(), ?)");
	 $stmt->execute([$_USER['id'], $iid, $item['type']]);
         header("location: /Item.aspx?id=".$iid);
	 exit;
}
?>