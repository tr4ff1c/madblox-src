<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/database.php');
$ban = true;
while($ban) {
    $q = $db->prepare("SELECT * FROM ads WHERE `status` = 'running' ORDER BY RAND() LIMIT 1");
    $q->execute();
    $ad = $q->fetch();
    $q = $db->prepare("SELECT * FROM users WHERE id = :id");
    $q->bindParam(':id', $ad["adOwner"], PDO::PARAM_INT);
    $q->execute();
    $user = $q->fetch();
    if(!$user) $ban = true;
    $q = $db->prepare("SELECT * FROM bans WHERE userid = :id");
    $q->bindParam(':id', $ad["adOwner"], PDO::PARAM_INT);
    $q->execute();
    $ban = $q->fetch();
    if($ban["typeBan"] === "None") $ban = false;
}
?>
<div style="position:relative; text-align:center;">
    <div style="position: relative; display: inline-block;">
        <a href="<?php echo addslashes($ad["adurl"]); ?>" title="<?php echo filterText(addslashes($ad["adtitle"])); ?>">
            <img style="border:solid 1px #000;width:728px;height:90px;" src="<?php echo addslashes($ad["adimg"]); ?>">
        </a>
        <a href="javascript:alert('Not done yet');" style="position:absolute; background-color:#EEE; border:solid 1px #000; color:blue; font-family:Verdana; font-size:10px; font-weight:lighter; bottom:0; right:0; padding-bottom:1px;">
            [ report ]
        </a>
    </div>
</div>