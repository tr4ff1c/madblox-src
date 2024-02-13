<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");
$apikey = "OgwIzikLIQdABK96jDY8EjMW2AcW4kc4";
if($_REQUEST["apikey"] !== $apikey) exit("Wrong API Key!");