<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
$userl = $db->prepare("SELECT * FROM users WHERE id = ?");
$userl->execute([$id]);
$user = $userl->fetch(PDO::FETCH_ASSOC);
echo '<img src="/img/user/'.$user['id'].'.png?rand='.random_int(1,999999999999999999).'" style="width: 100%;height: 100%;" / >';
?>
<style>
body{
margin: 0;
}
</style>