<?php

// List of banned IPs
$bannedIPs = ['47.221.57.19', '192.168.0.1']; // Add your banned IPs here


$userIP = $_SERVER['REMOTE_ADDR'];
if (in_array($userIP, $bannedIPs)) {
    header("Location: google.com");
    exit();
}

?>