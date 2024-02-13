<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
if(isset($_GET['ID'])){
$id = (int)filter_var($_GET["ID"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);
} else {
$id = 0;
}
if(
    $id === 3 ||
    $id === 68
) {
    // echo "<img style='position: fixed;z-index: -999;width: 100%;height: 100%;margin: -8;' src='https://media.discordapp.net/attachments/1131541893419900939/1203673218901213244/attachment.png?ex=65d1f30a&is=65bf7e0a&hm=6f793d3d9115010d666df9809f75b41450f50355277f56ed25eb7ea871a29e54&=&format=webp&quality=lossless'><h1>This page (user $id) has been eaten by EAT SLEEP MADBLOX fatass.</h1>";exit;
}
$banned = false;
$q = $db->prepare("SELECT * FROM bans WHERE userid = :id");
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();
$ban = $q->fetch();
if($ban && $ban["typeBan"] !== "None") {
    header('location: /Error.aspx?code=404');exit;
}
if (!isset($_GET['ID'])) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/My/Home.php');
} else {
    $searchuser = $db->prepare("SELECT * FROM users WHERE id=?");
    $searchuser->execute([$id]);
    $search = $searchuser->rowCount();
    require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');
    if($search < 1){
        header("location: /Browse.aspx");
        exit;
    } else {
        $user = $searchuser->fetch(PDO::FETCH_ASSOC);
        $blurb = filterText(htmlspecialchars($user['blurb']));
	$blurb = str_replace('{tix}', $user["tickets"], $blurb);
	$blurb = str_replace('{madbux}', $user["mlgbux"], $blurb);
        
        if($loggedin == "yes"){ $findifyouviewedq = $db->prepare("SELECT * FROM profileviews WHERE user_from = ? AND user_to = ?");
        $findifyouviewedq->execute([$_USER['id'], $user['id']]);
        $findifyouviewed = $findifyouviewedq->rowCount();

        if ($findifyouviewed < 1) {
            $viewq = $db->prepare("INSERT IGNORE INTO profileviews (id, user_from, user_to, timeViewed) VALUES (NULL, :me, :him, NOW())");
            $viewq->execute(array(":me" => $_USER['id'], ":him" => $user['id']));
        } }

        $profileviewsq = $db->prepare("SELECT * FROM profileviews WHERE user_to = ?");
        $profileviewsq->execute([$id]);
        $profileviews = $profileviewsq->rowCount();

        $profileviewslastweekq = $db->prepare("SELECT * FROM profileviews WHERE timeViewed >= NOW() - INTERVAL 1 WEEK AND timeViewed < NOW() AND user_to = ?");
        $profileviewslastweekq->execute([$id]);
        $profileviewslastweek = $profileviewslastweekq->rowCount();

    }
?>
<style>
#ProfilePane {
    background: <?php if($_USER["theme"] === "dark") { echo "transparent"; } else { echo "lightsteelblue"; } ?>;
}
#UserPlaces h4 {
    background-color: #6e99c9;
    color: #fff;
    font-family: Verdana,Sans-Serif;
    font-size: 1.4em;
    font-weight: 400;
    letter-spacing: .1em;
    line-height: 1.5em;
    margin: 0;
}
#UserAssetsPane #UserAssets h4, #UserBadgesPane #UserBadges h4, #UserStatisticsPane #UserStatistics h4, #FavoritesPane #Favorites h4 {
    background-color: #ccc;
    border-bottom: solid 1px #000;
    color: #333;
    font-family: Comic Sans MS,Verdana,Sans-Serif;
    margin: 0;
    text-align: center;
}
#FriendsPane, #FavoritesPane {
    clear: right;
    margin: 10px 0 0;
    background: #fff;
}
#FavoritesPane{
    color: #000;
	border: solid 1px #000;
}
#FavoritesContent {
    background: #eee;
}
#UserPlaces .PanelFooter, #Favorites .PanelFooter {
    background-color: #fff;
    border-top: solid 1px #000;
    color: #333;
    font-family: Verdana,Sans-Serif;
    margin: 0;
    padding: 3px;
    text-align: center;
}
</style>
<div id="Body">
<div id="UserContainer">
	<div id="LeftBank">
		<div id="ProfilePane">
			<table width="442" cellspacing="0" cellpadding="6">
				<tbody>
					<tr>
						<td>
														<span class="Title"><?=htmlspecialchars($user['username'])?></span><br>
								 
							<?php
							 $onlinetext = ($user['lastseen'] + 300 >= time()) ? "<span class='UserOnlineMessage'>[ Online: Website ]</span>" : "<span class='UserOfflineMessage'>[ Offline ]</span>";
                            echo 
    $onlinetext;
							?></td>
					</tr>
					<tr>
						<td>
														<span><?=htmlspecialchars($user['username'])?>'s <?=$sitename?>:</span><br>
							<a href="/User.aspx?ID=<?=$user['id']?>">https://<?=$sitedomain?>/User.aspx?ID=<?=$user['id']?></a><br>
							<br>
							<div style="left: 0px; float: left; position: relative; top: 0px">
								<a disabled="disabled" title="<?=$user['username']?>" onclick="return false" style="display:inline-block;"><img src="/img/user/<?=$user['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>" style="height:225px;width:190px;" id="img" alt="<?=htmlspecialchars($user['username'])?>" border="0"></a><br>
								<div class="ReportAbusePanel">
									<a href="/report/?id=25&amp;type=3"><span class="AbuseIcon"><img src="/images/abuse.gif" alt="Report Abuse" border="0"></span>
									<span class="AbuseButton">Report Abuse</span></a>
								</div>
							</div>
							<p><a href="/My/PrivateMessage.aspx?RecipientID=<?=$user['id']?>">Send Message</a></p><p><a href="/api/user/addFriend?userto=<?=$user['id']?>">Send Friend Request</a></p>														<p style="width:430px;"><span style="white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word;"><?php echo $blurb; ?></span></p>
													</td>
					</tr>
				</tbody>
			</table>
					</div>
				<div id="UserPageLargeRectangleAd">
			<div id="RobloxLargeRectangleAd">
							</div>
		</div>
				<div id="UserBadgesPane">
		<div id="UserBadges">
				<h4><a href="/Badges.aspx">Badges</a></h4>
                    <?php if($user["USER_PERMISSIONS"] === "Administrator") { ?>
                    <div class="Badge">
                        <div class="BadgeImage">
                            <img src="/images/madbloxadmin.png" width="75" height="75" title="This badge is given to administrators on the site." alt="Administrator"><br>
                            <div class="BadgeLabel">
                                <a href="/Badges.aspx">Administrator</a>
                            </div>
                        </div>
			        </div>
                    <?php } else { ?>
					This user doesn't have any <?=$sitename?> badges
                    <?php } ?>
                <table cellspacing="0" border="0" align="Center">
					<tbody></tbody>
				</table>
			</div>
		</div>
		<div id="UserStatisticsPane">
			<div id="UserStatistics">
				<div id="StatisticsPanel" style="transition: height 0.5s ease-out; overflow: hidden; height: 200px;">
					<h4>Statistics</h4>			
					<div style="margin: 10px 10px 150px 10px;" id="Results">
						<div class="Statistic">
							<div class="Label"><acronym title="The number of this user's friends.">Friends</acronym>:</div>
							<div class="Value"><span>2 (2 last week)</span></div>
						</div>
												<div class="Statistic">
							<div class="Label"><acronym title="The number of posts this user has made to the <?=$sitename?> forum.">Forum Posts</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
							<div class="Value"><span><?=$profileviews?> (<?=$profileviewslastweek?> last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's place has been visited.">Place Visits</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's models have been viewed - unfinished.">Model Views</acronym>:</div>
							<div class="Value"><span>TODO</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's character has destroyed another user's character in-game.">Knockouts</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's character has been destroyed in-game.">Wipeouts</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of this user's MADBUX.">MADBUX</acronym>:</div>
							<div class="Value"><span><?php echo (int)$user["mlgbux"]; ?></span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of this user's Tickets.">Tickets</acronym>:</div>
							<div class="Value"><span><?php echo (int)$user["tickets"]; ?></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="RightBank">
		
										<div id="UserPlacesPane">
					<p style="padding: 10px 10px 10px 10px;">This person doesn't have any <?=$sitename?> places.</p>       </div>		<div id="FriendsPane">
			<div id="Friends">
			<?php
$frs = $db->prepare("SELECT * FROM friends WHERE user_to=:id AND areFriends=1 OR user_from=:id AND areFriends=1");
$frs->execute([':id' => $user['id']]);
$frrr = $frs->rowCount();

$maxRows = 6;
$rowCount = 0;
$roww = 0;
?>

<h4><?=htmlspecialchars($user['username'])?>'s friends <a href="/Friends.aspx?UserID=<?=$user['id']?>">See all <?= $frrr ?></a></h4>
<table cellspacing="0" align="center" border="0" style="border-collapse:collapse;">
    <tbody>
        <tr>
        <?php
if ($frs->rowCount() < 1) {
    echo ("<p style='padding: 10px 10px 10px 10px;'>This person does not have any $sitename friends.</p>");
} else {
    $rowLimit = 6;
    $rowCounter = 0;

    while ($b = $frs->fetch(PDO::FETCH_ASSOC)) {
        if ($b['user_from'] == $user['id']) {
            $friendid = $b['user_to'];
        } else {
            $friendid = $b['user_from'];
        }
        $userq = $db->prepare("SELECT * FROM users WHERE id=:id");
        $userq->execute([":id" => $friendid]);
        $row = $userq->fetch(PDO::FETCH_ASSOC);

        echo "<td><div class=\"Friend\">
                <div class=\"Avatar\">
                    <a title=\"{$row['username']}\" href=\"/User.aspx?ID=$friendid\" style=\"display:inline-block;max-height:100px;max-width:100px;cursor:pointer;\">
                        <img src=\"/img/user/" . $row['id'] . ".png?rand=" . random_int(1, 999999999999999999) . "\" width=\"95\" border=\"0\" alt=\"".addslashes($row['username'])."\" blankurl=\"http://t6.roblox.com:80/blank-100x100.gif\">
                    </a>
                </div>
                <div class=\"Summary\">
                    <span class=\"OnlineStatus\">";
                    
        $onlinetest = ($row['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
        echo "$onlinetest</span>

                    <span class=\"Name\"><a href=\"/User.aspx?ID=$friendid\">".htmlspecialchars($row['username'])."</a></span>
                </div>
            </div></td>";

        $total++;
        $rowCounter++;

        if ($rowCounter >= $rowLimit) {
            break; 
        }

        if ($rowCounter % 3 == 0) {
            echo "</tr><tr>"; 
        }
    }
}
?>



        </tr>
    </tbody>
</table>

            </h4>          
<div class="columns"></div>
											</div>
		</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div id="FavoritesPane">
    <div id="Favorites">
        <h4>Favorites</h4>
        <div id="FavoritesContent">
            <div class="HeaderPager"></div>
            <table cellspacing="0" border="0" style="margin:auto;">
                <tbody>
                </tbody>
            </table>
            <div class="FooterPager"></div>
        </div>
        <div class="PanelFooter">
            Category:&nbsp;
            <select id="FavCategories">
                <option value="7">Heads</option>
                <option value="8">Faces</option>
                <option value="2">T-Shirts</option>
                <option value="5">Shirts</option>
                <option value="6">Pants</option>
                <option value="1">Hats</option>
                <option value="4">Decals</option>
                <option value="3">Models</option>
                <option selected="selected" value="0">Places</option>
            </select>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        function loadContent(wtype) {

            var id = getParameterByName('ID');

            switch (wtype) {
                case '7':
                    console.log('Heads selected');
                    wtype = "head";
                    break;
                case '8':
                    console.log('Faces selected');
		    wtype = "face";
                    break;
                case '2':
                    console.log('T-Shirts selected'); 
                    wtype = "tshirt";
                    break;
                case '5':
                    console.log('Shirts selected');
                    break;
                case '6':
                    console.log('Pants selected');
                    wtype = "pants";
                    break;
                case '1':
                    console.log('Hats selected');
                    wtype = "hat";
                    break;
                case '4':
                    console.log('Decals selected');
                    break;
                case '3':
                    console.log('Models selected');
                    break;
                case '0':
                    console.log('Places selected');
                    break;
                default:
                    console.log('Default action');
                    break;
            }

            $.ajax({
                url: '/api/user/getfavorites.php',
                type: 'GET',
                data: { id: id, wtype: wtype },
                success: function (responseData) {
                    $('#FavoritesContent table tbody').html(responseData);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        $('#FavCategories').change(function () {
            var selectedWtype = $(this).val();
            loadContent(selectedWtype);
        });

        loadContent('0');
    });
</script>




</div>
<div style="clear:both"></div>
<?php require("core/footer.php"); }
?>
