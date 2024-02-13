<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php"); 
$stmt = $db->prepare('SELECT * FROM ads WHERE adOwner=?');
$stmt->execute([$_USER['id']]);

if($loggedin !== "yes"){
    header("/Login/Default.aspx");
    exit;
}

?>
<div id="Body">
<div id="confirmAdRemovalFade" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
    <div id="confirmAdRemoval" class="anim" style="max-width: 325px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
		<div style="background-color: #FFFFE0; border:3px solid gray; box-shadow: black 5px 5px;">
			<form method="post" id="verifybid" style="margin: 1.5em;">
			    <h2>Remove Ad:</h2>
                <p>Are you sure you want to delete this ad?</p>
                <img style="max-width:275px; max-height:275px; display:block; margin:auto;" id="adimgconfirmremove">
                <br>
                <button type="submit" name="removead" id="rab" class="MediumButton" style="width:100%;" disabled="">Remove</button>
                <br><br>
                <input type="button" value="Cancel" onclick="$('#confirmAdRemovalFade').hide();" class="MediumButton" style="width:100%;">
			</form>
		</div>
	</div>
</div>
<font face="Verdana" size="small">For a detailed explanation of how advertising on <?=$sitename?> works, check out the <a href="/">How Advertising Works</a> article in the help section.
</font>
<br>
<br>
<?php
foreach ($stmt as $ad) {
    $a = $db->prepare("SELECT * FROM games WHERE id=?");
    $a->execute([$ad['gameId']]);
    $game = $a->fetch(PDO::FETCH_ASSOC);
?>
<div class="AdInfo" style="border:1px solid black;position:relative;height:auto;margin-bottom:5px;background-color:white;min-height: 150px;">
    <div style="position:absolute;right:8px;top:5px;">
        Ad Status:
        <br> 
        <?php if($ad['status'] == "stopped"){ ?><div style="margin-top:20px"><img src="/images/AdStopped.png"></div>
        <br>
        Not Running        <div style="position:absolute;right:8px;bottom:-7px;">
            <a href="RunAd.aspx?adId=<?=$ad['id']?>">Run Ad</a> <?php } else { ?> <div style="margin-top:20px"><img src="/images/AdRunning.png"></div>
        <br>
        Running        <div style="position:absolute;right:8px;bottom:-7px;">
            <a href="StopAd.aspx?adId=<?=$ad['id']?>">Stop Ad</a> <?php } ?><br>            <a href="#" onclick="">Remove</a>        </div>
        <br><br><br>
    </div>
    <b style="margin-left:5px;">Ad: <?=$ad['adTitle']?></b>
    <br>
    <img style="margin-left:5px;width: 728px;height:90px;" id="adimg648" src="<?=$ad['adimg']?>"><br>
    <a style="margin-left:5px;" href="/PlaceItem.aspx?ID=<?=$game['id']?>"><?=$game['name']?></a><br>
</div>
<?php
}
?>
				</div>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/footer.php"); ?>