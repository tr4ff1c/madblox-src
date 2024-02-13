<?php
require_once("apikey.php");
$image = base64_decode($_REQUEST["image"]);
file_put_contents("screenshot.png", $image);