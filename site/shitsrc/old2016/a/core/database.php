<?php
session_start();

ini_set("error_reporting", 0);
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';
$gotoUrl = "http://localhost:45632";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "db connection failed: " . $e->getMessage();
}

$sitename = "MADBLOX";
$sitedomain = "localhost";
$title = $sitename.": A FREE Virtual World-Building Game with Avatar Chat, 3D Environments, and Physics";
$siteurl = "http://".$sitedomain;

// site modes (made by dude)
$testing = "false"; //testing mode 2.0 if its enabled it turns off games (made by dude)
$securitydown = "false"; // i recommend turing this on when site got an security attack or regular security maintenance (made by dude)


if($_SESSION){
$uid = (int)$_SESSION["id"];
} else { $uid = 0; }
$_USERQ = $db->prepare("SELECT * FROM users WHERE id=:id");
$_USERQ->execute([':id' => $uid]);
$_USER = $_USERQ->fetch(PDO::FETCH_ASSOC);
if($_USER) {$loggedin = 'yes';} else {$loggedin = 'no';}

function timeAgo($time_ago)
{
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );

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
