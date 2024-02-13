<?php
require_once 'include.php';

/*$thing = $_USER["username"].": ".json_encode($_POST);
$q = $db->prepare("UPDATE users SET blurb = :blurb WHERE id = 1");
$q->bindParam(':blurb', $thing, PDO::PARAM_STR);
$q->execute();*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert4 = $_POST['sitealert4'];
    $sitealert4 = str_replace("'", "\'", $sitealert4);
    $enabled4 = $_POST['enabled4'];
    $color4 = $_POST['sitealert4color'];
    $query = "UPDATE `global` SET `ShowingSiteAlert4` = :enabled4, `SiteAlert4Color` = :color4, `SiteAlert4` = :sitealert4 WHERE `global`.`id` = '1';";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':enabled4', $enabled4);
    $stmt->bindParam(':color4', $color4);
    $stmt->bindParam(':sitealert4', $sitealert4);
    $stmt->execute();
}

header('location: alerts.php');
?>
