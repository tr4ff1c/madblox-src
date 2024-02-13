<?php 

include("../core/database.php");

if($loggedin === "no") {
    header('location: /');
    exit;
}

$id = htmlspecialchars($_GET['id']);

$itemq = $db->prepare("SELECT * FROM catalog WHERE id=:itemid");
        $itemq->execute([':itemid' => $id]);
        $item = $itemq->fetch(PDO::FETCH_ASSOC);

if(!$item) {
        exit("Doesnt exist");
}

if(
        $_USER["USER_PERMISSIONS"] !== "Administrator" &&
        $_USER["USER_PERMISSIONS"] !== "Asset_Moderator" &&
        $_USER["USER_PERMISSIONS"] !== "Moderator" &&
        $_USER["id"] !== $item["creatorid"]
) {
        exit("You can't do that.");
}

if($item['type'] == 'hat'){
$sql = "INSERT INTO renders (id, render_id, type, version) VALUES (NULL, :user_id, 'hats', '1')";

$stmt = $db->prepare($sql);

$stmt->bindParam(':user_id', $item['id'], PDO::PARAM_INT);

$result = $stmt->execute();

exit;
}

if($item['type'] == 'head'){
$sql = "INSERT INTO renders (id, render_id, type, version) VALUES (NULL, :user_id, 'heads', '1')";

$stmt = $db->prepare($sql);

$stmt->bindParam(':user_id', $item['id'], PDO::PARAM_INT);

$result = $stmt->execute();

exit;
}

if($item['type'] == 'shirt'){
$sql = "INSERT INTO renders (id, render_id, type, version) VALUES (NULL, :user_id, 'shirts', '1')";

$stmt = $db->prepare($sql);

$stmt->bindParam(':user_id', $item['id'], PDO::PARAM_INT);

$result = $stmt->execute();

exit;
}

if($item['type'] == 'pants'){
$sql = "INSERT INTO renders (id, render_id, type, version) VALUES (NULL, :user_id, 'pants', '1')";

$stmt = $db->prepare($sql);

$stmt->bindParam(':user_id', $item['id'], PDO::PARAM_INT);

$result = $stmt->execute();

exit;
}