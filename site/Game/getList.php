<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/core/database.php';
  
  $stmt = $db->prepare('SELECT game_id FROM serversrq ORDER BY id ASC LIMIT 1;');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($stmt->rowCount() == 0) {
    echo 'no-render';
  }else{
        if ($result['type'] == 'server'){
            echo 'no-render';
        }else{
            echo '{"userid":'.$result['game_id'].'}';
        }
  }
  $conn = null;
?>