<?php

require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");

$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

$idSearch = $db->prepare("SELECT * FROM catalog WHERE id = :id");
$idSearch->execute([":id" => htmlspecialchars($id)]);
$asset = $idSearch->fetch();
$types = array('pants');
if (in_array($asset['type'], $types)) {
	header("Content-Type: text/plain");
	echo '<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
	<External>null</External>
	<External>nil</External>
	<Item class="Pants" referent="RBX0">
		<Properties>
			<Content name="PantsTemplate"><url>'.$asset['filename'].'</url></Content>
			<string name="Name">'.$asset['name'].'</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
</roblox>
	';
} else {
	echo "{[error:'invalid type for request']}";
}