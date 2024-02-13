<?php
require_once("nav.php");
?>
<title>People | <?=$sitename?></title>
<br><br>
<h1>s1gma userz listz!!1!!1!</h1>
<?php
$a = $db->prepare("SELECT * FROM users");
$a->execute();
foreach($a as $user){
?>
<?=$user['username']?><br>
<?php } ?>