<?php
require_once("../core/database.php");
if($loggedin !== "yes"){
header("location: ../Login/Default.aspx");
exit;
}

$theme = $_REQUEST["theme"];
if(!in_array($theme, [
    "default",
    "dark",
    "calebblox",
    "shaker"
])) {
    $theme = "default";
}

$q = $db->prepare("UPDATE users SET theme = :theme WHERE id = :id");
$q->bindParam(':theme', $theme, PDO::PARAM_STR);
$q->bindParam(':id', $_USER["id"], PDO::PARAM_INT);
$q->execute();
header("location: ../My/Profile.php");
?>