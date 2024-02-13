<?php
require_once("../core/database.php");
if($loggedin !== "yes"){
header("location: ../Login/Default.aspx");
exit;
}

if($_USER['afison'] !== 1){
	$dba = $db->prepare("UPDATE users SET afison=1 WHERE id=?");
	$dba->execute([$_USER['id']]);
}else{
	$dba = $db->prepare("UPDATE users SET afison=0 WHERE id=?");
	$dba->execute([$_USER['id']]);
}
header("location: ../My/Profile.php");
?>