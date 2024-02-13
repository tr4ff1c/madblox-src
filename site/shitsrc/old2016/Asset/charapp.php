<?php
require_once($_SERVER['DOCUMENT_ROOT']."/config.php");

$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
/*$sql = "SELECT * FROM wearing WHERE userid=?";
$stmt = $db->prepare($sql);
$stmt->execute([$id]);
$result = $stmt->fetchAll();

$echothing = "";*/
echo "http://finobe.lol/Asset/BodyColors.ashx?userId=".$id.";";

/*foreach ($result as $row) {
    $itemq = $db->prepare("SELECT * FROM catalog WHERE id=?");
    $itemq->execute($row['itemid']);
    $item = $itemq->fetch(PDO::FETCH_ASSOC);

    if ($item['type'] == 'hat') {
        $echothing = "http://finobe.lol/asste/?id=" . $item['assetid'] . ";";
		echo $echothing;
    } elseif ($item['type'] == 'shirt') {
        $echothing = "http://finobe.lol/asste/ShirtFetch?id=" . $item['id'] . ";";
		echo $echothing;
    }
	elseif ($item['type'] == 'tshirt') {
        $echothing = "http://finobe.lol/asste/TshirtFetch?id=" . $item['id'] . ";";
		echo $echothing;
    }
	elseif ($item['type'] == 'pants') {
        $echothing = "http://finobe.lol/asste/PantsFetch?id=" . $item['id'] . ";";
		echo $echothing;
    }
}*/

?>
