<?php

include("../core/database.php");

$id = (int)$_GET['id'] ?? 0;

if($_USER['USER_PERMISSIONS'] !== 'Administrator'){
    die("no.");
    exit;
}

$usrq = $db->prepare("SELECT * FROM users WHERE id=:id");
$usrq->execute([":id" => $id]);
$user = $usrq->fetch(PDO::FETCH_ASSOC);

if($loggedin == "yes"){ 

// NEW RENDER

$user_id = $user['id'];

$sql = "INSERT INTO renders (id, render_id, type, version) VALUES (NULL, :user_id, 'user', '1')";

$stmt = $db->prepare($sql);

$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

$result = $stmt->execute();

exit; // END
    
$headColor = htmlspecialchars($user['headcolor']);
$torsoColor = htmlspecialchars($user['torsocolor']);
$rightArmColor = htmlspecialchars($user['rightarmcolor']);
$rightLegColor = htmlspecialchars($user['rightlegcolor']);
$leftLegColor = htmlspecialchars($user['leftlegcolor']);
$leftArmColor = htmlspecialchars($user['leftarmcolor']);

$sql34 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt34 = $db->prepare($sql34);
$stmt34->execute([
':id' => $user['id'],
':type' => "face"
]);
$result34 = $stmt34->fetchAll();  

$sql = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt = $db->prepare($sql);
$stmt->execute([
':id' => $user['id'],
':type' => "tshirt"
]);
$result = $stmt->fetchAll();

if (count($result) > 0 || $row['type'] == 'tshirt') {
    foreach ($result as $row) {
        $itemq = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq->execute([
        ':itemid' => $row['itemid'],
        ':type' => $row['type']    
            
            ]);
        $item = $itemq->fetch(PDO::FETCH_ASSOC);
        if ($row['type'] == 'tshirt'){ $echothing = $echothing . $item['filename']; }
    }
}

$sqlh = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmth = $db->prepare($sqlh);
$stmth->execute([
':id' => $user['id'],
':type' => "hat"
]);
$resulth = $stmth->fetchAll();

if (count($resulth) > 0) {
    $rowh = $resulth['0'];
        $itemqh = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemqh->execute([
        ':itemid' => $rowh['itemid'],
        ':type' => "hat"
        ]);
        $itemh = $itemqh->fetch(PDO::FETCH_ASSOC);
        if ($rowh['type'] == 'hat'){ $echothingh = $echothingh . 'hat1 = game:GetObjects("http://'.$sitedomain.'/asste/?id='.$itemh['assetid'].'")[1]
        hat1.Parent = char'; }
    
}

$sqlhh = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmthh = $db->prepare($sqlhh);
$stmthh->execute([
':id' => $user['id'],
':type' => "hat"
]);
$resulthh = $stmthh->fetchAll();

if (count($resulthh) > 1) {
    $rowhh = $resulthh['1'];
        $itemqhh = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemqhh->execute([
        ':itemid' => $rowhh['itemid'],
        ':type' => "hat"
        ]);
        $itemhh = $itemqhh->fetch(PDO::FETCH_ASSOC);
        if ($rowhh['type'] == 'hat'){ $echothinghh = $echothinghh . 'hat2 = game:GetObjects("http://'.$sitedomain.'/asste/?id='.$itemhh['assetid'].'")[1]
        hat2.Parent = char'; }
}

$sqlhhh = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmthhh = $db->prepare($sqlhhh);
$stmthhh->execute([
':id' => $user['id'],
':type' => "hat"
]);
$resulthhh = $stmthhh->fetchAll();

if (count($resulthhh) > 2) {
    $rowhhh = $resulthhh['2'];
        $itemqhhh = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemqhhh->execute([
        ':itemid' => $rowhhh['itemid'],
        ':type' => "hat"
        ]);
        $itemhhh = $itemqhhh->fetch(PDO::FETCH_ASSOC);
        if ($rowhhh['type'] == 'hat'){ $echothinghhh = $echothinghhh . 'hat3 = game:GetObjects("http://'.$sitedomain.'/asste/?id='.$itemhhh['assetid'].'")[1]
        hat3.Parent = char'; }
    
}

if (count($result34) > 0 || $row34['type'] == 'face') {
    foreach ($result34 as $row34) {
        $itemq34 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq34->execute([
        ':itemid' => $row34['itemid'],
        ':type' => $row34['type']    
            
            ]);
        $item34 = $itemq34->fetch(PDO::FETCH_ASSOC);
        if ($row34['type'] == 'face'){ $echothing34 = $echothing34 ."char.Head.face.Texture = '".$item34['forrendersface']."'"; }
    }
}

$sql2 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt2 = $db->prepare($sql2);
$stmt2->execute([
':id' => $user['id'],
':type' => "shirt"
]);
$result2 = $stmt2->fetchAll();
if (count($result2) > 0 || $row2['type'] === 'shirt') {
    foreach ($result2 as $row2) {
        $itemq2 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq2->execute([
        ':itemid' => $row2['itemid'],
        ':type' => $row2['type']    
            
            ]);
        $item2 = $itemq2->fetch(PDO::FETCH_ASSOC);
        if ($row2['type'] == 'shirt'){ $echothing2 = $echothing2 ."
        shirt = Instance.new('Shirt') 
        shirt.ShirtTemplate = '".$item2['filename']."'
        shirt.Parent = char"; }
    }
}
  
$sql3 = "SELECT * FROM wearing WHERE userid=:id AND type = :type";
$stmt3 = $db->prepare($sql3);
$stmt3->execute([
':id' => $user['id'],
':type' => "pants"
]);
$result3 = $stmt3->fetchAll();  

if (count($result3) > 0 || $row3['type'] == 'pants') {
    foreach ($result3 as $row3) {
        $itemq3 = $db->prepare("SELECT * FROM catalog WHERE id=:itemid AND type=:type");
        $itemq3->execute([
        ':itemid' => $row3['itemid'],
        ':type' => $row3['type']    
            
            ]);
        $item3 = $itemq3->fetch(PDO::FETCH_ASSOC);
        if ($row3['type'] == 'pants'){ $echothing3 = $echothing3 ."
        pant = Instance.new('Pants')
        pant.PantsTemplate = '".$item3['filename']."'
        pant.Parent = char"; }
    }
}

$xml = "

<?xml version='1.0' encoding='UTF-8'?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/' xmlns:SOAP-ENC='http://schemas.xmlsoap.org/soap/encoding/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:ns2='http://roblox.com/RCCServiceSoap' xmlns:ns1='http://roblox.com/' xmlns:ns3='http://roblox.com/RCCServiceSoap12'>
    <SOAP-ENV:Body>
        <ns1:OpenJob>
            <ns1:job>
                <ns1:id>3".$user['id']."</ns1:id>
                <ns1:expirationInSeconds>1</ns1:expirationInSeconds>
                <ns1:category>1</ns1:category>
                <ns1:cores>321</ns1:cores>
            </ns1:job>
            <ns1:script>
                <ns1:name>Script</ns1:name>
                <ns1:script>
                  game.Players:CreateLocalPlayer(0)
              game.Players.LocalPlayer:LoadCharacter()
game:GetService('RunService'):Run()
  
  local char = game.Players.LocalPlayer.Character or game.Players.LocalPlayer.Character.CharacterAdded:Wait()

char.Head.BrickColor = BrickColor.new('".$headColor."')
  char.Torso.BrickColor = BrickColor.new('".$torsoColor."')
  char['Right Arm'].BrickColor = BrickColor.new('".$rightArmColor."')
  char['Left Arm'].BrickColor = BrickColor.new('".$leftArmColor."')
  char['Right Leg'].BrickColor = BrickColor.new('".$rightLegColor."')
  char['Left Leg'].BrickColor = BrickColor.new('".$leftLegColor."')
  
    ".$echothing2."

  ".$echothing3."
  ".$echothing34."
  
  tshirt = Instance.new('Decal')
  tshirt.Texture = '".$echothing."'
  tshirt.Parent = char.Torso
  
  ".$echothingh."

  ".$echothinghh."
  
  ".$echothinghhh."

  print('".$sitename." Service: USER ".$user['id']." Rendered (renderedByAdmin:False)')
  
b64 = game:GetService('ThumbnailGenerator'):Click('PNG', 1200, 1200, true)
return b64

        </ns1:script>
            </ns1:script>
        </ns1:OpenJob>
    </SOAP-ENV:Body>
</SOAP-ENV:Envelope>

";

//The URL that you want to send your XML to.
$url = $gotoUrl;

//Initiate cURL
$curl = curl_init($url);

//Set CURLOPT_POST to true to send a POST request.
curl_setopt($curl, CURLOPT_POST, true);

//Attach the XML string to the body of our request.
curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);

//Tell cURL that we want the response to be returned as
//a string instead of being dumped to the output.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Execute the POST request and send our XML.
$result = curl_exec($curl);

//Do some basic error checking.
if(curl_errno($curl)){
    die("Failed to connect to the MCCService!");
}

//Close the cURL handle.
curl_close($curl);

$funnybase  = $result;
$luashit = array('LUA_TTABLE', "LUA_TSTRING");

$data = str_replace($luashit, "", $funnybase);

$almost = strstr($data, '<ns1:value>');
$luashit = array('<ns1:value>', "</ns1:value></ns1:OpenJobResult><ns1:OpenJobResult><ns1:type></ns1:type><ns1:table></ns1:table></ns1:OpenJobResult></ns1:OpenJobResponse></SOAP-ENV:Body></SOAP-ENV:Envelope>");

$yeab = str_replace($luashit, "", $almost);
$yeah = str_replace("</ns1:value></ns1:OpenJobResult></ns1:OpenJobResponse></SOAP-ENV:Body></SOAP-ENV:Envelope>","","$yeab");

$thumbpath = "../img/user/".$user['id'].".png";
$thumb = base64_decode($yeah);

file_put_contents($thumbpath ,$thumb);

exit("done");
}
?>