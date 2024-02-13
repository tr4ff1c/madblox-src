<?php
include($_SERVER["DOCUMENT_ROOT"]."/core/head.php");
// if($_USER["id"] !== -1) exit("Sorry, games are disabled while nolanwhy (the best madblox developer ofc) makes a better authentication system.");

if($testing == 'true' && ($_USER['USER_PERMISSIONS'] !== "Administrator" && $_USER['USER_PERMISSIONS'] !== "beta_tester")) {
    die("<div style='margin: 150px auto 150px auto; width: 500px; border: black thin solid; padding: 22px;'><strong><p>Games down because site up for testing purposes</p></strong></div>"); }
    

$id = (int)$_GET["id"] ?? 0;
if($loggedin == 'yes') {
$stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$newaccountcode = generateRandomString(25);
$stmt = $db->prepare("UPDATE users SET accountcode = :accountcode WHERE id = :id");
$stmt->bindParam(':accountcode', $newaccountcode);
$stmt->bindParam(':id', $_USER['id']);
$stmt->execute();

if($game["gameserver"] !== 0 && $game['players'] < 1){
    $q = $db->prepare("SELECT * FROM gameservers WHERE id = :id");
    $q->bindParam(':id', $game["gameserver"], PDO::PARAM_INT);
    $q->execute();
    $gameserver = $q->fetch();

    if($gameserver) {
        if(is_array($gameserver["usedPorts"])) {
            $input_array = json_decode($gameserver["usedPorts"]);

            $max_index = max(array_keys($input_array));

            for($i = 0; $i <= $max_index; $i++) {
                if (array_key_exists($i, $input_array)) {
                    $output_array[] = $input_array[$i];
                } else {
                    $output_array[] = 0;
                }
            }

            $gameserver["usedPorts"] = json_encode($output_array);
        }
        while(!$port) {
            list($start, $end) = explode('-', $gameserver["ports"]);
            $port = mt_rand($start, $end);
            if(in_array($port, json_decode($gameserver["usedPorts"]))) {
                $port = null;
            }
        }
        $new = json_decode($gameserver["usedPorts"]);
        array_push($new, $port);
        $new = json_encode($new);
        $q = $db->prepare("UPDATE gameservers SET usedPorts = :ports WHERE id = :id");
        $q->bindParam(':ports', $new, PDO::PARAM_STR);
        $q->bindParam(':id', $gameserver['id'], PDO::PARAM_INT);
        $q->execute();

        $q = $db->prepare("UPDATE games SET port = :port WHERE id = :id");
        $q->bindParam(':port', $port, PDO::PARAM_INT);
        $q->bindParam(':id', $game['id'], PDO::PARAM_INT);
        $q->execute();

        $q = $db->prepare("INSERT INTO serversrq (id, action, value1, value2, gameserver) VALUES (NULL, 'start-game', :value1, :value2, :gameserver)");
        $q->bindParam(':value1', $game['id'], PDO::PARAM_INT);
        $q->bindParam(':value2', $port, PDO::PARAM_INT);
        $q->bindParam(':gameserver', $gameserver['id'], PDO::PARAM_INT);
        $q->execute();

        $q = $db->prepare("UPDATE games SET players = 1 WHERE id = :id");
        $q->bindParam(':id', $game['id'], PDO::PARAM_INT);
        $q->execute();
    }
}

sleep(3);

$joinargs = '-script "wait(); dofile(\'http://finobe.lol/join/character.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\') dofile(\'http://finobe.lol/join/play.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\')"';
$b64joinargs = base64_encode($joinargs);
header('location: madbloxclient:'.$b64joinargs);
}
  
?>

<h1>How to play a game</h1>
<h3>Step 1: Radmin VPN</h3>
<a href="http://radmin-vpn.com/"><p>Download Radmin VPN here</p></a>
<p>Join the Radmin VPN network:</p>
<p>Name: DAYBLOX</p>
<p>Pass: lol123</p>
<h3>Step 2: Download <?=$sitename ?> Client</h3>
<a href="/download/MADBLOX-Client.zip"><p>Download <?=$sitename ?> here</p></a>
<h3>Step 3: Join the action!</h3>
<p>Go to your game, you clicked Play on <a href="/place.aspx?id=<?php echo $game['id']; ?>"><?php echo $game['name']; ?></a> before.</p>
<p>Then copy the PlaceId that you can find on the URL</p>
<img src="/images/gameid.png">
<p>Then open !Join.bat on the <?=$sitename ?> Client, paste the PlaceId and your Account Code</p>
<p><strong>Whats an Account Code?</strong> An Account Code is random characters linked to your <?=$sitename ?> account,</p>
<p>Your Account Code is: <?php echo $_USER['accountcode']; ?></p>
<p>Paste your Account Code into !Join.bat</p>
<h3>Step 4: Have fun!</h3>
<h2>Tutorial writen by nolanwhy</h2>
<?php include($_SERVER["DOCUMENT_ROOT"]."/core/footer.php"); ?>