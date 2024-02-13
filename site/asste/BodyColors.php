<?php

require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");

$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

$idSearch = $db->prepare("SELECT * FROM users WHERE id = :id");
$idSearch->execute([":id" => htmlspecialchars($id)]);
$asset = $idSearch->fetch();
	header("Content-Type: text/plain");
	echo '<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
	<External>null</External>
	<External>nil</External>
	<Item class="BodyColors">
		<Properties>
			<int name="HeadColor">'.htmlspecialchars($_USER['headcolor']).'</int>
			<int name="LeftArmColor">'.htmlspecialchars($_USER['leftarmcolor']).'</int>
			<int name="LeftLegColor">'.htmlspecialchars($_USER['leftlegcolor']).'</int>
			<string name="Name">Body Colors</string>
			<int name="RightArmColor">'.htmlspecialchars($_USER['rightarmcolor']).'</int>
			<int name="RightLegColor">'.htmlspecialchars($_USER['rightlegcolor']).'</int>
			<int name="TorsoColor">'.htmlspecialchars($_USER['torsocolor']).'</int>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
</roblox>

	';