<?php error_reporting(0); ?>
Port = <?php if(isset($_GET['port'])) {echo (int)$_GET['port'];} else {echo 53640;} ?>

Server = game:GetService("NetworkServer")

HostService = game:GetService("RunService")

Server:Start(Port,20)

game:Load("http://madblxx.tk/ast/places/get?id=<?php if(isset($_GET['id'])) {echo (int)$_GET['id'];} else {echo 0;} ?>&apikey=<?php echo $_GET['apikey'] ?? ""; ?>")

game:GetService("RunService"):Run()

print("Rowritten server started!")

function onJoined(NewPlayer)
    print("Player joined: "..NewPlayer.Name.."")
    print("Checking for account code...")
    check = game:httpGet("http://local.madblxx.tk/api/checkAccountCode?code="..NewPlayer.Name.."&apikey=<?php echo $_GET['apikey'] ?? ""; ?>")
    if check == "#cant-join" then
        NewPlayer:remove()
    else
        --NewPlayer.Name = check
        NewPlayer:LoadCharacter()
        while wait() do
            if NewPlayer.Character.Humanoid.Health == 0 then
                wait(5)
                NewPlayer:LoadCharacter()
            elseif NewPlayer.Character.Parent == nil then
                wait(5)
                NewPlayer:LoadCharacter()
            end
        end
    end
end

game.Players.PlayerAdded:connect(onJoined)

game.Players.PlayerAdded:connect(function(PlayerAdded)
    count = #game.Players:GetPlayers()
    game:httpGet("http://madblxx.tk/api/setplayers?gameid=<?php echo $_GET['id'];?>&count="..count.."&apikey=<?php echo $_GET['apikey'] ?? ""; ?>")
    --game:httpGet("http://madblxx.tk/api/addplayer?gameid=<?php echo $_GET['id'];?>&id="..PlayerAdded.userId.."&apikey=<?php echo $_GET['apikey'] ?? ""; ?>")
end)

game.Players.PlayerRemoving:connect(function(PlayerRemoved)
    count = #game.Players:GetPlayers()
    game:httpGet("http://madblxx.tk/api/setplayers?gameid=<?php echo $_GET['id'];?>&count="..count.."&apikey=<?php echo $_GET['apikey'] ?? ""; ?>")
    --game:httpGet("http://madblxx.tk/api/removeplayer?gameid=<?php echo $_GET['id'];?>&id="..PlayerRemoved.userId.."&apikey=<?php echo $_GET['apikey'] ?? ""; ?>")
end)