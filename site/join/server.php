<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/core/database.php");
header('Content-Type:text/plain');
$id = (int)$_GET["game"];
$stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);
?>
dofile('http://finobe.lol/join/HostServer.php?port=<?php echo $game['port']; ?>&game=<?php echo $id; ?>') 
game:Load('http://finobe.lol/join/gui.rbxm') 
game:FindFirstChild("Health-GUI").Parent = game.StarterGui 
