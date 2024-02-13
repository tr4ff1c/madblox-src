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
plr.Head.BrickColor = BrickColor.New("White")
plr.Torso.BrickColor = BrickColor.New("White")
plr["Right Arm"].BrickColor = BrickColor.New("White")
plr["Right Leg"].BrickColor = BrickColor.New("White")
plr["Left Arm"].BrickColor = BrickColor.New("White")
plr["Left Leg"].BrickColor = BrickColor.New("White")
local Pant = Instance.new("Pants", game.Players.LocalPlayer.Character)
Pant.PantsTemplate = "<?=$item['filename']?>";