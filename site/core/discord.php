<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");

// Discord Logging
if(
    !str_starts_with($_SERVER["PHP_SELF"], "/Login") &&
    !str_starts_with($_SERVER["PHP_SELF"], "/img") &&
    !str_starts_with($_SERVER["PHP_SELF"], "/Game/servers") &&
    $_SERVER["PHP_SELF"] !== "/Error.php"
) {
    try{
$content = "## Request
Logged In: **false**
Page: **{$_SERVER["REQUEST_URI"]}**
File: **{$_SERVER["PHP_SELF"]}**
Request Method: **{$_SERVER["REQUEST_METHOD"]}**
GET Parameters: **".json_encode($_GET)."**
POST Parameters: **".json_encode($_POST)."**";
        if($loggedin === "yes") {
$content = "## Request from {$_USER["username"]}
Logged In: **true**
ID: **{$_USER["id"]}**
Page: **{$_SERVER["REQUEST_URI"]}**
File: **{$_SERVER["PHP_SELF"]}**
MADBUX: **{$_USER["mlgbux"]}**
Tickets: **{$_USER["tickets"]}**
Theme: **{$_USER["theme"]}**
Request Method: **{$_SERVER["REQUEST_METHOD"]}**
GET Parameters: **".json_encode($_GET)."**
POST Parameters: **".json_encode($_POST)."**";
        }

        $msg = ["username" => $_USER["username"] ?? "Not Logged In", "content" => $content];

        $headers = array('Content-Type: application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://discord.com/api/webhooks/1205640101871353886/-jrh7aZbGdyBojIWMMmuYtwZtfPygVP7wSp6rC5lEhKGt4MZD3jNWo_WumnBy17oyC8G");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($msg));
        curl_exec($ch);
        curl_close($ch);
    } catch(Exception $e) {}
}