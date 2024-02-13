<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
header('content-type: application/json');
echo json_encode([
    "success" => true,
    "new" => filterText($_REQUEST["text"] ?? "")
]);