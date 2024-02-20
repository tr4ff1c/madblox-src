<?php header("Content-Type: text/plain");
  if (isset($_GET['id'])) {
    $userid = $_GET['id'];
  }else{
    exit;
  }
  include_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');

  $stmt = $db->prepare("SELECT * FROM users WHERE id=:id");
  $stmt->bindParam(':id', $userid, PDO::PARAM_INT);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $userid = $user['id'];
  
$sql = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt->bindValue(':type', "tshirt", PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll();

if (count($result) > 0 || $row['type'] == 'tshirt') {
    foreach ($result as $row) {
        $itemq = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq->bindValue(':itemid', $row['itemid'], PDO::PARAM_INT);
        $itemq->bindValue(':type', $row['type'], PDO::PARAM_INT);
        $itemq->execute();
        $item = $itemq->fetch(PDO::FETCH_ASSOC);
        if ($row['type'] == 'tshirt'){ $echothing = $echothing . "" .  $item['filename'] . ""; }
    }
}
  
$sql1 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt1 = $db->prepare($sql1);
$stmt1->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt1->bindValue(':type', "shirt", PDO::PARAM_INT);
$stmt1->execute();
$result1 = $stmt1->fetchAll();

if (count($result1) > 0 || $row1['type'] == 'shirt') {
    foreach ($result1 as $row1) {
        $itemq1 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq1->bindValue(':itemid', $row1['itemid'], PDO::PARAM_INT);
        $itemq1->bindValue(':type', $row1['type'], PDO::PARAM_INT);
        $itemq1->execute();
        $item1 = $itemq1->fetch(PDO::FETCH_ASSOC);
        if ($row1['type'] == 'shirt'){ $echothing1 = $echothing1 . "" .  $item1['filename'] . ""; }
    }
}
  
$sql2 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt2 = $db->prepare($sql2);
$stmt2->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt2->bindValue(':type', "pants", PDO::PARAM_INT);
$stmt2->execute();
$result2 = $stmt2->fetchAll();

if (count($result2) > 0 || $row2['type'] == 'pants') {
    foreach ($result2 as $row2) {
        $itemq2 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq2->bindValue(':itemid', $row2['itemid'], PDO::PARAM_INT);
        $itemq2->bindValue(':type', $row2['type'], PDO::PARAM_INT);
        $itemq2->execute();
        $item2 = $itemq2->fetch(PDO::FETCH_ASSOC);
        if ($row2['type'] == 'pants'){ $echothing2 = $echothing2 . "" .  $item2['filename'] . ""; }
    }
}
  

$sql3 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt3 = $db->prepare($sql3);
$stmt3->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt3->bindValue(':type', "face", PDO::PARAM_INT);
$stmt3->execute();
$result3 = $stmt3->fetchAll();

if (count($result3) > 0 || $row3['type'] == 'face') {
    foreach ($result3 as $row3) {
        $itemq3 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq3->bindValue(':itemid', $row3['itemid'], PDO::PARAM_INT);
        $itemq3->bindValue(':type', $row3['type'], PDO::PARAM_INT);
        $itemq3->execute();
        $item3 = $itemq3->fetch(PDO::FETCH_ASSOC);
        if ($row3['type'] == 'face'){ $echothing3 = $echothing3 . "" .  $item3['filename'] . ""; }
    }
}
  
if ($echothing3 == ''){
    $echothing3 = "rbxasset://textures/face.png";
}

  
$sql4555 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt4555 = $db->prepare($sql4555);
$stmt4555->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt4555->bindValue(':type', "head", PDO::PARAM_STR);
$stmt4555->execute();
$result4555 = $stmt4555->fetchAll();

if (count($result4555) > 0 || $row4555['type'] == 'head') {
        $row4555 = $result4555[0];
        $itemq4555 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq4555->bindValue(':itemid', $row4555['itemid'], PDO::PARAM_INT);
        $itemq4555->bindValue(':type', $row4555['type'], PDO::PARAM_STR);
        $itemq4555->execute();
        $item4555 = $itemq4555->fetch(PDO::FETCH_ASSOC);
        if ($row4555['type'] == 'head'){ $echothing4555 = ""
.$item4555['filename'].                       
"";
       }  
    }
$sql4 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt4 = $db->prepare($sql4);
$stmt4->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt4->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt4->execute();
$result4 = $stmt4->fetchAll();

if (count($result4) > 0) {
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

if (count($result45) > 0) {
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

if (count($result455) > 0) {
        $row455 = $result455['2'];
        $itemq455 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq455->bindValue(':itemid', $row455['itemid'], PDO::PARAM_STR);
        $itemq455->bindValue(':type', $row455['type'], PDO::PARAM_STR);
        $itemq455->execute();
        $item455 = $itemq455->fetch(PDO::FETCH_ASSOC);
        if ($row455['type'] == 'hat'){ $echothing455 = "".$item455['assetlink'].""; }
}
  
$sql4555 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt4555 = $db->prepare($sql4555);
$stmt4555->bindValue(':id', $user['id'], PDO::PARAM_INT);
$stmt4555->bindValue(':type', "head", PDO::PARAM_STR);
$stmt4555->execute();
$result4555 = $stmt4555->fetchAll();

if (count($result4555) > 0 && $row4555['type'] == 'head') {
        $row4555 = $result4555[0];
        $itemq4555 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq4555->bindValue(':itemid', $row4555['itemid'], PDO::PARAM_INT);
        $itemq4555->bindValue(':type', $row4555['type'], PDO::PARAM_STR);
        $itemq4555->execute();
        $item4555 = $itemq4555->fetch(PDO::FETCH_ASSOC);
        if ($row4555['type'] == 'head'){ $echothing4555 = ""
.$item4555['filename'].                       
"";
       }  
    }
  
$sql4 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt4 = $db->prepare($sql4);
$stmt4->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt4->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt4->execute();
$result4 = $stmt4->fetchAll();

if (count($result4) > 0) {
        $row4 = $result4['0'];
        $itemq4 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq4->bindValue(':itemid', $row4['itemid'], PDO::PARAM_INT);
        $itemq4->bindValue(':type', $row4['type'], PDO::PARAM_STR);
        $itemq4->execute();
        $item4 = $itemq4->fetch(PDO::FETCH_ASSOC);
        if ($row4['type'] == 'hat'){ $echothing4 = 'http://'.$sitedomain.'/asste/?id='.$item4['assetid']; }
}

$sql45 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt45 = $db->prepare($sql45);
$stmt45->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt45->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt45->execute();
$result45 = $stmt45->fetchAll();

if (count($result45) > 0) {
        $row45 = $result45['1'];
        $itemq45 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq45->bindValue(':itemid', $row45['itemid'], PDO::PARAM_STR);
        $itemq45->bindValue(':type', $row45['type'], PDO::PARAM_STR);
        $itemq45->execute();
        $item45 = $itemq45->fetch(PDO::FETCH_ASSOC);
        if ($row45['type'] == 'hat'){ $echothing45 = 'http://'.$sitedomain.'/asste/?id='.$item45['assetid']; }
}
  
$sql455 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt455 = $db->prepare($sql455);
$stmt455->bindValue(':id', $user['id'], PDO::PARAM_STR);
$stmt455->bindValue(':type', "hat", PDO::PARAM_STR);
$stmt455->execute();
$result455 = $stmt455->fetchAll();

if (count($result455) > 0) {
        $row455 = $result455['2'];
        $itemq455 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq455->bindValue(':itemid', $row455['itemid'], PDO::PARAM_STR);
        $itemq455->bindValue(':type', $row455['type'], PDO::PARAM_STR);
        $itemq455->execute();
        $item455 = $itemq455->fetch(PDO::FETCH_ASSOC);
        if ($row455['type'] == 'hat'){ $echothing455 = 'http://'.$sitedomain.'/asste/?id='.$item455['assetid']; }
}
  
  
if (count($result4) > 0){
$hatthing = '
local Hat = game:GetObjects("'.$echothing4.'")[1]
Hat.Parent = player.Character
';
}else{
$hatthing = '';
}
if (count($result45) > 0){
$hatthing2 = '
local Hat2 = game:GetObjects("'.$echothing45.'")[1]
Hat2.Parent = player.Character
';
}else{
$hatthing2 = '';
}
if (count($result455) > 0){
$hatthing3 = '
local Hat3 = game:GetObjects("'.$echothing455.'")[1]
Hat3.Parent = player.Character
';
}else{
$hatthing3 = '';
}
if (count($result4555) > 0){
$headthing = '
player.Character.Head["Mesh"]:Remove()
local Head = game:GetObjects("'.$echothing4555.'")[1]
Head.Parent = player.Character.Head
';
}else{
$headthing = '';
}

if (count($result1) > 0) {
$shirtthing = '
local Shirt = Instance.new("Shirt", game.Players.LocalPlayer.Character)
Shirt.ShirtTemplate = "'.$echothing1.'"';
}else{
$shirtthing = '';
}
 
if (count($result3) > 0) {
$facething = '
local Face = player.Character.Head.face
Face.Texture = "'.$echothing3.'"';
}else{
$facething = '';
}
  
if (count($result2) > 0) {
$pantthing = '
local Pant = Instance.new("Pants", game.Players.LocalPlayer.Character)
Pant.PantsTemplate = "'.$echothing2.'"';
}else{
$pantthing = '';
}
$r15 = false;
// if($userid === -1) $r15 = true;
if($r15) {
  echo 'game:GetObjects("http://madblxx.tk/img/R15.rbxm")[1].Parent = game.Workspace';
}
?>
--game.GuiRoot:Destroy()
game.Lighting.TimeOfDay = "12<?php //echo (int)$user["renderDaytime"] ?? 12 ?>"
local player = game.Players:CreateLocalPlayer(0)
--player.CharacterAppearance = "http://labs.madblxx.tk/api/charapp.php?id=<?php echo $userid;?>&mode=ch&sid=1&key=D869593BF742A42F79915993EF1DB&tick=" .. tick()

local loadCharacter = coroutine.create(function()
  wait(0.5)
    player:LoadCharacter()
  wait(0.5)
  player:LoadCharacter()
  wait(0.25)

<?php if($r15) {
  echo '
game:GetService("RunService"):Run()
game:GetService("RunService"):Reset()
';
} ?>

player.Character.Head.BrickColor = BrickColor.new("<?php echo $user['headcolor']; ?>")
player.Character.Torso.BrickColor = BrickColor.new("<?php echo $user['torsocolor']; ?>")
player.Character["Right Leg"].BrickColor = BrickColor.new("<?php echo $user['rightlegcolor']; ?>")
player.Character["Right Arm"].BrickColor = BrickColor.new("<?php echo $user['rightarmcolor']; ?>")
player.Character["Left Leg"].BrickColor = BrickColor.new("<?php echo $user['leftlegcolor']; ?>")
player.Character["Left Arm"].BrickColor = BrickColor.new("<?php echo $user['leftarmcolor']; ?>")

<?php if($user["renderPosition"] === "siu") { ?>
game.Players.LocalPlayer.Character.Torso['Left Shoulder'].C0=CFrame.new(-1, 0.5, 0, -4.37113883e-08, 0, -1, 0, 0.99999994, 0, 1, 0, -4.37113883e-08);
game.Players.LocalPlayer.Character.Torso['Left Shoulder'].C1=CFrame.new(0.49999997, 0.49999997, 4.47034836e-08, 0.163175777, -0.229498923, -0.959533036, -0.33284384, 0.90274477, -0.272519022, 0.928756475, 0.363843203, 0.0709187835);
game.Players.LocalPlayer.Character.Torso['Right Shoulder'].C0=CFrame.new(1, 0.5, 0, -4.37113883e-08, 0, 1, -0, 0.99999994, 0, -1, 0, -4.37113883e-08);
game.Players.LocalPlayer.Character.Torso['Right Shoulder'].C1=CFrame.new(-0.5, 0.5, 0, 0.163175479, 0.229498848, 0.959533155, 0.332843512, 0.902745068, -0.272518843, -0.928756654, 0.363842756, 0.0709186569);
<?php } else if($user["renderPosition"] === "walk") { ?>
game.Players.LocalPlayer.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(-20)
game.Players.LocalPlayer.Character.Torso["Left Shoulder"].CurrentAngle = math.rad(-20)
game.Players.LocalPlayer.Character.Torso["Right Hip"].CurrentAngle = math.rad(17)
game.Players.LocalPlayer.Character.Torso["Left Hip"].CurrentAngle = math.rad(17)
<?php } else if($user["renderPosition"] === "sit") { ?>
game.Players.LocalPlayer.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(90)
game.Players.LocalPlayer.Character.Torso["Left Shoulder"].CurrentAngle = math.rad(-90)
game.Players.LocalPlayer.Character.Torso["Right Hip"].CurrentAngle = math.rad(90)
game.Players.LocalPlayer.Character.Torso["Left Hip"].CurrentAngle = math.rad(-90)
<?php } else if($user["renderPosition"] === "lefthand") { ?>
game.Players.LocalPlayer.Character.Torso["Left Shoulder"].CurrentAngle = math.rad(-90)
<?php } else if($user["renderPosition"] === "righthand") { ?>
game.Players.LocalPlayer.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(90)
<?php } else if($user["renderPosition"] === "wave") { ?>
game.Players.LocalPlayer.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(180)
<?php } ?>

<?php echo $facething; ?>
<?php echo $shirtthing; ?>
<?php echo $pantthing; ?>
<?php echo $headthing; ?>

local TShirt = Instance.new("Decal")
TShirt.Parent = player.Character.Torso
TShirt.Texture = "<?php echo $echothing; ?>"

<?php echo $hatthing; ?>

<?php echo $hatthing2; ?>

<?php echo $hatthing3; ?>

  local count = 0
  local p = player.Backpack:GetChildren()
  for i = 1, #p do
    if p[i].className == "Tool" then
      count = count + 1
      if (count == 1) then
        game.Workspace.Player.Torso:findFirstChild("Right Shoulder").DesiredAngle = 1.58 
        game.Workspace.Player.Torso:findFirstChild("Right Shoulder").CurrentAngle = 1.58
        game.Workspace.Player.Torso.Anchored = true
        wait(0.25)
        p[i].Parent = player.Character
      end
    end
  end

end)
 
coroutine.resume(loadCharacter)