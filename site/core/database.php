<?php
// exit("We are doing a site backup. Please wait a bit.");
// if(str_starts_with($_SERVER["PHP_SELF"], "/Forum")) exit("Forums are disabled. Sorry :/");

//if(str_starts_with($_SERVER["REQUEST_URI"],"/img/getList")){exit("no-render");}exit("Site has been closed for the night. Sorry :/");
//<img style="position: fixed;z-index: -999;width: 100%;height: 100%;margin: -8;" src="https://media.discordapp.net/attachments/1131541893419900939/1203673218901213244/attachment.png?ex=65d1f30a&is=65bf7e0a&hm=6f793d3d9115010d666df9809f75b41450f50355277f56ed25eb7ea871a29e54&=&format=webp&quality=lossless">
//exit;

require_once("EasyPHP.php");
error_reporting(0);
//error_reporting(E_ALL);
$host = '127.0.0.1';
$dbname = 'madblox';
$username = 'yomi';
$password = '9vBmuhfEo7H606xBrA5leyqVazXB3x4k';
$gotoUrl = "http://localhost:45632";

$loggedin = 'no';
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con = $db; // for nolanwhy cause i always fucking forget its madblox and not my site
    $conn = $db;
    /* include "EasyPHP.php";
    $db = new EasyPHP();
    $db->ConnectDatabase($host, $dbname, $username, $password);
$con = $db;
$conn = $db; */



} catch (PDOException $e) {
    echo "db connection failed: " . $e->getMessage();
}

$sitename = "MADBLOX";
// $sitename = '<img style="width:100px;height:35px;" src="https://media.discordapp.net/attachments/1203465620255936552/1206294994084700210/IMG_2365.png?ex=65db7cc2&is=65c907c2&hm=5f1301ec56854881288dde493c98cd27cb425952261d86437762734fd526c517&=&format=png&quality=lossless">';
$sitedomain = "finobe.lol";
$title = $sitename.": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics";
$siteurl = "http://".$sitedomain;
$sitelogo = "/images/madbloxlogo.png";
$caleb = false;

if(random_int(1,10) === 8) {
    // $caleb = true;
}

$q = $db->prepare("SELECT * FROM renderserver LIMIT 1");
$q->execute();
$_RENDERSERVER = $q->fetch();

// site modes (made by dude)
$testing = "false"; //testing mode 2.0 if its enabled it turns off games (made by dude)
$securitydown = "false"; // i recommend turing this on when site got an security attack or regular security maintenance (made by dude)

$stmt = $db->prepare("SELECT * FROM global WHERE id = ?");
$stmt->execute([1]);
$_GLOBAL = $stmt->fetch(PDO::FETCH_ASSOC);

$_THEMECSS = "";

if(isset($_COOKIE["_MADBLOXSESSION"])) {
    $q = $db->prepare("SELECT * FROM sessions WHERE sessKey = :session");
    $q->bindParam(':session', $_COOKIE["_MADBLOXSESSION"], PDO::PARAM_STR);
    $q->execute();
    $session = $q->fetch();
    if($session) {
        $q = $db->prepare("SELECT * FROM users WHERE id = :id");
        $q->bindParam(':id', $session["userId"], PDO::PARAM_INT);
        $q->execute();
        $_USER = $q->fetch();
        if($_USER) {
            $loggedin = "yes"; // please god change this to a boolean
        }
    }
}

if($loggedin === "yes") {
    $_BANQ = $db->prepare("SELECT * FROM bans WHERE userid=:id");
    $_BANQ->execute([':id' => $_USER["id"]]);
    $_BAN = $_BANQ->fetch(PDO::FETCH_ASSOC);
    $banrows = $_BANQ->rowCount();

    if($banrows > 0 && $_BAN['typeBan'] !== "None"){
        if(!in_array($_SERVER["PHP_SELF"], [
            "/not-approved.php",
            "/reactivate-account.php",
            "/api/LogoutRequest.php"
        ])) {
            header('location: /not-approved.aspx');
            exit;
        };
    } else {
        if(in_array($_SERVER["PHP_SELF"], [
            "/not-approved.php",
            "/reactivate-account.php"
        ])) {
            header('location: /');
            exit;
        };
    }
}

require_once($_SERVER["DOCUMENT_ROOT"]."/core/discord.php");

if($loggedin === "yes" && $_USER['USER_PERMISSIONS'] !== "Administrator") {
    // exit("You must be admin to access the site :D");
}

if($loggedin === "yes" && $_USER["theme"] !== "default") {
    require_once($_SERVER["DOCUMENT_ROOT"]."/core/themes/".$_USER["theme"].".php");
}

function setSessionCookie($cookie) {
    setcookie('.MADBLOXSESSION', $cookie, time() + 31536000, '/');
    setcookie('.MADBLOXSESSION', $cookie, time() + 31536000, $sitedomain);
    setcookie('.MADBLOXSESSION', $cookie, time() + 31536000, '.'.$sitedomain);
}

function generateSessionCookie() {
    return bin2hex(random_bytes(100));
}

function filterText($string) {
    // return "[ Content Deleted ]";
    global $db;
    $q = $db->prepare("SELECT * FROM chatfilter WHERE original = :string");
    $q->bindParam(':string', $string, PDO::PARAM_STR);
    $q->execute();
    $dbfilter = $q->fetch();
    if($dbfilter) {
        return $dbfilter["filtered"];
    }
    $ch = curl_init("https://trr.boomlings.xyz/api/filter");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        "text" => $string,
        "apikey" => "OdcAFk6MvV9PPLGunL5nKhqlliIDtBa8"
    ]));
    $res = curl_exec($ch);
    curl_close($ch);
    if(!$res) {
        return "[ Failed to filter ]";
    } else {
        $response = json_decode($res, true);
        if(!$response["success"]) {
            return "[ Failed to filter: ".$response["message"]." ]";
        }
        $filtered = $response["new"];
        $q = $db->prepare("INSERT INTO chatfilter (id, original, filtered) VALUES (NULL, :og, :filtered)");
        $q->bindParam(':og', $string, PDO::PARAM_STR);
        $q->bindParam(':filtered', $filtered, PDO::PARAM_STR);
        $q->execute();
        return $filtered;
    }
}

function isFiltered($string) {
    if(filterText($string) !== $string) return true;
    return false;
}

function timeAgo($time_ago)
{
    $cur_time     = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds      = $time_elapsed ;
    $minutes      = round($time_elapsed / 60 );
    $hours        = round($time_elapsed / 3600);
    $days         = round($time_elapsed / 86400 );
    $weeks        = round($time_elapsed / 604800);
    $months       = round($time_elapsed / 2600640 );
    $years        = round($time_elapsed / 31207680 );

    if($seconds <= 60){
        return "Today";
    }

    else if($minutes <=60){
        if($minutes==1){
            return "Today";
        }
        else{
            return "Today";
        }
    }

    else if($hours <=24){
        if($hours==1){
            return "Today";
        }else{
            return "Today";
        }
    }

    else if($days <= 7){
        if($days==1){
            return "Yesterday";
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }

    else if($months <=12){
        if($months==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }

    else{
        if($years==1){
            return date("m/d/Y",$time_ago);
        }else{
            return date("m/d/Y",$time_ago);
        }
    }
}

function forumtime($ts)
{
    $clock = $ts;
        $ts = strtotime($ts);
        return timeAgo($clock)." @ ".date("h:i A",$clock);

}

$RobloxColors = array(
    1,          //1
    208,        //2
    194,        //3
    199,        //4
    26,         //5
    21,         //6
    24,         //7
    226,        //8
    23,         //9
    107,        //10
    102,        //11
    11,         //12
    45,         //13
    135,        //14
    106,        //15
    105,        //16
    141,        //17
    28,         //18
    37,         //19
    119,        //20
    29,         //21
    151,        //22
    38,         //23
    192,        //24
    104,        //25
    9,          //26
    101,        //27
    5,          //28
    153,        //29
    217,        //30
    18,         //31
    125         //32
);

$RobloxColorsHtml = array(
    "#F2F3F2",  //1
    "#E5E4DE",  //2
    "#A3A2A4",  //3
    "#635F61",  //4
    "#1B2A34",  //5
    "#C4281B",  //6
    "#F5CD2F",  //7
    "#FDEA8C",  //8
    "#0D69AB",  //9
    "#008F9B",  //10
    "#6E99C9",  //11
    "#80BBDB",  //12
    "#B4D2E3",  //13
    "#74869C",  //14
    "#DA8540",  //15
    "#E29B3F",  //16
    "#27462C",  //17
    "#287F46",  //18
    "#4B974A",  //19
    "#A4BD46",  //20
    "#A1C48B",  //21
    "#789081",  //22
    "#A05F34",  //23
    "#694027",  //24
    "#6B327B",  //25
    "#E8BAC7",  //26
    "#DA8679",  //27
    "#D7C599",  //28
    "#957976",  //29
    "#7C5C45",  //30
    "#CC8E68",  //31
    "#EAB891"   //32
);
?>
