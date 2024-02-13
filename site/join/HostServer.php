<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");
header('Content-Type:text/plain');
$id = (int)$_GET["game"];
$stmt = $db->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

?>
Port = <?php if(isset($_GET['port'])) {echo (int)$_GET['port'];} else {echo 53640;} ?> 
Server =  game:GetService("NetworkServer") 
HostService = game:GetService("RunService")
Server:Start(Port,20) 
game:GetService("RunService"):Run() 
print("Rowritten server started!") 
function onJoined(NewPlayer) 
print("New player found: "..NewPlayer.Name.."")
NewPlayer:LoadCharacter() 
while wait() do 
if NewPlayer.Character.Humanoid.Health == 0 then
wait(5) 
NewPlayer:LoadCharacter()
elseif NewPlayer.Character.Parent  == nil then 
wait(5) 
NewPlayer:LoadCharacter()
end 
end 
end 
game.Players.PlayerAdded:connect(onJoined) 
game.Players.PlayerAdded:connect(function(PlayerAdded)

game:httpGet("http://finobe.lol/api/addplayer?gameid=<?php echo $id;?>")
banned = game:httpGet("http://finobe.lol/api/isBanned?id="..PlayerAdded.Name)
if banned == "true" then
print(PlayerAdded.Name.." is banned")
end

end)
game.Players.PlayerRemoving:connect(function(PlayerRemoved)

game:httpGet("http://finobe.lol/api/removeplayer?gameid=<?php echo $id;?>")

end)


