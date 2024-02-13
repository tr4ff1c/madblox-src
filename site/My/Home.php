<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php");
if ($loggedin == 'no') {
    header("location: /");
    exit;
}
?>
<div id="Body">
<div id="UserContainer">
	<div id="LeftBank">
		<div id="ProfilePane">
			<table width="100%" cellpadding="6" cellspacing="0">
				<tbody>
					<tr>
						<td>
														<font face="Verdana" id="1"><span class="Title">Hi, <?=htmlspecialchars($_USER['username'])?>!</span><br></font>
													</td>
					</tr>
					<tr>
						<td>
														<font face="Verdana" id="2">
								<span>Your <?=$sitename?>:</span><br>
								<a href="/User.aspx?ID=<?=$_USER['id']?>">https://<?=$sitedomain?>/User.aspx?ID=<?=$_USER['id']?></a>
								<br>
								<br>
								<div style="left: 0px; float: left; position: relative; top: 0px;margin-top:67px;margin-left:10px">
									<a disabled="disabled" title="<?=$_USER['username']?>" onclick="return false" style="display:inline-block;height:220px;width:180px;">
										<img src="/img/user/<?=$_USER['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>" border="0" style="height:225px;width:190px;" id="img" alt="<?=$_USER['username']?>">
									</a>
									<br>
								</div>
								<div style="float:right;text-align:left;width:210px;">
									<font face="Verdana" id="3">
									<p><a href="/My/Messages/Inbox">Inbox</a>&nbsp;</p>
									<p><a href="/My/Character">Change Character</a></p>
									<p><a href="/My/Profile.aspx">Edit Profile</a></p>
									<p><a href="/Upgrades/BuildersClub.aspx">Account Upgrades</a>&nbsp;</p>
									<p><a href="/My/AccountBalance">Account Balance</a></p>
									<p><a href="/User.aspx?ID=<?=$_USER['id']?>">View Public Profile</a></p>
									<p>
																				<a href="/games/create">Create New Place</a> 
																				<br>
										(1 Remaining)
									</p>
									<p><a href="/my/InviteAFriend.aspx">Share <?=$sitename?></a></p>
									<p><a href="/Upgrades/Madbux.aspx">Buy MADBUX</a></p>
									<p><a href="/my/accountbalance/trade">Trade Currency</a></p>
									<p><a href="/my/AdInventory.aspx">Ad Inventory</a></p>
									<p><a href="/info/TermsOfService.aspx">Terms, Conditions, and Rules</a></p>
									</font>
								</div>
							</font>
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
				<table cellspacing="0" border="0" align="Center">
					<tbody>
					<tr>              <td></td><td>
                    <?php if($_USER["USER_PERMISSIONS"] === "Administrator") { ?>
                    <div class="Badge">
                        <div class="BadgeImage">
                            <img src="/images/madbloxadmin.png" width="75" height="75" title="This badge is given to administrators on the site." alt="Administrator"><br>
                            <div class="BadgeLabel">
                                <a href="/Badges.aspx">Administrator</a>
                            </div>
                        </div>
			        </div>
                    <?php } else { ?>
					You don't have any <?=$sitename?> badges
                    <?php } ?>
			  </div></td>
      <td>					</td></tr></tbody>
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
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
												<div class="Statistic">
							<div class="Label"><acronym title="The number of posts this user has made to the GOLDBLOX forum.">Forum Posts</acronym>:</div>
							<div class="Value"><span>0 (0 last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
							<?php
							$id = $_USER['id'];

        $profileviewsq = $db->prepare("SELECT * FROM profileviews WHERE user_to = :id");
        $profileviewsq->execute([':id' => $id]);
        $profileviews = $profileviewsq->rowCount();

        $profileviewslastweekq = $db->prepare("SELECT * FROM profileviews WHERE timeViewed >= NOW() - INTERVAL 1 WEEK AND timeViewed < NOW() AND user_to = :id"); // Fixed SQL syntax lmfao
        $profileviewslastweekq->execute([':id' => $id]);
        $profileviewslastweek = $profileviewslastweekq->rowCount();
							?>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="RightBank">
		
					<div id="UserPlacesPane">
					<p style="padding: 10px 10px 10px 10px;">You doesn't have any <?=$sitename?> places.</p>       </div>		<div id="FriendsPane"><div id="Friends">
					<?php
$frs = $db->prepare("SELECT * FROM friends WHERE user_to=:id AND areFriends=1 OR user_from=:id AND areFriends=1 LIMIT 0, 6");
$frs->execute([':id' => $_USER['id']]);

$frss = $db->prepare("SELECT * FROM friends WHERE user_to=:id AND areFriends=1 OR user_from=:id AND areFriends=1");
$frss->execute([':id' => $_USER['id']]);
$frrr = $frss->rowCount();

$maxRows = 6;
$rowCount = 0;
$roww = 0;
?>

<h4>My friends <a href="/Friends.aspx?UserID=<?=$_USER['id']?>">See all <?= $frrr ?></a> (<a href="/my/EditFriends.aspx">Edit</a>)</h4>
<table cellspacing="0" align="center" border="0" style="border-collapse:collapse;">
    <tbody>
        <tr>
            <?php
            if ($frs->rowCount() < 1) {
                echo ("<p style='padding: 10px 10px 10px 10px;'>You don't have any $sitename friends.</p>");
            } else {
                while ($b = $frs->fetch(PDO::FETCH_ASSOC)) {
                    if ($b['user_from'] == $_USER['id']) {
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
                                <img src=\"/img/user/" . $row['id'] . ".png?rand=" . random_int(1, 999999999999999999) . "\" width=\"95\" border=\"0\" alt=\"{$row['username']}\" blankurl=\"http://t6.roblox.com:80/blank-100x100.gif\">
                            </a>
                        </div>
                        <div class=\"Summary\">
                            <span class=\"OnlineStatus\">";
                            
                    $onlinetest = ($finfo['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
                    echo "$onlinetest</span>

                            <span class=\"Name\"><a href=\"/User.aspx?ID=$friendid\">{$row['username']}</a></span>
                        </div>
                    </div></td>";

                    $total++;
                    $roww++;

                    if ($roww >= 3) {
                        echo "</tr><tr>";
                        $roww = 0;
                    }
                }
            }
            ?>
        </tr>
    </tbody>
</table>

<style>
fix {
    display: table-cell;
    vertical-align: inherit;
}
</style>
<table cellspacing="0" align="Center" border="0" style="border-collapse:collapse;width: 360px;">
          <tbody><tr></tr>
					<tr>
										</tr>
										
				</tbody></table>
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

            var id = <?=$_USER['id']?>;

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
		<div id="FriendRequestsPane">
    <div id="FriendRequests">
      <span id="FriendRequestsHeaderLabel"><h4>My Friend Requests</h4></span>

                                               <table cellspacing="0" border="0" style="border-collapse:collapse;">
        <tbody><tr>
            <?php
            $frs = $db->prepare("SELECT * FROM friends WHERE user_to=:id AND areFriends=0 AND declined=0");
            $frs->execute([':id' => $_USER['id']]);
        if ($frs->rowCount() < 1) {
          echo ("<p style='padding: 10px 10px 10px 10px;'>You don't have any $sitename Friend Requests.</p>");
        }
        ?>
<?php
    while ($fr = $frs->fetch(PDO::FETCH_ASSOC)) {
      $stmt = $db->prepare("SELECT * FROM users WHERE id=:user_id");
      $stmt->bindParam(':user_id', $fr['user_from']);
      $stmt->execute();
      $userar = $stmt->fetch(PDO::FETCH_ASSOC);

      echo "<td>
						<div class='Friend'>
							<div class='Avatar'>
<a href='/My/FriendInvitation?ID=".$fr['id']."'> <img height='100' src='/img/user/".$userar['id'].".png?rand=".random_int(1,999999999999999999)." '> </a>
								
							</div>
							<div class='Summary'>
															<span class=\"OnlineStatus\">
							";													
							$onlinetest = ($userar['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
							echo"$onlinetest</span>
								<span class='Name'>
									<a title='Click to view this invitation' href='/my/FriendInvitation.aspx?ID={$fr['id']}'>".$userar['username']."</a><br>    <br>
								</span>
							</div>
						</div>
					</td>";
    }
    ?>
      </tr>
      </tbody></table>
    </div>
  </div>
    </div>
  </div>
			

				</div>
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
<style>
.modalBackground {
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(100,100,100,0.25);
	opacity: 1;
}
.modalPopup {
    color: black;
    background-color: #ffffdd;
    border-width: 3px;
    border-style: solid;
    border-color: Gray;
    padding: 3px;
    box-shadow: 5px 5px;
    text-align: center;
    width: 27em;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}
</style>