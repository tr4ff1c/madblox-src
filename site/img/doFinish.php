<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
  
  if (isset($_GET['renderid']) and isset($_GET['type']) and isset($_GET['apikey']) and isset($_GET['version'])) {
    $renderId = $_GET['renderid'];
    $type = $_GET['type'];
    $apiKey = $_GET['apikey'];
    $version = $_GET['version'];
    
    if ($apiKey == $_RENDERSERVER["apiKey"]) {
$time = time();
$q = $db->prepare("UPDATE renderserver SET lastPing = :time");
$q->bindParam(':time', $time, PDO::PARAM_INT);
$q->execute();

      $stmt = $db->prepare('DELETE FROM renders WHERE render_id = :rid AND type = :type LIMIT 1;');
      $stmt->bindParam(':rid', $renderId, PDO::PARAM_INT);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->execute();
      exit("Deleted old render row.");
    } else {
            exit("fuck yourself");
        }
  }

?>