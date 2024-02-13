<?php

require_once("config.php");

$script = '

local plr = game.Players:CreateLocalPlayer(1)
plr:LoadCharacter()
game:GetService("ScriptContext").ScriptsDisabled = false

                        local AngleOffsetX = 0
                        local AngleOffsetY = 0
                        local AngleOffsetZ = 0

                        local CameraAngle = plr.Character.Head.CFrame * CFrame.new(AngleOffsetX, AngleOffsetY, AngleOffsetZ)
                        local CameraPosition = plr.Character.Head.CFrame + Vector3.new(0, 0, 0) + (CFrame.Angles(0, -0.2, 0).lookVector.unit * 3)

                        local Camera = Instance.new("Camera", plr.Character)
                        Camera.Name = "ThumbnailCamera"
                        Camera.CameraType = Enum.CameraType.Scriptable
                        
			FOV = 30

                        Camera.CoordinateFrame = CFrame.new(CameraPosition.p, CameraAngle.p)
                        Camera.FieldOfView = FOV
                        workspace.CurrentCamera = Camera
print("'.$_USER['username'].' just rendered!")

local result = game:GetService("ThumbnailGenerator"):Click("PNG", 256, 256, true)
return result

';

$render = $RCCServiceSoap->execScript($script, rand(1,getrandmax()), 120);

$path = "renders/".$_USER['id']."-headshot.png";

file_put_contents($path, base64_decode($render));
?>
<script>
history.go(-1)  
</script>
<?php exit; ?>