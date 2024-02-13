<?php
include 'core/head.php';

$id = filter_var($_GET["id"] ?? $_GET["ID"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);

$sql = "SELECT * FROM catalog WHERE id = :id;";
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$resultCheck = $stmt->rowCount();

$thumbnailURL = "/images/reviewpending.png";
$type = $result["type"];
if ($result['status'] === 'Accepted') {
	if($type === "tshirt" || $type === "face") {
		$thumbnailURL = $result["filename"];
	} elseif($type === "hat" || $type === "head" || $type === "shirt") {
		$thumbnailURL = "/img/catalog/".$type."s/".(int)$result["id"].".png?rand=".random_int(1,999999999999999999);
	} else {
		$thumbnailURL = "/img/catalog/".$type."/".(int)$result["id"].".png?rand=".random_int(1,999999999999999999);
	}
} else if($result["status"] === "Declined") {
    $thumbnailURL = "/images/declined.png";
}

if ($resultCheck > 0) {
    $type = "";
    if ($result['type'] == "hat") $type = "Hat";
    if ($result['type'] == "hair") $type = "Hair";
    if ($result['type'] == "shirt") $type = "Shirt";
    if ($result['type'] == "pants") $type = "Pants";
    if ($result['type'] == "gear") $type = "Gear";
    if ($result['type'] == "tshirt") $type = "T-Shirt";
    if ($result['type'] == "face") $type = "Face";
    if ($result['type'] == "package") $type = "Package";

    $creatorq = $db->prepare("SELECT * FROM users WHERE id=:creatorid");
    $creatorq->bindValue(':creatorid', $result['creatorid'], PDO::PARAM_INT);
    $creatorq->execute();
    $creator = $creatorq->fetch(PDO::FETCH_ASSOC);

    $numbersq = $db->prepare("SELECT * FROM comments WHERE assetid = :id");
    $numbersq->bindValue(':id', $id, PDO::PARAM_INT);
    $numbersq->execute();
    $numbers = $numbersq->rowCount();

    $owneditemsq = $db->prepare("SELECT * FROM owneditems WHERE itemid=:itemid AND ownerid=:ownerid");
    $owneditemsq->bindValue(':itemid', $result['id'], PDO::PARAM_INT);
    $owneditemsq->bindValue(':ownerid', $_USER['id'], PDO::PARAM_INT);
    $owneditemsq->execute();
    $owneditems = $owneditemsq->fetch(PDO::FETCH_ASSOC);
    $owned = ($owneditems) ? 'yes' : 'no';

    $row = $result;

$da = $db->prepare("SELECT * FROM favorites WHERE userid=? AND itemid=?");
$da->execute([$_USER['id'], $row['id']]);
$d = $da->rowCount();

    if($row['type'] == "tshirt"){ $lolo = "250"; } else { $lolo = "120"; }

    if($row['type'] == "hat"){ $typea = "hats"; } elseif($row['type'] == "pants"){ $typea = "pants"; } elseif($row['type'] == "shirt"){ $typea = "shirts"; } elseif($row['type'] == "pants"){ $typea = "pants"; } elseif($row['type'] == "head"){ $typea = "heads"; }
?>
<style>
    #Item {
        font-family: Verdana, Sans-Serif;
        padding: 10px;
    }

    #ItemContainer {
        background-color: #eee;
        border: solid 1px #555;
        color: #555;
        margin: 0 auto;
        width: 620px;
    }

    #Actions {
        background-color: #fff;
        border-bottom: dashed 1px #555;
        border-left: dashed 1px #555;
        border-right: dashed 1px #555;
        clear: left;
        float: left;
        padding: 5px;
        text-align: center;
        min-width: 0;
        position: relative;
    }

    .PlayGames {
        background-color: #ccc;
        border: dashed 1px Green;
        color: Green;
        float: right;
        margin-top: 10px;
        padding: 10px 5px;
        text-align: right;
        width: 325px;
    }
</style>
<br>
<div id="ItemContainer" style="float:left;width: 720px;">
    <h2><?php echo filterText(htmlspecialchars($result['name'])); ?></h2>
    <div id="Item">
        <div id="Thumbnail">
            <a title="<?php echo filterText(addslashes($result['name'])); ?>"
                style="display:inline-block; <?php if($row['type'] == "tshirt"){?>background-image: url(/images/tshirt.png); background-size: <?=$lolo?>px <?=$lolo?>px; height: <?=$lolo?>px; width: <?=$lolo?>px;<?php } ?>"><?php if($row['type'] == "tshirt"){ ?> <center> <?php } ?><img
                    src="<?=$thumbnailURL?>"
                    border="0" id="img" alt="<?php echo filterText(htmlspecialchars($result['name'])); ?>"
                    blankurl="http://t6.roblox.com:80/blank-250x250.gif"
                    style="<?php if($row['type'] !== "tshirt"){ ?>display:inline-block;height:250px;width:250px;<?php } else { ?> height: 130px; width: 130px; margin-top: 65px;<?php } ?>"><?php if($row['type'] == "tshirt"){ ?> </center> <?php } ?></a>
        </div>
        <div id="Summary">
            <h3><?= $sitename ?> <?= $type ?></h3>
            <div
                id="<?php if ($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; } ?>Purchase">
                <?php if ($owned == 'no') { ?>
                <?php if ($result['offsale'] == '0') { ?><div
                    id="PriceIn<?php if ($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; } ?>">
                    <?php if ($result['buywith'] == 'tix') {echo 'Tx';} else {echo 'M$';} ?>: <?php echo $result['price']; ?>
                </div>
                <div id='BuyWith<?php if ($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; } ?>'>
                    <a onclick='showPurchaseDiag(0);' class='Button'>Buy with <?php if ($result['buywith'] == 'tix') {echo 'Tx';} else {echo 'M$';} ?></a>
                </div><?php } ?> <?php } else { ?>
                <div id="PriceIn<?php if ($result['buywith'] == 'tix') { echo 'Tickets'; } else { echo 'Robux'; } ?>">
                    You already own this item!
                </div>
                <?php } ?>
            </div>
            <br><br>
            <div id="Creator"><br><a
                    href="/User.aspx?ID=<?php echo $creator['id']; ?>"><img
                        src="/img/user/<?=$creator['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>" frameborder="0"
                        scrolling="no" width="84" height="100"></img></a><br><span
                    style="color:#555;">Creator: </span><a
                    href="/User.php?ID=<?php echo (int)$creator['id']; ?>"><?php echo htmlspecialchars($creator['username']); ?></a></div>
            <div id="LastUpdate">Updated: </div>
            <div id="Favourites">Favorited: 0 times</div>
            <div>
                <div id="DescriptionLabel">Description:</div>
                <div id="Description"><?php echo filterText(htmlspecialchars($result['description'])); ?></div>
            </div>
            <p>
            </p>
            <div class="ReportAbusePanel">
                <span class="AbuseIcon"><a><img src="/images/abuse.gif" alt="Report Abuse"
                            style="border-width:0px;"></a></span>
                <span class="AbuseButton"><a>Report Abuse</a></span>
            </div>
            <p></p>
        </div>
        <div id="Actions" style="width:240px;">
            <a href="/api/user/<?php if($d > 0){ ?>Un<?php } ?>FavoriteItem.php?itemid=<?=$result['id']?>"><?php if($d < 1){ ?>Favorite<?php }else{?> Unfavorite <?php } ?> </a>
        </div>
        <div style="clear: both;"></div>
        <?php if ($_USER['USER_PERMISSIONS'] == 'Administrator' || $creator['id'] == $_USER['id']) { ?>
        <a id="ctl00_cphRoblox_RemoveFromInventoryButton" class="Button"
            href="/api/RenderItems.php?id=<?= $result['id']; ?>">Render The Item</a>
        <?php } ?>
        <?php if($result['creatorid'] == $_USER['id']){ ?>
            <div id="Configuration">
        <a href="/my/Item.aspx?ID=<?=$result['id']?>">Edit <?=$type?></a>

      </div><div style="clear: both;"></div><div id="Configuration"><a href="/my/NewUserAd.aspx?targetId=<?=$result['id']?>">Advertise <?php if($result['type'] == "pants"){ echo 'These'; } else { echo 'This'; } ?> <?=$type?></a>
        </div> <br><?php } ?>
        <?php if ($owned == 'yes' && $result['creatorid'] !== $_USER['id']) { ?>
        <div id="Ownership">
            <a id="ctl00_cphRoblox_RemoveFromInventoryButton" class="Button"
                href="javascript:__doPostBack('ctl00$cphRoblox$RemoveFromInventoryButton','')">Delete from My
                Stuff</a>
        </div><div style="clear: both;">
		</div>
        <?php } ?>
       <div id="ctl00_cphRoblox_CommentsPane_CommentsUpdatePanel">

    <div class="CommentsContainer">

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <div style="/* margin: 10px; width: 703px; */">
      <div class="ajax__tab_xp ajax__tab_container ajax__tab_default" id="TabbedInfo">
        <div id="TabbedInfo_header" class="ajax__tab_header">
          <span id="__tab_TabbedInfo_CommentaryTab" >
            <span><span><a id="__tab_TabbedInfo_CommentaryTab" href="#" style="text-decoration:none;"><h3>Commentary</h3></a></span></span>
          </span>
        </div>
                    <?php
                    $sql = "SELECT * FROM comments WHERE assetid=:id ORDER BY time_posted DESC";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    $resultCheck = count($result);

echo '<div id="TabbedInfo_body" class="ajax__tab_body">';
echo '<div id="TabbedInfo_CommentaryTab" class="ajax__tab_panel">';
echo '<div id="TabbedInfo_CommentaryTab_CommentsPane_CommentsUpdatePanel">';
echo '<h3>Comments ('.$numbers.')</h3>';
echo '<div class="CommentsContainer">';

                    if ($resultCheck > 0) {
echo '<div class="Comments">';
                        foreach ($result as $row) {
                            $creatorq = $db->prepare("SELECT * FROM users WHERE id=:userid");
                            $creatorq->bindValue(':userid', $row['userid'], PDO::PARAM_INT);
                            $creatorq->execute();
                            $creatord = $creatorq->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <div class="Comment">
                        <div class="Commenter">
                            <div class="Avatar">
                                <a id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AvatarImage"
                                    title="<?php echo htmlspecialchars($creatord['username']); ?>"
                                    href="/User.aspx?ID=1"
                                    style="display:inline-block;height:64px;width:64px;cursor:pointer;"><img
                                        src="/img/user/<?=$creatord['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>"
                                        width="65" height="65" border="0" id="img"
                                        alt="<?php echo htmlspecialchars($creatord['username']); ?>"></a>
                            </div>
                        </div>
                        <div class="Post">
                            <div class="Audit">
                                Posted
                                <?php

$timestamp = $row['time_posted'];

$currentTimestamp = time();

date_default_timezone_set('UTC');

$timeDifference = $currentTimestamp - $timestamp;

if ($timeDifference >= 31536000) {
    // More than a year
    $yearsAgo = floor($timeDifference / 31536000);
    echo $yearsAgo . ' year' . ($yearsAgo > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference >= 2419200) {
    // More than a month
    $monthsAgo = floor($timeDifference / 2419200);
    echo $monthsAgo . ' month' . ($monthsAgo > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference >= 604800) {
    // More than a week
    $weeksAgo = floor($timeDifference / 604800);
    echo $weeksAgo . ' week' . ($weeksAgo > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference >= 86400) {
    // More than a day
    $daysAgo = floor($timeDifference / 86400);
    echo $daysAgo . ' day' . ($daysAgo > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference >= 3600) {
    // More than an hour
    $hoursAgo = floor($timeDifference / 3600);
    echo $hoursAgo . ' hour' . ($hoursAgo > 1 ? 's' : '') . ' ago';
} elseif ($timeDifference >= 60) {
    // More than a minute
    $minutesAgo = floor($timeDifference / 60);
    echo $minutesAgo . ' minute' . ($minutesAgo > 1 ? 's' : '') . ' ago';
} else {
    // Less than a minute
    echo $timeDifference . ' second' . ($timeDifference > 1 ? 's' : '') . ' ago';
}

?>
                                by
                                <a id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_UsernameHyperLink" href="/User.aspx?ID=<?php echo htmlspecialchars($creatord['id']); ?>">
                                    <?php echo htmlspecialchars($creatord['username']); ?>
                                    <?php
                                        $badge = "";
                                        if($creatord["USER_PERMISSIONS"] === "Administrator") $badge = "/images/madbloxadmin.png";
                                    
                                        if(strlen($badge) >= 1) $badge = '<img src="'.$badge.'" style="width: 13px;margin-left: -1px;margin-bottom: -3px;">';

                                        echo $badge;
                                    ?>
                                </a>
                            </div>
                            <div class="Content"><?php echo filterText(htmlspecialchars($row['content'])); ?></div>
                            <div id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_Actions" class="Actions">
                                <div id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AbuseReportButton_AbuseReportPanel"
                                    class="ReportAbusePanel">
                                    <span class="AbuseIcon"><a
                                            id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AbuseReportButton_ReportAbuseIconHyperLink"
                                            href="/AbuseReport/Comment.aspx?ID=114910&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fItem.aspx%3fID%3d1061325%26UserAssetID%3d78142"><img
                                                src="/images/abuse.gif" alt="Report Abuse"
                                                style="border-width:0px;"></a></span>
                                    <span class="AbuseButton"><a
                                            id="ctl00_cphRoblox_CommentsPane_CommentsRepeater_ctl01_AbuseReportButton_ReportAbuseTextHyperLink"
                                            href="/AbuseReport/Comment.aspx?ID=114910&amp;ReturnUrl=http%3a%2f%2fwww.roblox.com%2fItem.aspx%3fID%3d1061325%26UserAssetID%3d78142">Report
                                            Abuse</a></span>
                                </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <?php
                        }
echo '</div>';
                    }
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
                    ?>

                </div>
	<?php if ($loggedin == 'yes') { ?>
            <form action="/postcomment.aspx?id=<?php echo $id; ?>" method="post">
                <div id="ctl00_cphRoblox_CommentsPane_PostAComment" class="PostAComment">
                    <h3>Comment on this <?php echo $type; ?></h3>
                    <div class="CommentText"><textarea name="content" rows="5" cols="20"
                            id="ctl00_cphRoblox_CommentsPane_NewCommentTextBox"
                            class="MultilineTextBox"></textarea></div>
                    <div class="Buttons"><input id="ctl00_cphRoblox_CommentsPane_NewCommentButton" class="Button"
                            type="submit" value="Post Comment"></div>
                </div>
            </form>
            <?php } ?>
            </div>
        </div>

    </div>

</div>

<script>
    var currency;
    var suffTix = true;
    var suffBux = true;

    function showPurchaseDiag(currencyA) {
        $("#VerifyPurchaseTix").hide();
        $("#VerifyPurchaseBux").hide();
        $("#VerifyPurchaseTixIn").hide();
        $("#VerifyPurchaseBuxIn").hide();
        $("#ProcessPurchase").hide();
        $("#PurchaseMessage").hide();
        currency = currencyA
        $("#itemPurchaseFade").show();
        if (currency == 0) {
            if (suffTix) {
                $("#VerifyPurchaseTix").show();
            } else {
                $("#VerifyPurchaseTixIn").show();
            }
        } else {
            if (suffBux) {
                $("#VerifyPurchaseBux").show();
            } else {
                $("#VerifyPurchaseBuxIn").show();
            }
        }
    }
</script>
<?php
    $sql = "SELECT * FROM catalog WHERE id = :id;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultCheck = $stmt->rowCount();

if($result['buywith'] == "robux") {
echo"
<div id='itemPurchaseFade' style='position: fixed; z-index: 1; left: 0px; top: 0px; width: 100%; height: 100%; overflow: auto; background-color: rgba(100, 100, 100, 0.25); display: none;'>
	<div id='itemPurchase' class='anim' style='max-width: 325px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);'>
		<div style='background-color: #FFFFE0; border:3px solid gray; box-shadow: black 5px 5px;'>";
if($_USER['mlgbux'] >= $result['price']) {
        echo "<div id='VerifyPurchaseRobux' style='margin: 1.5em; display: block;'>
				<h3>Purchase Item:</h3><br>
			<p>Would you like to purchase ".htmlspecialchars($result['type'])." ".filterText(htmlspecialchars($result['name']))." from ".htmlspecialchars($creator['username'])." for ".htmlspecialchars($result['price'])."?</p>
				<p>Your balance MLGBUX: {$_USER['mlgbux']}.</p>
				<br><form method='POST' action='/buyitem.aspx?id=".$result['id']."'>
				<input type='submit' value='Buy Now!' name='buy_new' onclick='buyItem()' class='MediumButton' style='width:100%;'></form>
				<br>
				<input type='submit' name='oof' value='Cancel' onclick='$(&#39;#itemPurchaseFade&#39;).hide();' class='MediumButton' style='width:100%;'>
			</div>";
        }
        else{
        echo "<div id='VerifyPurchaseTix' style='margin: 1.5em; display:none;'>
				<h3>Insufficient Funds</h3>
				<p>You need more Robux to purchase this item.</p>
				<p><input type='submit' name='oof' value='Cancel' onclick='$(&#39;#itemPurchaseFade&#39;).hide();' class='MediumButton' style='width:100%;'></p>
			</div>";
        }
}else{
echo"
<div id='itemPurchaseFade' style='position: fixed; z-index: 1; left: 0px; top: 0px; width: 100%; height: 100%; overflow: auto; background-color: rgba(100, 100, 100, 0.25); display: none;'>
	<div id='itemPurchase' class='anim' style='max-width: 325px; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);'>
		<div style='background-color: #FFFFE0; border:3px solid gray; box-shadow: black 5px 5px;'>";
if($_USER['tickets'] >= $result['price']) {
        echo "<div id='VerifyPurchaseTix' style='margin: 1.5em; display: block;'>
				<h3>Purchase Item:</h3><br>
				<p>Would you like to purchase ".htmlspecialchars($result['type'])." ".filterText(htmlspecialchars($result['name']))." from ".htmlspecialchars($creator['username'])." for ".htmlspecialchars($result['price'])."?</p>
				<p>Your balance Tickets: {$_USER['tickets']}.</p>
				<br><form method='POST' action='/buyitem.aspx?id=".$result['id']."'>
				<input type='submit' value='Buy Now!' name='buy_new' onclick='buyItem()' class='MediumButton' style='width:100%;'></form>
				<br>
				<input type='submit' name='oof' value='Cancel' onclick='$(&#39;#itemPurchaseFade&#39;).hide();' class='MediumButton' style='width:100%;'>
			</div>";
        }
        else{
        echo "<div id='VerifyPurchaseTix' style='margin: 1.5em; display:none;'>
				<h3>Insufficient Funds</h3>
				<p>You need more Tickets to purchase this item.</p>
				<p><input type='submit' name='oof' value='Cancel' onclick='$(&#39;#itemPurchaseFade&#39;).hide();' class='MediumButton' style='width:100%;'></p>
			</div>";
        }
}
?>
<div style="clear:both;"></div>

<?php } else {header('location: /Catalog.aspx');} ?>