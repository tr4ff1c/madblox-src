<?php
require_once 'include.php';

/*$thing = $_USER["username"].": ".json_encode($_POST);
$q = $db->prepare("UPDATE users SET blurb = :blurb WHERE id = 1");
$q->bindParam(':blurb', $thing, PDO::PARAM_STR);
$q->execute();*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert5 = $_POST['sitealert5'];
    $sitealert5 = str_replace("'", "\'", $sitealert5);
    $enabled5 = $_POST['enabled5'];
    $color5 = $_POST['sitealert5color'];
    $query = "UPDATE `global` SET `ShowingSiteAlert5` = :enabled5, `SiteAlert5Color` = :color5, `SiteAlert5` = :sitealert5 WHERE `global`.`id` = '1';";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':enabled5', $enabled5);
    $stmt->bindParam(':color5', $color5);
    $stmt->bindParam(':sitealert5', $sitealert5);
    $stmt->execute();
}

header('location: alerts.php');
?>
