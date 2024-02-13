<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");

$id = (int)filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

$idSearch = $db->prepare("SELECT * FROM assets WHERE id = :id");
$idSearch->execute([":id" => htmlspecialchars($id)]);
$idSearchd = $db->prepare("SELECT * FROM assets WHERE id = $id");
$asset = $idSearch->fetch();

$file_content = $asset['content'];

// Specify the file name
$file_name = $asset['id'].".txt";

if($asset['id'] == 0){
    die("Asset not found");
}

try {
    $file = fopen($file_name, "w");
    if ($file) {
        header("Content-Type: text/plain");
        echo $file_content;
        exit();
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

try {
    $file_contents = file_get_contents($file_name);
} catch (Exception $e) {
    echo "An error occurred while reading the file: " . $e->getMessage();
}

?>