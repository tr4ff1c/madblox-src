<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");

$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM wearing WHERE userid=?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);
$result = $stmt->fetchAll();

$echothing = "http://www.roblox.com/Asset/BodyColors.ashx?userId=1;";
$echothing = "";

foreach ($result as $row) {
    $itemq = $db->prepare("SELECT * FROM catalog WHERE id=?");
    $itemq->execute([$row['itemid']]);
    $item = $itemq->fetch(PDO::FETCH_ASSOC);

    if ($item['type'] == 'hat') {
        $echothing .= "http://madblxx.tk/asste/?id=" . $item['assetid'] . ";";
    } elseif ($item['type'] == 'shirt') {
        $echothing .= "http://madblxx.tk/asste/ShirtFetch?id=" . $item['id'] . ";";
    } elseif ($item['type'] == 'tshirt') {
        $echothing .= "http://madblxx.tk/asste/TshirtFetch?id=" . $item['id'] . ";";
    } elseif ($item['type'] == 'pants') {
        $echothing .= "http://madblxx.tk/asste/PantsFetch?id=" . $item['id'] . ";";
    }
}

echo $echothing;
?>
