<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/core/database.php";

die("Old closed page.");

$head = filter_var($_POST['head'], FILTER_SANITIZE_NUMBER_INT);
$torso = filter_var($_POST['torso'], FILTER_SANITIZE_NUMBER_INT);
$larm = filter_var($_POST['larm'], FILTER_SANITIZE_NUMBER_INT);
$lleg = filter_var($_POST['lleg'], FILTER_SANITIZE_NUMBER_INT);
$rarm = filter_var($_POST['rarm'], FILTER_SANITIZE_NUMBER_INT);
$rleg = filter_var($_POST['rleg'], FILTER_SANITIZE_NUMBER_INT);
$currentid = $_USER['id'];

$stmt = $db->prepare("UPDATE users SET headcolor=?, torsocolor=?, leftarmcolor=?, leftlegcolor=?, rightarmcolor=?, rightlegcolor=? WHERE id=?");

if ($stmt->execute([$head, $torso, $larm, $lleg, $rarm, $rleg, $currentid])) {
    echo "<span style='color: green; font-family: verdana'>Successfully updated character</span>";
    echo "<script>window.history.back()</script>";
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

header("location: render.php");
exit();
?>


