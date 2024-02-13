<?php
require_once 'include.php';

/*$thing = $_USER["username"].": ".json_encode($_POST);
$q = $db->prepare("UPDATE users SET blurb = :blurb WHERE id = 1");
$q->bindParam(':blurb', $thing, PDO::PARAM_STR);
$q->execute();*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sitealert1 = $_POST['sitealert1'];
    $sitealert1 = str_replace("'", "\'", $sitealert1);
    $enabled1 = $_POST['enabled1'];
    $color1 = htmlspecialchars($_POST['sitealert1color']);
    $query = "UPDATE `global` SET `ShowingSiteAlert1` = :enabled1, `SiteAlert1Color` = :color1, `SiteAlert1` = :sitealert1 WHERE `global`.`id` = '1';";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':enabled1', $enabled1);
    $stmt->bindParam(':color1', $color1);
    $stmt->bindParam(':sitealert1', $sitealert1);
    $stmt->execute();
}

header('location: alerts.php');
?>
