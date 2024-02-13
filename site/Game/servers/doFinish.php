<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
  
  if (isset($_GET['gameid']) and isset($_GET['apiKey'])) {
    $renderId = $_GET['gameid'];
    $apiKey = $_GET['apiKey'];
    
    if ($apiKey == "NiceyomiIsTheCoolGoat13242") {
      $stmt = $db->prepare('DELETE FROM serversrq WHERE game_id = :rid LIMIT 1;');
      $stmt->bindParam(':rid', $renderId, PDO::PARAM_INT);
      $stmt->execute();
    } else {
            exit("fuck yourself");
        }
  }

?>