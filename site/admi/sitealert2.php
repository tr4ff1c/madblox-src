<?php
require_once 'include.php';

/*$thing = $_USER["username"].": ".json_encode($_POST);
$q = $db->prepare("UPDATE users SET blurb = :blurb WHERE id = 1");
$q->bindParam(':blurb', $thing, PDO::PARAM_STR);
$q->execute();*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert2 = $_POST['sitealert2'];
    $sitealert2 = str_replace("'", "\'", $sitealert2);
    $enabled2 = $_POST['enabled2'];
    $color2 = $_POST['sitealert2color'];
    $query = "UPDATE `global` SET `ShowingSiteAlert2` = :enabled2, `SiteAlert2Color` = :color2, `SiteAlert2` = :sitealert2 WHERE `global`.`id` = '1';";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':enabled2', $enabled2);
    $stmt->bindParam(':color2', $color2);
    $stmt->bindParam(':sitealert2', $sitealert2);
    $stmt->execute();
}

header('location: alerts.php');
?>
