<?php 

include("../core/database.php");

$modelshit = "http://".$sitedomain."/api/funnyguy.rbxm";
$xml = "

<?xml version='1.0' encoding='UTF-8'?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/' xmlns:SOAP-ENC='http://schemas.xmlsoap.org/soap/encoding/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:ns2='http://roblox.com/RCCServiceSoap' xmlns:ns1='http://roblox.com/' xmlns:ns3='http://roblox.com/RCCServiceSoap12'>
    <SOAP-ENV:Body>
        <ns1:OpenJob>
            <ns1:job>
                <ns1:id>3</ns1:id>
                <ns1:expirationInSeconds>1</ns1:expirationInSeconds>
                <ns1:category>1</ns1:category>
                <ns1:cores>321</ns1:cores>
            </ns1:job>
            <ns1:script>
                <ns1:name>Script</ns1:name>
                <ns1:script>
              game.Players:CreateLocalPlayer(0)
              game.Players.LocalPlayer:LoadCharacter()

local char = game.Players.LocalPlayer.Character or game.Players.LocalPlayer.Character.CharacterAdded:Wait()

tshirt = Instance.new('Decal')
  tshirt.Texture = 'http://placehold.co/600x400?text=Hello+World'
  tshirt.Parent = char.Torso
              
  
b64 = game:GetService('ThumbnailGenerator'):Click('PNG', 420, 420, true)                                     
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
    throw new Exception(curl_error($curl));
}

//Close the cURL handle.
curl_close($curl);

$funnybase  = $result;
$luashit = array('LUA_TTABLE', "LUA_TSTRING");

$data = str_replace($luashit, "", $funnybase);

$almost = strstr($data, '<ns1:value>');
$luashit = array('<ns1:value>', "</ns1:value></ns1:OpenJobResult><ns1:OpenJobResult><ns1:type></ns1:type><ns1:table></ns1:table></ns1:OpenJobResult></ns1:OpenJobResponse></SOAP-ENV:Body></SOAP-ENV:Envelope>");

$yeab = str_replace($luashit, "", $almost);
$yeas = str_replace("</ns1:value></ns1:OpenJobResult></ns1:OpenJobResponse></SOAP-ENV:Body></SOAP-ENV:Envelope>","","$yeab");
$yeah = "data:image/jpeg;base64,".$yeas;

echo '<img src="'.$yeah.'">';

$update = $db->prepare("UPDATE users SET thumbnail = :thumb WHERE id=:id");
$update->execute([
':thumb' => $yeah,
':id' => "49"
]);