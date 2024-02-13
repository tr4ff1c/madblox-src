<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");
if(strlen($_GET['accountcode']) <= 0) {
exit("--no account code");
}
$stmt = $db->prepare("SELECT * FROM users WHERE accountcode=:accountcode");
$stmt->bindParam(':accountcode', htmlspecialchars($_GET['accountcode']));
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$user) {
exit("--user not found");
}

$q = $db->prepare("SELECT * FROM bans WHERE userid = :id");
$q->bindParam(':id', $user["id"], PDO::PARAM_INT);
$q->execute();
$ban = $q->fetch();
if($ban && $ban["typeBan"] !== "None") {
   $type = "Account Deleted";
   if($ban["typeBan"] === "reminder") $type = "Reminder";
   if($ban["typeBan"] === "warning") $type = "Warning";
   if($ban["typeBan"] === "1day") $type = "1 day ban";
   if($ban["typeBan"] === "3day") $type = "3 days ban";
   if($ban["typeBan"] === "7days") $type = "7 days ban";
   if($ban["typeBan"] === "14days") $type = "14 days ban";
   exit('game:SetMessage("'.$type.': '.$ban["reason"].'")
wait(math.huge)');
}

$stmt = $db->prepare("SELECT * FROM games WHERE id=:id");
$stmt->bindParam(':id', htmlspecialchars((int)$_GET['placeid']), PDO::PARAM_INT);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);

$ip = $game['ip'];
$port = $game['port'];
if($game["gameserver"]) {
   $q = $db->prepare("SELECT * FROM gameservers WHERE id = :id");
   $q->bindParam(':id', $game["gameserver"], PDO::PARAM_INT);
   $q->execute();
   $gameserver = $q->fetch();
   if($gameserver) $ip = $gameserver["ip"];
}
$userid = (int)$user['id'];
$username = $user['username'];
$customerrorenabled = 'no';
$customerror = '';

$sql4 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt4 = $db->prepare($sql4);
$stmt4->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt4->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt4->execute();
$result4 = $stmt4->fetchAll();

if (count($result4) > 0 || $row4['type'] == 'hat') {
        $row4 = $result4['0'];
        $itemq4 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq4->bindValue(':itemid', $row4['itemid'], PDO::PARAM_INT);
        $itemq4->bindValue(':type', $row4['type'], PDO::PARAM_STR);
        $itemq4->execute();
        $item4 = $itemq4->fetch(PDO::FETCH_ASSOC);
        if ($row4['type'] == 'hat'){ $echothing4 = "".$item4['assetlink'].""; }
}

$sql45 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt45 = $db->prepare($sql45);
$stmt45->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt45->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt45->execute();
$result45 = $stmt45->fetchAll();

if (count($result45) > 0 || $row45['type'] == 'hat') {
        $row45 = $result45['1'];
        $itemq45 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq45->bindValue(':itemid', $row45['itemid'], PDO::PARAM_STR);
        $itemq45->bindValue(':type', $row45['type'], PDO::PARAM_STR);
        $itemq45->execute();
        $item45 = $itemq45->fetch(PDO::FETCH_ASSOC);
        if ($row45['type'] == 'hat'){ $echothing45 = "".$item45['assetlink'].""; }
}
  
$sql455 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt455 = $db->prepare($sql455);
$stmt455->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt455->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt455->execute();
$result455 = $stmt455->fetchAll();

if (count($result455) > 0 || $row455['type'] == 'hat') {
        $row455 = $result455['2'];
        $itemq455 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq455->bindValue(':itemid', $row455['itemid'], PDO::PARAM_STR);
        $itemq455->bindValue(':type', $row455['type'], PDO::PARAM_STR);
        $itemq455->execute();
        $item455 = $itemq455->fetch(PDO::FETCH_ASSOC);
        if ($row455['type'] == 'hat'){ $echothing455 = "".$item455['assetlink'].""; }
}
if (count($result4) > 0){
$hatthing = '
local Hat = game:GetObjects("'.$echothing4.'")[1]
Hat.Parent = playr
';
}else{
$hatthing = '';
}
if (count($result45) > 0){
$hatthing2 = '
local Hat2 = game:GetObjects("'.$echothing45.'")[1]
Hat2.Parent = playr
';
}else{
$hatthing2 = '';
}
if (count($result455) > 0){
$hatthing3 = '
local Hat3 = game:GetObjects("'.$echothing455.'")[1]
Hat3.Parent = playr
';
}else{
$hatthing3 = '';
}
?>
local server = "<?php echo $ip; ?>" 
local serverport = <?php echo $port; ?> 
local clientport = 0 
local playername = "<?php echo $username;//$_REQUEST["accountcode"];                                              if($user["USER_PERMISSIONS"] === "Administrator") echo "*"; ?>" 
game:SetMessage("<?php if($customerrorenabled == 'yes') {echo $customerror;} ?>") 
function dieerror(errmsg) 
game:SetMessage(errmsg) 
wait(math.huge) 
end 
local suc, err = pcall(function() 
client = game:GetService("NetworkClient") 
local player = game:GetService("Players"):CreateLocalPlayer(0) 
player:SetSuperSafeChat(false) 
pcall(function() game:GetService("Players"):SetChatStyle(Enum.ChatStyle.ClassicAndBubble) end) 
game:GetService("Visit") 
player.Name = playername
local funeeplayr = game.Players:FindFirstChild("<?php echo $username; ?>") 
game.Players.LocalPlayer.CharacterAppearance = "http://finobe.lol/api/charapp?id=<?php echo $userid; ?>"
player.userId = <?php echo $userid; ?> 
game:ClearMessage() 
end) 
if not suc then 
dieerror(err) 
end 
if not suc then
   dieerror(err)
end
function connected(url, replicator)
   local suc, err = pcall(function()
   local marker = replicator:SendMarker()
   local received = false
    
    local function onWorldReceived()
        pcall(function()
            game:ClearMessage()
        end)
        received = true
    end
    
    marker.Received:connect(onWorldReceived)
    game:SetMessageBrickCount()
   end)
   if not suc then
      dieerror(err)
   end
   marker.Recieved:wait()
   local suc, err = pcall(function()
   game:ClearMessage()
   end)
   if not suc then
      dieerror(err)
   end
end
function rejected()
   dieerror("Connection failed: Rejected by server.")
end
function failed(peer, errcode, why)
   dieerror("Failed<?php //[".. peer.. " ]?>, ".. errcode.. ": ".. why)
end
local suc, err = pcall(function()
client.ConnectionAccepted:connect(connected)
client.ConnectionRejected:connect(rejected)
client.ConnectionFailed:connect(failed)
client:Connect(server, serverport, clientport, 20)
end)
replicator.Disconnection:connect(disconnect)
local marker = nil
pcall(function()
game:SetMessageBrickCount()
marker = replicator:SendMarker()
end)
if not suc then
   local x = Instance.new("Message")
   x.Text = err
   x.Parent = workspace
   wait(math.huge)
end
while true do
   wait(0.001)
   replicator:SendMarker()
end