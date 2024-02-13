<?php

include("../core/database.php");



$xml = "

<?xml version='1.0' encoding='UTF-8'?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/' xmlns:SOAP-ENC='http://schemas.xmlsoap.org/soap/encoding/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:ns2='http://roblox.com/RCCServiceSoap' xmlns:ns1='http://roblox.com/' xmlns:ns3='http://roblox.com/RCCServiceSoap12'>
    <SOAP-ENV:Body>
        <ns1:OpenJob>
            <ns1:job>
                <ns1:id>3".$_USER['id']."</ns1:id>
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

    char.Head.face.Texture = 'http://mlgblox.xyz/api/SillyFun_FRENDER.png?thing=150'
  
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
    die("Failed to connect to the GCCService!");
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

echo "<img src='data:image;base64,".$yeah."'>click</img>";

?>