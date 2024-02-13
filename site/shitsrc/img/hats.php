<?php
	if (isset($_GET['id'])) {
		$datafile = (int)$_GET['id'];
	}else{
		exit;
	}

  include_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');

$itemq = $db->prepare("SELECT * FROM catalog WHERE id=?");
$itemq->execute([$datafile]);
$item = $itemq->fetch(PDO::FETCH_ASSOC);

$hatshit = "http://".$sitedomain."/asste/?id=".$item['assetid']."";

?>
game:Load("<?=$hatshit?>");
local p = game:GetChildren()
for i = 1, #p do
if p[i].className == "Hat" then
p[i].Parent = game.Workspace
end
end