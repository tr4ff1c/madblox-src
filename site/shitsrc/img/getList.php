<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/main/config.php';
  
  $stmt = $db->prepare('SELECT render_id, type, version FROM renders ORDER BY id ASC LIMIT 1;');
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($stmt->rowCount() == 0) {
    echo 'no-render';
  }else{
        if ($result['type'] == 'server'){
            echo 'no-render';
        }else{
            echo '{"type":"'.$result['type'].'", "userid":'.$result['render_id'].'}';
        }
  }
  $conn = null;
?>