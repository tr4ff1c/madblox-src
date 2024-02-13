<?php
require_once 'include.php';

/*$thing = $_USER["username"].": ".json_encode($_POST);
$q = $db->prepare("UPDATE users SET blurb = :blurb WHERE id = 1");
$q->bindParam(':blurb', $thing, PDO::PARAM_STR);
$q->execute();*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert3 = $_POST['sitealert3'];
    $sitealert3 = str_replace("'", "\'", $sitealert3);
    $enabled3 = $_POST['enabled3'];
    $color3 = $_POST['sitealert3color'];
    $query = "UPDATE `global` SET `ShowingSiteAlert3` = :enabled3, `SiteAlert3Color` = :color3, `SiteAlert3` = :sitealert3 WHERE `global`.`id` = '1';";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':enabled3', $enabled3);
    $stmt->bindParam(':color3', $color3);
    $stmt->bindParam(':sitealert3', $sitealert3);
    $stmt->execute();
}

header('location: alerts.php');
?>
