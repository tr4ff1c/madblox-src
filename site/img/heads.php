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

?>
game.Players:CreateLocalPlayer(1)
game.Players.LocalPlayer:LoadCharacter()
plr = game.Players.LocalPlayer.Character
plr.Head['Mesh']:Remove()
plr.Torso:Remove()
plr['Left Leg']:Remove()
plr['Left Arm']:Remove()
plr['Right Leg']:Remove()
plr['Right Arm']:Remove()
bab = game:GetObjects("<?=$item['filename']?>")[1]
bab.Parent = plr.Head
plr.Head.BrickColor = BrickColor.New("Medium stone grey")