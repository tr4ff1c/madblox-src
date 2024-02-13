<?php
require_once("../../core/head.php");

$MessageID = (int)$_GET['MessageID'] ?? 0;

$stmt = $db->prepare("SELECT * FROM messages WHERE id = :id");
$stmt->execute(['id' => $MessageID]);
$fpost = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fpost) {
  die("Invalid ID.");
}

if ($fpost['user_to'] != $_USER['id']) {
  die("This message wasn't sent to you.");
}

$q = $con->prepare("DELETE FROM messages WHERE id = :id");
$q->bindParam(':id', $MessageID, PDO::PARAM_INT);
$q->execute();
header('location: /My/Messages/Inbox.aspx');