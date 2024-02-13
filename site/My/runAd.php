<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');

if($loggedin !== "yes"){
    header("/Login/Default.aspx");
    exit;
}

$id = filter_var($_REQUEST['adId'], FILTER_SANITIZE_NUMBER_INT);
$a = $db->prepare("SELECT * FROM ads WHERE id=?");
$a->execute([$id]);
$ar = $a->rowCount();
if($ar < 1){
    die("This ad does not exist.");
}
$ad = $a->fetch(PDO::FETCH_ASSOC);
if($ad['adOwner'] !== $_USER['id']){
    die("This ad is not yours");
}
$b = $db->prepare("UPDATE ads SET status=? WHERE id=?");
$b->execute(["running", $id]);

header("location: /My/AdInventory.aspx");
exit;

?>