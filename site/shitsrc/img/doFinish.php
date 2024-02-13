<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/main/config.php';
  
  if (isset($_GET['renderid']) and isset($_GET['type']) and isset($_GET['apiKey']) and isset($_GET['version'])) {
    $renderId = $_GET['renderid'];
    $type = $_GET['type'];
    $apiKey = $_GET['apiKey'];
    $version = $_GET['version'];
    
    if ($apiKey == "NiceyomiIsTheCoolGoat13242") {
      $stmt = $db->prepare('DELETE FROM renders WHERE render_id = :rid AND type = :type LIMIT 1;');
      $stmt->bindParam(':rid', $renderId, PDO::PARAM_INT);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->execute();
    } else {
            exit("fuck yourself");
        }
  }

?>