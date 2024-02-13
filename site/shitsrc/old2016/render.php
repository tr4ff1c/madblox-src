<?php

require_once("config.php");

$script = '

local plr = game.Players:CreateLocalPlayer(1)
plr:LoadCharacter()

plr.Character.Torso.BrickColor = BrickColor.new("'.$_USER["TorsoColor"].'")
plr.Character.Head.BrickColor = BrickColor.new("'.$_USER["HeadColor"].'")
plr.Character["Right Leg"].BrickColor = BrickColor.new("'.$_USER["RightLegColor"].'")
plr.Character["Right Arm"].BrickColor = BrickColor.new("'.$_USER["RightArmColor"].'")
plr.Character["Left Leg"].BrickColor = BrickColor.new("'.$_USER["LeftLegColor"].'")
plr.Character["Left Arm"].BrickColor = BrickColor.new("'.$_USER["LeftArmColor"].'")


print("'.$_USER['username'].' just rendered!")

local result = game:GetService("ThumbnailGenerator"):Click("PNG", 840, 840, true)
return result

';

$render = $RCCServiceSoap->execScript($script, rand(1,getrandmax()), 120);

$path = "renders/".$_USER['id'].".png";

file_put_contents($path, base64_decode($render));
?>
<script>
history.go(-1)  
</script>
<?php exit; ?>