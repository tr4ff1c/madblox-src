<?php
	if (isset($_GET['id'])) {
		$datafile = (int)$_GET['id'];
	}else{
		exit;
	}

  include_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');

$itemq = $db->prepare("SELECT * FROM games WHERE id=?");
$itemq->execute([$datafile]);
$item = $itemq->fetch(PDO::FETCH_ASSOC);

?>
game:Load("http://finobe.lol/ast/places/get?id=<?php if(isset($_GET['id'])) {echo (int)$_GET['id'];} else {echo 0;} ?>&apikey=<?php echo $_GET['apikey'] ?? ""; ?>")