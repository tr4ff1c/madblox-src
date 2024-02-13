<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');
$q = $db->prepare("SELECT count(*) FROM renders");
$q->execute();
$renders = $q->fetch();
$itemsInRenderQueue = $renders[0];

$lastRSping = time() - $_RENDERSERVER["lastPing"];
if($lastRSping >= 7) {}
?>
<h2>Server Status</h2>
<ul>
	<li>WebServer: <span style="color:green;">online </span></li>
	<!-- <li>MasterServer: <span style="color:red;">offline</span></li> -->
	<li>ThumbnailServer: <span style="color:<?php if($lastRSping >= 7) { echo "red"; } else { echo "green"; } ?>;"><?php if($lastRSping >= 7) { echo "offline"; } else { echo "online"; } ?> (<?php echo (int)$itemsInRenderQueue; ?> items in queue)</span></li>
	<li>Asset Service: <span style="color:green;">online </span></li>
	<li style="display:none;">Place Validation Server: <span style="color:darkgray;">disabled</span></li>
	<li style="display:none;">Logging Service: <span style="color:darkgray;">disabled</span></li>
	<li>GameServer: <span style="color:green;">available, 0/69 games running</span></li>
</ul>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/footer.php');
?>