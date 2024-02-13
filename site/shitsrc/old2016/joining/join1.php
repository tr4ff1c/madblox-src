<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/joining/join2.php");
    header("Content-Type: text/plain");

    $user = addslashes($_GET["user"]);
    $ip = addslashes($_GET["ip"]);
    $port = addslashes($_GET["port"]);
    $id = addslashes($_GET["id"]);
    $capp = addslashes($_GET["capp"]);
    $mship = addslashes($_GET["mship"]);
    $pid = addslashes($_GET["PlaceId"]);

    if(preg_match("/[a-z]/i", $mship)){
        $mship = 0;
    }
    if ($mship == null) {
        $mship = 0;
    }
    if ($mship > 3) {
        $mship = 0;
    }
    if(preg_match("/[a-z]/i", $id)){
        $id = "1";
    }
    if(preg_match("/[a-z]/i", $port)){
        $port = "53640";
    }

    // Construct joinscript
    $joinscript = [
        "ClientPort" => 0,
        "MachineAddress" => $ip,
        "ServerPort" => $port,
        "PingUrl" => "",
        "PingInterval" => 20,
        "UserName" => $user,
        "SeleniumTestMode" => false,
        "UserId" => $id,
        "SuperSafeChat" => false,
        "CharacterAppearance" => "http://finobe.lol/Asset/charapp.php?id=4",
        "ClientTicket" => "",
        "GameId" => 1818,
        "PlaceId" => $pid,
        "MeasurementUrl" => "", // No telemetry here :)
        "WaitingForCharacterGuid" => "26eb3e21-aa80-475b-a777-b43c3ea5f7d2",
        "BaseUrl" => "http://finobe.lol/",
        "ChatStyle" => "ClassicAndBubble",
        "VendorId" => "0",
        "ScreenShotInfo" => "",
        "VideoInfo" => "",
        "CreatorId" => "3333",
        "CreatorTypeEnum" => "User",
        "MembershipType" => "None",
        "AccountAge" => "3000000",
        "CookieStoreFirstTimePlayKey" => "rbx_evt_ftp",
        "CookieStoreFiveMinutePlayKey" => "rbx_evt_fmp",
        "CookieStoreEnabled" => true,
        "IsRobloxPlace" => true,
        "GenerateTeleportJoin" => false,
        "IsUnknownOrUnder13" => false,
        "SessionId" => "39412c34-2f9b-436f-b19d-b8db90c2e186|00000000-0000-0000-0000-000000000000|0|190.23.103.228|8|2021-03-03T17:04:47+01:00|0|null|null",
        "DataCenterId" => 0,
        "UniverseId" => 3,
        "BrowserTrackerId" => 0,
        "UsePortraitMode" => false,
        "FollowUserId" => 0,
        "characterAppearanceId" => 1
    ];

    // Encode it!
    $data = json_encode($joinscript, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    // Sign joinscript
    $signature = get_signature("\r\n" . $data);

    // exit
    exit("--rbxsig%". $signature . "%\r\n" . $data);
?>